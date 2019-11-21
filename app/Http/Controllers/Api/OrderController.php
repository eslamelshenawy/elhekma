<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Orders;
use App\Models\products;
use App\Models\DeliveryAddresses;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Validator;
use Redirect;
use URL;
use Auth;
use File;
use App\Http\lib\Helper;
use App\Mail\WelcomeMail;
use Intervention\Image\Facades\Image;
use App\Models\customer;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
class OrderController extends ApiController
{
    public $lang = 1;

    public function __construct(Request $request){
        if($request->input('lang_id')){
            $this->lang = intval($request->input('lang_id'));
        }
    }

    public function getOrders(Request $request)
    {
        try {
            
            $customer = customer::user(true);

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = [];
            $orders = $customer->orders()->orderBy('created_at', 'DESC')->get();
            
            foreach($orders as $order){
                
                $response['data'][] = $order->formatObject($this->lang);
            }
        } catch (\Exception $e) {
            
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
        
            return response()->json($response, $statusCode);
        }
    }


    public function trackOrder(Request $request)
    {
        try {
            $statusCode = 200;
            $response = [];
            if(!$request->input('order_id')){
                $response['status'] = -1;
                $response['message'] = 'Missing parameter order_id';
                return response()->json($response, $statusCode);
            }
            $customer = customer::user(true);
            $order = $customer->orders()->where('id', $request->input('order_id'))->first();
            if(!$order){
                $response['status'] = -2;
                $response['message'] = 'invalid order_id';
                return response()->json($response, $statusCode);
            }
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = [];
            $logs = $order->orderStatusLog()->orderBy('created_at', 'DESC')->get();
            foreach($logs as $log){
                $response['data'][] = $order->formatStatusObject($this->lang, $log);
            }
        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }

     public function deleteOrderid(Request $request)
    {
         
        try {
           
            $customer = customer::user(true);

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = [];
            $orders = $customer->orders()->orderBy('created_at', 'DESC')->get();
            
            $order_id_remove =    $orders->where('id',$request->orderid)->first();
            
             if($order_id_remove == null){
	                $statusCode = 200;
			    	$response['status'] = 1;
			    	$response['message'] = 'Already removed';
	           }else{
	                $order_id_remove->delete();
	                $statusCode = 200;
				    $response['status'] = 1;
				    $response['message'] = 'data removed';
	           }
	           
           $orders_after = $customer->orders()->orderBy('created_at', 'DESC')->get();
           

            foreach($orders_after as $order){
                
                $response['data'][] = $order->formatObject($this->lang);
            }
            
        } catch (\Exception $e) {
            
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
        
            return response()->json($response, $statusCode);
        }
    }

    public function addToCart(Request $request){
        try {
            $customer = customer::user(true);

            $validator = Validator::make($request->all(), [
                'product_id' => 'required|numeric|exists:products,id',
                'qty' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                return response()->json($response, $statusCode);
            }

            $product = products::find($request->input('product_id'));

             
            $item = $product->formatCartItem(intval($request->input('qty')));

            $cart = customer::getCart(true);
           
            
            if(array_key_exists($product->id, $cart)){
                $cart[$product->id] = $item;
               
                customer::updateCart($cart, true);
            }

            customer::addCart($request->input('qty'),$request->input('product_id'),true);
             $cart = customer::getCart(true);

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "cart created or updated";
            $response['data'] = Cart::formatObject($this->lang, $cart);

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    
    
    
    public function ConfirmCart(Request $request){
        try {
            $customer = customer::user(true);

            $validator = Validator::make($request->all(), [
                'products.*.product_id' => 'required|numeric|exists:products,id',
                'products.*.qty' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                return response()->json($response, $statusCode);
            }

            foreach ($request->input('products') as $p){

                $product = products::find($p['product_id']);

                $item = $product->formatCartItem(intval($p['qty']));

                $cart = customer::getCart(true);

                if(array_key_exists($product->id, $cart)){
                    $cart[$product->id] = $item;

                    customer::updateCart($cart, true);
                }

                customer::addCart($p['qty'],$p['product_id'],true);
            }
            $cart = customer::getCart(true);

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "cart created or updated";
            $response['data'] = Cart::formatObject($this->lang, $cart);

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    

    public function removeFromCart(Request $request){
        try {
            $customer = customer::user(true);

            $validator = Validator::make($request->all(), [
                'product_id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                return response()->json($response, $statusCode);
            }

            $product_id = $request->input('product_id');
            $cart = customer::getCart(true);
            if(array_key_exists($product_id, $cart)){
                unset($cart[$product_id]);
                customer::updateCart($cart, true);
            }

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "Item Removed Successfully";
            $response['data'] = Cart::formatObject($this->lang, $cart);

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function getCart(Request $request){
        try {
            $customer = customer::user(true);

            $cart = customer::getCart(true);

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = Cart::formatObject($this->lang, $cart);

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function updateCart(Request $request){
        try {
            $customer = customer::user(true);

            $validator = Validator::make($request->all(), [
                'product_id' => 'required|numeric|exists:products,id',
                'qty' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                return response()->json($response, $statusCode);
            }

            $product = products::find($request->input('product_id'));

            $item = $product->formatCartItem(intval($request->input('qty')));

            $cart = customer::getCart(true);
            if(array_key_exists($product->id, $cart)) {
                $cart[$product->id]['quantity'] = $item['quantity'];
                $cart[$product->id]['quantity_price'] = $item['quantity_price'];
                customer::updateCart($cart, true);
            }

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "cart updated";
            $response['data'] = Cart::formatObject($this->lang, $cart);

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }


    public function checkout(Request $request){
        try {
            $customer = customer::user(true);


            $inputs = $request->all();
            if($request->info['oldid']){
                 $validator = Validator::make($request->all(), [
                'info.full_name' => 'required|min:4|string|max:255',
                'info.email' => 'required|email|max:255',
                'info.phone' => 'required|numeric',
                'info.oldid' => 'required',
                'products.*.product_id' => 'required|numeric|exists:products,id',
                'products.*.qty' => 'required|numeric',
            ]);
            
                $address = DeliveryAddresses::where('id',$inputs['info']['oldid'])->select('address','state_id','city_id')->get();
                $inputs['info']['address'] = $address[0]->address;
                $inputs['info']['state_id'] = $address[0]->state_id;
                $inputs['info']['city_id'] = $address[0]->city_id;
                
            }else{
                  $validator = Validator::make($request->all(), [
                'info.full_name' => 'required|min:4|string|max:255',
                'info.email' => 'required|email|max:255',
                'info.phone' => 'required|numeric|digits_between:8,20',
                'info.address' => 'required|string|min:6|max:255',
                'info.state_id' => 'required|exists:governs,id',
                'info.city_id' => 'required|exists:place,id',
                'products.*.product_id' => 'required|numeric|exists:products,id',
                'products.*.qty' => 'required|numeric',
            ]);
                
            }
            if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                return response()->json($response, $statusCode);
            }

            if (!empty($request->input('products'))) {

                $validator = Validator::make($request->all(), [
                    'products.*.product_id' => 'required|numeric|exists:products,id',
                    'products.*.qty' => 'required|numeric',
                ]);
                if ($validator->fails()) {
                    $statusCode = 200;
                    $response["status"] = -2;
                    $response['message'] = Helper::ArrayToString($validator->errors()->all());
                    return response()->json($response, $statusCode);
                }

                foreach ($request->input('products') as $p){

                    $product = products::find($p['product_id']);

                    $item = $product->formatCartItem(intval($p['qty']));

                    $cart = customer::getCart(true);

                    if(array_key_exists($product->id, $cart)){
                        $cart[$product->id] = $item;

                        customer::updateCart($cart, true);
                    }

                    customer::addCart($p['qty'],$p['product_id'],true);
                }

            }




            $cart = customer::getCart(true);

            if(!$cart){
                $statusCode = 200;
                $response["status"] = -3;
                $response['message'] = 'Empty cart';
                return response()->json($response, $statusCode);
            }


            $inputs['info']['govern'] = $inputs['info']['state_id'];
            $inputs['info']['place'] = $inputs['info']['city_id'];
            $inputs['info']['payment-method'] = 3;
            //create order & delivery address & qr code
            $order = Orders::createOrder($inputs['info'], [], true);
            if(!$order){
                $statusCode = 200;
                $response["status"] = -3;
                $response['message'] = 'Error in creating order';
                return response()->json($response, $statusCode);
            }

            $location = [
                'govern_id' => $inputs['info']['state_id'],
                'place_id'  => $inputs['info']['city_id']
            ];
            list($outlets, $outlets_status) = orders::findOutlets($customer, $cart, $location);

            try{
                $error = false;
                //add order details
                $result = $order->createDetails($outlets, $cart);
                if(!$result){
                    $order->rollBack();
                    $error = true;
                }
            }catch (\Throwable $e){
                //delete order and everything related
                $order->rollBack();
                $error = true;
            }
            if($error){
                $statusCode = 200;
                $response["status"] = -3;
                $response['message'] = 'Error in creating order2';
                return response()->json($response, $statusCode);
            }

            //log status change
            $order->logStatusChange();

            //clearing the cart
            customer::updateCart([], true);

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "order created";
            $response['data'] = $order->formatObject($this->lang);

        } catch (\Exception $e) {
            logger($e);
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    
    public function checkAvailability(Request $request){
        try {
            $customer = customer::user(true);
            $cart = customer::getCart(true);
            if(!$cart){
                $statusCode = 200;
                $response["status"] = -3;
                $response['message'] = 'Empty Cart';
                return response()->json($response, $statusCode);
            }

            $inputs = $request->all();
            $validator = Validator::make($request->all(), [
                'state_id' => 'required|exists:governs,id',
                'city_id' => 'required|exists:place,id',
            ]);
            if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                return response()->json($response, $statusCode);
            }

            $location = [
                'govern_id' => $request->input('state_id'),
                'place_id'  => $request->input('city_id')
            ];

            if($this->lang == 1) {
                \App::setLocale('en');
            }else{
                \App::setLocale('ar');
            }
            list($outlets, $outlets_status) = orders::findOutlets($customer, $cart, $location);

//            dd([$outlets, $outlets_status]);

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $outlets_status;

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }

}
