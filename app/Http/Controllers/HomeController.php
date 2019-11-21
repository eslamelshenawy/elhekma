<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\outlets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\products;
use App\Models\productsImages;
use App\Models\customer;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Ads;
use Auth;
use Validator;
use App\Models\ContactUs;
use App\Models\NewsLetter;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
    //    return view('home');

        $featured_products = products::where('featured_pro', 1)->inRandomOrder()->limit(20)->get();
        $best_sellers = products::where('best_seller', 1)->inRandomOrder()->limit(8)->get();
        $new_arrivals = products::where('new_arrival', 1)->inRandomOrder()->limit(8)->get();
        $slider = Slider::limit(3)->get();
        $ads = Ads::inRandomOrder()->limit(3)->get();

        // dd($best_seller);
        return view('index',[
            'current' => '',
            'featured_products' =>  $featured_products ,
            'best_sellers' =>  $best_sellers ,
            'new_arrivals' =>  $new_arrivals ,
            'sliders' =>  $slider ,
            'ads' =>  $ads ,
        ]);
    }

    public function compare(){
        return view('compare',[
            'current' => ''
        ]);
    }

    public function aboutUs(){
        $about_us = Setting::find(1);

        return view('about-us',[
            'current' => $about_us
        ]);
    }

    public function page($id){
        $page = Setting::find($id);

        return view('about-us',[
            'current' => $page
        ]);
    }

    public function contactUs(){
        $branches = outlets::orderBy('name_en', 'asc')->get();
        return view('contact',[
            'branches' => $branches
        ]);
    }
    public function submit_contactUs(Request $request)
    {

            $inputs = [

                'first_name'   => $request->input('first_name'),
                'last_name'   => $request->input('last_name'),
                'email_address' => $request->input('email_address'),
                'phone_number' => $request->input('phone_number'),
                'message'   => $request->input('message'),
            ];
            $rules = [
                'first_name' => 'required|min:4|string|max:255',
                'last_name' => 'required|min:4|string|max:255',
                'email_address' => 'required|email',
                'phone_number' => 'required|numeric',
                'message' => 'required',
            ];
            $messages = [];
            $validator = Validator::make($inputs, $rules, $messages);

            if ($validator->fails()) {
                return view('contact',[
                    'branches' => $branches
                ])->withErrors($validator);
            }
            $contact_us = new ContactUs;
            $contact_us->first_name = $inputs['first_name'];
            $contact_us->last_name = $inputs['last_name'];
            $contact_us->email = $inputs['email_address'];
            $contact_us->phone_number = $inputs['phone_number'];
            $contact_us->message = $inputs['message'];
            $contact_us->save();
            $contact_us->sendInfoMail();

            if( app()->getLocale() == "en"){
                Session::flash("success_message", "Message sent succssfully");
            }else{
                Session::flash("success_message", "تم ارسال الرساله بنجاح");
            }
            return redirect()->back();



    }
    public function subscribe(Request $request)
    {

            $inputs = [
                'email_address' => $request->input('email_address'),
            ];
            $rules = [
                'email_address' => 'required|email',
            ];

            $messages = [];
            $validator = Validator::make($inputs, $rules, $messages);

            if ($validator->fails()) {
                return response()->json('Check Mail',200);
            }
            $is_reg = NewsLetter::where('email','=',$inputs['email_address'])->exists();

            if ($is_reg) {
                return response()->json('Mail in our list',200);
            }
            $news_letter = new NewsLetter;
            $news_letter->email = $inputs['email_address'];
            $news_letter->save();
            return response()->json('E-mail Saved',200);



    }

    public function terms(){
        $terms = Setting::find(2);
        return view('terms-conditions',[
            'current' => $terms
        ]);
    }

    public function singleProduct(Request $request){
        $can_review = false;
        $id = $request->id;
        $product = products::find($id);
        if(auth('customer')->check()){
            $can_review = true;
            $orders = customer::find(auth('customer')->user()->id)->orders;
            foreach ($orders as $order) {
                foreach ($order->orderDetails as $o) {
                    if ($o['product_id'] == $product->id) {
                        $current_product = $o;
                    }
                }
            }
        }
        if (empty($current_product)) {
            $current_product = $product;
        }
        if ($product) {
        $images = $product->product_images['image'];
        $quantity = $product->productdetails;
        $stock = 0;
        foreach ($quantity as $q) {
            $stock = $stock + intval($q['quantity']);

        }
        $reviews = $product->reviews;


        $related_products = products::where('category_id',$product->category_id)->orwhere('pharma_tag1_id',$product->pharma_tag1_id)->orwhere('pharma_tag2_id',$product->pharma_tag2_id)->orwhere('pharma_tag3_id',$product->pharma_tag3_id)->get();
        if (count($related_products) > 20) {
           $related_products = $related_products->take(20);
        }


        return view('single-product',[
            'images' => $images,
            'product' => $product,
            'stock' => $stock,
            'reviews' => $reviews,
            'can_review' => $can_review,
            'current_product' => $current_product,
            'related_products' => $related_products
        ]);
        }else{
            return abort(404);
        }
    }

    public function search_product_header(Request $request)
    {
        
        $product_search = $request->search_product;
        $products = products::where('name_en','like','%'.$product_search.'%')->paginate(15)->onEachSide(3);//->get();
        return view('product_result',[
            'medicineData' => $products
        ]);
    }

    public function feature(){
        return view('feature',[
            'current' => ''
        ]);
    }

    public function faq(){
        $faqs = Faq::get();
        return view('faq',[
            'faqs' => $faqs
        ]);
    }
}
