<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderStatus extends Model
{
    use SoftDeletes;


    protected $table = 'order_status';


    public function orders()
    {
        return $this->hasMany(Orders::class, 'order_status', 'id');
    }

    public function orderStatusLog(){
        return $this->hasMany(OrderStatusLog::class, 'status_id','id');
    }
}
