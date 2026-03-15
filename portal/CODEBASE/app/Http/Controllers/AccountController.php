<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;

//Models
use App\Models\User;
use App\Models\Vendor_Bids;
use App\Models\Notifications;

class AccountController extends CoreController
{
    public $loggedInUser;
    public $data;
    public $activeMenu = '';
    public $activeSubmenu = '';

    public function __construct()
    {
        parent::__construct();

        $this->middleware(function ($request, $next) {
            // get current logged in user
            $this->middleware(function ($request, $next) {
                $this->loggedInUser = auth()->user();
                return $next($request);
            });

            return $next($request);
        });        
    }

    public function dashboard()
    {
        $this->data['title'] = 'Dashboard';
        $this->data['activeMenu'] = 'dashboard';
        $this->data['activeSubmenu'] = $this->activeSubmenu;
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Dashboard',
            ],
        ];
        $this->data['total_bids'] = Vendor_Bids::count();
        $this->data['accepted_bids'] = Vendor_Bids::where('status',1)->count();
        $this->data['pending_bids'] = Vendor_Bids::where('status',0)->count();

        $sql = "SELECT
                t4.name AS category_name,
                t3.name AS child_category_name,
                t1.cost AS total
            FROM
                `vendor_bids` AS `t1`
            INNER JOIN `requirements` AS `t2`
            ON
                `t1`.`requirement_id` = `t2`.`id`
                LEFT JOIN `childcategories` AS `t3`
            ON
                `t2`.`sub_category_id` = `t3`.`id`
            INNER JOIN `categories` AS `t4`
            ON
                `t2`.`category_id` = `t4`.`id`
            GROUP BY t4.name;";

        $sql1 = "SELECT
                t4.name AS category_name,
                t3.name AS child_category_name,
                t1.cost AS total
            FROM
                `vendor_bids` AS `t1`
            INNER JOIN `requirements` AS `t2`
            ON
                `t1`.`requirement_id` = `t2`.`id`
            LEFT JOIN `childcategories` AS `t3`
            ON
                `t2`.`sub_category_id` = `t3`.`id`
            INNER JOIN `categories` AS `t4`
            ON
                `t2`.`category_id` = `t4`.`id`
            WHERE `t1`.`status`= 1";

        $this->data['total_bids_value'] = DB::select($sql);
        $this->data['accepted_bids_value'] = DB::select($sql1);

        return view('account.dashboard', $this->data);
    }

    /**
     * [Logout from account]
     * @return [type] [description]
     */
    public function logout()
    {
        Auth::logout();
        return redirect()
                ->route('login')
                ->with(['toast'=>'1','status'=>'success','title'=>'Thank You','message'=>'Thank you. You have been succesfully logged out']);
    }

    public function notifications()
    {
        DB::beginTransaction();
        Notifications::whereNull('user_id')->update([
            'seen' => 1
        ]);
        DB::commit();
        $this->data['notifications'] = Notifications::where('notify_type','a')
                                                ->WhereNull('user_id')
                                                ->orderBy('created_at','desc')
                                                ->get();
        $this->data['notificationsCount'] = Notifications::where('notify_type','a')
                                                ->WhereNull('user_id')
                                                ->count();
        $this->data['title'] = 'Notification';
        $this->data['activeMenu'] = 'dashboard';
        $this->data['activeSubmenu'] = '';
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Notification',
            ],
        ];
       return view('account.notifications' ,$this->data);
    }

}
