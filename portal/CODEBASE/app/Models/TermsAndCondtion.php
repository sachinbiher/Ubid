<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermsAndCondtion extends Model
{
    use SoftDeletes;

	protected $table        = 'terms_conditions';
    protected $primaryKey   = 'id';

    public static function getAjaxListData(
    	$criteria=[], 
    	$page=1, 
    	$orderColumn='id', 
    	$orderDir='desc')
    {
    	$termsandcondtions = TermsAndCondtion::orderBy('created_at', 'desc');
        if(!is_null($criteria->search) && !empty($criteria->search)) {
            $termsandcondtions = $termsandcondtions->where('name', 'LIKE', "%{$criteria->search}%");
        }
        if(!is_null($criteria->fname)) $termsandcondtions = $termsandcondtions->where('name', 'LIKE', "%{$criteria->fname}%");
        if(!is_null($criteria->fstatus)) $termsandcondtions = $termsandcondtions->where('status', $criteria->fstatus);
        
        return $termsandcondtions->paginate(intval($criteria->length), ['id','name','display_name','status'], 'page', $page);
    }
}
