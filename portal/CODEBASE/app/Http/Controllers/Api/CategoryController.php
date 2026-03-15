<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Hash;
use Validator;
use Carbon\Carbon;
use Avatar;
use Mail;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\URL;

class CategoryController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getCategorysByNameandLocation(Request $request)
    {
        $details = array();
        try {


            $validator = \Validator::make($request->all(), [
                'category' => 'required',
            ]);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
                return response()->json(['error' => true, 'response' =>  $response['response']]);
            }
            $location_id = $request->input('location_id');
            $category_name = $request->input('category');
            $url =  URL::to('/');
            if ($location_id) {
                $categorys = DB::table('categories')
                    ->join('vendor_project_info', 'categories.id', '=', 'vendor_project_info.category')
                    ->join('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')

                    ->where('categories.name', 'LIKE', '%' . $category_name . '%')
                    ->where('vendors.city', '=', $location_id)
                    //->where('categories.mobile_visible', '=', 1)
                    ->where('vendors.status', '=', 1)

                    ->select('categories.*', 'vendor_project_info.*', 'vendors.company as company_name', 'vendors.first_name as vendor_first_name', 'vendors.last_name as vendor_last_name')
                    ->get();
            } else {
                $categorys = DB::table('categories')
                    ->join('vendor_project_info', 'categories.id', '=', 'vendor_project_info.category')
                    ->join('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')

                    ->where('categories.name', 'LIKE', '%' . $category_name . '%')
                    // ->where('vendors.city', '=', $location_id)
                    //->where('categories.mobile_visible', '=', 1)
                    ->where('vendors.status', '=', 1)

                    ->select('categories.*', 'vendors.company as company_name', 'vendor_project_info.*', 'vendors.first_name as vendor_first_name', 'vendors.last_name as vendor_last_name')
                    ->get();
            }
            //  echo count($categorys);
            if (count($categorys) < 1) {
                if ($location_id) {
                    $categorys = DB::table('childcategories')
                        ->join('vendor_project_info', 'childcategories.id', '=', 'vendor_project_info.subcategory')
                        ->join('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')

                        ->where('childcategories.name', 'LIKE', '%' . $category_name . '%')
                        // ->where('vendors.city', '=', $location_id)
                        // ->where('childcategories.mobile_visible', '=', 1)
                        ->where('vendors.status', '=', 1)
                        // if($location_id){
                        ->where('vendors.city', '=', $location_id)
                        ->select('childcategories.*', 'vendor_project_info.*', 'vendors.company as company_name', 'vendors.first_name as vendor_first_name', 'vendors.last_name as vendor_last_name')
                        ->get();
                } else {

                    $categorys = DB::table('childcategories')
                        ->join('vendor_project_info', 'childcategories.id', '=', 'vendor_project_info.subcategory')
                        ->join('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')

                        ->where('childcategories.name', 'LIKE', '%' . $category_name . '%')
                        // ->where('vendors.city', '=', $location_id)
                        //->where('childcategories.mobile_visible', '=', 1)
                        ->where('vendors.status', '=', 1)
                        // if($location_id){
                        //     $categorys->where('vendors.city', '=', $location_id);

                        // }


                        ->select('childcategories.*', 'vendors.company as company_name', 'vendor_project_info.*', 'vendors.first_name as vendor_first_name', 'vendors.last_name as vendor_last_name')
                        ->get();
                }
            }

            foreach ($categorys as $category) {
                $details['company_name'] = $category->company_name;
                $details['category_name'] = $category->name;
                if ($category->images) {


                    $images = json_decode($category->images);
                    unset($category->images);
                    $images_data = array();
                    foreach ($images as $image) {
                        // print_r($image);
                        // exit;
                        $name = $url . "/" . $image->name;
                        $vendor_name = $category->vendor_first_name . $category->vendor_last_name;
                        // echo $name;exit;
                        $details['results'][] = array("name" => $name, "comapny_name" => $category->company_name, "description" => $image->description, "vendor_id" => $category->vendor_ref_id, "vendor_name" => $vendor_name, "vendor_design_id" => $category->id);
                        //  array_push(array("name"=>$name,"description"=> $image->description),$category->images);
                        // $id++;
                    }
                }
                // $category->images=$images_data;
                // }

                //  print_r($category);
                //                      exit;
                //  echo base_url();

                //  $details[] = $category;
            }
            return response()->json(['success' => true, "data" => $details]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, "message" => $e->getMessage()]);
        }
    }



    public function getAllcategorysandSubcategorys()
    {
        try {
            $details = array();
            $child_details = array();
            $url =  URL::to('/');
            $categorys = DB::table('categories')
                //  ->leftjoin('childcategories', 'childcategories.category_id', 'categories.id')
                ->select('categories.*')
                ->whereNull('deleted_at')
                ->where('mobile_visible', '=', 1)
                ->get();
            foreach ($categorys as $category) {
                $category->icon = $url . "/" . $category->icon;
                $details[] = $category;
            }
            $child_categorys = DB::table('childcategories')
                //  ->leftjoin('childcategories', 'childcategories.category_id', 'categories.id')
                ->select('childcategories.name as child_name', 'childcategories.sort_order as sort_order', 'childcategories.id as child_id', 'childcategories.icon as child_icon', 'childcategories.status as child_status', 'childcategories.mobile_visible as mobile_visible')
                ->whereNull('deleted_at')
                ->where('mobile_visible', '=', 1)
                ->get();
            foreach ($child_categorys as $category) {
                $category->child_icon = $url . "/" . $category->child_icon;
                $child_details[] = $category;
            }
            $all_categorys = array_merge($details, $child_details);
            return response()->json(['success' => true, "data" => $all_categorys]);
        } catch (\Exception $e) {
            return response()->json(['success' => true, "message" => $e->getMessage()]);
        }
    }


    public function getAllDesigns(Request $request)
    {
        $details = array();
        try {


            // $validator = \Validator::make($request->all(), [
            //     "location_id" => 'required', 'category' => 'required',
            // ]);
            // if ($validator->fails()) {
            //     $response['response'] = $validator->messages();
            //     return response()->json(['error' => true, 'response' =>  $response['response']]);
            // }
            $location_id = $request->input('location_id');
            // $category_name = $request->input('category');
            $url =  URL::to('/');
            if ($location_id) {
                $categorys = DB::table('categories')
                    ->join('vendor_project_info', 'categories.id', '=', 'vendor_project_info.category')
                    ->join('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')
                    ->leftjoin('reviews', 'vendors.id', '=', 'reviews.vendor_id')

                    // ->where('categories.name', 'LIKE', '%' . $category_name . '%')
                    ->where('vendors.city', '=', $location_id)
                    //  ->where('categories.mobile_visible', '=', 1)
                    ->where('vendors.status', '=', 1)
                   // ->where('vendor_project_info.subcategory', '=', NULL)
                    ->whereNull('vendor_project_info.deleted_at')

                    ->select('categories.*', 'vendors.id as vendor_id','vendor_project_info.*', 'vendor_project_info.id as design_id', 'vendors.first_name as vendor_first_name', 'vendors.last_name as vendor_last_name', 'vendors.photo as vendor_image', 'vendors.no_of_projects', 'vendors.company')
                      ->groupBy('vendor_project_info.id')
                    ->get();
            } else {
                $categorys = DB::table('categories')
                    ->join('vendor_project_info', 'categories.id', '=', 'vendor_project_info.category')
                    ->join('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')
                    ->leftjoin('reviews', 'vendors.id', '=', 'reviews.vendor_id')

                    // ->where('categories.name', 'LIKE', '%' . $category_name . '%')
                    //  ->where('vendors.city', '=', $location_id)
                    // ->where('categories.mobile_visible', '=', 1)
                    ->where('vendors.status', '=', 1)
                   // ->where('vendor_project_info.subcategory', '=', NULL)
                    ->whereNull('vendor_project_info.deleted_at')


                    ->select('categories.*', 'vendors.id as vendor_id', 'vendor_project_info.*', 'vendor_project_info.id as design_id', 'vendors.first_name as vendor_first_name', 'vendors.last_name as vendor_last_name', 'vendors.company', 'vendors.photo as vendor_image', 'vendors.no_of_projects')
                    ->groupBy('vendor_project_info.id')
                    ->get();
            }

            foreach ($categorys as $category) {
                $reviwes_count = 0;
                $reviwes_count_data = DB::table('reviews')->where('vendor_id', '=', $category->vendor_id)->select(DB::raw('AVG(reviews.rate_us)  AS rating'), DB::raw('count(reviews.id)  AS reviews_count'))->first();
                // if ($reviwes_count_data) {
                //     $reviwes_count=$reviwes_count_data;
                // }
                $vendor_name = "";
                $company_name = "";
                $category_data = (array)$category;
                $category_data['reviews_count'] = $reviwes_count_data->reviews_count;
                $category_data['rating'] = $reviwes_count_data->rating;

                $category_data['icon'] = $url . "/" . $category_data['vendor_image'];
                $category_data['images'] = json_decode($category_data['images']);
                $vendor_name = $category_data['vendor_first_name'] . $category_data['vendor_last_name'];
                $company_name = $category_data['company'];
                //$vendor_name="";
                $images_data = array();
                if ($category_data['images']) {
                    $count = 0;
                    foreach ($category_data['images'] as $image) {
                        $count++;

                        // print_r($image);
                        // exit;
                        $name = $url . "/" . $image->name;
                        if ($count == 1) {
                            $category_data['image'] =  $name;
                        }

                        // echo $name;exit;
                        $category_data['images_data'][] = array("name" => $name, "description" => $image->description, "company_name" => $company_name, "vendor_id" => $category_data['vendor_ref_id'], "vendor_name" => $vendor_name, "design_id" => $category_data['design_id']);
                    }
                    unset($category_data['images']);
                }

                //

                // if (isset($details[$category_data['category']])) {
                //     $details[$category_data['category']][]=$category_data;
                // }else{
                $details[$category_data['name']][] = $category_data;
                //  }

            }
            if ($location_id) {
                $childcategories = DB::table('childcategories')
                    ->join('vendor_project_info', 'childcategories.id', '=', 'vendor_project_info.subcategory')
                    ->join('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')
                    ->leftjoin('reviews', 'vendors.id', '=', 'reviews.vendor_id')

                    // ->where('categories.name', 'LIKE', '%' . $category_name . '%')
                    ->where('vendors.city', '=', $location_id)
                    //  ->where('categories.mobile_visible', '=', 1)
                    ->where('vendors.status', '=', 1)
                    ->whereNull('vendor_project_info.deleted_at')

                    ->select('childcategories.*','vendors.id as vendor_id', 'vendor_project_info.*', 'vendor_project_info.id as design_id', 'vendors.first_name as vendor_first_name', 'vendors.last_name as vendor_last_name', 'vendors.photo as vendor_image', 'vendors.no_of_projects', 'vendors.company')
                    ->groupBy('vendor_project_info.id')
                    ->get();
            } else {
                $childcategories = DB::table('childcategories')
                    ->join('vendor_project_info', 'childcategories.id', '=', 'vendor_project_info.subcategory')
                    ->join('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')
                    ->leftjoin('reviews', 'vendors.id', '=', 'reviews.vendor_id')

                    // ->where('categories.name', 'LIKE', '%' . $category_name . '%')
                    //  ->where('vendors.city', '=', $location_id)
                    // ->where('categories.mobile_visible', '=', 1)
                    ->where('vendors.status', '=', 1)
                    ->whereNull('vendor_project_info.deleted_at')

                    ->select('childcategories.*', 'vendors.id as vendor_id', 'vendor_project_info.*', 'vendor_project_info.id as design_id', 'vendors.first_name as vendor_first_name', 'vendors.last_name as vendor_last_name', 'vendors.company', 'vendors.photo as vendor_image', 'vendors.no_of_projects')
                    ->groupBy('vendor_project_info.id')
                    ->get();
            }

            foreach ($childcategories as $category) {
                $reviwes_count = 0;
                $reviwes_count_data = DB::table('reviews')->where('vendor_id', '=', $category->vendor_id)->select(DB::raw('AVG(reviews.rate_us)  AS rating'), DB::raw('count(reviews.id)  AS reviews_count'))->first();
                // if ($reviwes_count_data) {
                //     $reviwes_count=$reviwes_count_data;
                // }
                $vendor_name = "";
                $company_name = "";
                $category_data = (array)$category;
                $category_data['reviews_count'] = $reviwes_count_data->reviews_count;
                $category_data['rating'] = $reviwes_count_data->rating;

                $category_data['icon'] = $url . "/" . $category_data['vendor_image'];
                $category_data['images'] = json_decode($category_data['images']);
                $vendor_name = $category_data['vendor_first_name'] . $category_data['vendor_last_name'];
                $company_name = $category_data['company'];
                //$vendor_name="";
                $images_data = array();
                if ($category_data['images']) {
                    $count = 0;
                    foreach ($category_data['images'] as $image) {
                        $count++;

                        // print_r($image);
                        // exit;
                        $name = $url . "/" . $image->name;
                        if ($count == 1) {
                            $category_data['image'] =  $name;
                        }

                        // echo $name;exit;
                        $category_data['images_data'][] = array("name" => $name, "description" => $image->description, "company_name" => $company_name, "vendor_id" => $category_data['vendor_ref_id'], "vendor_name" => $vendor_name, "design_id" => $category_data['design_id']);
                    }
                    unset($category_data['images']);
                }

                //

                // if (isset($details[$category_data['category']])) {
                //     $details[$category_data['category']][]=$category_data;
                // }else{
                $details[$category_data['name']][] = $category_data;
                //  }

            }
            return response()->json(['success' => true, "data" => $details]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, "message" => $e->getMessage()]);
        }
    }


    public function getVendorDesignById(Request $request)
    {
        $details = array();
        try {

            $validator = \Validator::make($request->all(), [
                "vendor_design_id" => 'required'
            ]);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
                return response()->json(['error' => true, 'response' =>  $response['response']]);
            }
            $url =  URL::to('/');
            $id = $request->input('vendor_design_id');
            $design_data = DB::table('vendor_project_info')->where('id', '=', $id)->first();
            if ($design_data) {

                $design_details = (array)$design_data;

                $design_details['images'] = json_decode($design_details['images']);
                $images_data = array();
                foreach ($design_details['images'] as $image) {
                    // print_r($image);
                    // exit;
                    $name = $url . "/" . $image->name;
                    //$vendor_name = $category_data['vendor_first_name'].$category_data['vendor_last_name'];
                    // echo $name;exit;
                    $details[] = array("name" => $name, "description" => $image->description, "vendor_id" => $design_details['vendor_ref_id'], "design_id" => $design_details['id'], "category_id" => $design_details['category']);
                }
                unset($design_details['images']);
            }
            return response()->json(['success' => true, "data" => $details]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, "message" => $e->getMessage()]);
        }
    }

    public function getAllLocations()
    {
        $alllocations = DB::table('cities')->get();
        return response()->json(['success' => true, "data" => $alllocations]);
    }
}
