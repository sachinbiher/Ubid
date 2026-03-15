<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use DB;
use View;
use Session;
use Validator;

// Models
use App\Models\Customer;

class CustomerController extends CoreController
{
	public $loggedInUser;
    public $data;
    public $activeMenu = 'customer';
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
        $this->data['dt_perpage'] = Session::get('customer_data_perpage', 10);
        $this->data['dt_page'] = Session::get('customer_data_page', 1);
        $this->data['dt_ajax_url'] = route('customer.getcustomerajaxlistdata');
        $this->data['dt_search_colums'] = ['fname','fstatus','fcustomer','femail','fmobile'];
        $this->data['title'] = 'Customer Management';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = $this->activeSubmenu;
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Customer Management',
            ],
        ];

        return view('customer.index', $this->data);
    }

    public function getcustomerajaxlistdata(Request $request)
    {
        $columnList = [
            0 => 'customer_id',
            1 => 'name',
            2 => 'email',
            3 => 'mobile',
            4 => 'status',
            5 => 'status',
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
            'fcustomer' => (!is_null($request->fcustomer))?$request->fcustomer:null,
            'femail' => (!is_null($request->femail))?$request->femail:null,
            'fmobile' => (!is_null($request->fmobile))?$request->fmobile:null,
            'fstatus' => (!is_null($request->fstatus))?$request->fstatus:null,
        ];

        $customers = Customer::getAjaxListData($criteria, $iPage, $orderColumn, $orderDir);

        $iTotalRecords = $customers->total();
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

        foreach ($customers as $customer) {
            $status = $statusList[$customer->status];
            $records["data"][] = [
                $customer->customer_id,
                $customer->name,
                $customer->email,
                $customer->mobile,
                '<span class="badge badge-light-'.(key($status)).' badge-roundless">'.(current($status)).'</span>',
                '<a class="text-secondary" href="'.route('customer.editCustomer', ['id'=>$customer->id]).'" data-toggle="modal" data-target="#ajaxModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>'
            ];
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        return response()->json($records);
    }
    
    public function editCustomer(Request $request)
    {
        if($request->id) {
            $this->data['customer'] = $customer = Customer::find($request->id);
        }
        return view('customer.editCustomer', $this->data);
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'email' => 'required|email|unique:customers,email,'.$request->id,
            'mobile' => 'required|regex:/^[6789]\d{9}$/|unique:customers,mobile,'.$request->id,
            'status'=>'required',
        ],
        [
            'mobile.unique' =>'Mobile number has already been taken.', 
            'email.unique' =>'Email has already been taken.',           

        ]);

        if($validator->fails()) {
            return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
        }
        
        DB::beginTransaction();
        try {
            $customer = Customer::find($request->id);
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->mobile = $request->mobile;
            $customer->status = $request->status;
            $customer->save();

            DB::commit();

            __setFlashMessage(['toast'=>'1','status'=>'success','title'=>'Customer','message'=>'Success! Customer data updated successfully.']);
            return response()->json(['status'=>'success']);
        }
        catch(Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'error','title'=>'Customer','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $deleteCustomer = Customer::where(['id'=>$id])->delete();

            DB::commit();

            return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Customer','message'=>'Success! Customer deleted successfully.']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['success'=>2, 'message'=>"Error! Some error occured, please try again."], 200);
        }
    }

    public function changeStatus(Request $request)
    {
    	if($request->table=='customers') $status = ($request->status=='true')?1:0;
		else  $status = ($request->status=='true')?'y':'n';
    	return DB::table($request->table)
		    	->where('id', $request->id)
		    	->update([
		    		'status' => $status,
		    		'updated_at' => date('Y-m-d H:i:s')
		    	]);
    }
}
