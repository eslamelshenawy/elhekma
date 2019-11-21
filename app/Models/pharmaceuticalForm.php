<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pharmaceuticalForm extends Model
{
    use SoftDeletes;

    protected $table = 'pharmaceutical_form';
    
    public function products()
    {
        return $this->hasMany(products::class, 'pharma_form_id', 'id');
    }

    public static function getFormByName($_name)
    {
        //search for the department by name if found retrun id if not insert it and then return id
        $obj = pharmaceuticalForm::where('name_en' , 'like', '%'.$_name.'%')->first();
        if(!$obj)
        {
            $obj = new pharmaceuticalForm();
            $obj->name_en = $_name;
            $obj->save();
        }
        return $obj->id;
    }
}
