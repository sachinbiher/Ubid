<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

	protected $table        = 'tickets';
    protected $primaryKey   = 'id';
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'ref_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\TicketComment', 'help_desk_id', 'id');
    }

    public function category()
    {
        return $this->hasMany('App\Models\Ticketing_Category', 'id', 'category_id');
    }

    public static function getAjaxListData(
    	$criteria=[], 
    	$page=1, 
    	$orderColumn='id', 
    	$orderDir='desc')
    {
    	$tickets = Ticket::with(['user','category'])->orderBy('created_at', 'desc');
        if(!is_null($criteria->fname)) $tickets = $tickets->whereHas('user', function($q) use($criteria){
            $q->where('name', 'LIKE', "%{$criteria->fname}%");
        });
        if(!is_null($criteria->femail)) $tickets = $tickets->whereHas('user', function($q) use($criteria){
            $q->where('email',$criteria->femail);
        });
        if(!is_null($criteria->fmobile)) $tickets = $tickets->whereHas('user', function($q) use($criteria){
            $q->where('mobile',$criteria->fmobile);
        });
        if(!is_null($criteria->search) && !empty($criteria->search)) {
            $tickets = $tickets->where('ticket_id',$criteria->search);
        }
        if(!is_null($criteria->fuser)) $tickets = $tickets->whereHas('user', function($q) use($criteria){
            $q->where('user_type_id',$criteria->fuser);
        });
        // if(!is_null($criteria->fuser)) $tickets = $tickets->where('user_type_id',$criteria->fuser);
        if(!is_null($criteria->fticket)) $tickets = $tickets->where('ticket_id',$criteria->fticket);
        if(!is_null($criteria->fstatus)) $tickets = $tickets->where('status', $criteria->fstatus);

        return $tickets->paginate(intval($criteria->length), ['id','ticket_id','user_id','category_id','issue_title','issue','status','created_at'], 'page', $page);
    }

}