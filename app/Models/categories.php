<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categories extends Model
{
    use SoftDeletes;

      public function custom_field()
    {
        return $this->belongsTo(customFields::class, 'custom_field_id', 'id');
    }

   public function tags_group()
    {
        return $this->belongsToMany(tagsGroup::class);
    }

    public function department()
    {
        return $this->belongsTo(department::class);
    }

    public function products()
    {
        return $this->hasMany(products::class,'category_id','id');
    }


    public static function getCategoryByName($_name , $department_id)
    {
        //search for the department by name if found retrun id if not insert it and then return id
        $obj = categories::where('name_en' , 'like', '%'.$_name.'%')->first();
        if(!$obj)
        {
            $obj = new categories();
            $obj->name_en = $_name;
            $obj->department_id = $department_id;
            $obj->save();
        }
        return $obj->id;
    }
}
