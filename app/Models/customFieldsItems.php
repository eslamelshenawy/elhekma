<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class customFieldsItems extends Model
{
    use SoftDeletes;

    protected $table = 'custom_fields_items';

     public function custom_field()
    {
        return $this->belongsTo(customFields::class, 'custom_field_id','id');
    }
}
