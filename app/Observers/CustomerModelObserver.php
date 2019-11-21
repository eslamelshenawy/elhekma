<?php

namespace App\Observers;
use App\Models\customer;
use Carbon\Carbon;
use Hash;
class CustomerModelObserver
{
      /**
     * Handle the Customer "created" event.
     *
     * @param  \App\customer  $customer
     * @return void
     */
    public function creating(Customer $customer)
    {
      $customer->activation_code = md5(Carbon::now()->timestamp);
      $customer->api_token = Hash::make(Carbon::now()->timestamp);
    }
}
