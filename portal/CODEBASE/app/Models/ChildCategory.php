<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ChildCategory extends Model
{
    use SoftDeletes;

    protected $table        = 'childcategories';
    protected $primaryKey   = 'id';

    // protected $appends = ['icon_path','image_path'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public static function getAjaxListData(
        $criteria=[],
        $page=1,
        $orderColumn='id',
        $orderDir='desc'
    ) {
        
        $childcategories = ChildCategory::with(['category'])->orderBy('created_at', 'desc');
        if(!is_null($criteria->search) && !empty($criteria->search)) {
            $childcategories = $childcategories->where('childcategories.name', 'LIKE', '%'.$criteria->search.'%');
        }
        if (!is_null($criteria->fname)) {$childcategories = $childcategories->where('childcategories.name', 'LIKE', "%{$criteria->fname}%"); }
        if (!is_null($criteria->fstatus)) { $childcategories = $childcategories->where('childcategories.status', $criteria->fstatus); }
        
        return $childcategories->paginate(intval($criteria->length), ['childcategories.id','childcategories.icon','childcategories.category_id','childcategories.name as subcategory_name','childcategories.status'], 'page', $page);
    }

    
}
