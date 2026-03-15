<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use DB;
use Rule;
use View;
use Session;
use Validator;

// Models
use App\Models\Category;
use App\Models\ChildCategory;

class CategoryController extends CoreController
{
	public $loggedInUser;
    public $data;
    public $activeMenu = 'category';
    public $activeSubmenu = '';

    public function __construct()
    {
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
        $this->data['dt_perpage'] = Session::get('category_perpage', 10);
        $this->data['dt_page'] = Session::get('category_page', 1);
        $this->data['dt_ajax_url'] = route('category.getcategoryajaxlistdata');
        $this->data['dt_search_colums'] = ['fname','fstatus'];
        $this->data['title'] = 'Category Management';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = 'categories';
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Category Management',
            ],
        ];
        $this->data['category'] = Category::whereNull('deleted_at')->orderBy('name','asc')->get();

        return view('category.index', $this->data);
    }

    public function getcategoryajaxlistdata(Request $request)
    {
        $columnList = [
            0 => 'name',
            1 => 'icon',
            2 => 'status',
            3 => 'status',
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
            'fname' => ($request->fname)?:null,
            'search' => $request->search['value'],
            'fstatus' => (!is_null($request->fstatus))?$request->fstatus:null,
        ];

        $categories = Category::getAjaxListData($criteria, $iPage, $orderColumn, $orderDir);

        $iTotalRecords = $categories->total();
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

        foreach ($categories as $category) {
            $status = $statusList[$category->status];
            $records["data"][] = [
                $category->name,
                '<img src="'.$category->icon.'" id="'.$category->icon.'" data-toggle="modal" data-target="#imgmyModal" onclick="showSlides(this)" class="categoryicon-thumbnail-img" alt="'.$category->name.'" height="50" width="50"/>',
                '<span class="badge badge-light-'.(key($status)).' badge-roundless">'.(current($status)).'</span>',
                '<a class="text-secondary" href="'.route('category.addEditCategory', ['id'=>$category->id]).'" data-toggle="modal" data-target="#ajaxModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>
                <a href="javascript:;" del-url="'.route('category.delete', ['id'=>$category->id]).'" class="text-secondary delete-record">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </a>',
            ];
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        return response()->json($records);
    }

    public function addEditCategory(Request $request)
    {
        $this->data = [];
        if($request->id) {
            $this->data['category'] = $category = Category::find($request->id);
        }

        return view('category.addEditCategory', $this->data);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'customFile'=>'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'status'=>'required',
        ]);

        if(!empty($request->name)) {
            $isExist = Category::where(['name'=>$request->name])->exists();
            if($isExist) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'name', 'Category name already exists!'
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
            $category = new Category();
            $category->name = $request->name;
            $category->icon = $fileUploadPath;
            $category->status = $request->status;
            $category->save();

            DB::commit();

            __setFlashMessage(['toast'=>'1','status'=>'success','title'=>'Category','message'=>'Success! New Category created successfully.']);
            return response()->json(['status'=>'success']);
        }
        catch(Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'error','title'=>'Category','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'customFile'=>'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'status'=>'required',
        ],
        [
            'customFile.image' =>'File type must be an image', 
            'customFile.mimes' =>'Only *jpeg,*jpg,*png,*gif,*svg files are accepted.',           
        ]);

        if (!empty($request->name)) {
            $isExist = Category::where('name', $request->name)->where('id', '<>', $request->id)->exists();
            if ($isExist) {
                $validator->after(function ($validator) {
                    $validator->errors()->add('name', 'Category name already exist!');
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
            $category = Category::find($request->id);
            $category->name = $request->name;
            if($fileUploadPath !='' )
                $category->icon = $fileUploadPath;
            $category->status = $request->status;
            $category->save();

            if($request->status==0){
                $subcategory = ChildCategory::where('category_id',$request->id)->update(['status' => 0]);
            }
            else if($request->status==1)
            {
                $subcategory = ChildCategory::where('category_id',$request->id)->update(['status' => 1]);     
            }

            DB::commit();

            __setFlashMessage(['toast'=>'1','status'=>'success','title'=>'Category','message'=>'Success! New Category updated successfully.']);
            return response()->json(['status'=>'success']);
        }
        catch(Exception $e) {
            return $e;
            DB::rollback();
            return response()->json(['status'=>'error','title'=>'Category','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $deleteCategory = Category::where(['id'=>$id])->delete();
            $deleteSubCategory = ChildCategory::where(['category_id'=>$id])->delete();

        DB::commit();

            return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Category','message'=>'Success! Category deleted successfully.']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['success'=>2, 'message'=>"Error! Some error occured, please try again."], 200);
        }
    }

}