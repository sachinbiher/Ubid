<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requirements extends Model
{
    use SoftDeletes;

	protected $table        = 'requirements';
    protected $primaryKey   = 'id';
    protected $fillable=['customer_id' ,'category_id'];

}