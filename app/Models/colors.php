<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class colors extends Model
{
    use SoftDeletes;

    public function products()
    {
        return $this->hasMany(products::class, 'color_id','id');
    }
}
