<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\brandsGroup;
class brands extends Model
{
    use SoftDeletes;


    public function brandsGroup()
    {
        return $this->belongsToMany(brandsGroup::class);
    }

    public function products()
    {
        return $this->hasMany(products::class, 'brand_id', 'id');
    }

    public static function getBrandByName($_name)
    {
        //search for the department by name if found retrun id if not insert it and then return id
        $obj = brands::where('name_en' , 'like', '%'.$_name.'%')->first();
        if(!$obj)
        {
            $obj = new brands();
            $obj->name_en = $_name;
            $obj->save();
        }
        return $obj->id;
    }
}
