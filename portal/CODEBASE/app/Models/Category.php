<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

	protected $table        = 'categories';
    protected $primaryKey   = 'id';

    public static function getAjaxListData(
    	$criteria=[], 
    	$page=1, 
    	$orderColumn='created_at', 
    	$orderDir='desc')
    {
    	$categories = Category::orderBy('created_at', 'desc');
        if(!is_null($criteria->search) && !empty($criteria->search)) {
            $categories = $categories->where('name', 'LIKE', '%'.$criteria->search.'%');
        }
        if(!is_null($criteria->fname)) $categories = $categories->where('name', 'LIKE', "%{$criteria->fname}%");
        if(!is_null($criteria->fstatus)) $categories = $categories->where('status', $criteria->fstatus);
        return $categories->paginate(intval($criteria->length), ['id','name','icon','status'], 'page', $page);
    }

}