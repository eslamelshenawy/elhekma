<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tagItem extends Model
{
    use SoftDeletes;

    protected $table = 'tag_item';
    
     public function tagsGroup()
    {
        return $this->belongsToMany(tagsGroup::class);
    }
    public function products()
    {
        return $this->belongsToMany(products::class);
    }
    
}
