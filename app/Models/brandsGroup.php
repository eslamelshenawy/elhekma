<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class brandsGroup extends Model
{
    use SoftDeletes;

    protected $table = 'brands_group';
     public function brands()
    {
        return $this->belongsToMany(brands::class);
    }

}
