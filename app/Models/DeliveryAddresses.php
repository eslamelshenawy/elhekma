<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;


class DeliveryAddresses extends Model
{
    use SoftDeletes;


    protected $table = 'delivery_addresses';


    public function order(){
        return $this->belongsTo(Orders::class, 'id', 'address_id');
    }

    public function state()
    {
        return $this->belongsTo(governs::class, 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(place::class, 'city_id', 'id');
    }

    public static function createFromData($data, $api){
        $user = customer::user($api);
        if(!$user){
            $user = new customer();
        }
        $user->firstLastName($data['full_name']);

        $address = new self();
        $address->customer_id = isset($data['customer_id']) ? $data['customer_id'] : $user->id;
        $address->first_name = $user->first_name;
        $address->last_name = $user->last_name;
        $address->address = $data['address'];
        $address->email = $data['email'];
        $address->phone_number = $data['phone'];
        $address->state_id = $data['govern'];
        $address->city_id = $data['place'];
        $address->save();
        return $address;
    }
    

    
}
