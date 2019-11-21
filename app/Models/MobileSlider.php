<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileSlider extends Model
{
    use SoftDeletes;

    protected $table = 'mobile_slider';
    public function product()
    {
    	return $this->belongsTo(products::class,'product_id','id');
    }
}
