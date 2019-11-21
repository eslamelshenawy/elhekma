<?php

namespace App\Http\Controllers;

use App\Models\brands;
use App\Models\brandsGroupDepartment;
use App\Models\brandsBrandsGroup;

use App\Models\categories;
use App\Models\department;
use App\Models\effectiveMaterial;
use App\Models\EffectiveMaterialProducts;
use App\Models\pharmaceuticalForm;
use App\Models\PharmaTag;
use App\Models\ProductEffectiveMaterial;
use App\Models\ProductPharmaTag;
use App\Models\products;
use App\Models\Sheet1;
use App\Models\targetAudience;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function depends(Request $request)
    {
        $department_id = $request->get('q');
        logger($department_id.'brand');
        $brand_group_ids = brandsGroupDepartment::where('department_id', $department_id)->get(['brands_group_id']);
        $brands_ids = brandsBrandsGroup::whereIn('brands_group_id', $brand_group_ids)->get(['brands_id']);
        return brands::whereIn('id', $brands_ids)->orderBy('name_en', 'asc')->get(['id', 'name_en']);
    }


    public function importExcel()
    {
        $shs = Sheet1::all();
        //$shs = Sheet1::limit(500)->offset(0)->get();
        //$shs = Sheet1::where('product_code','=' , '13006')->get();
        foreach($shs as $sh)
        {
            $pro=0;
            $pro = products::getProductByName($sh->product_description , $sh->product_code);
            if($pro==null)
            {
                //echo $sh->product_code;
                echo '<br>';
                //`name_en`, `name_ar`, `desc_en`, `desc_ar`, `product_code`, `bar_code`, `price`, `is_offer`, `price_before`,
                // `department_id`, `category_id`, `target_audience_id`, `brand_id`, `pack_details`, `company_id`, `color_id`, `pharma_form_id`  ,
                //    Relation in tables bridge

                ///`product_description`,                       `product_code`,             `price`,
                // `department`, `category`,       , `age`     `mother_company`, `pack_unit`, `pack_size`,
                //  `pharmaceutical_form`, `pharma_tag1`, `pharma_tag2`, `pharma_tag3`, `active_ingredients`
                $pro = new products();
                $pro->name_en = $sh->product_description;
                $pro->desc_en = $sh->product_description;
                $pro->product_code = $sh->product_code;
                $pro->price = $sh->price;
                $pro->price_before = $sh->price;
                $pro->pack_details = $sh->pack_size .' '.$sh->pack_unit;

                $pro->department_id = department::getDepartmentByName($sh->department);

                $pro->category_id = categories::getCategoryByName($sh->category , $pro->department_id);
                $pro->target_audience_id = targetAudience::getTargetByName($sh->age);
                $pro->brand_id = brands::getBrandByName($sh->mother_company);
                $pro->company_id =1;
                $pro->pharma_form_id = pharmaceuticalForm::getFormByName($sh->pharmaceutical_form);
                //$pro->save();

                //need update ProductPharmaTag  with category and parent_id
                $pharma_tag1_id = PharmaTag::getFormByName($sh->pharma_tag1,$pro->category_id,0);
                $pharma_tag2_id = PharmaTag::getFormByName($sh->pharma_tag2,$pro->category_id, $pharma_tag1_id);
                $pharma_tag3_id = PharmaTag::getFormByName($sh->pharma_tag3, $pro->category_id, $pharma_tag2_id);
                //`pharma_tag1`, `pharma_tag2`, `pharma_tag3`,

                $pro->pharma_tag1_id = $pharma_tag1_id;
                $pro->pharma_tag2_id = $pharma_tag2_id;
                $pro->pharma_tag3_id = $pharma_tag3_id;
                $pro->save();

                /*$tag1 = new ProductPharmaTag();
                $tag1->product_id = $pro->id;
                $tag1->pharma_tag_id = $pharma_tag1_id;
                $tag1->save();

                $tag2 = new ProductPharmaTag();
                $tag2->product_id = $pro->id;
                $tag2->pharma_tag_id = $pharma_tag2_id;
                $tag2->save();

                $tag3 = new ProductPharmaTag();
                $tag3->product_id = $pro->id;
                $tag3->pharma_tag_id = $pharma_tag3_id;
                $tag3->save();*/

                // `active_ingredients
                $active_arr = explode(' - ',$sh->active_ingredients);
                foreach($active_arr as $active)
                {
                    $active = trim($active);
                    if(!empty($active))
                    {
                        $active_id = effectiveMaterial::getByName($active);
                        $active1 = new EffectiveMaterialProducts();
                        $active1->products_id = $pro->id;
                        $active1->effective_material_id = $active_id;
                        $active1->save();
                    }

                }

                echo $pro->id.'<br>';
            }
            else
            {
                //need update price
                $pro->price = $sh->price;
                $pro->price_before = $sh->price;

                //need update ProductPharmaTag  with category and parent_id
                $pharma_tag1_id = PharmaTag::getFormByName($sh->pharma_tag1,$pro->category_id,0);
                $pharma_tag2_id = PharmaTag::getFormByName($sh->pharma_tag2,$pro->category_id, $pharma_tag1_id);
                $pharma_tag3_id = PharmaTag::getFormByName($sh->pharma_tag3, $pro->category_id, $pharma_tag2_id);
                //`pharma_tag1`, `pharma_tag2`, `pharma_tag3`,

                $pro->pharma_tag1_id = $pharma_tag1_id;
                $pro->pharma_tag2_id = $pharma_tag2_id;
                $pro->pharma_tag3_id = $pharma_tag3_id;
                $pro->save();

                echo '<br>';
                echo $pro->id;
                echo ' --------------       '.$sh->product_code.'    --------------';
                echo '<br>';
            }

        }
    }
}
