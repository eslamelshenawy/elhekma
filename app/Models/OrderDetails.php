<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderDetails extends Model
{
    use SoftDeletes;


    protected $table = 'order_details';


    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id', 'id');
    }

    public function outlet()
    {
        return $this->belongsTo(outlets::class, 'outlet_id', 'id');
    }






}
