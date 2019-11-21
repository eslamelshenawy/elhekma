<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class department extends Model
{
    use SoftDeletes;

    public function brandsGroup()
    {
        return $this->belongsToMany(brandsGroup::class);
    }

     public function categories()
    {
        return $this->belongsToMany(categories::class);
    }

    public function companies()
    {
        return $this->belongsToMany(companies::class, 'companies_department', 'department_id', 'companies_id');
    }

    public function products()
    {
        return $this->hasMany(products::class, 'department_id', 'id');
    }

    public static function getDepartmentByName($department_name)
    {
        //search for the department by name if found retrun id if not insert it and then return id
        $dep = department::where('name_en' , 'like', '%'.$department_name.'%')->first();
        if(!$dep)
        {
            $dep = new department();
            $dep->name_en = $department_name;
            $dep->save();
        }
        return $dep->id;
    }

}
