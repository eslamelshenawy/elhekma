<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('desc_en');
            $table->string('desc_ar');
            $table->string('logo');
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
        Schema::dropIfExists('brands_group');
    }
}
