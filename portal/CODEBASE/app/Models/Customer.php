<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

	protected $table        = 'customers';
    protected $primaryKey   = 'id';

    public static function getAjaxListData(
    	$criteria=[], 
    	$page=1, 
    	$orderColumn='id', 
    	$orderDir='desc')
    {
    	$customers = Customer::orderBy('created_at', 'desc');
        if(!is_null($criteria->search) && !empty($criteria->search)) {
            $customers = $customers->where('customer_id', $criteria->search);
        }
        if(!is_null($criteria->fname)) $customers = $customers->where('name', 'LIKE', "%{$criteria->fname}%");
        if(!is_null($criteria->femail)) $customers = $customers->where('email', $criteria->femail);
        if(!is_null($criteria->fmobile)) $customers = $customers->where('mobile', $criteria->fmobile);
        if(!is_null($criteria->fcustomer)) $customers = $customers->where('customer_id', $criteria->fcustomer);
        if(!is_null($criteria->fstatus)) $customers = $customers->where('status', $criteria->fstatus);
        return $customers->paginate(intval($criteria->length), ['id','customer_id','name','email','mobile','status'], 'page', $page);
    }

}