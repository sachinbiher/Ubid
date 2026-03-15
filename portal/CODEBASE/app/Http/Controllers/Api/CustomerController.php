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
use File;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\URL;
use App\Models\Customer;
use Image;
use App\Models\User;
use App\Models\CustomerVendorBids;
use App\Models\Requirements;
use App\Models\Vendor_Bids;

class CustomerController extends ApiController
{
    public function __construct(CustomerVendorBids $customerVendorBids, Requirements $requirements)
    {
        $this->middleware('auth:api');
        $this->customer_vendor_bids = $customerVendorBids;
        $this->requirements = $requirements;
    }

    public function getNotificationlist(Request $request)
    {
        try {


            $validator = \Validator::make($request->all(), [
                "user_id" => 'required'
            ]);
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
                return response()->json(['error' => true, 'response' =>  $response['response']]);
            }
            $search_query = $request->all();
            if (!empty($search_query['id'])) {
                $id = $search_query['id'];
                $result = DB::table('notifications')
                    ->where('id', $id)
                    ->update(['seen' => 1]);
            }
            //   $user_id='';
            //$user_id = $request->input('user_id');
            $user_id = $request->input('user_id');
            //  $user_id=DB::table('users')->where('ref_id','=',$customer_id)->where('user_type','=','customer')->select('id')->first();
            // if($user_id){
            //     $user_id= $user_id->id;
            // }

            $notification_list = DB::table('users')
                ->join('notifications', 'users.id', '=', 'notifications.user_id')
                ->where([['user_id', '=', $user_id], ['seen', '=', 0], ['notify_type', '=', 'c'], ['notifications.deleted_at', '=', null]])
                ->select('notifications.title', 'notifications.content', 'notifications.id')
                ->get();
            return $this->respond(['success' => true, 'data' => $notification_list]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, "message" => $e->getMessage()]);
        }
    }

    public function updateUserProfile(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:3',
                'email' => 'email|unique:customers,email,id',
                'address1' => 'nullable|string',
                'address2' => 'nullable|string',
                'city' => 'nullable|integer',
                'id' => 'required'

            ]);

            if ($validator->fails()) {
                return $this->respond(['success' => false, 'errors' => $validator->errors()], 200);
            }

            $id = $request->input('id');
            $user = User::find($id);
            if ($user) {
                $destinationPath = 'uploads/profile_pics';
                $profilePic = null;
                if ($request->image) {
                    $profilePic = $destinationPath . '/' . time() . '-' . uniqid() . '.jpg';

                    Image::make($request->image)->save($profilePic);
                    $user->profile_pic = $profilePic;
                }

                $user->name = $request->name ? $request->name : $user->name;
                $user->email = $request->email ? $request->email : $user->email;
                $user->save();

                // get customer
                $customer = Customer::where('id',$user->ref_id)->first();
                $customer->name = $request->name ? $request->name : $customer->name;
                $customer->email = $request->email ? $request->email : $customer->email;
                $customer->address1 = $request->address1;
                $customer->address2 = $request->address2;
                $customer->city_id = $request->city ? $request->city : $customer->city_id;
                $customer->save();


                return $this->respond(['success' => true, "data" => "User Updated Sucess Fully"], 200);
            }
            return $this->respond(['success' => false, "data" => "User Not Found"], 200);
        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => 'Some error occured!'], 200);
        }
    }


    public function customerAllBids(Request $request)
    {
        try {


            $validator = \Validator::make($request->all(), [
                'customer_id' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->respond(['success' => false, 'errors' => $validator->errors()], 200);
            }
            $customer_id = $request->input('customer_id');
            $data = array();
            $bids_data = DB::table('requirements')
                ->leftjoin('categories', 'requirements.category_id', '=', 'categories.id')
                ->leftjoin('childcategories', 'requirements.sub_category_id', '=', 'childcategories.id')

                ->leftjoin('vendor_bids', 'requirements.id', '=', 'vendor_bids.requirement_id')
                // ->leftjoin('customer_vendor_bids', 'vendor_bids.id', '=', 'customer_vendor_bids.vendor_bid_id')

                ->where('requirements.customer_id', '=', $customer_id)
                // ->where('customer_vendor_bids.customer_id','=', $customer_id)
                ->select('requirements.*', 'childcategories.name as child_category_name', 'vendor_bids.id as bid_id', 'categories.name as category_name', DB::raw('count(vendor_bids.id)  AS vendors_accepted_count'))
                //->select('requirements.*','customer_vendor_bids.id as bid_id','categories.name as category_name')
                ->groupBy('requirements.id')
                ->get();
            //echo"<pre>";print_r($bids_data);exit;
            $start_date = date('Y-m-d H:m:s');

            foreach ($bids_data as $bid) {
                $end_date = "";
                if ($bid->sub_category_id != null or $bid->category_id != null) {
                    $customers_vendor_bids=DB::table('customer_vendor_bids')->where('vendor_bid_id','=',$bid->bid_id)->first();
                    // $end_date = date($bid->created_at, strtotime("+60 days"));
                    
                    $date = new \DateTime($bid->created_at);
                    $date->add(new \DateInterval('P60D'));
                    $end_date  = $date->format('Y-m-d H:m:s');
                    // $end_date = date($bid->created_at, time() + 86400 * 60);
                    // echo  $start_date;
                    // echo $end_date;exit;

                    if ($end_date >= $start_date or $customers_vendor_bids) {
                        $bid->start_date = $start_date;
                        $bid->end_date = $end_date;

                        $data['active'][] = $bid;
                    } else {
                        $data['inactive'][] = $bid;
                    }
                }
            }
            return $this->respond(['success' => true, "data" => $data], 200);
        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => 'Some error occured!'], 200);
        }
    }

    public function getBidsAcceptedByVendor(Request $request)
    {
        try {

            $validator = \Validator::make($request->all(), [
                'requirement_id' => 'required', 'customer_id' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->respond(['success' => false, 'errors' => $validator->errors()], 200);
            }
            $data = array();
            $require_id = $request->input('requirement_id');
            $accepted_bids_data = DB::table('vendor_bids')
                ->leftjoin('requirements', 'vendor_bids.requirement_id', '=', 'requirements.id')
                ->leftjoin('cities', 'requirements.location', '=', 'cities.id')
                ->leftjoin('vendors', 'vendor_bids.vendor_id', '=', 'vendors.id')
                ->leftjoin('reviews', 'vendors.id', '=', 'reviews.vendor_id')

                ->leftjoin('customer_vendor_bids', 'vendor_bids.id', '=', 'customer_vendor_bids.vendor_bid_id')
                ->where('requirement_id', '=', $require_id)
                ->select('vendor_bids.*', DB::raw('AVG(reviews.rate_us)  AS rating'), DB::raw('COUNT(reviews.id)  AS reviews_count'),'customer_vendor_bids.id as accepted_bid_id', 'requirements.location as location', 'cities.name as locations', 'vendors.first_name as vendor_first_name', 'vendors.last_name as vendor_last_name','vendors.company as company_name')
                ->groupBy('vendor_bids.id')
                ->get();
            foreach ($accepted_bids_data as $bid_data) {
                $bid_data->accepted = 0;
                if ($bid_data->accepted_bid_id != null) {
                    $bid_data->accepted = 1;
                }
                $data[] = $bid_data;
            }
            return $this->respond(['success' => true, "data" => $data], 200);
        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => 'Some error occured!'], 200);
        }
    }


    public function AcceptBidByCusomerRequest(Request $request)
    {
        try {

            $validator = \Validator::make($request->all(), [
                'customer_id' => 'required', 'vendor_bid_id' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->respond(['success' => false, 'errors' => $validator->errors()], 200);
            }
            $customer_id = $request->input('customer_id');
            $vendor_bid_id = $request->input('vendor_bid_id');
            $customer_data = $this->customer_vendor_bids
                ->where('customer_id', '=', $customer_id)
                ->where('vendor_bid_id', '=', $vendor_bid_id)->first();
            if ($customer_data) {
                return $this->respond(['success' => false, 'message' => "Record Already Exits With Same Details"], 200);
            }
            $customer_bid_accepted = $this->customer_vendor_bids;
            $customer_bid_accepted->customer_id = $customer_id;
            $customer_bid_accepted->vendor_bid_id = $vendor_bid_id;
            $customer_bid_accepted->save();
           $vendor_bid= Vendor_Bids::find($vendor_bid_id);
           if($vendor_bid){
            $vendor_bid->status=1;
            $vendor_bid->save();
           }

            return $this->respond(['success' => true, 'message' => "Record Added Sucessfully"], 200);
        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => 'Some error occured!'], 200);
        }
    }

    public function getCustomerEnquires(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'customer_id' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->respond(['success' => false, 'errors' => $validator->errors()], 200);
            }
            $data = [];
            $customer_id = $request->input('customer_id');
            $user_id = DB::table('users')->where('ref_id', '=', $customer_id)->where('user_type', '=', 'customer')->select('id')->first();
            $url =  URL::to('/');
            if ($user_id) {
                $id = $user_id->id;
                $enquires_data = DB::table('enquiries')

                    ->join('vendors', 'enquiries.vendor_id', '=', 'vendors.id')
                    ->leftjoin('reviews', 'vendors.id', '=', 'reviews.vendor_id')
                    ->leftjoin('vendor_project_info', 'enquiries.vendor_design_id', '=', 'vendor_project_info.id')

                    ->select('enquiries.*', 'vendor_project_info.images','vendors.photo as vendor_photo', 'vendors.no_of_projects', DB::raw('AVG(reviews.rate_us)  AS rating'), DB::raw('COUNT(reviews.id)  AS reviews_count'))
                    ->where('user_id', '=', $id)
                    ->groupBy('enquiries.id')
                    ->get();
                foreach ($enquires_data as $enquire) {
                    $image = "";
                    if($enquire->category_id==null&&$enquire->subcategory_id==null&&$enquire->vendor_id!=null){
                        $enquire->vendor_photo=$url . "/" .$enquire->vendor_photo;
                    }
                    
                    if ($enquire->images) {
                        $images = json_decode($enquire->images);
                        // echo"<pre>";print_r($url."/".$images[0]->name);exit;
                        $image =  $url . "/" . $images[0]->name;
                        $enquire->image = $image;
                    }
                    unset($enquire->images);




                    $data[] = $enquire;
                }
            }
            return $this->respond(['success' => true, "data" => $data], 200);
        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => 'Some error occured!'], 200);
        }
    }
    public function customerRequirementsSave(Request $request)
    {

        try {
            $validator = \Validator::make($request->all(), [
                'customer_id' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->respond(['success' => false, 'errors' => $validator->errors()], 200);
            }

            $customer_id = $request->input('customer_id');
            $cat_id = $request->input('category_id');
            $sub_cat_id = $request->input('sub_category_id');
            if (!$request->input('category_id') && !$request->input('sub_category_id')) {
                return $this->respond(['success' => false, 'errors' => "Category Id Required"], 200);
            }
            $input = $request->all();
            // dd($request->attachment);
            $folder = ('uploads/'.$customer_id.'/requirements');

            if (!File::exists($folder)) {
                mkdir($folder, 0777, true);
                chmod($folder, 0777);
            }

            $attachment = null;
                if ($request->attachment) {
                    $attachment = $folder . '/' . time() . '.jpg';

                    Image::make($request->attachment)->save($attachment);
                    $input['attachment'] = $attachment;
                    // dd($input['attachment']);
                }


            $data = DB::table('requirements')->insert($input);

            if ($data) {
                return $this->respond(['success' => true, 'message' => 'Details Added Succesfully!'], 200);
            } else {
                return $this->respond(['success' => false, 'message' => 'Error Occured!'], 200);
            }
        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => $e->getMessage()], 200);
        }
    }
    public function enquireSave(Request $request)
    {

        try {
            $validator = \Validator::make($request->all(), [
                'user_id' => 'required', 'vendor_id' => 'required', 'Message' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->respond(['success' => false, 'errors' => $validator->errors()], 200);
            }
            $input = $request->all();
            $data = DB::table('enquiries')->insert($input);
            if ($data) {
                return $this->respond(['success' => true, 'message' => 'Details Added Succesfully!'], 200);
            } else {
                return $this->respond(['success' => false, 'message' => 'Error Occured!'], 200);
            }
        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => 'Some error occured!'], 200);
        }
    }
}
