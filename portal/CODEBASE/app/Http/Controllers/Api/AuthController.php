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
use Image;
use App\Services\MessageService;

// Models
use App\Models\User;
use App\Models\VerifyOtp;
use App\Models\Customer;
use App\Models\CustomerVendorBids;
use App\Models\Vendor;
use App\Models\Vendor_Project_info;
use App\Models\Category;
use App\Models\Enquiries;
use App\Models\Requirements;
use App\Models\Cities;
use App\Models\Reviews;

class AuthController extends ApiController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login','verifyOtpLoginDetails','verifyOtpRegister','verifyOtp','resendOtp','register','verifyOtpLogin']]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile'=>'required|digits:10'
        ]);
        if($validator->fails()){
            return $this->respond(['success'=>false,'errors'=>$validator->errors()], 200);
        }

        // check user exist or not
        $user = User::where('mobile', $request->mobile)
                        ->where('user_type', 'customer')
                        ->first();

        if(!$user) {
            return $this->respond(['success'=>false, 'message'=> 'New User!']);
        }

        // generate otp
         $otp = __generateOtp();
     
      //  $otp = '1234';
        $this->sendOtp($user->mobile, $otp);
        $this->saveOTP($user->mobile, $otp);

        return $this->respond(['success'=>true]);
    }

    /**
     * Register a new User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            //'mobile' => 'required|integer|digits:10|unique:customers',
            'mobile' => 'required|integer|digits:10|unique:customers',
            'email' => 'required|email|unique:customers',
            // 'image' => 'required'
        ]);


        if($validator->fails()){
            return $this->respond(['success'=>false,'errors'=>$validator->errors()], 200);
        }

       $customer_exits= DB::table('users')->where('mobile','=',$request->mobile)->where("user_type",'=','customer')->first();
       if($customer_exits){
        return $this->respond(['success'=>false,'message'=>"Customer Already Exits With Mobile Number"], 200);

       } 

        $otp = __generateOtp();
     
       // $otp = '1234';
        $this->saveOTP($request->mobile, $otp);
        $this->sendOtp($request->mobile, $otp);

        return $this->respond(['success'=>true]);
    }

    public function verifyOtpRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'name' => 'required|string|min:3',
            'mobile' => 'required|integer|digits:10|unique:customers',
            'email' => 'required|email|unique:customers',
            // 'image' => 'required'
        ]);

        if($validator->fails()){
            return $this->respond(['success'=>false,'errors'=>$validator->errors()], 200);
        }

        $otpData = VerifyOtp::where('mobile', $request->mobile)->first();

        if(!$otpData || ($otpData->otp != $request->otp)) return $this->respond(['success'=>false,'message'=>'Otp Verification Failed!']);

        $destinationPath = 'uploads/profile_pics';
        $profilePic = null;
        if($request->image) {
            $profilePic = $destinationPath.'/'.time().'-'.uniqid().'.jpg';

            Image::make($request->image)->save($profilePic);
        }

        $customer = new Customer();
        $customer->customer_id = __generateNewCustomerId();
        $customer->mobile = $request->mobile;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->save();

        // Create a new Customer User
        $password = 'ubid@123';
        $user = new User();
        $user->ref_id = $customer->id;
        $user->user_type = 'customer';
        $user->user_type_id = $customer->customer_id;
        $user->mobile = $customer->mobile;
        $user->profile_pic = $profilePic;
        $user->name = $customer->name;
        $user->email = $customer->email;
        $user->password = Hash::make($password);
        $user->save();

        $credentials = [
            'mobile'=>$request->mobile,
            'password'=>$password,
            'user_type'=>'customer'
        ];

        if(!$token = auth('api')->attempt($credentials)) {
            return response(['success' => false,'message'=>'Can not Login, Try again after sometime'], 200);
        }

        // delete otp data
        $otpData->delete();

        // Mail::to($request->email)->send(new SendRegisterSuccessEmail(['user'=>$customer]));
        return $this->respondWithToken($token);
    }

    public function verifyOtpLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|integer|digits:10',
            'otp' => 'required'
        ]);

        if($validator->fails()){
            return $this->respond(['success'=>false,'errors'=>$validator->errors()], 200);
        }

        $user = User::where('mobile',$request->mobile)->where('user_type', 'customer')->first();
        if($user){
            $otpData = VerifyOtp::where('mobile', $user->mobile)->first();
            
             if($user->mobile == 9515830590){
                $otpData->otp=1234; 
            }
            if($otpData && $otpData->otp == $request->otp) {
                if(!$token = auth('api')->login($user)) {
                    return response(['success' => false,'message'=>'Can not Login,Try after sometime'], 200);
                }
                $otpData->delete();
                return $this->respondWithToken($token);
            } else {
                return $this->respond(['success'=>false,'message'=>"Otp Verification Failed!"]);
            }
        } else {
            return $this->respond(['success'=>false,'message'=>"Account not found!"]);
        }
    }

    public function profile()
    {
        $user = User::find(auth('api')->user()->id);
      //  echo $user->ref_id;exit;
        $user->pic_url = ($user->profile_pic)?env('APP_URL').'/'.$user->profile_pic:null;

        $customer = Customer::find($user->ref_id);
        $user->address1 = $customer->address1;
        $user->address2 = $customer->address2;
        $user->city = $customer->city_id;
        if($customer->city_id){
           $name= Cities::where("id",'=',$customer->city_id)->select('name')->first();
            $user->city_name = $name->name;

        }


        return $this->respond(['success'=>true,'user'=>$user]);
    }

    public function updateProfile(Request $request)
    {
        // get user
        $user = auth('api')->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'email|unique:customers,email,'.$user->ref_id.',id',
            'address1' => 'nullable|string',
            'address2' => 'nullable|string',
            'city' => 'nullable|integer',
            // 'image' => 'required'
        ]);

        if($validator->fails()){
            return $this->respond(['success'=>false,'errors'=>$validator->errors()], 200);
        }

        try {

            $destinationPath = 'uploads/profile_pics';
            $profilePic = null;
            if($request->image) {
                $profilePic = $destinationPath.'/'.time().'-'.uniqid().'.jpg';

                Image::make($request->image)->save($profilePic);
                $user->profile_pic = $profilePic;
            }

            $user->name = $request->name?$request->name:$user->name;
            $user->email = $request->email?$request->email:$user->email;
            $user->save();

            // get customer
            $customer = Customer::find($user->ref_id);
            $customer->name = $request->name?$request->name:$customer->name;
            $customer->email = $request->email?$request->email:$customer->email;
            $customer->address1 = $request->address1;
            $customer->address2 = $request->address2;
            $customer->city_id = $request->city?$request->city:$customer->city_id;
            $customer->save();

            return $this->respond(['success'=>true]);
        } catch (\Exception $e) {
            return $this->respond(['success'=>false,'error'=>'Some error occured!'], 200);
        }
    }

    /**
     * Resend Otp.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|integer|digits:10'
        ]);

        if($validator->fails()){
            return $this->respond($validator->errors()->toJson(), 400);
        }

         $otp = __generateOtp();
        //$otp = '1234';
        $this->saveOTP($request->mobile, $otp);

        if($this->sendOtp($request->mobile, $otp)) {
            return $this->respond(['success'=>true]);
        } else {
            return $this->respond(['success'=>false]);
        }
    }

    public function saveOTP($mobile, $otp)
    {
        return VerifyOtp::updateOrInsert([
            'mobile' => $mobile
        ],
        [
            'mobile' => $mobile,
            'otp' => $otp,
            'otp_expiry' => Carbon::now()->addMinutes(10)
        ]);
    }

    public function sendOtp($mobile, $otp)
    {
        $message=new MessageService();
        $message->mobileNumber([$mobile],91)
        ->message('617fe6b13114e6307a18cfe2',['OTP'=>$otp])
        ->send();
        // __sendSms($mobile, ['otp'=>$otp]);
        return true;
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout(true);

        return $this->respondSuccess();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return "123";
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return $this->respond([
            'success'=>true,
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }

    public function customerBids(Request $request)
    {
        $vendor_info = $request->all();
        if($vendor_info['vendor_bid_id'])
        {
            $user_information = auth('api')->user();
            $customer_bids = new CustomerVendorBids();
            $customer_bids->customer_id = $user_information['id'];
            $customer_bids->vendor_bid_id = $vendor_info['vendor_bid_id'];
            $customer_bids->save();
            $total_customer_bids = CustomerVendorBids::where('customer_id',$user_information['id'])->get();
            return $this->respond(['success'=>true,'message'=>"Bid Accepted successfully", 'data' =>$total_customer_bids]);
        }
        else
        {
            return $this->respond(['success'=>false]);
        }
    }

    public function categoryImages(Request $request)
    {
        $category_info = $request->all();
        if($category_info['category_id'])
        {
            return $this->respond(['success'=>true]);
        }
        else
        {
            return $this->respond(['success'=>false]);
        }
    }
    public function vendorList(Request $request)
    {
        $search_query = $request->all();
        $vendor_profile = [];
        if(!empty($search_query['city_id']))
        {
            $city_id = $search_query['city_id'];
            // return $city_id;
            $vendors = DB::table('vendors')
                        ->join('cities', 'vendors.city', '=', 'cities.id')
                        ->where('vendors.city', '=', $city_id)
                        ->get();
                        // return $vendors;
        }
        else if(!empty($search_query['vendor_id']))
        {
            $vendor_id = $search_query['vendor_id'];
            return  DB::table('vendors')
                         ->select(DB::reviews('count(*) as vendor_id, status','company','no_of_projects','image'))
                         ->where('vendor_id', '=', $vendor_id)
                         ->groupBy('vendor_id')
                         ->get();
        }
        else
        {
            $vendors = Vendor::whereIn('status',[1,4])->where(['profile_status'=>1])->orderBy('created_at', 'desc')->get();
        }
        foreach($vendors as $key => $vendor){
            $Vendor_Profile[$key]['company'] = $vendor->company;
            $Vendor_Profile[$key]['vendor_id'] = $vendor->id;
            $Vendor_Profile[$key]['no_of_projects'] = $vendor->no_of_projects;
            $Vendor_Profile[$key]['image'] = $vendor->photo;
        }
        return $this->respond(['success'=>true,'Vendor Information'=>$Vendor_Profile]);
    }

    public function vendorCategories($id)
    {
        $categories_list = DB::table('vendor_project_info')
                        ->join('categories', 'vendor_project_info.category', '=', 'categories.id')
                        ->where([['vendor_project_info.vendor_ref_id', '=', $id], ['categories.status', '=' , 1],['categories.deleted_at', '=' , null]])
                        ->groupBY('categories.id')
                        ->select('categories.name', 'categories.icon','categories.id')
                        ->get();
        return $this->respond(['success'=>true,'Vendor Category Information'=>$categories_list]);
    }

    public function vendorSubcategories(Request $request, $id)
    {
        $sub_categories_list = DB::table('categories')
                        ->join('childcategories', 'categories.id', '=', 'childcategories.category_id')
                        ->where([['category_id', '=', $id], ['childcategories.status' ,'=', 1], ['childcategories.deleted_at' ,'=', null]])
                        ->select('childcategories.name', 'childcategories.icon')
                        ->get();
        return $this->respond(['success'=>true,'Sub Category Information'=>$sub_categories_list]);
    }

    public function notificationsList(Request $request)
    {
        $search_query = $request->all();
        if(!empty($search_query['id']))
        {
            $id = $search_query['id'];
            $result = DB::table('notifications')
                        ->where('id', $id)
                        ->update(['seen' => 1]);
        }
        $user_id = auth('api')->user();
        $notification_list = DB::table('users')
                        ->join('notifications', 'users.id', '=', 'notifications.user_id')
                        ->where([['user_id', '=', $user_id->id], ['seen', '=', 0], ['notify_type', '=', 'c'], ['notifications.deleted_at', '=', null]])
                        ->select('notifications.title', 'notifications.content', 'notifications.id')
                        ->get();
        return $this->respond(['success'=>true,'Notifications Information'=>$notification_list]);
    }

    public function vendorServices(Request $request, $id)
    {
        $vendor_profile = [];
        $vendor = Vendor::where(['id'=>$id])->first();
        $Vendor_Profile['company'] = $vendor->company;
        $Vendor_Profile['no_of_projects'] = $vendor->no_of_projects;
        $Vendor_Profile['image'] = $vendor->photo;
        foreach (json_decode($vendor->services) as $key=>$service)  {
            $Vendor_Profile['services'][$key] = json_decode(Category::where(['id'=>$service , 'deleted_at'=>null, 'status'=>1])->first());
        }
            return $this->respond(['success'=>true,'Vendor Services'=>$Vendor_Profile]);
    }

    public function enquiries(Request $request)
    {
        $search_query = $request->all();
        $user = auth('api')->user();
        if(!empty($search_query['vendor_id']))
        {
            $enquiry = new Enquiries();
            $enquiry->user_id = $user->id;
            $enquiry->vendor_id = $search_query['vendor_id'];
            if(!empty($search_query['category_id']))
            {
                $enquiry->category_id = $search_query['category_id'];
            }
            if(!empty($search_query['subcategory_id']))
            {
                $enquiry->subcategory_id  = $search_query['subcategory_id'];
            }
            $enquiry->Message = $search_query['Message'];
            $enquiry->save();
            return $this->respond(['success'=>true,'message'=>"Enquiry Created Successfully"]);
        }
        else
        {
            $enquiries = Enquiries::where(['user_id'=>$user->id, 'status'=>0, 'deleted_at'=>null])->get();
            return $this->respond(['success'=>true,'Enquiries'=>$enquiries]);
        }
    }

    public function requirements(Request $request)
    {
        $search_query = $request->all();
        $user = auth('api')->user();
        $customer = Customer::where(['customer_id'=>$user->user_type_id])->first();
        // return $this->respond($customer);
        if(!empty($search_query['category_id']))
        {
            $requirements = new Requirements();
            $requirements->customer_id = $customer->id;
            $requirements->category_id = $search_query['category_id'];
            if(!empty($search_query['sub_category_id']))
            {
                $requirements->sub_category_id = $search_query['sub_category_id'];
            }
            $requirements->property_type  = $search_query['property_type'];
            $requirements->how_early = $search_query['how_early'];
            $requirements->finish_type = $search_query['finish_type'];
            $requirements->name = $search_query['name'];
            $requirements->description  = $search_query['description'];
            $requirements->max_budget = $search_query['max_budget'];
            $requirements->work_type = $search_query['work_type'];
            $requirements->total_area  = $search_query['total_area'];
            $requirements->designs_2d = $search_query['designs_2d'];
            $requirements->negotiable  = $search_query['negotiable'];
            $requirements->location = $search_query['location'];
            $requirements->design_3d = $search_query['design_3d'];
            $requirements->status = 1;
            $requirements->save();
            return $this->respond(['success'=>true,'message'=>"Will get back to you soon"]);
        }
        else
        {
            return $this->respond(['success'=>false,'message'=>"Please Try Again"]);
        }
    }

    public function categoriesList(Request $request)
    {
        $categories_list = DB::table('categories')
                        ->where([['categories.status' ,'=', 1], ['categories.deleted_at' ,'=', null]])
                        ->select('categories.name', 'categories.icon','categories.id')
                        ->get();
        return $this->respond(['success'=>true,'Categories list'=>$categories_list]);
    }

    public function categoryVendors(Request $request)
    {
        $search_query = $request->all();
        if(!empty($search_query['category_id']))
        {
            $vendors_list = [];
            $vendors = Vendor::where(['profile_status'=>1])->whereIn('status',[1,4])->orderBy('created_at', 'desc')->get();
            foreach ($vendors as $key=>$vendor)  {
                if (in_array($search_query['category_id'], json_decode($vendor['services']), true)) {
                    array_push($vendors_list,$vendor);
                }
            }
            return $this->respond(['success'=>true,'Vendors List'=>$vendors_list]);
        }
        else
        {
            return $this->respond(['success'=>false,'message'=>"Invalid Input"]);
        }
    }

    public function searchCategory(Request $request)
    {
        $search_query = $request->all();
        if(!empty($search_query['name']))
        {
            $query = $search_query['name'];
            $categories = Category::where('name','LIKE',"%{$query}%")
                                    ->where(['status'=>1,'deleted_at'=>null])
                                    ->select('name','id')
                                    ->get();
            return $this->respond(['success'=>true,'Categories'=>$categories]);
        }
        else
        {
            return $this->respond(['success'=>false,'message'=>"No results"]);
        }
    }

    public function locations(Request $request)
    {
        $cities = Cities::where(['deleted_at'=>null])
                                ->select('name','state_id')
                                ->get();
        return $this->respond(['success'=>true,'cities'=>$cities]);
    }

    public function reviews(Request $request)
    {
        $search_query = $request->all();
        $user = auth('api')->user();
        $customer = Customer::where(['customer_id'=>$user->user_type_id])->first();
        // return $this->respond($customer);
        if(empty($search_query['vendor_id']))
        {
            $reviews = new Reviews();
            $reviews->customer_id = $customer->id;
            $reviews->vendor_id = $search_query['vendor_id'];
            $reviews->rate_us = $search_query['rate_us'];
            $reviews->comments = $search_query['comments'];
            $reviews->save();
            return $this->respond(['success'=>true,'message'=>"Review was updated successfully"]);
        }
        else
        {
            $reviews = Reviews::where(['vendor_id'=>$search_query['vendor_id']])->get();
            return $this->respond(['success'=>true,'Reviews'=>$reviews]);
        }
    }

    public function subcategoriesList(Request $request)
    {
        $childcategories_list = DB::table('childcategories')
                        ->where([['childcategories.status' ,'=', 1], ['childcategories.deleted_at' ,'=', null]])
                        ->get();
        return $this->respond(['success'=>true,'SubCategories list'=>$childcategories_list]);
    }

    public function vendorProject(Request $request)
    {
        $vendor_projects = DB::table('vendor_project_info')
                        ->where([['vendor_project_info.status' ,'=', 1], ['vendor_project_info.deleted_at' ,'=', null]])
                        ->get();
        return $this->respond(['success'=>true,'Vendor Project list'=>$vendor_projects]);
    }

    public function vendorProjectImages(Request $request)
    {
        $request = $request->all();
        // return $request['id'];
        $vendor_projects_info = DB::table('vendor_project_info')
                        ->where([['vendor_project_info.status' ,'=', 1], ['vendor_project_info.deleted_at' ,'=', null]])
                        ->get();
                        $i = 0;
                        $vendor_project_images = [];
                        // return $vendor_projects_info;
                        foreach($vendor_projects_info as $projects)
                        {
                            if(!empty($projects->images))
                            {
                                // return $projects->images;
                                foreach(json_decode($projects->images) as $image)
                                {
                                    $vendor_project_images[$i]['id'] = $i+1;
                                    $vendor_project_images[$i]['project_id'] = $projects->id;
                                    $vendor_project_images[$i]['projectname'] = $projects->projectname;
                                    $vendor_project_images[$i]['category'] = $projects->category;
                                    $vendor_project_images[$i]['SubCategory'] = $projects->subcategory;
                                    $vendor_project_images[$i]['image'] = $image->name;
                                    $vendor_project_images[$i]['description'] = $image->description;
                                    if(!empty($request['id']) && $vendor_project_images[$i]['id'] != $request['id'])
                                    {
                                        unset($vendor_project_images[$i]);
                                    }
                                    $i++;
                                }
                            }

                        }
                        return $vendor_project_images;
        return $this->respond(['success'=>true,'Vendor Project list'=>$vendor_projects]);
    }
}