<?php

namespace App\Http\Controllers\Partnerpanel;


use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use View;
use Session;
use Validator;
use Auth;
use DB;
use Redirect;
use Hash;
use File;
use Mail;
use Schema;
use Carbon\Carbon;
use Arr;

//Models
use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\Vendor;
use App\Models\Vendor_Project_info;
use App\Models\ChildCategory;
use App\Models\Requirements;
use App\Models\Vendor_Wishlist;
use App\Models\Vendor_Bids;
use App\Models\Category;
use App\Models\Ticketing_Category;
use App\Models\Notifications;
use App\Models\Testimonials;
use App\Models\Subscriber;
use App\Models\Subscription;
use App\Models\Customer;

//Mails
use App\Mail\ticketraise;
use App\Mail\ticketraisevendor;
use App\Mail\requesttestimonial;



class PartnerPanelController extends CoreController
{
    public $loggedInUser;
    public $data;
    public $activeMenu = '';
    public $activeSubmenu = '';

    public function __construct() {
        parent::__construct();

            $this->middleware(function ($request, $next) {
                $this->loggedInUser = auth()->user();
            return $next($request);
        });
        
    }

    public function placeBids()
    {
        $id = $this->loggedInUser->ref_id;
        $sub = Subscriber::where('user_id',$id)->first();
        $currentURL =  url()->full();
        $url_components = parse_url($currentURL);
        $sortOrder = 'ASC';

        $placebids = Requirements::where('vendor_id',$id)
                                    ->orwhereNull('vendor_id')
                                    ->where('requirements.status',1);

        if(isset($url_components['query']))
        {
            parse_str($url_components['query'], $params);

            if( isset($params['sort'])){
                $sortOrder = ($params['sort']==1) ? 'DESC' : 'ASC'; 
                $placebids->orderBy('max_budget',$sortOrder);
            }
            
            if( isset($params['min']) && isset($params['max']) && !empty($params['min']) && !empty($params['max']) )
            {
                
                $placebids->whereBetween('max_budget', [$params['min'], $params['max']]);
            }

            if(isset($params['timefilter']) && !empty($params['timefilter']) )
            {
                $date = date('Y-m-d',strtotime(Carbon::today()->subDays($params['timefilter']))); 
                $placebids->where('requirements.created_at','>=',$date);
            }

            if(isset($params['searchproduct']) && !empty($params['searchproduct']) )
            {
                $product = $params['searchproduct'];
                
                $cate = Category::where('name','LIKE',"%$product%")->where('status','1')
                ->whereNull('deleted_at')->select('id')->get();
                $subcate = ChildCategory::where('name','LIKE',"%$product%")->where('status','1')
                ->whereNull('deleted_at')->select('id')->get();
                
                
                // $placebids->where('categories.name','LIKE',"%$product%" ) ;
                $placebids->whereIn('category_id',$cate);
                $placebids->orWhereIn('sub_category_id',$subcate);
            }

            if(isset($params['category']) && !empty($params['category']) )
            {
                $placebids->whereIn('category_id',$params['category']);
            }
            
            if(isset($params['city']) && !empty($params['city']) )
            {
                $placebids->whereIn('location',$params['city']);
            }
        }
        else{
            $placebids->orderBy('requirements.created_at','desc');
        }

        // 'categories.id as categoryid','categories.name',
        $result =$placebids->get([ 'requirements.*']);
        // dd($placebids->get());
        $this->data = [
            'vendor' => Vendor::where('id',$id)->first(),
            'subscribertype' => Subscriber::where('user_id',$id)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first(),
            'requirements'=> $result,
           ];

        $this->data['title'] = 'Place Bids';
        $this->data['activeMenu'] = 'Place Bids';
        return view('partnerpanel.placeBids',$this->data);
    }



