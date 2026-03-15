<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor_Wishlist extends Model
{
    use SoftDeletes;

	protected $table        = 'vendor_wishlist';
    protected $primaryKey   = 'id';

}

