<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class customFields extends Model
{
    use SoftDeletes;

    protected $table = 'custom_fields';

    public function customFieldsItems()
    {
        return $this->hasMany(customFieldsItems::class);
    }

     public function categories()
    {
        return $this->hasMany(categories::class,'custom_field_id', 'id');
    }

}
