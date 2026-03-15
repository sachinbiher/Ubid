<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor_Bids extends Model
{
    use SoftDeletes;

	protected $table        = 'vendor_bids';
    protected $primaryKey   = 'id';

}

