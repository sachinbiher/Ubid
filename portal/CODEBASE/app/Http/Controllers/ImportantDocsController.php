<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use DB;
use Redirect;
use Session;
use Validator;

//Modals
use App\Models\TermsAndCondtion;

class ImportantDocsController extends CoreController
{
    public $loggedInUser;
    public $data;
    public $activeMenu = 'importantdocs';
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
        $this->data['dt_perpage'] = Session::get('documents_perpage', 10);
        $this->data['dt_page'] = Session::get('documents_page', 1);
        $this->data['dt_ajax_url'] = route('importantdocs.getAjaxListData');
        $this->data['dt_search_colums'] = ['fname','fstatus'];
  
        $this->data['title'] = 'Documents List';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = $this->activeSubmenu;
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Documents',
            ],
        ];

        return view('importantdocs.index', $this->data);
    }

    /**
     * [get all Terms and Condtions and for datatable through Ajax]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getAjaxListData(Request $request)
    {
        $columnList = [
            0 => 'id',
            1 => 'name',
            2 => 'updated_at'
        ];

        $order = (isset($_REQUEST['order']))?$_REQUEST['order'][0]:['column'=>1, 'dir'=>'desc'];
        $orderColumn = $columnList[$order['column']];
        $orderDir = $order['dir'];
        // dd(intval($request->length));
        $iPage = (intval($request->start) / intval($request->length)) + 1;
        
        __setDatatableCurrPage('importantdocs', intval($request->length), $iPage);

        $records = [];
        $records["data"] = [];

        if (isset($request->customActionType)
            && $request->customActionType == "group_action") {
            $records["customActionStatus"] = "OK";
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!";
        }
        

        $criteria = (object)[
            'length' => intval($request->length),
            'search' => $request->search['value'],
            'fname' => (!is_null($request->fname))?$request->fname:null,
            'fstatus' => (!is_null($request->fstatus))?$request->fstatus:null,
        ];

        $termsandcondtions = TermsAndCondtion::getAjaxListData($criteria, $iPage, $orderColumn, $orderDir);

        $iTotalRecords = $termsandcondtions->total();
        
        $iDisplayLength = intval($request->length);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($request->start);
        $sEcho = intval($request->draw);

        $end = $iDisplayStart + $iDisplayLength;

        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        // $canChange = ($this->loggedInUser->hasRole('Super Admin') || $this->loggedInUser->hasRole('Admin'));

        $featuredList = [
            ["danger" => "No"],
            ["primary" => "Yes"]
        ];

        $statusList = [
            ["danger" => "Inactive"],
            ["success" => "Active"]
        ];
        $k=1;
        foreach ($termsandcondtions as $condtions) {
            $status = $statusList[$condtions->status];

            $records["data"][] = [
                $condtions->name,
                $condtions->display_name,
                '<span class="badge badge-light-'.(key($status)).' badge-roundless">'.(current($status)).'</span>',
                '<a class="text-secondary" href="'.route('importantdocs.edit', ['id'=>$condtions->id]).'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>
                <a class="text-secondary" href="'.route('importantdocs.view', ['id'=>$condtions->id]).'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye font-small-4 mr-50"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>',                
            ];
            $k++;
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        return response()->json($records);
    }

    /**
     * [Add new Conditions]
     * @param  Request $request [description]
     * @return [type]           [description]
    */
    public function add(Request $request)
    {
        if ($request->save) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'display_name' => 'required|string',
                'description'=>'required',         
            ]);

            if (!empty($request->name)) {
                $isExist = TermsAndCondtion::where('name', $request->name)->exists();
                if ($isExist) {
                    $validator->after(function ($validator) {
                        $validator->errors()->add('name', 'Name already exist!');
                    });
                }
            }

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            try {
                $tblData = new TermsAndCondtion();
                $tblData->name = $request->name;
                $tblData->display_name = $request->display_name;
                $tblData->description = $request->description;

                if($tblData->save()) {
                    DB::commit();
                    // Cache::tags('POLICIES')->flush();
                    return redirect()
                            ->route('importantdocs')
                            ->with(['toast'=>'1','status'=>'success','title'=>'Documents','message'=>'Success! Added successfully.']);
                }
                else
                    return redirect()
                            ->route('importantdocs')
                            ->with(['toast'=>'1','status'=>'error','title'=>'Documents','message'=>'Error! Some error occured, please try again.']);
            } catch (Exception $e) {
                // dd($e);
                DB::rollback();
                return back();
            }
        }
  
        $this->data['title'] = 'Add New Document';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = $this->activeSubmenu;
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Documents',
            ],
        ];

        return view('importantdocs.addEditDocs', $this->data);
    }

    /**
     * [Edit the existing Conditions]
     * @param  Request $request [description]
     * @return [type]           [description]
    */
    public function edit(Request $request, $id)
    {
        $condtions = TermsAndCondtion::find($id);

        if ($request->save) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'display_name' => 'required|string',
                'description'=>'required',    
            ]);

            if (!empty($request->name)) {
                $isExist = TermsAndCondtion::where('name', $request->name)->where('id', '<>', $id)->exists();
                if ($isExist) {
                    $validator->after(function ($validator) {
                        $validator->errors()->add('name', 'Name already exist!');
                    });
                }
            }

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            try {
                $tblData = new TermsAndCondtion();
                $tblData=[
                    'name' => $request->name,
                    'display_name' => $request->display_name,
                    'description' => $request->description,
                    'status' => $request->status,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $update = TermsAndCondtion::where('id',$id)->update($tblData);

                if($update) {
                    DB::commit();
                    // Cache::tags('POLICIES')->flush();
                    if($request->save == 'save') {
                        return redirect()
                                ->route('importantdocs')
                                ->with(['toast'=>'1','status'=>'success','title'=>'Documents','message'=>'Success! Data updated successfully.']);
                    }
                    else {
                        return redirect()
                                ->back()
                                ->with(['toast'=>'1','status'=>'success','title'=>'Documents','message'=>'Success! Data updated successfully.']);
                    }
                }
                else
                    return redirect()
                            ->route('importantdocs')
                            ->with(['toast'=>'1','status'=>'error','title'=>'Documents','message'=>'Error! Some error occured, please try again.']);
            } catch (Exception $e) {
                // dd($e);
                DB::rollback();
                return back();
            }
        }

        $this->data['condtions'] = $condtions;
        $this->data['id'] = $id;
  
        $this->data['title'] = 'Edit Document';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = $this->activeSubmenu;
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => 'importantdocs',
                'title' => 'Documents',
            ],
            (object) [
                'url' => false,
                'title' => $condtions->name,
            ],
        ];

        return view('importantdocs.addEditDocs', $this->data);
    }

    /**
     * [View the existing Conditions]
     * @param  Request $request [description]
     * @return [type]           [description]
    */
    public function view(Request $request, $id)
    {
        $condtions = TermsAndCondtion::find($id);

        $this->data['condtions'] = $condtions;
        $this->data['id'] = $id;
        $this->data['type'] = 'view';
  
        $this->data['title'] = 'View Document';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = $this->activeSubmenu;
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => 'importantdocs',
                'title' => 'Documents',
            ],
            (object) [
                'url' => false,
                'title' => $condtions->name,
            ],
        ];

        return view('importantdocs.addEditDocs', $this->data);
    }

    public function changeStatus(Request $request)
    {
    	if($request->table=='terms-conditions') $status = ($request->status=='true')?1:0;
		else  $status = ($request->status=='true')?'y':'n';
    	return DB::table($request->table)
		    	->where('id', $request->id)
		    	->update([
		    		'status' => $status,
		    		'updated_at' => date('Y-m-d H:i:s')
		    	]);
    }

}
