<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class productDetails extends Model
{
    use SoftDeletes;


    protected $table = 'product_details';
    protected $fillable = [
        'products_id',
        'outlet_id',
        'custom_field_item_id',
         'quantity',
        ];


    public function product()
    {
        return $this->belongsTo(products::class, 'products_id', 'id');
    }


    public function outlet(){
        return $this->belongsTo(outlets::class, 'outlet_id', 'id');
    }



}
