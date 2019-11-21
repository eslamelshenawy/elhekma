<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use URL;

class Cart extends Model
{

    protected $table = 'cart';

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id', 'id');
    }


    public static function formatObject($lang_id, $cart){
        $products = [];
        $total_without_shipping = 0;
        foreach($cart as $cart_item){
            $product = products::find($cart_item['product_id']);
            $item = [];
            $item['id'] = $cart_item['product_id'];
            $item['title'] = $lang_id == 2 && strval($product->name_ar) ?
                strval($product->name_ar) :
                strval($product->name_en);
            $item['photo'] = '';
            if($product->photo){
                $item['photo'] = strval($product->photo);
            }elseif($product->product_images){
                $images = $product->product_images->image;
                if($images){
                    $item['photo'] = strval($images[0]);
                }
            }
            if($item['photo']){
                $item['photo'] = urldecode(URL::to('/uploads',$item['photo']));
            }else{
                $item['photo'] = urldecode(URL::to('assets/images/product/product-1.png'));
            }
            $item['qty'] = intval($cart_item['quantity']);
            $item['price'] = floatval($cart_item['item_price']);
            $item['price_before'] = floatval($product->price_before);
            $item['subtotal'] = floatval($cart_item['quantity_price']);
            $item['is_offer'] = intval($product->is_offer);

            $products[] = $item;
            $total_without_shipping += $item['subtotal'];
        }

        $obj = new \stdClass();
        $obj->total = floatval($total_without_shipping);
        $obj->shipping_cost = floatval(store_identity::first()->shipping_cost);
        $obj->products = $products;

        return $obj;
    }
}
