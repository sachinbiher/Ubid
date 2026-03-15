<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use SoftDeletes;

	protected $table        = 'subscribers';
    protected $primaryKey   = 'id';

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'user_id', 'id');
    }

    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription', 'subscription_id', 'id');
    }

    public static function getAjaxListData(
    	$criteria=[], 
    	$page=1, 
    	$orderColumn='created_at', 
    	$orderDir='desc')
    {
    	$subscribers = Subscriber::with(['vendor','subscription'])->orderBy('created_at', 'desc');
        // dd($subscribers);
        if(!is_null($criteria->search) && !empty($criteria->search)) {
            $subscribers = $subscribers->whereHas('vendor', function($q) use($criteria){
                $q->where('vendor_id', 'LIKE', "%{$criteria->search}%");
            });
        }
        // dd($criteria->fname);
        if(!is_null($criteria->fname)) $subscribers = $subscribers->whereHas('vendor', function($q) use($criteria){
            $q->where('company', 'LIKE', "%{$criteria->fname}%");
        });
        if(!is_null($criteria->femail)) $subscribers = $subscribers->whereHas('vendor', function($q) use($criteria){
            $q->where('email', $criteria->femail);
        });
        if(!is_null($criteria->fmobile)) $subscribers = $subscribers->whereHas('vendor', function($q) use($criteria){
            $q->where('mobile', $criteria->fmobile);
        });
        if(!is_null($criteria->fuser)) $subscribers = $subscribers->whereHas('vendor', function($q) use($criteria){
            $q->where('vendor_id', $criteria->fuser);
        });
        // if($criteria->fsubscribemin && $criteria->fsubscribemax)
        // {
        //     $start_date = date('Y-m-d', strtotime($criteria->fsubscribemin));
        //     $end_date = date('Y-m-d', strtotime($criteria->fsubscribemax));
            
        //     $subscribers = $subscribers->whereBetween('order_details.created_at', [$start_date, $end_date]);
            
        // }
        // if($criteria->startDate && $criteria->endDate)
        // {
        //     $start_date = date('Y-m-d', strtotime($criteria->startDate));
        //     $end_date = date('Y-m-d', strtotime($criteria->endDate));
            
        //     $allOrdersDetails = $allOrdersDetails->whereBetween('order_details.created_at', [$start_date, $end_date]);
            
        // }
        if(!is_null($criteria->fpackage)) $subscribers = $subscribers->whereHas('subscription', function($q) use($criteria){
            $q->where('name', 'LIKE', "%{$criteria->fpackage}%");
        });
        if(!is_null($criteria->fstatus)) $subscribers = $subscribers->where('status', $criteria->fstatus);
        return $subscribers->paginate(intval($criteria->length), ['id','user_id','subscription_id','subscribed_on','payment_date','status'], 'page', $page);
    }

}