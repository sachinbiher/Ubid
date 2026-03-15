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

class VendorDesignController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function getTopVendors(Request $request)
    {
        try {

            $url =  URL::to('/');
            $Details = array();
            $location_id = $request->input('location_id');
            if ($location_id) {
                $top_vendors = DB::table('vendors')
                 ->leftjoin('reviews', 'vendors.id', '=', 'reviews.vendor_id')
                    ->leftjoin('cities', 'vendors.city', '=', 'cities.id')
                    ->orderBy('created_at', 'desc')
                    ->where('vendors.status', '=', 1)
                    ->where('vendors.profile_status', '=', 1)
                    ->where('vendors.city', '=', $location_id)
                    ->select('vendors.*', 'cities.name as location_name',DB::raw('AVG(reviews.rate_us)  AS rating'), DB::raw('COUNT(reviews.id)  AS reviews_count'))
                    ->groupBy('vendors.id')
                    ->get();
            } else {
                $top_vendors = DB::table('vendors')
                    ->leftjoin('reviews', 'vendors.id', '=', 'reviews.vendor_id')
                    ->leftjoin('cities', 'vendors.city', '=', 'cities.id')

                    ->orderBy('created_at', 'desc')
                    ->where('vendors.status', '=', 1)
                    ->where('vendors.profile_status', '=', 1)
                    ->select('vendors.*','cities.name as location_name', DB::raw('AVG(reviews.rate_us)  AS rating'), DB::raw('COUNT(reviews.id)  AS reviews_count'))
                    ->groupBy('vendors.id')
                    ->get();
            }

            foreach ($top_vendors as $top_vendor) {
                if ($top_vendor->photo != "") {
                    $top_vendor->photo = $url . "/" . $top_vendor->photo;
                }

                $Details[] = $top_vendor;
            }
            return response()->json(['success' => true, "data" => $Details], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => true, "message" => $e->getMessage()]);
        }
    }


    public  function getDesignDetailsByVendor(Request $request)
    {
        try {
            $url =  URL::to('/');
            $details = array();
            $validator = \Validator::make($request->all(), [
                "vendor_id" => 'required', 'category_id' => 'required',
            ]);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
                return response()->json(['error' => true, 'response' =>  $response['response']]);
            }
            $vendor_id = $request->input('vendor_id');
            $category_id = $request->input('category_id');

            $designs_data = DB::table('vendor_project_info')
                ->where('vendor_ref_id', $vendor_id)
                ->where('category', $category_id)
                ->first();
            $images = json_decode($designs_data->images);
            unset($designs_data->images);
            $images_data = array();
            foreach ($images as $image) {
                // print_r($image);
                // exit;
                $name = $url . "/" . $image->name;
                $project_name = $designs_data->projectname;
                $details['name'] = $project_name;
                // echo $name;exit;
                $details[] = array("name" => $name, "description" => $image->description, "vendor_id" => $designs_data->vendor_ref_id);
                //  array_push(array("name"=>$name,"description"=> $image->description),$category->images);
                // $id++;
            }
            return response()->json(['success' => true, "data" => $details]);
        } catch (\Exception $e) {
            return response()->json(['success' => true, "message" => $e->getMessage()]);
        }
    }

    public function getVendorDetailsByVendorId(Request $request)
    {

        try {

            $validator = \Validator::make($request->all(), [
                "vendor_id" => 'required'
            ]);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
                return response()->json(['error' => true, 'response' =>  $response['response']]);
            }
            $vendor_id = $request->input('vendor_id');
            $customer_id = $request->input('customer_id');
            $url =  URL::to('/');
            $Details = array();
            $top_vendors = DB::table('vendors')
                // ->leftjoin('vendor_project_info', 'vendor,'s.id', '=', 'vendor_project_info.vendor_ref_id')
                // ->orderBy('created_at', 'desc')
                //->leftjoin('reviews','vendors.id','=','reviews.customer_id')
                ->where('vendors.id', '=', $vendor_id)


                // ->where('vendors.profile_status', '=', 1)
                ->select('vendors.*')
                //  ->groupBy('vendors.id')
                ->first();
            if ($top_vendors) {

                $top_vendors->services = json_decode($top_vendors->services);
                $id = $top_vendors->id;
                $rating = DB::table('reviews')->where('vendor_id', '=', $id)->where('customer_id', '=', $customer_id)->first();
                $rating_value = "";
                $rating_comments = "";
                if ($rating) {
                    $rating_value = $rating->rate_us;
                    $rating_comments = $rating->comments;
                }
                $top_vendors->rating=$rating_value;
                $top_vendors->rating_comments=$rating_comments;

                $vendors_images = DB::table('vendor_project_info')
                    ->leftjoin('categories', 'vendor_project_info.category', '=', 'categories.id')
                    ->where('vendor_ref_id', '=', $id)
                    ->whereNull('vendor_project_info.deleted_at')
                    ->select('vendor_project_info.*', 'categories.name as category_name')
                    ->get();
                $top_vendors_images = [];
                foreach ($vendors_images as $vendors_image) {
                    $vendors_image = (array)$vendors_image;

                    // // echo"<pre>";var_dump($category);exit>;
                    $vendors_image['images'] = json_decode($vendors_image['images']);
                    $images_data = array();
                    // $vendor_name = $vendors_image['vendor_first_name'].$vendors_image['vendor_last_name'];
                    $design_id = $vendors_image['id'];
                    // $top_vendors_images['category_name']=$vendors_image['category_name'];
                    if ($vendors_image['images']) {
                        foreach ($vendors_image['images'] as $image) {
                            // print_r($image);
                            // exit;
                            $name = $url . "/" . $image->name;
                            $top_vendors_images[] = array("name" => $name, "description" => $image->description, "vendor_id" => $vendors_image['vendor_ref_id'], "vendor_design_id" => $design_id, "rating_value" => $rating_value, "rating_comments" => $rating_comments,"company_name"=>$top_vendors->company);
                        }
                        unset($vendors_image['images']);
                    }

                    // $top_vendors_images[$vendors_image['category_name']][]=  $top_vendors_images;


                }
                $top_vendors->images_data = $top_vendors_images;
            }

            return response()->json(['success' => true, "data" => $top_vendors], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => true, "message" => $e->getMessage()]);
        }
    }
    public function getBannerImages()
    {
        $banner_images = ["/uploads/banner_1.png", "/uploads/banner_2.png", "/uploads/banner_3.png"];
        $url =  URL::to('/');
        $image_data = array();
        foreach ($banner_images as $image) {
            $image_data[] = $url . $image;
        }
        return response()->json(['success' => true, "data" => $image_data], 200);
    }


    public function getAllVendorDesignsByCategory(Request $request)
    {
        try {
            $url =  URL::to('/');
            $details = array();
            $validator = \Validator::make($request->all(), [
              //  'category_id' => 'required',
            ]);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
                return response()->json(['error' => true, 'response' =>  $response['response']]);
            }
            // $vendor_id = $request->input('vendor_id');
            $category_id = $request->input('category_id');
            $subcategory_id = $request->input('sub_category_id');

            
            $location_id = $request->input('location_id');
            if($category_id){
                if ($location_id) {
                    $designs_datas = DB::table('vendor_project_info')
                        ->leftjoin('categories', 'vendor_project_info.category', '=', 'categories.id')
                        ->leftjoin('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')
                        // ->where('vendor_ref_id', $vendor_id)
                        ->where('category', $category_id)
                        ->where('vendors.city', $location_id)
                        ->where('vendors.status', '=', 1)
                        ->whereNull('vendor_project_info.deleted_at')

                        
                        ->select('vendor_project_info.*', 'categories.name as category_name', 'vendors.first_name as firstname', 'vendors.last_name as lastname','vendors.company as company_name')
                        ->get();
                } else {
                    $designs_datas = DB::table('vendor_project_info')
                        ->leftjoin('categories', 'vendor_project_info.category', '=', 'categories.id')
                        ->leftjoin('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')
                        // ->where('vendor_ref_id', $vendor_id)
                        ->where('category', $category_id)
                        ->where('vendors.status', '=', 1)
                        ->whereNull('vendor_project_info.deleted_at')

                        ->select('vendor_project_info.*', 'categories.name as category_name', 'vendors.first_name as firstname', 'vendors.last_name as lastname','vendors.company as company_name')
                        ->get();
                }
            }
            if($subcategory_id){

            if ($location_id) {
                $designs_datas = DB::table('vendor_project_info')
                ->leftjoin('childcategories', 'vendor_project_info.subcategory', '=', 'childcategories.id')
                ->leftjoin('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')
               // ->where('vendor_ref_id', $vendor_id)
                    ->where('subcategory', $subcategory_id)
                    ->where('vendors.city', $location_id)
                    ->where('vendors.status', '=', 1)
                    ->whereNull('vendor_project_info.deleted_at')

                    ->select('vendor_project_info.*', 'childcategories.name as category_name', 'vendors.first_name as firstname', 'vendors.last_name as lastname','vendors.company as company_name')
                    ->get();
            } else {
                $designs_datas = DB::table('vendor_project_info')
                    ->leftjoin('childcategories', 'vendor_project_info.subcategory', '=', 'childcategories.id')
                    ->leftjoin('vendors', 'vendor_project_info.vendor_ref_id', '=', 'vendors.id')
                    // ->where('vendor_ref_id', $vendor_id)
                    ->where('subcategory', $subcategory_id)
                    ->where('vendors.status', '=', 1)
                    ->whereNull('vendor_project_info.deleted_at')

                    ->select('vendor_project_info.*', 'childcategories.name as category_name', 'vendors.first_name as firstname', 'vendors.last_name as lastname','vendors.company as company_name')
                    ->get();
            }
        }

            foreach ($designs_datas as $designs_data) {

                $company_name="";
                $images = json_decode($designs_data->images);
                unset($designs_data->images);
                $images_data = array();
                $category_name = $designs_data->category_name;
                $vendor_name = $designs_data->firstname . $designs_data->lastname;
                $company_name=$designs_data->company_name;
                if ($images) {
                    foreach ($images as $image) {
                        // print_r($image);
                        // exit;
                        $name = $url . "/" . $image->name;

                        $project_name = $designs_data->projectname;
                        //$details['name'] = $project_name;
                        // echo $name;exit;
                        $details[] = array("name" => $name, "vendor_design_id" => $designs_data->id, "description" => $image->description, "vendor_id" => $designs_data->vendor_ref_id, "category_name" => $category_name, "vendor_name" => $vendor_name,"company_name"=>$company_name);
                        //  array_push(array("name"=>$name,"description"=> $image->description),$category->images);
                        // $id++;
                    }
                }
            }
            return response()->json(['success' => true, "data" => $details]);
        } catch (\Exception $e) {
            return response()->json(['success' => true, "message" => $e->getMessage()]);
        }
    }

    public function Addrating(Request $request)
    {
        try {
            $url =  URL::to('/');
            $details = array();
            $validator = \Validator::make($request->all(), [
                'customer_id' => 'required', 'vendor_id' => 'required', 'rate_us', 'comments'
            ]);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
                return response()->json(['error' => true, 'response' =>  $response['response']]);
            }
            $input = $request->all();
            $rating_data =    DB::table('reviews')->insert($input);
            if ($rating_data) {
                return $this->respond(['success' => true, 'message' => 'Rating Added Succesfully!'], 200);
            } else {
                return $this->respond(['success' => false, 'message' => 'Error Occured!'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => true, "message" => $e->getMessage()]);
        }
    }

    public function getratingbyVendor(Request $request)
    {
        try {
            $url =  URL::to('/');
            $details = array();
            $validator = \Validator::make($request->all(), [
                'vendor_id' => 'required'
            ]);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
                return response()->json(['error' => true, 'response' =>  $response['response']]);
            }
            $vendor_id = $request->input('vendor_id');
            $rating_data =    DB::table('reviews')
                ->leftjoin('customers', 'reviews.customer_id', '=', 'customers.id')
                ->select('customers.name as customer_anme', 'reviews.*')
                ->where('vendor_id', '=', $vendor_id)
                ->get();
            $details = [];
            foreach ($rating_data as  $rating) {
                $details[] = $rating;
            }
            return response()->json(['success' => true, "data" => $details]);
        } catch (\Exception $e) {
            return response()->json(['success' => true, "message" => $e->getMessage()]);
        }
    }
}
