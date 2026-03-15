<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;
use Auth;
use Redirect;


//Models
use App\Models\Notifications;

use App\Models\Vendor;

class CoreController extends Controller
{
	public $loggedInUser;

	public function __construct()
    {
        $this->loggedInUser = auth()->user();   
            
		$this->middleware(function ($request, $next) {
            $this->loggedInUser = auth()->user();

            if(!is_null($this->loggedInUser) && !is_null($this->loggedInUser->id) && $this->loggedInUser->user_type=="vendor")
            {
                $vendorinfo = Vendor::select('status')->where('id',$this->loggedInUser->ref_id)->first();
                if($vendorinfo->status == '4')
                {
                    Auth::logout();
                    return Redirect::route('login')->with(['toast'=>'1','status'=>'error','title'=>'Account Login','message'=>'Account In-active, Please contact admin!']);
                }
                if($vendorinfo->status == '2')
                {
                    Auth::logout();
                    return Redirect::route('login')->with(['toast'=>'1','status'=>'error','title'=>'Account Login','message'=>'Account Rejected!, Please contact admin!']);
                }
            }
                
            if(!is_null($this->loggedInUser) && !is_null($this->loggedInUser->id) && $this->loggedInUser->user_type=='admin')
            {
                $notifications = Notifications::where('notify_type','a')
                                                    ->WhereNull('user_id')
                                                    ->orderBy('created_at', 'desc')
                                                    ->take(3)
                                                    ->get();
                $notification_count = Notifications::where('notify_type','a')
                                                    ->WhereNull('user_id')
                                                    ->where('seen',0)
                                                    ->count();

                View::share(['notification_count' => $notification_count, 'notifications' => $notifications]);

            }

            if(!is_null($this->loggedInUser) && !is_null($this->loggedInUser->id) && $this->loggedInUser->user_type=='vendor')
            {
                $notifications = Notifications::where('notify_type','v')
                                                    ->Where('user_id',$this->loggedInUser->ref_id)
                                                    ->orderBy('created_at', 'desc')
                                                    ->take(3)
                                                    ->get();
                $notification_count = Notifications::where('notify_type','v')
                                                    ->Where('user_id',$this->loggedInUser->ref_id)
                                                    ->where('seen',0)
                                                    ->count();
                View::share(['notification_count' => $notification_count, 'notifications' => $notifications]);

            }

            if(!is_null($this->loggedInUser) && !is_null($this->loggedInUser->id) && $this->loggedInUser->user_type=='customer')
            {
                $notifications = Notifications::where('notify_type','c')
                                                    ->Where('user_id',$this->loggedInUser->ref_id)
                                                    ->orderBy('created_at', 'desc')
                                                    ->take(3)
                                                    ->get();
                $notification_count = Notifications::where('notify_type','c')
                                                    ->Where('user_id',$this->loggedInUser->ref_id)
                                                    ->where('seen',0)
                                                    ->count();

                View::share(['notification_count' => $notification_count, 'notifications' => $notifications]);

            }
            return $next($request);
        });
    }
}