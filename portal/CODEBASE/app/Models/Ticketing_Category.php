<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticketing_Category extends Model
{
    use SoftDeletes;

	protected $table        = 'ticketing_categories';
    protected $primaryKey   = 'id';

    public static function getAjaxListData(
    	$criteria=[], 
    	$page=1, 
    	$orderColumn='created_at', 
    	$orderDir='desc')
    {
    	$categories = Ticketing_Category::orderBy('created_at', 'asc');
        if(!is_null($criteria->search) && !empty($criteria->search)) {
            $categories = $categories->where('name', 'LIKE', "%{$criteria->search}%");
        }
        if(!is_null($criteria->fname)) $categories = $categories->where('name', 'LIKE', "%{$criteria->fname}%");
        if(!is_null($criteria->fstatus)) $categories = $categories->where('status', $criteria->fstatus);
        return $categories->paginate(intval($criteria->length), ['id','name','status'], 'page', $page);
    }

}