<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Admin;
use Encore\Admin\Auth\Database\Administrator;

class CompanyUsers extends Model
{
     protected $table = 'admin_users';

    public function company()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = owner_id, localKey = id)
        return $this->hasOne(companies::class, 'id','company_id');
    }
    public function branch()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = owner_id, localKey = id)
        return $this->hasOne(outlets::class, 'id','branch_id');
    }

    public function orderStatusLog(){
        return $this->hasMany(OrderStatusLog::class, 'admin_id','id');
    }
}
