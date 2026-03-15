<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviews extends Model
{
	
	protected $table        = 'reviews';
    protected $primaryKey   = 'id';
}
