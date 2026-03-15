<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use DB;
use View;
use Session;
use Validator;
use Redirect;

// Models
use App\Models\Subscription;

class SubscriptionController extends CoreController
{
	public $loggedInUser;
    public $data;
    public $activeMenu = 'subscription';
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
        $this->data['dt_perpage'] = Session::get('subscription_perpage', 10);
        $this->data['dt_page'] = Session::get('subscription_page', 1);
        $this->data['dt_ajax_url'] = route('subscription.getsubscriptionajaxlistdata');
        $this->data['dt_search_colums'] = ['fsubscription','fstatus'];
        $this->data['title'] = 'Subscription Management';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = 'subscription';
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Subscription Management',
            ],
        ];

        return view('subscription.index', $this->data);
    }

    public function getsubscriptionajaxlistdata(Request $request)
    {
        $columnList = [
            0 => 'name',
            1 => 'price',
            2 => 'period',
            3 => 'description',
            4 => 'status'
        ];

        $order = (isset($_REQUEST['order']))?$_REQUEST['order'][0]:['column'=>1, 'dir'=>'desc'];
        $orderColumn = $columnList[$order['column']];
        $orderDir = $order['dir'];
        $iPage = (intval($request->start) / intval($request->length)) + 1;
        __setDatatableCurrPage('store', intval($request->length), $iPage);

        $records = [];
        $records["data"] = [];

        if (isset($request->customActionType)
            && $request->customActionType == "group_action") {
            $records["customActionStatus"] = "OK";
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!";
        }

        $criteria = (object)[
            'length' => intval($request->length),
            'fsubscription' => ($request->fsubscription)?:null,
            'search' => $request->search['value'],
            'fstatus' => (!is_null($request->fstatus))?$request->fstatus:null,
        ];

        $subscriptions = Subscription::getAjaxListData($criteria, $iPage, $orderColumn, $orderDir);

        $iTotalRecords = $subscriptions->total();
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
            ["danger" => "Inactive"],
            ["success" => "Active"]
        ];

        $period =[
            ["0" => "0"],
            ["1" => "1"],
            ["2" => "12"],
            ["3" => "1"],
            ["4" => "12"]
        ];

        foreach ($subscriptions as $subscription) {
            $status = $statusList[$subscription->status];
            $period_val =  $period[$subscription->period];
            $records["data"][] = [
                $subscription->name,
                current($period_val),
                $subscription->price,
                $subscription->finalprice,
                '<span class="badge badge-light-'.(key($status)).' badge-roundless">'.(current($status)).'</span>',
                '<a class="text-secondary" href="#" data-toggle="modal" data-target="#editDocuments" onclick="getdetails(this)" id="'.$subscription->id.'">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye font-small-4 mr-50"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>',
            ];
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        return response()->json($records);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required|string',
            'period' =>'required',
            'price' =>'required',
            'discount' => 'required',
            'projectview' => 'required',
            'placebids' => 'required',
            'viewaccept' => 'required',
            'viewall'=> 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
        }
     
        $fileUploadPathSub='';
        if ($file = $request->hasFile('subscription_img')) {
            $file = $request->file('subscription_img') ;
            $fileName = "Subscription_".date('YmdHis')."_".$file->getClientOriginalName();
            $destinationPath = 'uploads/images';
            $file->move($destinationPath,$fileName);
            $fileUploadPathSub = $destinationPath.'/'.$fileName;
        }

        DB::beginTransaction();
        try {
            $subscription = new Subscription();
            $subscription->name = $request->name;
            $subscription->period = $request->period;
            $subscription->price = $request->price;
            $subscription->discount =  $request->discount;
            $subscription->finalprice = $request->finalprice;
            $subscription->viewall = $request->projectview;
            $subscription->placebids = $request->placebids;
            $subscription->viewcontact_bidaccepted = $request->viewaccept;
            $subscription->viewaccepted_pro = $request->viewall;
            $subscription->image = $fileUploadPathSub;
            $subscription->description = $request->description;
            $subscription->status = $request->status;
            $subscription->period_months = $request->period_months;
            $subscription->gopro_type = $request->goppro;
            $subscription->save();

            DB::commit();

            return Redirect::route('subscription')->with(['toast'=>'1','status'=>'success','title'=>'Subscription','message'=>'Success! New Subscription created successfully.']);
        }
        catch(Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'error','title'=>'Subscription','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function getsubscription(Request $request)
    {
        $sid = $request->subscriptionid;
        $query = Subscription::where('id',$sid)->get();
        
        return $query;
    }
   
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edit_name' =>'required|string',
            'edit_period' =>'required',
            'edit_price' =>'required',
            'edit_discount' => 'required',
            'edit_finalprice' => 'required',
            'edit_projectview' => 'required',
            'edit_placebids' => 'required',
            'edit_viewaccept' => 'required',
            'edit_viewall'=> 'required',
            'edit_description' => 'required',
            'edit_status' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
        }
     
        $fileUploadPathSub='';
        if ($file = $request->hasFile('edit_subscription_img')) {
            $file = $request->file('edit_subscription_img') ;
            $fileName = "Subscription_".date('YmdHis')."_".$file->getClientOriginalName();
            $destinationPath = 'uploads/images';
            $file->move($destinationPath,$fileName);
            $fileUploadPathSub = $destinationPath.'/'.$fileName;
        }

        DB::beginTransaction();
        try {
            // dd($request->edit_period_months);
            $subscription =  Subscription::find($request->sid);
            $subscription->name = $request->edit_name;
            $subscription->period = $request->edit_period;
            $subscription->price = $request->edit_price;
            $subscription->discount =  $request->edit_discount;
            $subscription->finalprice = $request->edit_finalprice;
            $subscription->viewall = $request->edit_projectview;
            $subscription->placebids = $request->edit_placebids;
            $subscription->viewcontact_bidaccepted = $request->edit_viewaccept;
            $subscription->viewaccepted_pro = $request->edit_viewall;
            if($fileUploadPathSub !='')
            $subscription->image = $fileUploadPathSub;
            $subscription->description = $request->edit_description;
            $subscription->status = $request->edit_status;
            $subscription->period_months = $request->edit_period_months;
            $subscription->gopro_type = $request->edit_gopro;
            $subscription->save();

            DB::commit();

            return Redirect::route('subscription')->with(['toast'=>'1','status'=>'success','title'=>'Subscription','message'=>'Success!  Subscription Updated Successfully.']);
        }
        catch(Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'error','title'=>'Subscription','message'=>'Error! Some error occured, please try again.']);
        }
    }
}
