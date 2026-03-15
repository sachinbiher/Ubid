<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cities extends Model
{
	
	protected $table        = 'cities';
    protected $primaryKey   = 'id';


    public static function filterCities($criteria=[],$orderColumn='id', $orderDir='desc')
    {
        $cities = new Cities();

        if(isset($criteria->search)) $cities = $countries->where('name', 'LIKE', '%'.$criteria->search.'%');
        if(isset($criteria->id)) $cities = $countries->where('id', '!=', $criteria->id);

        return $cities->orderBy($orderColumn, $orderDir)->get();
    }
}
