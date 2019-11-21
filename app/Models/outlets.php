<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class outlets extends Model
{
    use SoftDeletes;
    public function govern()
    {
        return $this->belongsTo(governs::class, 'govern_id', 'id');
    }
    public function place()
    {
        return $this->belongsTo(place::class);
    }
    public function company()
    {
        return $this->belongsTo(companies::class);
    }
    public function companyusers()
    {
        return $this->belongsTo(CompanyUsers::class,'id','company_id');
    }

    public function products(){
        return $this->hasMany(productDetails::class, 'outlet_id', 'id');
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetails::class, 'outlet_id', 'id');
    }

    public function changeStock($product_id, $quantity, $type){
        $stock_info = $this->products()->where('products_id', $product_id)->first();
        if($stock_info){
            if($type == 'order'){
                $stock_info->quantity -= $quantity;
            }elseif($type == 'cancel'){
                $stock_info->quantity += $quantity;
            }
            $stock_info->save();
        }
    }
}
