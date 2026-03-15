<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketComment extends Model
{
    //use SoftDeletes;

    protected $table        = 'help_desk_comments';
    protected $primaryKey   = 'id';

    public function user(){
        return $this->belongsTo('\App\Models\User', 'comment_by', 'id');
    }

    public function tickets(){
        return $this->belongsTo('\App\Models\Ticket', 'help_desk_id', 'id');
    }

}
