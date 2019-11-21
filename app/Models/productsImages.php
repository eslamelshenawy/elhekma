<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class productsImages extends Model
{
    use SoftDeletes;

    protected $table = 'products_images';
    protected $fillable = [
        'products_id',
        'image',
        ];

        
    public function getImageAttribute($image)
    {
        if (is_string($image)) {
            return json_decode($image, true);
        }

        return $image;
    }

    public function setImageAttribute($image)
    {
        if (is_array($image)) {
            $this->attributes['image'] = json_encode($image);
        }
    }


    public function product()
    {
        return $this->belongsTo(products::class,'products_id');
    }
}
