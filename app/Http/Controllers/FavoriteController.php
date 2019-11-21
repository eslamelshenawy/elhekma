<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\products;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function add_favorite(Request $request)
    {

    
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;

            $validator = Validator::make($request->all(), [
                'product_id' => 'required',
            ]);

            if ($validator->fails()) {
                $response["status"] = -3;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
            } else {
                $product_id = $request->input('product_id');
                $product_id = products::find($product_id);
                //dd($product_id);
        $current_user = auth('customer')->user();

        $favoriteRemove = Favorite::where('customer_id', $current_user->id)->where('product_id',$product_id->id)->first();
        $favorite_hide_table='';
        if ($favoriteRemove) {
            $favorite_hide_table = $favoriteRemove->product_id;
            $favoriteRemove->forcedelete();
        }else{
            $favorite = new Favorite;
            $favorite->customer_id = $current_user->id;
            $favorite->product_id = $request->product_id;
            $favorite->save();

        }
        //dd(count(auth('customer')->user()->favorite));
            return response()->json([
                'success'=>true,
                'fav_count'=> count(auth('customer')->user()->favorite),
                'favorite_hide_table'=> $favorite_hide_table,
            ]);
        
            // if (app()->getLocale() == "en") {
            //     return
            // } else {
            //     Session::flash("favoritemessage", "تم تحديث قائمه المفضله" );
            // }
                
            }    
    }
}
