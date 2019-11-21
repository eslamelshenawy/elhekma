<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmaTag extends Model
{
    protected $table = 'pharma_tag';

    public function products()
    {
        return $this->belongsToMany(products::class);
    }

    public function department()
    {
        return $this->belongsTo(department::class);
    }

    public function category()
    {
        return $this->belongsTo(categories::class);
    }

    public function parent()
    {
        return $this->belongsTo(PharmaTag::class);
    }
    
    public static function getFormByName($_name ,  $category_id , $parent_id)
    {
        //search for the department by name if found retrun id if not insert it and then return id
        $cond[]=['category_id' , '=' , $category_id];
        $cond[]=['parent_id' , '=' , $parent_id];
        $cond[]=['name_en' , 'like' ,  '%'.$_name.'%'];
        $obj = PharmaTag::where($cond)->first();
        if(!$obj)
        {
            $obj = new PharmaTag();
            $obj->name_en = $_name;
            $obj->category_id = $category_id;
            $obj->parent_id = $parent_id;
            $obj->save();
        }
        return $obj->id;
    }

}
