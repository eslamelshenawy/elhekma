<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class companies extends Model
{
    use SoftDeletes;

    public function departments()
    {
        return $this->belongsToMany(department::class ,'companies_department', 'companies_id', 'department_id');
    }

    public function outlets()
    {
        return $this->hasMany(outlets::class,'company_id','id');

    }
    public function products()
    {
        return $this->hasMany(products::class, 'company_id', 'id');

    }

    public function companyusers()
    {
        return $this->belongsTo(CompanyUsers::class,'id','company_id');
    }    
}
