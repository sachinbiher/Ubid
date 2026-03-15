<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Notifications extends Model
{
    // use SoftDeletes;

	protected $table        = 'notifications';
    protected $primaryKey   = 'id';

    public static function getAjaxListData(
    	$criteria=[], 
    	$page=1, 
    	$orderColumn='id', 
    	$orderDir='asc')
    {
    	$notifications = Notifications::whereNull('deleted_at')->orderBy($orderColumn, $orderDir);
        if(!is_null($criteria->ffromdate) && !is_null($criteria->ftodate)){
            if($criteria->ffromdate == $criteria->ftodate){
                $notifications = $notifications->where('notify_on','>=', $criteria->ffromdate);
            }else{
                $notifications = $notifications->whereBetween('notify_on',[ $criteria->ffromdate, $criteria->ftodate ]);
            }
        } else if(!is_null($criteria->ffromdate)){
            $notifications = $notifications->where('notify_on','>=', $criteria->ffromdate);
        } else if(!is_null($criteria->ftodate)){
            $notifications = $notifications->where('notify_on','<=', $criteria->ftodate);
        }
        if(!is_null($criteria->ftype)) $notifications = $notifications->where('notified_to', $criteria->ftype);

        return $notifications->paginate(intval($criteria->length), ['id','title','content','notify_on','notified_to','users'], 'page', $page);
    }

}
