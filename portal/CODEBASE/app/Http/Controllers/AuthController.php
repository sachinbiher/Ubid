<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use DB;
use Redirect;
use Validator;
use Session;
use Hash;
use Mail;
use File;
use Carbon\Carbon;
use App\Services\MessageService;

//Model
use App\Models\User;
use App\Models\Vendor;
use App\Models\TermsAndCondtion;
use App\Models\Notifications;
use App\Models\Cities;
use App\Models\Testimonials;
use App\Models\Subscriber;
use App\Models\Subscription;
use App\Models\Vendor_Project_info;


// Mails
use App\Mail\ForgotPasswordUserEmail;
use App\Mail\loginCredentials;
use App\Mail\resendOtp;
use App\Mail\registerOtp;

class AuthController extends CoreController
{
    public $loggedInUser;
    public $data;
    public $activeMenu = '';
    public $activeSubmenu = '';

    public function __construct() {
        parent::__construct();

          $this->middleware(function ($request, $next) {
            $this->loggedInUser = auth()->user();
            // $this->loggedInUser = auth()->guard('admin')->user();
            return $next($request);
        });

    }

    protected function credentials(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL))
            return ['email' => $request->email, 'password'=> $request->password];
    }

     public function passwordGeneration($n)
    {
        $generator = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        return $result;
    }

    public function otpGeneration($n)
    {
        $generator = "123456789";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        return $result;
    }
    public function login(Request $request)
    {

        if($request->doSubmit) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:rfc,dns',
                'password'  => 'required',
            ],
            [
                'email.email' =>'Please enter a valid email',
				'email.required' =>'Please enter your email',
				'password.required'=> 'Please enter your password'
            ]);

            // $remember_me = $request->has('remember') ? true : false;
            // dd($remember_me);
			if ($validator->fails()) {
				return Redirect::back()
							->withErrors($validator)
							->withInput();
	        }

	        

            //$user = Auth::user();
            $user = User::where('email', $request->email)->first();
            //dd($user);
            if($user)
            {

                if($user->user_type=="vendor"){
                    
                    $credentials = $this->credentials($request);

                    if(!Auth::attempt($credentials)){
                        return redirect()
                                ->back()
                                ->withInput()
                                ->with(['toast'=>'1','status'=>'error','title'=>'Account Login','message'=>'Invalid Credentials!']);
                    }
                        Session::put('id',$user->ref_id);
                        $vendorinfo = Vendor::select('status')->where('id',$user->ref_id)->first();
                        
                        $sub = Subscriber::where('user_id',$user->ref_id)->first();
                        if(isset($sub))
                            $subscriptiontype = Subscription::where('id',$sub->subscription_id)->first();
                        else
                            $subscriptiontype = Subscription::where('id',1)->first();
    
                        Session::put('status',$vendorinfo->status);
                        Session::save();
                        if($vendorinfo->status=='1' )
                            return Redirect::route('ppanel.placebids');
                        else if($vendorinfo->status=='2')
                            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Account Login','message'=>'Account Rejected!']);
                        else if($vendorinfo->status=='4')
                            return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Account Login','message'=>'Account In-active, Please contact admin!']);
                        else
                            return Redirect::route('ppanel.vprofile');
                }
                elseif($user->user_type =="customer")
                {
                    return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Account Login','message'=>"You can't sign-in using customer email id ."]);
                }
                else{
                      $credentials = $this->credentials($request);

                    if(!Auth::attempt($credentials)){
                        return redirect()
                                ->back()
                                ->withInput()
                                ->with(['toast'=>'1','status'=>'error','title'=>'Account Login','message'=>'Invalid Credentials!']);
                    }
                    return redirect()
                        ->route('dashboard');
                }
            }
            else
            {
                return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Account Login','message'=>"User doesn't exist. Please Signup to register"]);
            }
    	}
        return view('auth.login');
    }
