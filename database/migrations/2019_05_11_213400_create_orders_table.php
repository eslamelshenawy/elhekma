<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->nullable();
            $table->decimal('total')->nullable();
            $table->integer('order_status')->index()->comment('0- Pending  1- On the way  2- Delivered 3- Cancelled 4- Complained  5- Refunded')->nullable();
            $table->integer('payment_id')->nullable();
            $table->integer('address_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('gateway_response')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