    public function setwishlist(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $id = $this->loggedInUser->ref_id;
            $check = Vendor_Wishlist::where(['requirement_id'=>$request->rid,'vendor_id'=>$id])->get();
            if(count($check)>0)
            {
                return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Place Bids','message'=>'Project Already Added In Your Wishlist.']);
            }
            else
            {
                $wishlist = new Vendor_Wishlist();
                $wishlist->requirement_id = $request->rid;
                $wishlist->vendor_id =$id;
                $wishlist->save();
           
            DB::commit();

             return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Place Bids','message'=>'Project Added In Your Wishlist.']);
       
            }
             }
        catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Place Bids','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function myBids()
    {
        $id = $this->loggedInUser->ref_id;
        $sub = Subscriber::where('user_id',$id)->first();
        $currentURL =  url()->full();
        $url_components = parse_url($currentURL);
        $sortOrder = 'DESC';
        if(isset($url_components['query']))
        {
            parse_str($url_components['query'], $params);
            if(isset($params) && isset($params['sort'])){
                $sortOrder = ($params['sort']==1) ? 'DESC' : 'ASC'; 
            }
        }
        $this->data = [
            'vendor' => Vendor::where('id',$id)->first(),
            'subscribertype' => Subscriber::where('user_id',$id)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first(),
            'allbids'=>DB::table('requirements')->join('vendor_bids','requirements.id','=','vendor_bids.requirement_id')
                            // ->join('categories','requirements.category_id','=','categories.id')
                            ->where(['vendor_bids.vendor_id'=>$id])->orderBy('vendor_bids.updated_at',$sortOrder)->get(),
            'acceptedbids'=>DB::table('requirements')->join('vendor_bids','requirements.id','=','vendor_bids.requirement_id')
                            // ->join('categories','requirements.category_id','=','categories.id')
                            ->where(['vendor_bids.status'=>1,'vendor_bids.vendor_id'=>$id])->orderBy('vendor_bids.updated_at',$sortOrder)->get(),
            'rejectedbids'=>DB::table('requirements')->join('vendor_bids','requirements.id','=','vendor_bids.requirement_id')
                            // ->join('categories','requirements.category_id','=','categories.id')
                            ->where(['vendor_bids.status'=>2,'vendor_bids.vendor_id'=>$id])->orderBy('vendor_bids.updated_at',$sortOrder)->get(),
            
        ];

        $this->data['title'] = 'My Bids';
        $this->data['activeMenu'] = 'My Bids';
        return view('partnerpanel.myBids',$this->data);
    }

    public function support()
    {
        $id = $this->loggedInUser->ref_id;
        $sub = Subscriber::where('user_id',$id)->first();
        
        $this->data = [
            'vendor' => Vendor::where('id',$id)->first(),
            'subscribertype' => Subscriber::where('user_id',$id)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first()
        ];
        $this->data['tickets'] = Ticket::where(['user_id' => $this->loggedInUser->ref_id, 'user_type' => 'vendor'])->orderBy('created_at','desc')->get();
        $this->data['title'] = 'Support';
        $this->data['activeMenu'] = 'Support';
        return view('partnerpanel.support',$this->data);
    }
    

    public function wishlist()
    {
        $id = $this->loggedInUser->ref_id;
        $sub = Subscriber::where('user_id',$id)->first();
        
        $this->data = [
            'vendor' => Vendor::where('id',$id)->first(),
            'subscribertype' => Subscriber::where('user_id',$id)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first(),
            'wishlist'=>Vendor_Wishlist::whereNull('deleted_at')->where('vendor_id',$id)->get(),
        ];

        $this->data['title'] = 'Wishlist';
        $this->data['activeMenu'] = 'Wishlist';
        return view('partnerpanel.wishlist',$this->data);
    }

