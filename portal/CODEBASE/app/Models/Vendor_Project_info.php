<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor_Project_info extends Model
{
    use SoftDeletes;

	protected $table        = 'vendor_project_info';
    protected $primaryKey   = 'id';

}