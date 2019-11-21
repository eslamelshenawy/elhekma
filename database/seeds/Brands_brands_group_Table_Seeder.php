<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Brands_brands_group_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $brands=DB::table('brands')->get();
        foreach ($brands as $brand) {
            DB::table('brands_brands_group')->insert([
                'brands_id' =>$brand->id,
                'brands_group_id' =>1 ,
            ]);
        }


       
    }
}
