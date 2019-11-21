<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sheet1 extends Model
{
    protected $table = 'sheet1';


    //`mother_company`, `product_code`, `product_description`, `price`, `pharmaceutical_form`, `age`, `pack_unit`, `pack_size`, `department`, `category`, `pharma_tag1`, `pharma_tag2`, `pharma_tag3`, `active_ingredients`


///`name_en`, `name_ar`, `desc_en`, `desc_ar`, `product_code`, `bar_code`, `price`, `is_offer`, `price_before`, `department_id`, `category_id`, `target_audience_id`, `brand_id`, `pack_details`, `company_id`, `color_id`, `pharma_form_id`  ,    Relation in tables bridge
//`product_description`,                       `product_code`,             `price`,                             `department`, `category`,       , `age`     `mother_company`, `pack_unit`, `pack_size`,                   `pharmaceutical_form`, `pharma_tag1`, `pharma_tag2`, `pharma_tag3`, `active_ingredients`


// companies - department - category - brands - pharmaceuticalForm - targetAudience - PharmaTag - effectiveMaterial

}
