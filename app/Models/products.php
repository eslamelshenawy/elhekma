<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class products extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    public function favorite()
    {
        // belongsToMany(RelatedModel, pivotTable, thisKeyOnPivot = dish_id, otherKeyOnPivot = user_id)
        return $this->hasMany(Favorite::class, 'product_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(department::class,'department_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(categories::class,'category_id','id');
    }

    public function target_audience()
    {
        return $this->belongsTo(targetAudience::class, 'target_audience_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(brands::class, 'brand_id','id');
    }

    public function product_images()
    {
        return $this->hasOne(productsImages::class, 'products_id');
    }

    public function productdetails()
    {
        return $this->hasMany(productDetails::class, 'products_id', 'id');
    }

    public function productdetails2()
    {
        return $this->hasMany(productDetails::class, 'products_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
    public function color()
    {
        return $this->belongsTo(colors::class, 'color_id','id');
    }

    public function company()
    {
        return $this->belongsTo(companies::class, 'company_id', 'id');
    }

    public function pharma_form()
    {
        return $this->belongsTo(pharmaceuticalForm::class, 'pharma_form_id' , 'id');
    }

    public function pharma_tag1()
    {
        return $this->belongsTo(PharmaTag::class, 'pharma_tag1_id' , 'id');
    }

    public function pharma_tag2()
    {
        return $this->belongsTo(PharmaTag::class, 'pharma_tag2_id' , 'id');
    }

    public function pharma_tag3()
    {
        return $this->belongsTo(PharmaTag::class, 'pharma_tag3_id' , 'id');
    }

    public function products_tags()
    {
        return $this->belongsToMany(tagItem::class);
    }

    public function orderDetails()
    {
        // belongsToMany(RelatedModel, pivotTable, thisKeyOnPivot = dish_id, otherKeyOnPivot = user_id)
        return $this->hasMany( OrderDetails::class, 'product_id', 'id');
    }

    public function cartItem()
    {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }

    /*public function product_pharma_tag()
    {
        return $this->belongsToMany(PharmaTag::class);
    }*/
    public function product_effective_material()
    {//$related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null,
        //$parentKey = null, $relatedKey = null, $relation = null
        return $this->belongsToMany(effectiveMaterial::class);
    }

    /*public function productEffectiveMaterials()
    {
        //$pivotTable = config('admin.database.role_permissions_table');
        $pivotTable = 'product_effective_material';

        //$relatedModel = config('admin.database.permissions_model');
        $relatedModel = effectiveMaterial::class;

        return $this->belongsToMany($relatedModel, $pivotTable,'product_id', 'effective_material_id');
    }*/

    /*public function productEffectiveMaterials()
    {
        return $this->morphedByMany(effectiveMaterial::class, 'effective_material', 'product_effective_material' , 'product_id');
    }*/



    public static function getProductByName($_name , $product_code)
    {
        //search for the department by name if found retrun id if not insert it and then return id
        $cond[] = ['name_en' , 'like', '%'.$_name.'%'];
        $cond[] = ['product_code' , '=', $product_code ];
        $obj = products::where($cond)->first();
        if(!$obj)
        {
            return null;
        }
        return $obj;
    }

    public function formatCartItem($quantity){
        $item = [
            'product_id'=> $this->id,
            'product_name'=> $this->name_en,
            'product_name_ar'=>$this->name_ar ?: $this->name_en,
            'product_image'=> isset($this->photo) ? $this->photo : "" ,
            'quantity'=> $quantity,
            'item_price'=> $this->price,
            'quantity_price'=> round($this->price*intval($quantity), 2)
        ];
        return $item;
    }


    public static function Search($keyword,$conditions,$conditions2,$perPage =30,$page=1)
    {
        $keys = $sort ? array_keys($sort) : [];
        $query = $this->select('products.*');
        if (isset($keyword) && $keyword != '') {
                $query->where(function ($query) use ($keyword) {
                $query->where('name_en', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('name_ar', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('desc_en', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('desc_ar', 'LIKE', '%' . $keyword . '%');
            });
        }   
        if (count($conditions) > 0) {
            $query->where($conditions);
        } 
        dd($query->get());
        if (count($conditions2) > 0) {
            $query->whereIn($conditions2);
        }             
        // $query->where($conditions);
        // if (count($sort)) {
        //     $query->orderBy($keys[0], $sort[$keys[0]]);
        // }        
        return $query->paginate($page_size, ['products.*'], 'page', $page);


    }
}
