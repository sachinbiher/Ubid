<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use DB;
use Session;
use View;
use Hash;
use Mail;

// Models
use App\Models\Vendor;
use App\Models\User;

//Mails
use App\Mail\accountdeactivate;
use App\Mail\accountactivate;

class ManagePartnerController extends CoreController
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
        $this->data['dt_ajax_url'] = route('managepartner.getvendorajaxlistdata');
        $this->data['dt_search_colums'] = ['fname','femail', 'fvendor', 'fmobile'];
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

        $vendors = Vendor::getManagePartnerAjaxListData($criteria, $iPage, $orderColumn, $orderDir);

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
            ["danger" => "Inactive"],
            ["success" => "Active"]
        ];

        $actions='';
        foreach ($vendors as $vendor) {
            if($vendor->status==1){
                $actions = '<div class="custom-control custom-control-success custom-switch"><input type="checkbox" checked="" 
                class="custom-control-input update-record"  id="'.$vendor->vendor_id.'" onclick="activty(this)" data-on-text="Active" data-off-text="In-active" 
                data-size="small"><label class="custom-control-label"  for="'.$vendor->vendor_id.'"></label></div>';
            }
            if($vendor->status==4){
                $actions = '<div class="custom-control custom-control-success custom-switch"><input type="checkbox"  
                class="custom-control-input update-record" id="'.$vendor->vendor_id.'" onclick="activty(this)" data-on-text="Active" data-off-text="In-active" 
                data-size="small"><label class="custom-control-label"  for="'.$vendor->vendor_id.'"></label></div>';
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

    public function update(Request $request,$id)
    {
        DB::beginTransaction();
        try {
            $vendor = Vendor::where(['vendor_id'=>$id])->first();
            if($vendor->status ==1){
                $updatestatus = Vendor::where(['vendor_id'=>$id])->update(['status'=>4]);
                Mail::to($vendor->email)->send(new accountdeactivate());
            }
            else if($vendor->status == 4){
                $updatestatus = Vendor::where(['vendor_id'=>$id])->update(['status'=>1]); 
                Mail::to($vendor->email)->send(new accountactivate()); 
            }          
            DB::commit();

            return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Manage Partner','message'=>'Success! Vendor Account Status Changed successfully.']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['success'=>2, 'message'=>"Error! Some error occured, please try again."], 200);
        }
    }
}


                     
