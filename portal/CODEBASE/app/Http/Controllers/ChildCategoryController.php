<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use DB;
use View;
use Session;
use Validator;


// Models
use App\Models\Category;
use App\Models\ChildCategory;

class ChildCategoryController extends CoreController
{
	public $loggedInUser;
    public $data;
    public $activeMenu = 'category';
    public $activeSubmenu = '';

    public function __construct()
    {
        parent::__construct();

        $this->middleware(function ($request, $next) {
            $this->loggedInUser = auth()->user();
            return $next($request);
        });    
    }

    public function index()
    {
        $this->data['datatable_listing'] = true;
        $this->data['dt_ordering'] = 1;
        $this->data['dt_perpage'] = Session::get('subcategory_data_perpage', 10);
        $this->data['dt_page'] = Session::get('subcategory_data_page', 1);
        $this->data['dt_ajax_url'] = route('childcategory.getchildcategoryajaxlistdata');
        $this->data['dt_search_colums'] = ['fname','fstatus'];
        $this->data['title'] = 'Category Management';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = 'subcategories';
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Category Management',
            ],
        ];

        return view('category.subcategories', $this->data);
    }

    public function getchildcategoryajaxlistdata(Request $request)
    {
        $columnList = [
            0 => 'name',
            1 => 'category_id',
            2 => 'icon',
            3 => 'status',
            4 => 'status',
        ];

        $order = (isset($_REQUEST['order']))?$_REQUEST['order'][0]:['column'=>1, 'dir'=>'desc'];
        $orderColumn = $columnList[$order['column']];
        $orderDir = $order['dir'];
        $iPage = (intval($request->start) / intval($request->length)) + 1;
        
        __setDatatableCurrPage('category', intval($request->length), $iPage);

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
            'fstatus' => (!is_null($request->fstatus))?$request->fstatus:null,
        ];

        $childcategories = ChildCategory::getAjaxListData($criteria, $iPage, $orderColumn, $orderDir);

        $iTotalRecords = $childcategories->total();
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

        foreach ($childcategories as $subcategory) {
            $status = $statusList[$subcategory->status];
            $records["data"][] = [
                $subcategory->subcategory_name,
                @$subcategory->category->name,
                '<img src="'.$subcategory->icon.'" class="categoryicon-thumbnail-img" alt="'.$subcategory->name.'" height="50" width="50"/>',
                '<span class="badge badge-light-'.(key($status)).' badge-roundless">'.(current($status)).'</span>',
                '<a class="text-secondary" href="'.route('childcategory.addEditSubCategory', ['id'=>$subcategory->id]).'" data-toggle="modal" data-target="#ajaxModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>
                <a href="javascript:;" del-url="'.route('childcategory.delete', ['id'=>$subcategory->id]).'" class="text-secondary delete-record">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </a>',
            ];
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        return response()->json($records);
    }

    public function addEditSubCategory(Request $request)
    {
        $this->data['categories'] = Category::where('status',1)->whereNull('deleted_at')->orderBy('name','asc')->get() ;
        if($request->id) {
            $this->data['subcategory'] = $subcategory = ChildCategory::find($request->id);
        }

        return view('category.addEditSubCategory', $this->data);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'parent_category' =>'required',
            'customFile'=>'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'status'=>'required',
        ],
        [
            'customFile.image' =>'File type must be an image', 
            'customFile.mimes' =>'Only *jpeg,*jpg,*png,*gif,*svg files are accepted.',           

        ]);

        if(!empty($request->name)) {
            $isExist = ChildCategory::where(['name'=>$request->name])->exists();
            if($isExist) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'name', 'SubCategory name already exists!'
                    );
                });
            }
        }

        if($validator->fails()) {
            return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
        }

        $fileUploadPath ='';
        if ($file = $request->hasFile('customFile')) {
            $file = $request->file('customFile') ;            
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = 'uploads/images';
            $file->move($destinationPath,$fileName);
            $fileUploadPath = $destinationPath.'/'.$fileName;
        }

        DB::beginTransaction();
        try {
            $childcategory = new ChildCategory();
            $childcategory->name = $request->name;
            $childcategory->category_id = $request->parent_category;
            $childcategory->icon = $fileUploadPath;
            $childcategory->status = $request->status;
            $childcategory->save();

            DB::commit();

            __setFlashMessage(['toast'=>'1','status'=>'success','title'=>'SubCategory','message'=>'Success! New Sub-Category created successfully.']);
            return response()->json(['status'=>'success']);
        }
        catch(Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'error','title'=>'Subcategory','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'parent_category' =>'required',
            'customFile'=>'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'status'=>'required',
        ],
        [
            'customFile.image' =>'File type must be an image', 
            'customFile.mimes' =>'Only *jpeg,*jpg,*png,*gif,*svg files are accepted.',           

        ]);

        if (!empty($request->name)) {
            $isExist = ChildCategory::where('name', $request->name)->where('id', '<>', $request->id)->exists();
            if ($isExist) {
                $validator->after(function ($validator) {
                    $validator->errors()->add('name', 'Sub-Category name already exist!');
                });
            }
        }

        if($validator->fails()) {
            return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
        }
        
        $fileUploadPath ='';
        if ($file = $request->hasFile('customFile')) {
            $file = $request->file('customFile') ;            
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = 'uploads/images';
            $file->move($destinationPath,$fileName);
            $fileUploadPath = $destinationPath.'/'.$fileName;
        }

        DB::beginTransaction();
        try {
            $childcategory = ChildCategory::find($request->id);
            $childcategory->name = $request->name;
            $childcategory->category_id = $request->parent_category;
            if($fileUploadPath !='')
            $childcategory->icon = $fileUploadPath;
            $childcategory->status = $request->status;
            $childcategory->save();

            DB::commit();

            __setFlashMessage(['toast'=>'1','status'=>'success','title'=>'SubCategory','message'=>'Success! Sub-Category updated successfully.']);
            return response()->json(['status'=>'success']);
        }
        catch(Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'error','title'=>'SubCategory','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $deletesubCategory = ChildCategory::where(['id'=>$id])->delete();

            DB::commit();

            return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Sub-Category','message'=>'Success! Sub-Category deleted successfully.']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['success'=>2, 'message'=>"Error! Some error occured, please try again."], 200);
        }
    }

}
