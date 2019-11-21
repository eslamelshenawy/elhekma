<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class targetAudience extends Model
{
    use SoftDeletes;

    protected $table = 'target_audience';

    public function products()
    {
        return $this->hasMany(products::class, 'target_audience_id', 'id');
    }

    public static function getTargetByName($_name)
    {
        //search for the department by name if found retrun id if not insert it and then return id
        $obj = targetAudience::where('name_en' , 'like', '%'.$_name.'%')->first();
        if(!$obj)
        {
            $obj = new targetAudience();
            $obj->name_en = $_name;
            $obj->save();
        }
        return $obj->id;
    }
}
