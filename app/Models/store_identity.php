<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_identity extends Model
{
    use SoftDeletes;

    protected $table = 'store_identity';
}