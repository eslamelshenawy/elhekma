<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Validator;
use App\Models\products;
use App\Models\Favorite;
use App\Http\lib\Helper;
class FavoriteController extends ApiController
{
    public function add_favorite(Request $request)
    {
            $lang_id = $request->input('lang_id');
            if ($lang_id == 2) {
            	$message_success = 'تم تحديث قائمه المفضلات';
            	$message_fail = 'لا يوجد منتج';
            }else{
				$message_success = 'favorite list updated';
            	$message_fail = 'No Product Found';            	
            }
            $response = [];
            $statusCode = 200;
			try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required',
            ]);

            if ($validator->fails()) {
                $response["status"] = -3;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
            } else {
                $product_id = $request->input('product_id');
                $product = products::find($product_id);

                if ($product) {
        		$current_user = auth('customer-api')->user();
		        $favoriteRemove = Favorite::where('customer_id', $current_user->id)->where('product_id',$product->id)->first();
		        if ($favoriteRemove) {
		            $favoriteRemove->forcedelete();
		        }else{
		            $favorite = new Favorite;
		            $favorite->customer_id = $current_user->id;
		            $favorite->product_id = $product->id;
		            $favorite->save();
		        }
		        
		        	$current_user = auth('customer-api')->user();
	        $favorite_list = Favorite::where('customer_id', $current_user->id)->get();	
	        if (count($favorite_list) > 0) {
		        foreach ($favorite_list as $favorite) {
		        	$list[] = $this->getProductFavorite($favorite->product,$lang_id);
		        }
	        }else{
				$list = [];
	        }
					$statusCode = 200;
					$response['status'] = 1; 
					$response['message'] = $message_success;
					$response['data'] = $list;

                }else{
					$statusCode = 200;
					$response['status'] = -1; 
					$response['message'] = $message_fail;	                	
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
    public function get_favorite(Request $request)
    {
    		$lang_id = $request->input('lang_id');
    		$list =[];
    	try {
    		$current_user = auth('customer-api')->user();
	        $favorite_list = Favorite::where('customer_id', $current_user->id)->get();	
	        if (count($favorite_list) > 0) {
		        foreach ($favorite_list as $favorite) {
		        	$list[] = $this->getProductFavorite($favorite->product,$lang_id);
		        }
	        }else{
				$list = [];
	        }
	       		$statusCode = 200;
				$response['status'] = 1;
				$response['message'] = 'data retrieved';
				$response['data'] = $list;

    	} catch (Exception $e) {
        	$statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();	    		
    	}finally{
        		return response()->json($response, $statusCode);
        }   
    }
    
    /*
    * function to delete product from wishlist
    */
     public function remove_favorite(Request $request)
    {
    		$lang_id = $request->input('lang_id');
    		$product_id = $request->input('product_id');
    		$list =[];
    	try {
    	    	$current_user = auth('customer-api')->user();
	        
	            $favorite_list = Favorite::where('product_id',$product_id)->where('customer_id',$current_user->id)->first();
	        
	           if($favorite_list == null){
	                $statusCode = 200;
			    	$response['status'] = 1;
			    	$response['message'] = 'Already removed';
	           }else{
	                $favorite_list->delete();
	                $statusCode = 200;
				    $response['status'] = 1;
				    $response['message'] = 'data removed';
	           }
	           
	           $favorite_list = Favorite::where('customer_id', $current_user->id)->get();	
	            if (count($favorite_list) > 0) {
    		        foreach ($favorite_list as $favorite) {
    		        	$list[] = $this->getProductFavorite($favorite->product,$lang_id);
    		        }
	             }else{
				    $list = [];
                }  
	         $response['data'] = $list;
	       		
                
    	} catch (Exception $e) {
        	$statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();	    		
    	}finally{
        		return response()->json($response, $statusCode);
        }   
    }
    
}
