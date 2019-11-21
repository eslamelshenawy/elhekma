<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Validator;
use App\Models\products;
use App\Models\Review;

class ProductController extends ApiController
{
    public function get_product_by_id(Request $request)
    {
        $lang_id = $request->input('lang_id');
        $response = [];
        $statusCode = 200;
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
            $response["status"] = -3;
            $response['message'] = $validator->errors()->all();
        } else {       
        	try {
        	$product_id = $request->input('product_id');
        	$product = products::find($product_id);
        	if ($product) {
				$statusCode = 200;
				$response['status'] = 1;
				$response['message'] = 'data retrieved';
				$response['data'] = $this->getProductsObject($product,$lang_id);
        	}
        	
        	} catch (Exception $e) {
        	$statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
        	}finally{
        		return response()->json($response, $statusCode);
        	}
        }
    }
    public function get_product_review(Request $request)
    {
        $lang_id = $request->input('lang_id');
        $response = [];
        $statusCode = 200;
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
            $response["status"] = -3;
            $response['message'] = $validator->errors()->all();
        } else {       
        	try {
        	$product_id = $request->input('product_id');
        	$product = products::find($product_id);
        	if (count($product->reviews) > 0) {
        		$statusCode = 200;
				$response['status'] = 1;
				$response['message'] = 'data retrieved';
        		foreach ($product->reviews as $review) {
                    if ($review->is_approved == 1) {
                        $response['data'][] = $this->get_review_object($review);
                    }
        			
        		}
           	}else{
        		$statusCode = 200;
				$response['status'] = 1;
				$response['message'] = 'data retrieved';
        		$response['data'] = '';
        		
           	}
        	
        	} catch (Exception $e) {
        	$statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
        	}finally{
        		return response()->json($response, $statusCode);
        	}
        }    	
    }
   public function add_product_review(Request $request)
    {
        $lang_id = $request->input('lang_id');
        $response = [];
        $statusCode = 200;
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'rate' => 'required|numeric|min:1|max:5',
            'review' => 'required',
        ]);
        if ($validator->fails()) {
            $response["status"] = -3;
            $response['message'] = $validator->errors()->all();
        } else { 
        	try {
            	$product_id = $request->input('product_id');
            	$rate = $request->input('rate');
            	$customer_review = $request->input('review');
     			$current_user = auth('customer-api')->user();
            	
            	$product = products::find($product_id);
            	
            	$orders = $current_user->orders;
                foreach ($orders as $order) {
                    foreach ($order->orderDetails as $o) {
                        if ($o['product_id'] == $product->id) {
                            $current_product = $o;
                        }
                    }
                }
                if(empty($current_product)){
    				$statusCode = 200;
    				$response['status'] = 1;
    				$response['message'] = 'Buy it first';									
                }
                if ($current_product) {
    				$review = Review::where('product_id',$product->id)->where('customer_id',$current_user->id)->first();

    	        	if (empty($review)) {
    	        		$review =  new Review;
    					$review->product_id = $product_id;
    					$review->customer_id = $current_user->id;
    					$review->review = $customer_review ;
    					$review->rating = $rate;
                        $review->is_approved = 0;
    					$review->save();
    					$statusCode = 200;
    					$response['status'] = 1;
    					$response['message'] = 'Review added successfully';					
    	           	}else{
    	        		$statusCode = 200;
    					$response['status'] = 1;
    					$response['message'] = 'already reviwed';       		
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
        }    	
    }    

