<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class governs extends Model
{
    use SoftDeletes;
    public $table='governs';



    public function places()
    {
        return $this->hasMany(place::class, 'govern_id', 'id');
    }

    public function outlets()
    {
        return $this->hasMany(outlets::class, 'govern_id', 'id');
    }

    public function customers()
    {
        return $this->hasMany(customer::class, 'state_id', 'id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'govern_id', 'id');
    }

    public function address()
    {
        return $this->hasMany(DeliveryAddresses::class, 'state_id', 'id');
    }
}
