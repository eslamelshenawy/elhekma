<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\products;
use App\Models\pharmaceuticalForm;
use App\Models\targetAudience;
use App\Models\companies;
use App\Models\categories;
use App\Models\brands;
use App\Models\effectiveMaterial;
use Validator;

class SearchController extends ApiController
{
    public function search(Request $request)
    {
        try {
            if (isset($request->lang_id)) {
                $lang_id = $request->lang_id;
            } else {
                $lang_id = 1;
            }
            $response = [];
            $statusCode = 200;
            $validator = Validator::make($request->all(), [
                'department_id' => 'numeric',
                'target_audience_ids' => 'array',
                'specialist_ids' => 'array',
                'categories_ids' => 'array',
                'pharmaceutical_form_ids' => 'array',
                'perPage' => 'numeric',
                'page' => 'numeric',

            ]);

            if ($validator->fails()) {
                $response["status"] = -3;
                $response['message'] = $validator->errors()->all();
            } else {

                $current_user = auth('customer-api')->user();
                $department_id = $request->department_id;
                $keyword = $request->keyword;
                $perPage = $request->perPage;
                $page = $request->page;
                $company_name = $request->company_name;
                $active_ingredient = $request->active_ingredient;
                $target_audience_ids = $request->target_audience_ids;
                $specialist_ids = $request->specialist_ids;
                $categories_ids = $request->categories_ids;
                
    		
                $conditions = [];
                $conditions2 = [];
                $requestData = ['category_id', 'pharma_tag1_id', 'pharma_tag2_id','pharma_tag3_id'];
                $products = products::where('name_en','like','%'.$keyword.'%');
                if (isset($department_id) && !empty($department_id)) {
                    $products->where('department_id',$department_id);
                }

                if (isset($company_name) && !empty($company_name)) {
                    $brands = brands::select('id')->where('name_en','like','%'.$company_name.'%')->get();
                    foreach ($brands as $brand) {
                        $brand_ids[] = $brand->id;
                    }
                    if (isset($brand_ids) && count($brand_ids) >0 ) {
                        $products->whereIn('brand_id',$brand_ids);
                        // $conditions2[] = [];
                    }
                }

                if (isset($active_ingredient) && !empty($active_ingredient)) {
                    $effectivematerials = effectiveMaterial::select('id')->where('name_en','like','%'.$active_ingredient.'%')->get();
                    $effectivematerial_ids = [];
                    foreach ($effectivematerials as $effectivematerial) {
                        $effectivematerial_ids[] = $effectivematerial->id;
                    }

                    $products->whereHas('product_effective_material', function($query) use($effectivematerial_ids) {
                        $query->whereIn('effective_material_id', $effectivematerial_ids);
                    });
                }
                
                // if (isset($target_audience) && !empty($target_audience)) {
                //     $target_audiences = targetAudience::select('id')->where('name_en','like','%'.$target_audience.'%')->get();
                //     foreach ($target_audiences as $target_audience) {
                //         $target_audience_ids[] = $target_audience->id;
                //     }

                    if (isset($target_audience_ids) && count($target_audience_ids) > 0 ) {
                        $products->whereIn('target_audience_id',$target_audience_ids);
                        // $conditions2[] = [];
                    }
                // }

                    if (isset($categories_ids) && count($categories_ids) > 0 ) {
                        foreach ($requestData as $q) {
                            $products->orwhereIn($q,$categories_ids);
                        }
                    }
                    // dd(isset($pharmaceutical_form_ids));
                    if (isset($pharmaceutical_form_ids) && count($pharmaceutical_form_ids) > 0 ) {
                        $products->whereIn('pharma_form_id',$pharmaceutical_form_ids);
                    }                                        
                    
                $products = $products->paginate($perPage, ['products.*'], 'page', $page);
                $statusCode = 200;
                $response['status'] = 1;
                $response['message'] = 'data retrieved';
                // return response()->json(['data' => $products]);
                if (count($products) > 0) {
                    foreach ($products as $product) {
                        $response['data'][] = $this->getSearchProductObj($product,$current_user->id,$lang_id); //$product;
                    }
                }else{
                    $response['data']=[];
                }
            }
        } catch (Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
        }finally{
            return response()->json($response, $statusCode);

        }
    }
    public function getTargetAudience(Request $request)
    {
        
        try {
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $target_audiences = targetAudience::all();
            foreach ($target_audiences as $target_audience) {
            $response['data'][] = $this->getTargetAudinceObj($target_audience, $lang_id);
            }

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }        
    }

    public function getSpecialist(Request $request)
    {
        
        try {
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $specialists = categories::all();
            foreach ($specialists as $specialist) {
            $response['data'][] = $this->getSpecialistObj($specialist, $lang_id);
            }

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }        
    }
    public function getPharmaceuticalForm(Request $request)
    {
        
        try {
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $pharmaceuticalForms= pharmaceuticalForm::all();
            foreach ($pharmaceuticalForms as $pharmaceuticalForm) {
            $response['data'][] = $this->getPharmaceuticalFormObj($pharmaceuticalForm, $lang_id);
            }

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }        
    }    
}
