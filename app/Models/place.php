<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class place extends Model
{
    use SoftDeletes;


    protected $table = 'place';


    public function govern()
    {
        return $this->belongsTo(governs::class);
    }

    public function customers()
    {
        return $this->hasMany(customer::class, 'city_id', 'id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'place_id', 'id');
    }

    public function address()
    {
        return $this->hasMany(DeliveryAddresses::class, 'city_id', 'id');
    }

}
