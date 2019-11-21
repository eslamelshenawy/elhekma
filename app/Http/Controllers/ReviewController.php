<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function add_review(Request $request)
    {
		try {
			//dd($request->all());
            $customer = auth('customer')->user();
            $inputs = [

                'product_id'   => $request->input('product_id'),
                'customer_id'   => $request->input('customer_id'),
                'review' => $request->input('review'),
                'star' => $request->input('star'),
            ];
            $rules = [
                'product_id' => 'required',
                'customer_id' => 'required',
                'review' => 'required|between:10,191',
                'star' => 'required',


            ];		
            
            $messages = [];
            $validator = Validator::make($inputs, $rules, $messages);
            if ($validator->fails()) {
                $message = implode(' ', $validator->errors()->all());

                return back()->withErrors($validator);

            }else{
            	$review_before = Review::where('product_id',$inputs['product_id'])->where('customer_id',$inputs['customer_id'])->first();
            	if (!empty($review_before)) {
            		return back()->with($review_before);
            	}else{
            		$review =  new Review;
					$review->product_id = $inputs['product_id'];
					$review->customer_id = $inputs['customer_id'];
					$review->review = $inputs['review'];
					$review->rating = $inputs['star'];
					$review->save();

                    if (app()->getLocale() == "en") {
                       Session::flash("reviewmessage", "thank you for your review, " . $customer->full_name);
                    } else {
                       Session::flash("reviewmessage", "شكرا لاضافه التقييم الخاص بك" . $customer->full_name);
                    }                    
					return redirect()->back();           			
            	}
			
            }            	



		    		
		    	} catch (Exception $e) {

		    		return back()->withInput(Input::all())->with("message", "Server Error");
		    	}    	
    }
}
