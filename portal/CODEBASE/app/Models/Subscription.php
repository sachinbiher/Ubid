<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

	protected $table        = 'subscriptions';
    protected $primaryKey   = 'id';

    public static function getAjaxListData(
    	$criteria=[], 
    	$page=1, 
    	$orderColumn='created_at', 
    	$orderDir='desc')
    {
    	$subscriptions = Subscription::where('period','<>','0')->orderBy('created_at', 'desc');
        // dd($subscriptions);
        if(!is_null($criteria->search) && !empty($criteria->search)) {
            $subscriptions = $subscriptions->where('name', 'LIKE', "%{$criteria->search}%");
        }
        if(!is_null($criteria->fsubscription)) $subscriptions = $subscriptions->where('name', 'LIKE', "%{$criteria->fsubscription}%");
        if(!is_null($criteria->fstatus)) $subscriptions = $subscriptions->where('status', $criteria->fstatus);
        return $subscriptions->paginate(intval($criteria->length), ['id','name','period','price','finalprice','status'], 'page', $page);
    }

}