//
    public function forgotPassword(Request $request)
    {
        if ($request->doSubmit) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email'
            ],
            [
				'email.required' =>'Please enter your email',
			]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {

                $user = User::where('email', $request->email)->where('user_type','vendor')->first();

                if ($user) {
                    $vendorinfo = Vendor::select('status')->where('id',$user->ref_id)->first();
                    if($vendorinfo->status ==4 || $vendorinfo->status == 2)
                    return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Account Login','message'=>'Account In-active, Please contact admin!']);
                    $password= $this->passwordGeneration(8);

                    User::where('email', $request->email)
                        ->update(['password'=> Hash::make($password)]);

                    $admin_details = User::where('email', $request->email)->first();

                    Mail::to($request->email)->send(new ForgotPasswordUserEmail($password));

                    DB::commit();
                    return Redirect::route('login')->with(['toast'=>'1','status'=>'success','title'=>'Mail Sent','message'=>'Password has been sent to your mail']);

                } else {
                    DB::rollback();
                    return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Error','message'=>'No User Found!']);
                }
            }
        }
        return view('auth.forgot-password');
    }

    public function changePassword(Request $request)
    {
        $this->data['title'] = 'Change Password';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = $this->activeSubmenu;
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Change Password',
            ],
        ];

            if($request->doSubmit){
                // dd($request->all());

            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => ['required','string','min:6','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
                'confirmed' => 'required|same:new_password',
            ],
            [
				'current_password.required' =>'Please enter your current password',
				'new_password.required' =>'Please enter your new password',
                'confirmed.required' =>'Please enter your confirm password',
                'confirmed.same' =>'New Password and Confirm Password does not match.',
			]);
            // dd($validator->fails());

            if ($validator->fails()) {
				return Redirect::back()
							->withErrors($validator)
							->withInput();
	        }

            $user = Auth::user();
            if (!(Hash::check($request->current_password,$user->password))) {
                // The passwords matches
                return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>'Error','message'=>'Your current password does not matches with the password you provided. Please try again.']);

            }

            if(strcmp($request->current_password, $request->new_password) == 0){
                // If Current password and new password are same
                return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>'Error','message'=>'New Password cannot be same as your current password. Please choose a different password.']);

            }

            DB::beginTransaction();
            try{

                User::where('id', $user->id)
                        ->update(['password'=> Hash::make($request->new_password)]);

                        DB::commit();

                return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Change Password','message'=>'Success! Your new Password has been updated successfully.']);
            }
            catch(Exception $e){
                DB::rollback();
                return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>'Change Password','message'=>'Error! Some error occured, please try again.']);
            }
        }
        return view('auth.change-password',$this->data);
    }

   

    
    public function sendVendorOtp(Request $request)
    {
        // if($request->pripol && $request->tercon)
        // {
            DB::beginTransaction();
            try{
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email:rfc,dns',
                    'mobile' => 'required|integer|digits:10',
                    'tercon' => 'required',
                    'pripol' => 'required'
                ],
                [
                    'email.required' =>'Please enter your email',
                    'email.email' =>'Please enter a valid email',
                    'mobile.required' =>'Please enter your mobile number',
                    'mobile.digits' =>'Mobile number must be of 10 digits.'
                ]);

                if ($validator->fails()) {
                    return Redirect::back()
                                ->withErrors($validator)
                                ->withInput();
                };

                $otp = $this->otpGeneration(6);
                $mobile_otp = $this->otpGeneration(4);
                // $otp = 123456;
                $email = $request->email;
                $mobile = $request->mobile;
                // dd($email);
                $otp_expiry = Carbon::now()->addMinutes(5);
                 $user = User::where('email', $request->email)->where('mobile',$request->mobile)->first();
            
                if(!$user)
                {

                    $checkVendor = Vendor::where('email',$email)->first();
                    if($checkVendor){
                        if($checkVendor->mobile==$request->mobile){
                            if($checkVendor->otp_verified==0){
    
                                $data = array(
                                    'otp'=>$otp,
                                    'mobile_otp'=>$mobile_otp,
                                    'mobile_otp_max_time'=>$otp_expiry,
                                    'otp_max_time'=>$otp_expiry
                                );
    
                                $update= DB::table('vendors')->where('email', $checkVendor->email)
                                    ->update($data);
                                // dd($update);
                                DB::commit();
    
                                Mail::to($email)->send(new registerOtp($otp));
    
                                //mobile otp
    
                                    $message=new MessageService();
                                    $message->mobileNumber([$mobile],91)
                                    ->message('617fe6b13114e6307a18cfe2',['OTP'=>$mobile_otp])
                                    ->send();
    
    
                                return Redirect::route('verifyOtp')
                                ->with(['email'=>$email,'mobile'=>$request->mobile,'toast'=>'1','status'=>'success','title'=>'OTP','message'=>'Otp has been sent to your mail!']);
    
                            }
                            else{
                                return Redirect::route('registerDetails')
                                ->with(['email'=>$email,'toast'=>'1','status'=>'success','title'=>'Register','message'=>'Your Email and Mobile has already been verified! Please fill all the details to complete your registration!']);
                            }
                        }
                        else{
                            if($checkVendor->otp_verified==0){
                                $vendor = new Vendor();
                                $vendor->vendor_id = __generateNewVendorId();
                                $vendor->email = $email;
                                $vendor->mobile = $request->mobile;
                                $vendor->otp = $otp;
                                $vendor->mobile_otp = $mobile_otp;
                                $vendor->mobile_otp_max_time = Carbon::now()->addMinutes(5);
                                $vendor->otp_max_time = Carbon::now()->addMinutes(5);
                                $vendor->save();
    
                                Mail::to($email)->send(new registerOtp($otp));
    
                                $message=new MessageService();
                                        $message->mobileNumber([$mobile],91)
                                        ->message('617fe6b13114e6307a18cfe2',['OTP'=>$mobile_otp])
                                        ->send();
                            }
                            else
                            {
                                return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>'Send Otp','message'=>'Error!  Email provided has already been used. Please try with another Email.']);
                      
                            }
    
                        }
                    }
                    else{
    
                        $checkMobile = Vendor::where('mobile',$request->mobile)->first();
    
                        if($checkMobile){
                            if($checkMobile->email==$email){
                                if($checkMobile->otp_verified==0){
    
                                    Vendor::where('mobile',$request->mobile)
                                    ->update(['otp'=>$otp,'mobile_otp'=>$mobile_otp,'mobile_otp_max_time'=>$otp_expiry,'otp_max_time'=>$otp_expiry]);
                                    DB::commit();
    
    
                                    Mail::to($email)->send(new registerOtp($otp));
    
                                    $message=new MessageService();
                                    $message->mobileNumber([$mobile],91)
                                    ->message('617fe6b13114e6307a18cfe2',['otp'=>$mobile_otp])
                                    ->send();
    
                                    return Redirect::route('verifyOtp')
                                    ->with(['email'=>$email,'mobile'=>$request->mobile,'toast'=>'1','status'=>'success','title'=>'OTP','message'=>'Otp has been sent to your mail!']);
    
                                }
                                else{
                                    return Redirect::route('registerDetails')
                                    ->with(['email'=>$email,'toast'=>'1','status'=>'success','title'=>'Register','message'=>'Your Email and Mobile has already been verified! Please fill all the details to complete your registration!']);
                                }
                            }
                            else{
    
                                if($checkMobile->otp_verified==0){
                                    $vendor = new Vendor();
                                    $vendor->vendor_id = __generateNewVendorId();
                                    $vendor->email = $email;
                                    $vendor->mobile = $request->mobile;
                                    $vendor->otp = $otp;
                                    $vendor->mobile_otp = $mobile_otp;
                                    $vendor->mobile_otp_max_time = Carbon::now()->addMinutes(5);
                                    $vendor->otp_max_time = Carbon::now()->addMinutes(5);
                                    $vendor->save();
        
                                    Mail::to($email)->send(new registerOtp($otp));
        
                                    $message=new MessageService();
                                            $message->mobileNumber([$mobile],91)
                                            ->message('617fe6b13114e6307a18cfe2',['OTP'=>$mobile_otp])
                                            ->send();
                                }
                                else
                                {
                                    // return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>'Send Otp','message'=>'Error!  Email provided has already been used. Please try with another Email.']);
                                    return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>'Send Otp','message'=>'Error! Mobile No provided has already been used. Try with another Mobile No.']);
                                }
                                
                               
                            }
                        }
                        else{
    
                            $vendor = new Vendor();
                            $vendor->vendor_id = __generateNewVendorId();
                            $vendor->email = $email;
                            $vendor->mobile = $request->mobile;
                            $vendor->otp = $otp;
                            $vendor->mobile_otp = $mobile_otp;
                            $vendor->mobile_otp_max_time = Carbon::now()->addMinutes(5);
                            $vendor->otp_max_time = Carbon::now()->addMinutes(5);
                            $vendor->save();
    
                            Mail::to($email)->send(new registerOtp($otp));
    
                            $message=new MessageService();
                                    $message->mobileNumber([$mobile],91)
                                    ->message('617fe6b13114e6307a18cfe2',['OTP'=>$mobile_otp])
                                    ->send();
                        }
    
                    }
    
                        DB::commit();
    
                        return Redirect::route('verifyOtp')
                                ->with(['email'=>$email,'mobile'=>$request->mobile,'toast'=>'1','status'=>'success','title'=>'OTP','message'=>'Otp has been sent to your mail!']);
                }
                else
                {
                     DB::rollback();
                    return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>"You can't sign-up using customer email id "]);
                }
            }
            catch(Exception $e){
                    DB::rollback();
                    return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>'Send Otp','message'=>'Error! Some error occured, please try again.']);
            }
        // }
        // else{
        //     return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Send Otp','message'=>'Error! Please select Terms & Conditions and Privacy Policy .']);
        // }
    }

    public function resendOtp(Request $request)
    {
        try{
            if(!$request->verify_email){
            return Redirect::route('register')->with(['toast'=>'1','status'=>'error','title'=>'Send Otp','message'=>'Error! Some error occured, please try again.']);

            }
            DB::beginTransaction();
            // dd($request->verify_email);
            $newOtp= $this->otpGeneration(6);
            $newMobileOtp = $this->otpGeneration(4);
            // $newOtp = 123456;
            $vendor = Vendor::where('email', $request->verify_email)->update([
                'otp' => $newOtp,
                'mobile_otp' => $newMobileOtp,
                'mobile_otp_max_time' => Carbon::now()->addMinutes(5),
                'otp_max_time' => Carbon::now()->addMinutes(5),
            ]);
            $otp = $newOtp;
            $mobile_otp = $newMobileOtp;
            Mail::to($request->verify_email)->send(new resendOtp($otp));

            $message=new MessageService();
                                $message->mobileNumber([$request->verify_mobile],91)
                                ->message('60e2a30100e50a0d245d31c2',['OTP'=>$mobile_otp])
                                ->send();

            if($vendor){
                DB::commit();

                return Redirect::route('verifyOtp')
                        ->with(['email'=>$request->verify_email,'toast'=>'1','status'=>'success','title'=>'OTP','message'=>'Otp has been sent to your mail!']);
            }else{
                return redirect()->back()->with(['toast'=>'1','status'=>'error','title'=>'Send Otp','message'=>'Error! Some error occured, please try again.']);
            }
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with(['status'=>'error','title'=>'Send Otp','message'=>'Error! Some error occured, please try again.']);
        }
    }

    public function verifyOtp(Request $request) 
    {
        if ($request->doVerify) {
            // dd($request->all());
            // dd(gettype((int)implode("",$request->otp)));
            try{
                $validator = Validator::make($request->all(), [
                    'otp' => 'required',
                    'otp1'=> 'required'
                ]);

                if ($validator->fails()) {
                    return Redirect::back()
                                ->withErrors($validator)
                                ->withInput()
                                ->with(['email'=>$request->verify_email]);
                };

                // dd($request->verify_email);
                $entered_otp = (int)implode("",$request->otp);
                $mobile_otp = (int)implode("",$request->otp1);

                $vendor = Vendor::where('email', $request->verify_email)->where('mobile', $request->verify_mobile)->first();

                $now = Carbon::now();

                if(!$vendor){

                    return Redirect::route('register')->with(['toast'=>'1','status'=>'error','title'=>'Otp','message'=>'Something went wrong! Please try again']);
                }
                // dd($vendor->otp_max_time<$now);
                // dd(($request->otp == $vendor->otp) && ($vendor->otp_max_time>$now));
                if(($entered_otp == $vendor->otp) && ($mobile_otp == $vendor->mobile_otp) && ($vendor->otp_max_time>$now)){

                    DB::beginTransaction();
                        Vendor::where('email',$request->verify_email)->update([
                            'otp_verified'=>1
                        ]);
                    DB::commit();
                    return Redirect::route('registerDetails')->with(['email'=>$request->verify_email]);
                }
                elseif($vendor->otp_max_time<$now){
                    return redirect()->back()
                ->with(['email'=>$request->verify_email, 'toast'=>'1','status'=>'error','title'=>'Otp Expired!','message'=>'Your Otp has expired!']);
                }
                else if($entered_otp != $vendor->otp){
                    return redirect()->back()->with(['email'=>$request->verify_email,'toast'=>'1','status'=>'error','title'=>'Email Otp Invalid!','message'=>'Please enter valid Otp!']);
                }
                else if($mobile_otp != '1234'){
                    return redirect()->back()->with(['email'=>$request->verify_email,'toast'=>'1','status'=>'error','title'=>'Mobile Otp Invalid!','message'=>'Please enter valid Otp!']);
                }
            }
            catch(Exception $e){
                return Redirect::route('register')
                ->with(['toast'=>'1','status'=>'success','title'=>'Registration','message'=>'Something went wrong! Please try again.']);
            }
        }
        return view('auth.verifyotp');
    }

    public function registerDetails(Request $request)
    {
        // dd('hi');

        if($request->registserSubmit){
            // dd($request->all());
            try{
            DB::beginTransaction();
                $validator = Validator::make($request->all(), [
                    'category' => 'required',
                    'id_proof' => 'required',
                    'front_img' => 'required|mimes:jpeg,jpg,png,gif,pdf|max:5000',
                    'back_img' => 'required|mimes:jpeg,jpg,png,gif,pdf|max:5000',
                    // 'profile_img' => 'required',
                    'projects_done' => 'required',
                    'company' => 'required',
                    'adtype' => 'required',
                    'address1' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'pincode' => 'required',
                    // 'landmark' => 'required',
                ]);
                if ($validator->fails()) {
                    return Redirect::back()
                                ->withErrors($validator)
                                ->withInput()
                                ->with(['email'=>$request->email]);
                };

                $vendor = Vendor::where('email', $request->email)->first();

                if(!$vendor){
                    return Redirect::route('register')->with(['toast'=>'1','status'=>'error','title'=>'Register','message'=>'Something went wrong! Please try again']);
                }

                $folder = ('uploads/'.$vendor->vendor_id);
                // dd($folder);
                ## CREATE FOLDER
                if (!File::exists($folder)) {
                    mkdir($folder, 0777, true);
                    chmod($folder, 0777);
                }

                $fileUploadPath ='';
                if ($file = $request->hasFile('profile_img')) {
                    $file = $request->file('profile_img') ;
                    $fileName = $file->getClientOriginalName() ;
                    $destinationPath = 'uploads/images';
                    $file->move($destinationPath,$fileName);
                    $fileUploadPath = $destinationPath.'/'.$fileName;
                }
                // dd($fileUploadPath);
                $fileUploadPathFront='';
                if ($file = $request->hasFile('front_img')) {
                    $file = $request->file('front_img') ;
                    $fileName = date('YmdHis')."_".$file->getClientOriginalName();
                    $destinationPath = $folder;
                    $file->move($destinationPath,$fileName);
                    $fileUploadPathFront = $destinationPath.'/'.$fileName;
                }
                // dd($fileUploadPathFront);
                $fileUploadPathBack='';
                if ($file = $request->hasFile('back_img')) {
                    $file = $request->file('back_img') ;
                    $fileName = date('YmdHis')."_".$file->getClientOriginalName();
                    $destinationPath = $folder;
                    $file->move($destinationPath,$fileName);
                    $fileUploadPathBack = $destinationPath.'/'.$fileName;
                }
                // dd($fileUploadPathBack);

                $category = json_encode($request->category);
                // dd($category);
                Vendor::where('email', $request->email)->update([
                    // 'first_name' => $request->firstname,
                    // 'last_name' => $request->lastname,
                    'services' => $category,
                    'id_proof' => $request->id_proof,
                    'photo' => $fileUploadPath,
                    'id_proof_front' => $fileUploadPathFront,
                    'id_proof_back' => $fileUploadPathBack,
                    'no_of_projects' => $request->projects_done,
                    'company' => $request->company,
                    'address_type' => $request->adtype,
                    'deleted_services' => [],
                    'address1' => $request->address1,
                    // 'address2' => $request->address2,
                    'city' => $request->city,
                    'state_id' =>  $request->state,
                    'pincode' => $request->pincode,
                    'landmark' => $request->landmark,
                    'profile_status' => 1,
                ]);

                $password = $this->passwordGeneration(8);
                // $password = 123456;
                $email = $vendor->email;
                $data=[
                    'email'=> $email,
                    'password'=>$password
                ];
                $user = new User();
                $user->ref_id = $vendor->id;
                $user->user_type ='vendor';
                $user->user_type_id = $vendor->vendor_id;
                $user->mobile = $vendor->mobile;
                $user->name= $request->company;
                ;
                $user->email= $email;
                $user->password=Hash::make($password);
                $user->save();

                $notify = new Notifications();
                $notify->title = 'A new vendor has registered.';
                $notify->content = 'Vendor with vendor Id: '.$vendor->vendor_id.' has uploaded all his details.';
                $notify->notify_type = 'a';
                $notify->save();

                $subscriber_update = new Subscriber();
                $subscriber_update->user_id =  $vendor->id;
                $subscriber_update->subscription_id = 1;
                $subscriber_update->subscribed_on = date('Y-m-d H:i:s');
                $subscriber_update->payment_date = date('Y-m-d H:i:s');
                $subscriber_update->subscription_ends =  date('Y-m-d H:i:s');
                $subscriber_update->status ='1';
                $subscriber_update->save();

                $mail= Mail::to($email)->send(new loginCredentials($data));

                DB::commit();
                return Redirect::route('subscriptionDetails')
                ->with(['id'=>$vendor->id,'toast'=>'1','status'=>'success','title'=>'Register','message'=>'Registration Successfull.']);
            }
        catch(Exception $e){
            DB::rollback();
            return Redirect::route('registerDetails')
            ->with(['status'=>'error','title'=>'Register','message'=>'Error! Some error occured, please try again.']);
        }
    }
        return view('auth.registerDetails');
    }

    public function updateDetails(Request $request)
    {
        if($request->registserSubmit){
            // dd($request->file('profile_img'));
            try{
               // return $request;
            DB::beginTransaction();
                $validator = Validator::make($request->all(), [
                    'category' => 'required',
                    'id_proof' => 'required',
                    // 'front_img' => 'required',
                    // 'back_img' => 'required',
                    'projects_done' => 'required|integer',
                    'company' => 'required',
                    'adtype' => 'required',
                    'address1' => 'required',
                    // 'address2' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'pincode' => 'required',
                    // 'landmark' => 'required',
                ]);

                if($validator->fails()) {
                    return response()->json(['status'=>'validations','errors'=>$validator->getMessageBag()->toArray()]);
                }

                $vendor = Vendor::where('vendor_id', $request->vendorid)->first();
                // dd($vendor);
                $folder = ('uploads/'.$vendor->vendorid);
                // dd($folder);
                ## CREATE FOLDER
                if (!File::exists($folder)) {
                    mkdir($folder, 0777, true);
                    chmod($folder, 0777);
                }

                $fileUploadPathFront = '';
                $fileUploadPathBack = '';
                $fileUploadPathProfile = '';
                //Front Image
                if ($file = $request->hasFile('front_img')) {
                    $file = $request->file('front_img') ;
                    $fileName = date('YmdHis')."_".$file->getClientOriginalName();
                    $destinationPath = $folder;
                    $file->move($destinationPath,$fileName);
                    $fileUploadPathFront = $destinationPath.'/'.$fileName;
                }

                if ($file = $request->hasFile('back_img')) {
                    $file = $request->file('back_img') ;
                    $fileName = date('YmdHis')."_".$file->getClientOriginalName();
                    $destinationPath = $folder;
                    $file->move($destinationPath,$fileName);
                    $fileUploadPathBack = $destinationPath.'/'.$fileName;
                }

                if ($file = $request->hasFile('profile_img')) {
                    $file = $request->file('profile_img') ;
                    $fileName = date('YmdHis')."_".$file->getClientOriginalName();
                    $destinationPath = $folder;
                    $file->move($destinationPath,$fileName);
                    $fileUploadPathProfile = $destinationPath.'/'.$fileName;
                    // dd($fileUploadPathProfile);
                }

                $checkproj = Vendor::where('id',$request->vendorrefid)->select('services','deleted_services')->first();
                $delcategory= json_decode($checkproj->deleted_services,TRUE);
                $deletedarr = array_intersect($delcategory,$request->category);
                if($deletedarr != [])
                {
                    for($i=0;$i<count($deletedarr);$i++){
                        if (($key = array_search($deletedarr[$i], $delcategory)) !== false) {
                            array_splice($delcategory,$key,1);
                        }
                    }
                }

                $category = json_encode($request->category);
                // dd($fileUploadPathProfile);

                $vendor_data =  Vendor::find($request->vendorrefid);
                // dd($vendor_data);
                $vendor_data->services = $category;
                $vendor_data->deleted_services =$delcategory;
                $vendor_data->id_proof = $request->id_proof;
                if($fileUploadPathFront !='')
                      $vendor_data->id_proof_front = $fileUploadPathFront;
                if($fileUploadPathBack !='')
                     $vendor_data->id_proof_back = $fileUploadPathBack;
                if($fileUploadPathProfile !='')
                     $vendor_data->photo = $fileUploadPathProfile;

                $vendor_data->no_of_projects = $request->projects_done;
                $vendor_data->company = $request->company;

                $vendor_data->address_type = $request->adtype;
                $vendor_data->address1 = $request->address1;
                $vendor_data->address2 = $request->address2;
                $vendor_data->city = $request->city;
                $vendor_data->state_id =  $request->state;
                $vendor_data->pincode = $request->pincode;
                $vendor_data->landmark = $request->landmark;
                $vendor_data->save();

                User::where('ref_id', $request->vendorrefid)
                ->update(['name'=> $request->company]);



                Vendor_Project_info::where('vendor_ref_id',$request->vendorrefid)->whereNotIn('category',$request->category)
                ->update(['deleted_at'=>date('Y-m-d-h:i:s')]);

                $notify = new Notifications();
                $notify->title = 'Your profile has been updated by UBID.';
                $notify->content = 'Your profile has been updated by UBID. Please verify your details in your profile section.';
                $notify->user_id = $vendor->id;
                $notify->notify_type = 'v';
                $notify->save();

                // dd($vendor);
                DB::commit();
                return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner','message'=>'Success! Details Updated.']);

               }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with(['toast'=>'1','status'=>'success','title'=>'Partner','message'=>'Error! Details Not Saved.']);
        }
    }
}

    /**
     * [new seller registration]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function register(Request $request)
    {
        $data = [
            'title' => 'Register'
        ];

        return view('auth.register', $data);
    }

    public function subscriptionDetails(Request $request)
    {
        // if($request->id !='')
        
        $this->data['vendor_detail']= Vendor::where('id', Session::get('id'))->first();

        $id = $this->data['vendor_detail']->id;
        $sub = Subscriber::where('user_id',$id)->first();
        
        $this->data = [
            'vendor' => Vendor::where('id',$id)->first(),
            'subscribertype' => Subscriber::where('user_id',$id)->first(),
            'subscriptiontype' => Subscription::where('id',$sub->subscription_id)->first()
        ];
       
            return view('auth.subscriptionDetails',$this->data);
        // else
        //     return Redirect::to('/login');
    }

    public function profile_review(Request $request)
    {
        $this->data['vendor_detail']= Vendor::where('id', $request->id)->first();

        $subcrptionid = $request->subscription_id;

        //transaction_id

        if($request->id !='')
        {
            // add subscription
            $subscriber_check = Subscriber::where('user_id',$request->id)->first();
            
            $subscription = Subscription::where('status','1')->where('id',$subcrptionid)->whereNull('deleted_at')->first();

            $subscriber_update = Subscription::where('status','1')->where('id',$subscriber_check->subscription_id)->whereNull('deleted_at')->first();
            
            if(($subscriber_check))
            {

                if($subscriber_check->subscription_id == '1' || $subscriber_check->subscription_id == $subcrptionid )
                // || $subscriber_update->gopro_type == 'no' || ( date('d M Y',strtotime($subscriber_update->subscription_ends)) < date('d M Y', time())) )
                {

                    $subscriber_update = Subscriber::find($subscriber_check->id);
                    $subscriber_update->user_id = $request->id;
                    $subscriber_update->subscription_id = $subcrptionid;
                    $subscriber_update->subscribed_on = date('Y-m-d H:i:s');
                    $subscriber_update->payment_date = date('Y-m-d H:i:s');
                    $subscriber_update->subscription_ends =  date('Y-m-d H:i:s', strtotime("+  $subscription->period_months months", strtotime($subscriber_check->subscription_ends)));
                    $subscriber_update->status ='1';
                    $subscriber_update->payment_id = $request->transaction_id;
                    $subscriber_update->save();
                    if(isset($this->loggedInUser) && $this->loggedInUser->user_type=='vendor')
                        return Redirect::route('ppanel.vprofile')->with(['toast'=>'1','status'=>'success','title'=>'Subscription','message'=>$subscription->name.' Subscription  Added.']);
                    else
                    return view('auth.profile_review', $this->data)->with(['toast'=>'1','status'=>'success','title'=>'Subscription','message'=>$subscription->name.' Subscription  Added.']);
                }
                elseif($subscriber_check->subscription_id != '1' && $subscription->period !=0 )
                {
                    if( $subscription->period > $subscriber_update->period)
                    {
                        $subscriber_update = Subscriber::find($subscriber_check->id);
                        $subscriber_update->user_id = $request->id;
                        $subscriber_update->subscription_id = $subcrptionid;
                        $subscriber_update->subscribed_on = date('Y-m-d H:i:s');
                        $subscriber_update->payment_date = date('Y-m-d H:i:s');
                        $subscriber_update->subscription_ends =  date('Y-m-d H:i:s', strtotime("+  $subscription->period_months months", strtotime(date('Y-m-d H:i:s'))));
                        $subscriber_update->status ='1';
                        $subscriber_update->payment_id = $request->transaction_id;
                        $subscriber_update->save();
                        if(isset($this->loggedInUser) && $this->loggedInUser->user_type=='vendor')
                        return Redirect::route('ppanel.vprofile')->with(['toast'=>'1','status'=>'success','title'=>'Subscription','message'=>$subscription->name.' Subscription  Added.']);
                        else
                        return view('auth.profile_review', $this->data)->with(['toast'=>'1','status'=>'success','title'=>'Subscription','message'=>$subscription->name.' Subscription  Added.']);
       
                    }
                    else
                    {
                        if(isset($this->loggedInUser) && $this->loggedInUser->user_type=='vendor')
                            return Redirect::route('ppanel.vprofile')->with(['toast'=>'1','status'=>'error','title'=>'Subscription','message'=>'Subscription Already Added.']);
                        else
                            return Redirect::to('/login')->with(['toast'=>'1','status'=>'error','title'=>'Subscription','message'=>' Subscription Already Added.']);
             
                    }
                       
                }

                else
                {
                    if(isset($this->loggedInUser) && $this->loggedInUser->user_type=='vendor')
                        return Redirect::route('ppanel.vprofile')->with(['toast'=>'1','status'=>'error','title'=>'Subscription','message'=>'Subscription Already Added, Free Plan is not Avaliable']);
                    else
                        return Redirect::to('/login')->with(['toast'=>'1','status'=>'error','title'=>'Subscription','message'=>' Subscription Already Added, Free Plan is not Avaliable.']);
                }
            }
            else
            {
                $subscriber = new Subscriber();
                $subscriber->user_id = $request->id;
                $subscriber->subscription_id = $subcrptionid;
                $subscriber->subscribed_on = date('Y-m-d H:i:s');
                $subscriber->payment_date = date('Y-m-d H:i:s');
                $subscriber->subscription_ends =  date('Y-m-d H:i:s', strtotime("+  $subscription->period_months months", strtotime(date('Y-m-d H:i:s'))));
                $subscriber->status ='1';
                $subscriber->payment_id = $request->transaction_id;
                $subscriber->save();
                return view('auth.profile_review', $this->data)->with(['toast'=>'1','status'=>'success','title'=>'Subscription','message'=>$subscription->name.' Subscription  Added.']);
            }

        }

        else
            return Redirect::to('/login');
    }

    public function privacyPolicy(Request $request)
    {
        $this->data['privacypolicy'] = TermsAndCondtion::where('id',2)->select('description')->first();

        return view('privacypolicy',$this->data);
    }

    public function vendoragreement(Request $request)
    {
        $this->data['vendoragreement'] = TermsAndCondtion::where('id',2)->select('description')->first();

        return view('vendoragreement',$this->data);
    }

    public function termsandconditions(Request $request)
    {
        $this->data['termsandconditions'] = TermsAndCondtion::where('id',1)->select('description')->first();

        return view('termsandconditions',$this->data);
    }

    public function getcitiesbystate(Request $request)
    {
        // dd($request->all);
        $data['cities'] = Cities::where("state_id",$request->state_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }

    public function getcities(Request $request)
    {
        // dd($request->all);
        $data['cities'] = Cities::where("state_id",$request->state_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }


    public function clienttestimonial($ref_id)
    {
        $this->data['title'] = 'Testimonials';
        $this->data['activeMenu'] ='Testimonials';
        $this->data['ref_id'] =$ref_id;

        $check_testimonial = Testimonials::where('id',$ref_id)->where('comments','<>','')->get();
        if(count($check_testimonial) > 0)
        {
            return Redirect::to('https://www.ubidindia.com');
        }
        else
        {
            return view('auth.clienttestimonal',$this->data);
        }

    }

    public function submitfeedback(Request $request)
    {
        try
        {
                // return $request;
                DB::beginTransaction();
                $validator = Validator::make($request->all(), [
                    'username' => 'required',
                    'rating' => 'required',
                    'comments' => 'required',
                     ],
                    [
                        'username.required' =>'Please enter your name',
                        'rating.required' =>'Please select a rating',
                        'comments.required' =>'Please enter your Comments',

                    ]);

                if ($validator->fails()) {
                    return Redirect::back()
                                ->withErrors($validator)
                                ->withInput();
                }

                $check_testimonial = Testimonials::where('id',$request->ref_id)->where('comments','')->get();
                // dd(count($check) > 0);

                if(count($check_testimonial) > 0)
                {
                    $feedback =  Testimonials::find($request->ref_id);
                    $feedback->name = $request->username;
                    $feedback->rating = $request->rating;
                    $feedback->comments = $request->comments;
                    // $feedback->vendor_ref_id = $request->vendor_ref_id;
                    $feedback->save();
                    DB::commit();
                    // return Redirect::to('login')->with(['toast'=>'1','status'=>'success','title'=>'Testimonial','message'=>' Feedback Added Successfull.']);
                    return Redirect::to('https://www.ubidindia.com');
                }
                else
                {
                    // return redirect()->to('login')->with(['toast'=>'1','status'=>'error','title'=>'Testimonial','message'=>'Feedback Details Already Added.']);
                    return Redirect::to('https://www.ubidindia.com');
                }
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->withInput()->with(['toast'=>'1','status'=>'error','title'=>'Testimonial','message'=>'Error! Details Not Saved.']);

        }

    }

}
