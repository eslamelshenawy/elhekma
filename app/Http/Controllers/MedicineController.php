<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\products;
use App\Models\productsImages;
use App\Models\pharmaceuticalForm;
use App\Models\targetAudience;
use App\Models\companies;
use App\Models\categories;
use App\Models\department;
use App\Models\brands;
use App\Models\EffectiveMaterialProducts;
use App\Models\effectiveMaterial;

class MedicineController extends Controller
{
    // public function medicinePageOld(){

    // if (isset($_GET['paginate'])&&$_GET['paginate']!=null) {
    //     $medicineData=products::where('department_id',1)->where('is_viewed',0)->paginate($_GET['paginate']);
    // }else{
    //   $medicineData=products::where('department_id',1)->where('is_viewed',0)->paginate(12);
    // }
    // $target_audience_ids=products::where('department_id',1)->get(['target_audience_id']);
    // $category_ids=products::where('department_id',1)->get(['category_id']);
    // $pharma_form_ids=products::where('department_id',1)->get(['pharma_form_id']);
    // $collections=products::where('department_id',1)->with('product_effective_material')->get();
    // $active_Ingredients = [];
    // foreach ($collections as $key => $value) {
    //  foreach ($value->product_effective_material as $key => $value) {
    //      if (!in_array($value, $active_Ingredients)){
    //         $active_Ingredients[] = $value;
    //      }

    //  }

    // }

    //     $pharmaceuticalForms=pharmaceuticalForm::whereIn('id',$pharma_form_ids)->get(['id', 'name_en']);
    //     $targetAudiences=targetAudience::whereIn('id',$target_audience_ids)->get(['id', 'name_en']);
    //     $categories=categories::whereIn('id',$category_ids)->get(['id', 'name_en']);
    //     $products=products::where('department_id',1)->where('is_viewed',0)->get();
    //     return view('medicine',compact(['medicineData','pharmaceuticalForms','targetAudiences','products','categories','active_Ingredients']));

    // }
    public function medicinePage(Request $request){
        $sortBy = 'id';
        $orderBy = 'desc';
        $perPage = 15;
        $q = null;
        if ($request->has('orderBy')) {
            $orderBy = $request->query('orderBy');

        }
        if ($request->has('sortBy')) {
            $sortBy = $request->query('sortBy');

        }
        if ($request->has('perPage')) {
            $perPage = $request->query('perPage');

        }
        $slug = $request->slug;
        $department_id = department::where('name_en',$slug)->first();
        $slug_en = $department_id->name_en;
        $slug_ar = $department_id->name_ar;
        //dd($department_id->id);
        if ($department_id) {
            $medicineData= products::where('department_id',$department_id->id)->where('is_viewed',0)->orderBy($sortBy,$orderBy)->paginate($perPage)->onEachSide(3);

        }else{
            $medicineData= products::where('department_id',1)->where('is_viewed',0)->orderBy($sortBy,$orderBy)->paginate($perPage)->onEachSide(3);
        }


    //dd($medicineData[0]->reviews);
    $companies = brands::get(['name_en']);
    $active_Ingredients = effectiveMaterial::get(['name_en']);
        $pharmaceuticalForms= pharmaceuticalForm::get(['id', 'name_en']);
        $targetAudiences=targetAudience::get(['id', 'name_en']);
        $categories=categories::get(['id', 'name_en']);
        //$products=products::where('department_id',1)->where('is_viewed',0)->get();
//        return view('medicine',compact(['medicineData','pharmaceuticalForms','targetAudiences','categories','active_Ingredients','companies', 'slug']));
        if ($request->ajax()) {
            //dd($medicineData);
            return view('medicine_products', ['medicineData' => $medicineData , 'slug_en'=>$slug_en,'slug_ar'=>$slug_ar])->render();
        }
        
        return view('medicine',compact(['medicineData','pharmaceuticalForms','targetAudiences','categories','active_Ingredients','companies', 'slug_en','slug_ar']));

    }
    public  function ajaxAutoCompeleteProducts($name_en)
    {
        $products=products::where('department_id',1)->where('name_en', 'like', '%'.$name_en.'%')->get(['id','name_en']);
         return response()->json($products);
     //   return $products;
    }
    public  function ajaxAutoCompeleteCompanies($name_en)
    {

        $brands=brands::where('name_en', 'like', '%'.$name_en.'%')->get(['id','name_en']);
        return response()->json($brands);
    }

