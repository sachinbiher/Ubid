<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use DB;
use Session;
use View;
use Hash;
use Redirect;
use Mail;

// Models
use App\Models\Vendor;
use App\Models\User;
use App\Models\Notifications;
use App\Models\Vendor_Bids;
use App\Models\Subscriber;
use App\Models\Vendor_Project_info;

//Mails
use App\Mail\accountapprove;
use App\Mail\accounthold;
use App\Mail\accountreject;

class PartnerController extends CoreController
{
	public $loggedInUser;
    public $data;
    public $activeMenu = 'partner';
    public $activeSubmenu = '';

    public function __construct() {
        parent::__construct();

        $this->middleware(function ($request, $next) {
            // get current logged in user
            $this->loggedInUser = auth()->user();

            return $next($request);
        });
    }

    public function index()
    {
        $this->data['datatable_listing'] = true;
        $this->data['dt_ordering'] = 1;
        $this->data['dt_perpage'] = Session::get('partner_data_perpage', 10);
        $this->data['dt_page'] = Session::get('partner_data_page', 1);
        $this->data['dt_ajax_url'] = route('partner.getvendorajaxlistdata');
        $this->data['dt_search_colums'] = ['fname','femail', 'fvendor', 'fmobile'];

        $this->data['title'] = 'Bussiness Partner Management';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = 'partner';
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Bussiness Partner Management',
            ],
        ];

        return view('partner.index', $this->data);
    }

    public function getvendorajaxlistdata(Request $request)
    {
        $columnList = [
            0 => 'id',
            1 => 'first_name',
            2 => 'email',
            3 => 'mobile',
            4 => 'company',
            5 => 'status'
        ];

        $order = (isset($_REQUEST['order']))?$_REQUEST['order'][0]:['column'=>1, 'dir'=>'desc'];
        $orderColumn = $columnList[$order['column']];
        $orderDir = $order['dir'];
        // dd(intval($request->length));
        $iPage = (intval($request->start) / intval($request->length)) + 1;
        
        __setDatatableCurrPage('customer', intval($request->length), $iPage);

        $records = [];
        $records["data"] = [];

        if (isset($request->customActionType)
            && $request->customActionType == "group_action") {
            $records["customActionStatus"] = "OK";
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!";
        }

        $criteria = (object)[
            'length' => intval($request->length),
            'fname' => ($request->fname)?:null,
            'search' => $request->search['value'],
            'fvendor' => (!is_null($request->fvendor))?$request->fvendor:null,
            'femail' => (!is_null($request->femail))?$request->femail:null,
            'fmobile' => (!is_null($request->fmobile))?$request->fmobile:null,
        ];

        $vendors = Vendor::getAjaxListData($criteria, $iPage, $orderColumn, $orderDir);

        $iTotalRecords = $vendors->total();
        
        $iDisplayLength = intval($request->length);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($request->start);
        $sEcho = intval($request->draw);

        $end = $iDisplayStart + $iDisplayLength;

        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $featuredList = [
            ["danger" => "No"],
            ["success" => "Yes"]
        ];

        $statusList = [
            ["danger" => "Pending"],
            ["success" => "Accepted"],
            ["danger" => "Rejected"],
            ["warning" => "Account Hold"],
        ];
        // dd($vendors)

        foreach ($vendors as $vendor) {
            $status = $statusList[$vendor->status];
            $actions = '';
            if($vendor->status==2){
                $actions = '<span class="badge badge-light-'.(key($status)).' badge-roundless">'.(current($status)).'</span>';
            }
            if($vendor->status==3){
                $actions = '<span class="badge badge-light-'.(key($status)).' badge-roundless">'.(current($status)).'</span>';
            }
            if($vendor->status==0){
                $actions = '
                <a href="'.route('partner.accept',['id'=>$vendor->vendor_id]).'" ><span class="badge badge-pill badge-light-success">Accept</span></a>
                <a href="#" onclick="gethold(this)" id="'.$vendor->vendor_id.'1'.'" data-toggle="modal" data-target="#holdModal" ><span class="badge badge-pill badge-light-info">Hold</span></a>
                <a href="'.route('partner.reject',['id'=>$vendor->vendor_id]).'"><span class="badge badge-pill badge-light-danger">Reject</span></a>
                ';
            }

            $records["data"][] = [
                $vendor->vendor_id,
                '<a href="'.route('partner.partnerdetails',['id'=>$vendor->id]).'" >'.$vendor->company.'</a>',

                $vendor->email,
                $vendor->mobile,
                $actions,
                '<a class="text-secondary" href="#" data-toggle="modal" data-target="#viewDocuments" onclick="getdetails(this)" id="'.$vendor->vendor_id.'">
          
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye font-small-4 mr-50"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>',

            ];
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        return response()->json($records);
    }

    public function managePartners()
    {
        $this->data['title'] = 'Bussiness Partner Management';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = 'managepartner';
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Bussiness Partner Management',
            ],
        ];

        return view('partner.manage', $this->data);
    }

    public function view(Request $request)
    {
        $id= $request->id;
        $data = Vendor::where('vendor_id',$id)->first();

        return response()->json($data);
    }

    public function passwordGeneration($n) 
    {       
        $generator = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@#$%&"; 
        $result = ""; 
        for ($i = 1; $i <= $n; $i++) { 
            $result .= substr($generator, (rand()%(strlen($generator))), 1); 
        } 
        return $result; 
    } 
       
    public function acceptPartner(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $rejectpartner = Vendor::where(['vendor_id'=>$id])
                                ->update([
                                    'status' => 1,
                                    'actiondate' => date('Y-m-d H:i:s'), 
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
            DB::commit();
            
            $vendor = Vendor::where('vendor_id',$id)->first();
            Mail::to($vendor->email)->send(new accountapprove());

            $notify = new Notifications();
            $notify->title = 'Your profile has been accepted by UBID.';
            $notify->content = 'Your profile has been verified and accepted by UBID. Now You can explore UBID.';
            $notify->user_id = $vendor->id;
            $notify->notify_type = 'v';
            $notify->save();

            return Redirect::route('managepartner')->with(['toast'=>'1','status'=>'success','title'=>'Partner','message'=>'Success! Vendor Accepted successfully.']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['success'=>2, 'message'=>"Error! Some error occured, please try again."], 200);
        }
    }
    public function rejectPartner(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $rejectpartner = Vendor::where(['vendor_id'=>$id])
                                    ->update([
                                        'status' => 2,
                                        'actiondate' => date('Y-m-d H:i:s'), 
                                        'updated_at' => date('Y-m-d H:i:s')
                                    ]);

            DB::commit();

            $vendor = Vendor::where('vendor_id', $id)->first();

            Mail::to($vendor->email)->send(new accountreject());
            
            return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner','message'=>'Success! Partner Rejected.']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['success'=>2, 'message'=>"Error! Some error occured, please try again."], 200);
        }
    }

    public function holdPartner(Request $request)
    {
        $id = $request->vendor_id;
        
        $holdmsg = $request->holdmessage;
        DB::beginTransaction();
        try {
            $holdpartner = Vendor::where(['vendor_id'=>$id])
                                    ->update([
                                        'status' => 3,
                                        'hold_message'=> $holdmsg,
                                        'actiondate' => date('Y-m-d H:i:s'), 
                                        'updated_at' => date('Y-m-d H:i:s')
                                    ]);
            // dd($holdpartner);
            DB::commit();

            $vendor = Vendor::where('vendor_id',$id)->first();

            $notify = new Notifications();
            $notify->title = 'Your profile has been put on hold.';
            $notify->content = 'UBID says: '.$request->holdmessage;
            $notify->user_id = $vendor->id;
            $notify->notify_type = 'v';
            $notify->save();

            Mail::to($vendor->email)->send(new accounthold()); 

            return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner','message'=>'Success! Partner Hold.']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['success'=>2, 'message'=>"Error! Some error occured, please try again."], 200);
        }
    }

    public function partnerdetails(Request $request,$id)
    {

        $this->data['title'] = 'Bussiness Partner Management';
        $this->data['activeMenu'] = 'Partner Details';
        $this->data['activeSubmenu'] = 'partner';
        $this->data['totalbids'] = Vendor_Bids::where('vendor_id',$id)->sum('cost');
        $this->data['acceptedbids'] = Vendor_Bids::where('vendor_id',$id)->where('status',1)->sum('cost');
        $this->data['pendingbids'] = Vendor_Bids::where('vendor_id',$id)->where('status',0)->sum('cost');
        $this->data['subscriptiondetails'] = Subscriber::where('user_id',$id)->get();
        $this->data['vendor_projects'] = Vendor_Project_info::where('vendor_ref_id',$id)->get();
        $this->data['vendor_info'] = Vendor::where('id',$id)->first();
        

        // dd($this->data);
       

        return view('partner.partnerdetails', $this->data);

    }
}
