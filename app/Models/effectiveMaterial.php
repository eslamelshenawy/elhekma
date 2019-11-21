<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class effectiveMaterial extends Model
{
    use SoftDeletes;

    protected $table = 'effective_material';
    

    public function products()
    {
        return $this->belongsToMany(products::class);
    }

    public static function getByName($_name)
    {
        //search for the department by name if found retrun id if not insert it and then return id
        $obj = effectiveMaterial::where('name_en' , 'like', '%'.$_name.'%')->first();
        if(!$obj)
        {
            $obj = new effectiveMaterial();
            $obj->name_en = $_name;
            $obj->save();
        }
        return $obj->id;
    }


}
