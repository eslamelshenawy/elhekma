<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tagsGroup extends Model
{
    use SoftDeletes;

    protected $table = 'tags_group';
      public function tagItems()
    {
        return $this->belongsToMany(tagItem::class);
    }


     public function categories()
    {
        return $this->belongsToMany(categories::class);
    }

}
