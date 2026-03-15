<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
	protected $table        = 'vendors';
    protected $primaryKey   = 'id';

    public static function getAjaxListData(
    	$criteria=[], 
    	$page=1, 
    	$orderColumn='id', 
    	$orderDir='desc')
    {
    	$vendors = Vendor::where(['profile_status'=>1])->whereNotIn('status',[1,4])->orderBy('created_at', 'desc');
        // dd($vendors);
        if(!is_null($criteria->search) && !empty($criteria->search)) {
            $vendors = $vendors->where('vendor_id', $criteria->search);
        }
        if(!is_null($criteria->fname)) $vendors = $vendors->where('company', 'LIKE', "%{$criteria->fname}%");
        if(!is_null($criteria->femail)) $vendors = $vendors->where('email', $criteria->femail);
        if(!is_null($criteria->fmobile)) $vendors = $vendors->where('mobile', $criteria->fmobile);
        if(!is_null($criteria->fvendor)) $vendors = $vendors->where('vendor_id', $criteria->fvendor);
        return $vendors->paginate(intval($criteria->length), ['id','vendor_id','first_name','last_name','email','mobile','company','status'], 'page', $page);
    }

    public static function getManagePartnerAjaxListData(
        $criteria=[], 
    	$page=1, 
    	$orderColumn='id', 
    	$orderDir='desc')
    {
        $vendors = Vendor::whereIn('status',[1,4])->where(['profile_status'=>1])->orderBy('created_at', 'desc');
        // dd($vendors);
        if(!is_null($criteria->search) && !empty($criteria->search)) {
            $vendors = $vendors->where('vendor_id', $criteria->search);
        }
        if(!is_null($criteria->fname)) $vendors = $vendors->where('company', 'LIKE', "%{$criteria->fname}%");
        if(!is_null($criteria->femail)) $vendors = $vendors->where('email', $criteria->femail);
        if(!is_null($criteria->fmobile)) $vendors = $vendors->where('mobile', $criteria->fmobile);
        if(!is_null($criteria->fvendor)) $vendors = $vendors->where('vendor_id', $criteria->fvendor);
        return $vendors->paginate(intval($criteria->length), ['id','vendor_id','first_name','last_name','email','mobile','company','status'], 'page', $page);
    }

}