    public function removewishlist(Request $request, $id)
    {
        DB::beginTransaction();
        try {
                $wishlist = Vendor_Wishlist::find($id);
                $wishlist->deleted_at = date('Y-m-d h:i:s');
                $wishlist->save();
           
                DB::commit();

                return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Place Bids','message'=>'Post Removed from  Wishlist.']);
            }
        catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Place Bids','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function vprofile()
    {
        
        $id = $this->loggedInUser->ref_id;
        $sub = Subscriber::where('user_id',$id)->first();
        
        $this->data = [
            'vendor' => Vendor::where('id',$id)->first(),
            'subscribertype' => Subscriber::where('user_id',$id)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first()
        ];
        $this->data['testimonial_count_test'] = Testimonials::where('vendor_ref_id',$id)->where('comments','<>','')->count();
        if(($this->data['testimonial_count_test'])>0){
            $this->data['test_count_test'] = $this->data['testimonial_count_test'];
            $this->data['rating_count_test'] = Testimonials::where('vendor_ref_id',$id)->where('comments','<>','')->avg('rating');
        }
        else{
            $this->data['test_count_test'] = 0;
            $this->data['rating_count_test'] = 0;
        }
        // dd($this->data['testimonial_count_test'],$this->data['rating_count_test']);
        $this->data['testimonial_count_review'] = DB::table('reviews')->where('vendor_id',$id)->where('comments','<>','')->count();
        if(($this->data['testimonial_count_review'])>0){
            $this->data['test_count_review'] = $this->data['testimonial_count_review'];
            $this->data['rating_count_review'] = DB::table('reviews')->where('vendor_id',$id)->where('comments','<>','')->avg('rate_us');
        }
        else{
            $this->data['test_count_review'] = 0;
            $this->data['rating_count_review'] = 0;
        }
        $this->data['testimonials_count'] = $this->data['test_count_test']+$this->data['test_count_review'];
        // dd($this->data['rating_count_review']);
        if(($this->data['test_count_review'])==0){
            $this->data['rating'] = $this->data['rating_count_test'];
        }
        elseif(($this->data['test_count_test'])==0){
            $this->data['rating'] = $this->data['rating_count_review'];
        }
        else{
            $this->data['rating'] = ($this->data['rating_count_test']+$this->data['rating_count_review'])/2;
        }
        // dd($this->data['rating']);
        $this->data['title'] = 'Profile Management';
        $this->data['activeMenu'] = 'Profile Management';
        return view('partnerpanel.profile',$this->data);
    }

    public function testimonials()
    {
        $id = $this->loggedInUser->ref_id;
        $sub = Subscriber::where('user_id',$id)->first();
        $testimonials = Testimonials::where('vendor_ref_id',$id)->where('comments','<>','')->orderBy('created_at','DESC');
    

        $currentURL =  url()->full();
        $url_components = parse_url($currentURL);
       
        if(isset($url_components['query']))
        {
            parse_str($url_components['query'], $params);

            if(isset($params['name']) && !empty($params['name']) )
                {
                    $product = $params['name'];
                
                    $testimonials->where('name','LIKE',"%$product%" ) ;
                }
        }
        
        $result =$testimonials->get();

        $this->data = [
            'vendor' => Vendor::where('id',$id)->first(),
            'subscribertype' => Subscriber::where('user_id',$id)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first(),
            'testimonials'=>$result,
        ];

        $this->data['title'] = 'Testimonials';
        $this->data['activeMenu'] ='Testimonials';
        return view('partnerpanel.testimonials',$this->data);
    }

    public function requesttestimonial(Request $request)
    {
        $emails = explode(',', $request->email);
        $trimmed_emails = array_map('trim', $emails);

        foreach($trimmed_emails as $email){
            
            $feedback = new Testimonials();
            $feedback->vendor_ref_id = $this->loggedInUser->ref_id;
            $feedback->email_id = $email;
            $feedback->save();

            $data = [
                'vendorid' => $this->loggedInUser->ref_id,
                'message' => $request->message,
                'name' => $this->loggedInUser->name,
                'testimonialid' => $feedback->id
            ];

            Mail::to($email)->send(new requesttestimonial($data));

        }

        return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Request Testimonial','message'=>'Successfully requested customer for testimonial!']);
    }

    public function details($id)
    {
        $vid = $this->loggedInUser->ref_id;
      
        $sub = Subscriber::where('user_id',$vid)->first();
        
        $this->data = [
            'subscribertype' => Subscriber::where('user_id',$vid)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first(),
            'requirements' => Requirements::where('id',$id)->first(),
            'vendor' => Vendor::where('id',$vid)->first(),
            'columns' => Schema::getColumnListing('requirements')
        ];
   
        $this->data['title'] = 'Bid Details';
        $this->data['activeMenu'] = 'Bid Details';
        
        
        return view('partnerpanel.details',$this->data);
    }

    public function bidDetails($id)
    {
        $vid = $this->loggedInUser->ref_id;
      
        $sub = Subscriber::where('user_id',$vid)->first();
        
        $this->data = [
            'subscribertype' => Subscriber::where('user_id',$vid)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first(),
            'requirements' => Requirements::where('id',$id)->first(),
            'vendor' => Vendor::where('id',$vid)->first(),
        ];
        $this->data['title'] = 'Bid Details';
        $this->data['activeMenu'] = 'Bid Details';
        return view('partnerpanel.bidDetails',$this->data);
    }

    public function getbidstatus(Request $request)
    {
        $vid = $this->loggedInUser->ref_id;
        $sub = Subscriber::where('user_id',$vid)->first();
        
        $this->data = [
            'subscribertype' => Subscriber::where('user_id',$vid)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first(),
        ];

        $searchbid = Vendor_Bids::where('status','<>',2)->where(['requirement_id'=>$request->projectid,'vendor_id' => $vid,])->get();

        return ['bidstatus'=>$searchbid,'subscription'=>$this->data];
            
    }

    public function submitbid(Request $request)
    {
        $maxamount = Requirements::select('max_budget')->where('id',$request->projectid)->first();
        $val =  round($maxamount->max_budget);
        $validator = Validator::make($request->all(), 
        [
            'bidamount'=>"required|numeric|min:0|max:$val",
            'category' =>"required"
        ],
        [
            'bidamount.required' =>'Please enter your Bid Amount',
            'category.required' => "Please Select category",
            'bidamount.max' =>'Bid Amount Must not exceed Max Budget',
        ]);

        if($validator->fails()) {
            return Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }

        DB::beginTransaction();
        try {

            $searchbid = Vendor_Bids::where('status','<>','2')->where(['requirement_id'=>$request->projectid,'vendor_id' => $request->vendor_id,])->get();
            if(count($searchbid)>0)
            {
                return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Place Bids','message'=>'Bid Already Submitted.']);
            }
            else
            {   
                $category = json_encode($request->category);

                $bid= new Vendor_Bids();
                $bid->requirement_id = $request->projectid;
                $bid->vendor_id = $request->vendor_id;
                $bid->cost = $request->bidamount;
                $bid->services = $category;
                $bid->negotiable = $request->input('negotiable') == 'on' ? 'yes':'no';
                $bid->designs_2d = $request->input('2d_designs') == 'on' ? 'yes':'no';
                $bid->designs_3d = $request->input('3d_designs') == 'on' ? 'yes':'no';
                
                $bid->status = 0;
                $bid->save();
                $data =  Requirements::where('id',$request->projectid)->select('customer_id')->first();
                // // dd($data);
                // $customerinfo = Customer::where('id',$requirements->customer_id)->where('status',1)
                // ->whereNull('deleted_at')->first();

                $user =  User::where('ref_id',$data->customer_id)->first();
                // dd($user->id);

                $notify = new Notifications();
                $notify->title = 'Vendor '.$request->vendor_id.' has placed a bid';
                $notify->content = $request->vendor_id.' has placed an amount of '.$request->bidamount .' bid on your project : '.$request->projectid;
                $notify->user_id = $user->id;
                $notify->notify_type = 'c';
                $notify->save();

                DB::commit();
                return redirect()->to('mybids')->with(['toast'=>'1','status'=>'success','title'=>'Project Details','message'=>'Success! Bid Created successfully.']);

            }
        }
        catch(Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'error','title'=>'Project Details','message'=>'Error! Some error occured, please try again.']);
        }

    }

    public function vendorRaiseTicket(Request $request)
    {
        $vendor = Vendor::where('id',$this->loggedInUser->ref_id)->first();
        $validator = Validator::make($request->all(), [
            'title'=>'required|string',
            'category'=>'required',
            'description'=>'required',
        ]);

        if($validator->fails()) {
            return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
        }

        $folder = ('uploads/'.$vendor->vendor_id);

        if (!File::exists($folder)) {
            mkdir($folder, 0777, true);
            chmod($folder, 0777);
        }

        $fileUploadPathFront='';
            if ($file = $request->hasFile('customFile')) {
                $file = $request->file('customFile') ;            
                $fileName = date('YmdHis')."_".$file->getClientOriginalName();
                $destinationPath = $folder;
                $file->move($destinationPath,$fileName);
                $fileUploadPathFront = $destinationPath.'/'.$fileName;
            }

            DB::beginTransaction();
        try {
            $ticket = new Ticket();
            $ticket->ticket_id = __generateNewTicketId();
            $ticket->user_id = $this->loggedInUser->ref_id;
            $ticket->user_type = 'vendor';
            $ticket->issue_title = $request->title;
            if($file = $request->hasFile('customFile')){
            $ticket->attachments = $fileUploadPathFront;
            }
            $ticket->category_id = $request->category;
            $ticket->issue = $request->description;
            $ticket->save();

            DB::commit();

            $notify = new Notifications();
            $notify->title = 'Vendor has raised a new ticket.';
            $notify->content = 'Vendor with vendor Id: '.$vendor->vendor_id.' has raised a ticket.';
            $notify->notify_type = 'a';
            $notify->save();

            $ticketcategory = Ticketing_Category::where('id',$request->category)->first();
            $data = [
                    'name' => $this->loggedInUser->name,
                    'vendor_id' => $vendor->vendor_id,
                    'ticket_id' => $ticket->ticket_id,
                    'created_at' => date('d M, Y', strtotime($ticket->created_at)),
                    'category' => $ticketcategory->name,
                    'description' => $ticket->issue
            ];
            $admin_email ="lavanyas@mirakitech.com";

            Mail::to($admin_email)->send(new ticketraise($data));
            Mail::to($this->loggedInUser->email)->send(new ticketraisevendor($data));

            return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Ticket ','message'=>'Success! Ticket Created successfully.']);
       
        }
        catch(Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'error','title'=>'Category','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function updatebasicdetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profileimg' => 'mimes:jpeg,jpg,png|max:5000',
            'noofprojects' => 'required',
        ],
        [
            'profileimg.mimes' =>'Only *jpeg, *jpg, *png image types are allowed!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fileUploadPath ='';
        if ($file = $request->hasFile('profileimg')) {
            $file = $request->file('profileimg') ;            
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = 'uploads/images';
            $file->move($destinationPath,$fileName);
            $fileUploadPath = $destinationPath.'/'.$fileName;
        }
   
        DB::beginTransaction();

        try {
            $id = $this->loggedInUser->ref_id;
            $vendor = Vendor::find($id);
            $vendor->company = $request->company;
            if($fileUploadPath !='')
                $vendor->photo = $fileUploadPath;
            $vendor->no_of_projects = $request->noofprojects;
            $vendor->save();

            User::where('ref_id', $this->loggedInUser->ref_id)
            ->update(['name'=> $request->company]);
           
            DB::commit();

             return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner Panel','message'=>'Success! Details Saved Successfully.']);
        }
        catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Partner Panel','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function updateadditionaldetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categoryservice' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
        }

        DB::beginTransaction();
        
        try {
            $id = $this->loggedInUser->ref_id;
            $vendor = Vendor::where('id', $id)->first();
            $category = json_encode($request->categoryservice);
            $deleteprojects = Vendor_Project_info::where('vendor_ref_id',$id)->whereNotIn('category',$request->categoryservice)
            ->update(['deleted_at'=>date('Y-m-d-h:i:s')]);

            $checkproj = Vendor::where('id',$id)->select('services','deleted_services')->first();
            $category1 = json_decode($checkproj->deleted_services,TRUE);
            $deletedarr = array_intersect($category1,$request->categoryservice);
            if($deletedarr != [])
            {
                for($i=0;$i<count($deletedarr);$i++){
                    if (($key = array_search($deletedarr[$i], $category1)) !== false) {
                        array_splice($category1,$key,1);
                    }
                }    
            }

            Vendor::where('id', $id)->update([
                'services' => $category,
                'deleted_services' =>json_encode($category1),
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'state_id' =>  $request->state,
                'pincode' => $request->pincode,
                'landmark' => $request->landmark,
                'about_us' =>$request->aboutus,
            ]);

            DB::commit();

             return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner Panel','message'=>'Success! Details Saved Successfully.']);
        }
        catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Partner Panel','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function addcategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categoryserve' => 'required',            
        ]);

        if($validator->fails()) {
            return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
        }
        $id = $this->loggedInUser->ref_id;
        DB::beginTransaction();
        try {

            $query = Vendor_Project_info::where(['vendor_ref_id'=>$id,'category'=> $request->categoryserve,'subcategory'=>$request->subcategoryserve])->get();
            if(count($query)>0)
            {
                return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Profile','message'=>'Category Already Added.']);
            }
            else
            {    
                $project = new Vendor_Project_info();
                $vendor_details = Vendor::select('id','services','deleted_services')->where('id',$id)->first();
                $serves = json_decode($vendor_details->services,TRUE);
                $categories = Category::where('status',1)->where('id',$request->categoryserve)->whereNull('deleted_at')->orderby('name','asc')->first();
                if($categories != null)
                {
                    if(!in_array($categories->id,$serves))
                    {   
                        array_push($serves,$request->categoryserve);
                    }
                    else
                    {
                        if($request->subcategoryserve == '')
                        return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Profile','message'=>'Category Already Added.']);
                    }
                }
               
                $vendor_services = Vendor::find($id);
                $vendor_services->services = json_encode($serves);
                $vendor_services->save();

                $project->vendor_ref_id = $id;
                $project->projectname = $request->projectname;
                $project->category = $request->categoryserve;
                $project->subcategory =$request->subcategoryserve;
                $project->status ='1';
                $project->save();
            
                DB::commit();
            }
            
             return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner Panel','message'=>'Success! Project Details Saved Successfully.']);
        }
        catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Partner Panel','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function addprojectimage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_img' => 'required',   
            'project_img.*' => 'mimes:jpeg,jpg,png|max:5000',         
        ]);

        if($validator->fails()) {
            return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
        }

        if($request->hasfile('project_img'))
        {
           foreach($request->file('project_img') as $file)
           {
               $name = time().rand().'.'.$file->extension();
               $destinationPath = 'uploads/images';
                $file->move($destinationPath,$name); 
               $data[] = array('name'=>$destinationPath.'/'.$name,'description'=>'');  
           }
        }

        DB::beginTransaction();
        
        try {

            $id = $this->loggedInUser->ref_id;
            $projectid = $request->projectid;
            $vendordata = Vendor_Project_info::where(['id'=> $projectid])->first();
            if($vendordata->images =='')
            {
                $img = json_encode($data);
            }
            else
            {
                $dataimg = json_decode($vendordata->images,TRUE);
                foreach($data as $data1)
                {
                    $dataimg = Arr::prepend($dataimg, $data1);
                }
                $img = json_encode($dataimg);
            }

            Vendor_Project_info::where(['id'=> $projectid])
                ->update([
                'images' => $img,
                'description' => $request->description,
            ]);

            DB::commit();

             return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner Panel','message'=>'Success! Project Images Details Saved Successfully.']);
        }
        catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Partner Panel','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function uploadprojectimage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_img_u' => 'required',
            'project_img_u.*' => 'mimes:jpeg,jpg,png|max:5000',
        ]);

        if($validator->fails()) {
            return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
        }
        $id = $this->loggedInUser->ref_id;
        if($request->hasfile('project_img_u'))
        {
           foreach($request->file('project_img_u') as $file)
           {
               $name = time().rand().'.'.$file->extension();
               $destinationPath = 'uploads/images';
                $file->move($destinationPath,$name); 
                $data[] = array('name'=>$destinationPath.'/'.$name,'description'=>'');  
           }
        }

        DB::beginTransaction();
        
        try {

            $query = Vendor_Project_info::where(['vendor_ref_id'=>$id,'category'=> $request->categoryid,'subcategory'=>$request->childcategory])->get();
            if(count($query)>0)
            {
                return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Profile','message'=>'Category Already Added.']);
            }
            else
            {    
                $project = new Vendor_Project_info();
                
                $project->vendor_ref_id = $id;
                $project->projectname = $request->projectname1;
                $project->category = $request->categoryid;
                $project->subcategory =$request->childcategory;
                $project->images = json_encode($data);
                $project->status ='1';
                $project->save();
            
                DB::commit();

                return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner Panel','message'=>'Success! Project Images Details Saved Successfully.']);
            }
        }
        catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Partner Panel','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function updateprojectimage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'project_img_u' => 'required',
            // 'projectname' => 'required',
            
        ]);

        if($validator->fails()) {
            return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
        }

        $fileUploadPath ='';
        if ($file = $request->hasFile('project_img_update')) {
            $file = $request->file('project_img_update') ;            
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = 'uploads/images';
            $file->move($destinationPath,$fileName);
            $fileUploadPath = $destinationPath.'/'.$fileName;
        }

        DB::beginTransaction();

        try {
            
            $data = Vendor_Project_info::where('id',$request->project_id)->whereNull('deleted_at')->first();
            $project_imgdata = json_decode($data->images,TRUE);
            if($fileUploadPath !='')
            $project_imgdata[$request->imageid]['name']=$fileUploadPath;
            $project_imgdata[$request->imageid]['description']=$request->description;
            $projectimg = Vendor_Project_info::find($request->project_id);
            $projectimg->images = json_encode($project_imgdata);
            $projectimg->save();            
           
            DB::commit();

             return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner Panel','message'=>'Success! Project Image Details Updated Successfully.']);
        }
        catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Partner Panel','message'=>'Error! Some error occured, please try again.']);
        }
    }
    
    public function deleteprojectimage(Request $request,$id)
    {
        DB::beginTransaction();
        try {
            $projectid = explode(',',$id);
            $data = Vendor_Project_info::where('id',$projectid[0])->whereNull('deleted_at')->first();
            $project_imgdata = json_decode($data->images,TRUE);
            array_splice($project_imgdata,$projectid[1],1);
            $projectimg = Vendor_Project_info::find($projectid[0]);
            $projectimg->images = json_encode($project_imgdata);
            $projectimg->save();

            DB::commit();

             return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner Panel','message'=>'Success! Project Image Delete Successfully.']);
        }
        catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Partner Panel','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function deletecategory(Request $request,$id)
    {   
        $data=[];
        DB::beginTransaction();
        try {
            $vidval = $this->loggedInUser->ref_id;
            $delete_category = Vendor::select('deleted_services','services')->where('id',$vidval)->first();
            $serves = json_decode($delete_category->services,TRUE);
            $categories = Category::where('status',1)->where('id',$id)->whereNull('deleted_at')->orderby('name','asc')->first();
            if($categories != null)
            {
                if (($key = array_search($categories->id, $serves)) !== false) {
                    array_splice($serves,$key,1);
                }
            }
            
            $vendor_services = Vendor::find($vidval);
            $vendor_services->services = json_encode($serves);
            $vendor_services->save();
          
            if($delete_category->deleted_services =='')
            {
                $data=[];
                array_push($data,$id) ;
            }
            else
            {
                $data=json_decode($delete_category->deleted_services,TRUE);
                if(!in_array($id,$data))
                     array_push($data,$id) ;
            }

            $deletecategory = Vendor::find($vidval);
            $deletecategory->deleted_services = $data;
            $deletecategory->save();

            DB::commit();

             return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner Panel','message'=>'Success! Project Image Deleted Successfully.']);
        }
        catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Partner Panel','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function getsubcategories(Request $request)
    {
        $category = $request->category;
        $data = ChildCategory::select('name','id')->where('category_id',$category)->where('status',1)->whereNull('deleted_at')->get();
        
        return $data;
    }

    public function getprojectdetails(Request $request)
    {
        $projectid = $request->projectid;
        $data = Vendor_Project_info::where('id',$projectid)->whereNull('deleted_at')->get();
       
        return $data;

    }

    public function getprojectimages(Request $request)
    {
        $projectid = explode(',',$request->projectid);
        $data = Vendor_Project_info::where('id',$projectid[0])->whereNull('deleted_at')->first();
        $project_imgdata = json_decode($data->images,TRUE)[$projectid[1]];
        
        return ['imgdata'=>$project_imgdata,'projectid'=>$data->id,'imageid'=>$projectid[1]];
    }

    public function uploadproject(Request $request)
    {
        $projectid = $request->projectid;
        $category = Category::where('id',$projectid)->select('id')->whereNull('deleted_at')->get();
        $childcategory = ChildCategory::where('category_id',$category[0]->id)->where('status',1)->select('id','name')->whereNull('deleted_at')->get();
        
        return ['category'=>$category,'child'=>$childcategory];

    }

    public function customerinfo(Request $request)
    {
        $vid = $this->loggedInUser->ref_id;
        $requirements =  Requirements::where('id',$request->projectid)->first();
        $customerinfo = Customer::where('id',$requirements->customer_id)->where('status',1)->whereNull('deleted_at')->first();
        
        return  $customerinfo;
    }

    public function deleteproject($id)
    {
        DB::beginTransaction();
        try {
            $vidval = $this->loggedInUser->ref_id;
            $delete_category = Vendor::select('deleted_services','services')->where('id',$vidval)->first();
            $datacheck = Vendor_Project_info::where('id',$id)->first();
            $serves = json_decode($delete_category->services,TRUE);
            $categories = Category::where('status',1)->where('id',$datacheck->category)->whereNull('deleted_at')->orderby('name','asc')->first();
            if($categories != null)
            {
                if (($key = array_search($categories->id, $serves)) !== false) {
                    array_splice($serves,$key,1);
                }
            }
            $vendor_services = Vendor::find($vidval);
            $vendor_services->services = json_encode($serves);
            $vendor_services->save();
            if($delete_category->deleted_services =='')
            {
                $data=[];
                array_push($data,$categories->id) ;
            }
            else
            {

                $data=json_decode($delete_category->deleted_services,TRUE);
                if(!in_array($id,$data))
                     array_push($data,$categories->id) ;
            }

            // return $data;
            
            $deletecategory = Vendor::find($vidval);
            $deletecategory->deleted_services = $data;
            $deletecategory->save();
            $data = Vendor_Project_info::where('id',$id)->update(['deleted_at'=>date('Y-m-d-h:i:s')]);

            DB::commit();

            return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Profile','message'=>'Success! Project deleted successfully.']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['success'=>2, 'message'=>"Error! Some error occured, please try again."], 200);
        }
    }


    // public function deletecategory(Request $request,$id)
    // {   
    //     $data=[];
    //     DB::beginTransaction();
    //     try {
    //         $vidval = $this->loggedInUser->ref_id;
    //         $delete_category = Vendor::select('deleted_services','services')->where('id',$vidval)->first();

            
    //         $serves = json_decode($delete_category->services,TRUE);
    //         $categories = Category::where('status',1)->where('id',$id)->whereNull('deleted_at')->orderby('name','asc')->first();
    //         if($categories != null)
    //         {
    //             if (($key = array_search($categories->id, $serves)) !== false) {
    //                 // unset($serves[$key]);
    //                 array_splice($serves,$key,1);
    //             }
    //         }
            
    //         $vendor_services = Vendor::find($vidval);
    //         $vendor_services->services = json_encode($serves);
    //         $vendor_services->save();
          
    //         if($delete_category->deleted_services =='')
    //         {
    //             $data=[];
    //             array_push($data,$id) ;
    //         }
    //         else
    //         {
    //             $data=json_decode($delete_category->deleted_services,TRUE);
    //             if(!in_array($id,$data))
    //                  array_push($data,$id) ;
    //         }

    //         $deletecategory = Vendor::find($vidval);
    //         $deletecategory->deleted_services = $data;
    //         $deletecategory->save();

    //         DB::commit();

    //          return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner Panel','message'=>'Success! Project Image Deleted Successfully.']);
    //     }
    //     catch(Exception $e) {
    //         // return $e;
    //         DB::rollback();
    //         return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Partner Panel','message'=>'Error! Some error occured, please try again.']);
    //     }
    // }

    public function changepassword(Request $request)
    {
        $id = $this->loggedInUser->ref_id;
        $sub = Subscriber::where('user_id',$id)->first();
        $this->data = [
            'vendor' => Vendor::where('id',$id)->first(),   
            'subscribertype' => Subscriber::where('user_id',$id)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first()
        ];
        $this->data['title'] = 'Change Password';
        $this->data['activeMenu'] = 'Change Password';
        $this->data['activeSubmenu'] = $this->activeSubmenu;
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Change Password',
            ],
        ];

            if($request->doSubmit){
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => ['required','string','min:6','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
                'confirmed' => 'required|same:new_password',
            ],
            [
				'current_password.required' =>'Please enter your current password',
				'new_password.required' =>'Please enter your new password',
                'confirmed.required' =>'Please enter your confirm password',
                'confirmed.same' =>'New Password and Confirm Password does not match.',
			]);

            if ($validator->fails()) {
				return Redirect::back()
							->withErrors($validator)
							->withInput();
	        }

            $user = Auth::user();
            if (!(Hash::check($request->current_password,$user->password))) {
                return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>'Error','message'=>'Your current password does not matches with the password you provided. Please try again.']);
                
            }
            if(strcmp($request->current_password, $request->new_password) == 0){
                return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>'Error','message'=>'New Password cannot be same as your current password. Please choose a different password.']);
            }
            
            DB::beginTransaction();
            try{
                User::where('id', $user->id)
                        ->update(['password'=> Hash::make($request->new_password)]);
            DB::commit();
                return Redirect::route('ppanel.vprofile')->with(['toast'=>'1','status'=>'success','title'=>'Change Password','message'=>'Success! Your new Password has been updated successfully.']);
            }
            catch(Exception $e){
                DB::rollback();
                return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>'Change Password','message'=>'Error! Some error occured, please try again.']);
            }
        }
        return view('partnerpanel.changepassword',$this->data);
    }

    public function notification()
    {
        $id = $this->loggedInUser->ref_id;
        $sub = Subscriber::where('user_id',$id)->first();
        $this->data = [
            'vendor' => Vendor::where('id',$id)->first(),
            'subscribertype' => Subscriber::where('user_id',$id)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first(),
        ];

        DB::beginTransaction();

        Notifications::where('user_id',$this->loggedInUser->ref_id)->update([
            'seen' => 1
        ]);
        DB::commit();

        $this->data['notifications'] = Notifications::where('notify_type','v')
                                                ->Where('user_id',$this->loggedInUser->ref_id)
                                                ->orderBy('created_at','desc')
                                                ->get();
        $this->data['notificationsCount'] = Notifications::where('notify_type','v')
                                                ->Where('user_id',$this->loggedInUser->ref_id)
                                                ->count();
        $this->data['title'] = 'Notification';
        $this->data['activeMenu'] = 'Notifications';
        $this->data['activeSubmenu'] = '';
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Notification',
            ],
        ];
       return view('partnerpanel.notifications' ,$this->data);
    }

       /**
     * [Manage tickets Page View]
     * @return [type] [description]
     */
    public function conversation(Request $request, $id)
    {
        $vid = $this->loggedInUser->ref_id;
        $sub = Subscriber::where('user_id',$vid)->first();
        $this->data = [
            'vendor' => Vendor::where('id',$id)->first(),
            'subscribertype' => Subscriber::where('user_id',$vid)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first(),
        ];
        $this->data['ticket'] = Ticket::where('id',$id)->first();
        $this->data['ticket_details'] = TicketComment::where('help_desk_id',$id)->orderBy('created_at','asc')->get();
        $this->data['seller_id'] = auth()->user()->ref_id;
        $this->data['title'] = 'Manage Tickets';
        $this->data['activeMenu'] ='Manage Tickets';
        $this->data['activeSubmenu'] = $this->activeSubmenu;

        return view('partnerpanel.conversation', $this->data);
    }

    /**
     * [post ticket comment]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postcomment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                'sellerComment' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator) ->withInput();
        }

        try {
            $tblData = new TicketComment();
            $tblData->comments = $request->sellerComment;
            $tblData->comment_by = auth()->user()->ref_id;
            $tblData->help_desk_id = $id;
            
            if ($tblData->save()) {
                return redirect()->back();
            } else {
                return redirect()
                       ->back()
                        ->with(['toast'=>'1','status'=>'error','title'=>'Ticket','message'=>'Error! Some error occured, please try again.']);
            }
        } catch (Exception $e) {
            return redirect()
                        ->back()
                        ->with(['toast'=>'1','status'=>'error','title'=>'Ticket','message'=>'Error! Some error occured, please try again!']);
        }
    }

    public function ticketreopen(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            Ticket::where('id', $id)
                    ->update([
                        'status' => 2,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            DB::commit();
            $ticket = Ticket::where('id', $id)->first();
            $status = 'Re-Open';
            $user = User::where('ref_id',$ticket->user_id)->first();
            $data = [
                'name' => $user->name,
                'ticket_id' => $ticket->ticket_id,
                'created_at' => date('d M, Y', strtotime($ticket->created_at)),
                'status' => $status
            ];

            $notify = new Notifications();
            $notify->title = 'Your issue has been updated.';
            $notify->content = 'UBID has updated your ticket with Ticket Id: '.$ticket->ticket_id;
            $notify->user_id = $ticket->user_id;
            $notify->notify_type = 'v';
            $notify->save();

            Mail::to($user->email)->send(new ticketupdate($data));

            return redirect()
                    ->back()
                    ->with(['toast'=>'1','status'=>'success','title'=>'Ticket','message'=>'Status updated successfully!']);
            }
        catch(Exception $e) {
            DB::rollback();
            return redirect()
                    ->back()
                    ->with(['toast'=>'1','status'=>'error','title'=>'Ticket','message'=>'Error! Some error occured, please try again!']);
        }
    } 
}