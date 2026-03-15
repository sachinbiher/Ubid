<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use DB;
use View;
use Session;

// Models
use App\Models\Subscriber;

class SubscriberController extends CoreController
{
	public $loggedInUser;
    public $data;
    public $activeMenu = 'subscription';
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
        $this->data['dt_perpage'] = Session::get('subscriber_perpage', 10);
        $this->data['dt_page'] = Session::get('subscriber_page', 1);
        $this->data['dt_ajax_url'] = route('subscriber.getsubscriberajaxlistdata');
        $this->data['dt_search_colums'] = ['fuser','fname','femail','fmobile','fstatus','fpackage'];
        $this->data['title'] = 'Subscription Management';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = 'subscribers';
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Subscription Management',
            ],
        ];

        return view('subscription.subscribers', $this->data);
    }

    public function getsubscriberajaxlistdata(Request $request)
    {
        $columnList = [
            0 => 'id',
            1 => 'user_id'
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
            'search' => $request->search['value'],
            'fuser' => (!is_null($request->fuser))?$request->fuser:null,
            'fname' => (!is_null($request->fname))?$request->fname:null,
            'femail' => (!is_null($request->femail))?$request->femail:null,
            'fmobile' => (!is_null($request->fmobile))?$request->fmobile:null,
            'fpackage' => (!is_null($request->fpackage))?$request->fpackage:null,
            'fstatus' => (!is_null($request->fstatus))?$request->fstatus:null,
        ];

        $subscribers = Subscriber::getAjaxListData($criteria, $iPage, $orderColumn, $orderDir);

        $iTotalRecords = $subscribers->total();
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

        foreach ($subscribers as $subscriber) {
            $status = $statusList[$subscriber->status];
            $records["data"][] = [
                $subscriber->vendor->vendor_id,
                'Name: '.$subscriber->vendor->company.'<br>'.'Email Id: '.$subscriber->vendor->email.'<br>'.'Contact: '.$subscriber->vendor->mobile,
                date('d M, Y', strtotime($subscriber->subscribed_on)),
                $subscriber->subscription->name,
                $subscriber->subscription->period_months.' Months',
                date('d M, Y', strtotime($subscriber->payment_date)),
                '<span class="badge badge-light-'.(key($status)).' badge-roundless">'.(current($status)).'</span>',
            ];
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        return response()->json($records);
    }
}