     public function search(Request $request)
    {
        $sortBy = 'id';
        $orderBy = 'DESC';
        $perPage = 15;
        $q = null;
        if ($request->has('orderBy')) {
            $orderBy = $request->query('orderBy');

        }
        if ($request->has('sortBy')) {
            $sortBy = $request->query('sortBy');

        }
        if ($request->has('perPage')) {
            $perPage = $request->query('perPage');

        }

        $slug = $request->slug;
        $department_id = department::where('name_en',$slug)->first();
        $slug_en = $department_id->name_en;
        $slug_ar = $department_id->name_ar;
        $medicineData=products::where('department_id',$department_id->id)->where('is_viewed',0);
        //print_r($request->input());
        if (isset($request->name_en) && !empty($request->name_en)) {
            $medicineData =$medicineData->where('name_en','like','%'.$request->name_en.'%');
        }


        if (isset($request->brand_name) && !empty($request->brand_name)) {
            $company=brands::where('name_en','like','%'.$request->brand_name.'%')->first();
            if ($company) {
                $medicineData =$medicineData->where('brand_id',$company->id);
            }

        }
        /*if (isset($request->brand_id) && !empty($request->brand_id)) {
            //$company=companies::where('name_en',$_GET['company'])->get(['id']);
            $medicineData =$medicineData->where('brand_id',$request->brand_id);
        }*/
        if (isset($request->active_Ingredient_id) && !empty($request->active_Ingredient_id)) {
            $x=effectiveMaterial::where('name_en','like','%'.$request->active_Ingredient_id.'%')->first();
            if ($x) {
                $pro_effectives = $x->products;
                foreach($pro_effectives as $pro_effective)
                {
                    $pro_arr_id[] = $pro_effective->id;
                }
                $medicineData->whereIn('id',$pro_arr_id);
            }

        }

        if (isset($request->target_audience_id) && !empty($request->target_audience_id)) {
            $medicineData =$medicineData->Where('target_audience_id',$request->target_audience_id);
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
            $medicineData =$medicineData->Where('category_id',$request->category_id);
        }
        if (isset($request->pharma_form_id) && !empty($request->pharma_form_id)) {
            $medicineData =$medicineData->Where('pharma_form_id',$request->pharma_form_id);
        }
        //  echo $medicineData->toSql();
         $medicineData= $medicineData->orderBy($sortBy,$orderBy)->paginate($perPage)->onEachSide(3);
         $medicineData->appends($request->all());
         //dd($medicineData);
        //$medicineData= $medicineData->paginate($perPage)->onEachSide(3);
        //$medicineData= products::where('department_id',$department_id->id)->where('is_viewed',0)->orderBy($sortBy,$orderBy)->paginate($perPage)->onEachSide(3);
        // $medicineData->withPath('custom/url');

        // return $products;
        // $active_Ingredients = [];
        // $target_audience_ids=products::where('department_id',1)->get(['target_audience_id']);
        // $category_ids=products::where('department_id',1)->get(['category_id']);
        // $pharma_form_ids=products::where('department_id',1)->get(['pharma_form_id']);
        //     $pharmaceuticalForms=pharmaceuticalForm::whereIn('id',$pharma_form_ids)->get(['id', 'name_en']);
        //     $targetAudiences=targetAudience::whereIn('id',$target_audience_ids)->get(['id', 'name_en']);
        //     $categories=categories::whereIn('id',$category_ids)->get(['id', 'name_en']);
        //     $products=products::where('department_id',1)->where('is_viewed',0)->get();

        $companies = brands::get(['name_en']);
        $active_Ingredients = effectiveMaterial::get(['name_en']);
        $pharmaceuticalForms= pharmaceuticalForm::get(['id', 'name_en']);
        $targetAudiences=targetAudience::get(['id', 'name_en']);
        $categories=categories::where('department_id',$department_id->id)->get(['id', 'name_en']);
        if ($request->ajax()) {
            // dd($request->all());
        $sortBy = 'id';
        $orderBy = 'DESC';
        $perPage = 15;
        $q = null;
        if ($request->has('orderBy')) {
            $orderBy = $request->query('orderBy');

        }
        if ($request->has('sortBy')) {
            $sortBy = $request->query('sortBy');

        }
        if ($request->has('perPage')) {
            $perPage = $request->query('perPage');

        }

        $slug = $request->slug;
        $department_id = department::where('name_en',$slug)->first();
        $medicineData=products::where('department_id',$department_id->id)->where('is_viewed',0);

        if (isset($request->brand_name) && !empty($request->brand_name) && $request->brand_name <> 'undefined') {            
            $company=brands::where('name_en','like','%'.$request->brand_name.'%')->first();
            if ($company) {
                
                $medicineData->where('brand_id',$company->id);
            }
            
        }
        if (isset($request->active_Ingredient_id) && !empty($request->active_Ingredient_id)) {
            $x=effectiveMaterial::where('name_en','like','%'.$request->active_Ingredient_id.'%')->first();
            if ($x) {
                $pro_effectives = $x->products;
                foreach($pro_effectives as $pro_effective)
                {
                    $pro_arr_id[] = $pro_effective->id;
                }
                $medicineData->whereIn('id',$pro_arr_id);
            }

        }        
        if (isset($request->target_audience_id) && !empty($request->target_audience_id) && $request->target_audience_id <> 'undefined' ) {
         $medicineData =    $medicineData->Where('target_audience_id',$request->target_audience_id);
        }
        if (isset($request->category_id) && !empty($request->category_id) && $request->category_id <> 'undefined') {
            $medicineData =  $medicineData->Where('category_id',$request->category_id);
        }
        if (isset($request->pharma_form_id) && !empty($request->pharma_form_id) && $request->pharma_form_id <> 'undefined') {
            $medicineData = $medicineData->Where('pharma_form_id',$request->pharma_form_id);
        }
        $medicineData= $medicineData->orderBy($sortBy,$orderBy)->paginate($perPage)->onEachSide(3);
        
            return view('medicine_products', ['medicineData' => $medicineData , 'slug_en'=>$slug_en,'slug_ar'=>$slug_ar])->render();
        }
        return view('medicine',compact(['medicineData','pharmaceuticalForms','targetAudiences','categories','active_Ingredients','companies' , 'slug_en' , 'slug_ar']));

            // return view('medicine',compact(['medicineData','pharmaceuticalForms','targetAudiences','products','categories', 'active_Ingredients']));

    }

}
