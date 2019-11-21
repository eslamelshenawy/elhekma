<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use SoftDeletes;

    protected $table = 'favorite';
     protected $fillable = [
        'product_id', 'customer_id', 'deleted_at', 'created_at', 'updated_at'
    ];

    public function product()
    {
    	return $this->belongsTo(products::class,'product_id','id');
    }

    /**
     * Favorite has many Users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function customer()
    {
    	return $this->belongsTo(customer::class,'customer_id','id');
    }    
}
