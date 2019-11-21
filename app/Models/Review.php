<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $table = 'reviews';

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }        
}
