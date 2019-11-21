<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\DeliveryAddresses;
use App\Models\governs;
use App\Models\OrderStatusLog;
use App\Models\place;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\OrderStatus;
use App\Models\outlets;
use App\Models\products;
use App\Models\store_identity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Storage;
class OrderController extends Controller
{


    public function actionCart(Request $request, $action){

        if(!in_array($action, ['add', 'remove', 'quantity'])){
            return response()->json(['success'=>false]);
        }

        //check product
        if($request->input('product_id') && intval($request->input('quantity'))){
            $product = products::find($request->input('product_id'));
            if(!$product){
                return response()->json(['success'=>false]);
            }

            $item = $product->formatCartItem(intval($request->input('quantity')));

            $cart = customer::getCart();
            if($action == 'add'){
                if(!array_key_exists($product->id, $cart)){
                    $cart[$product->id] = $item;
                }
            }elseif($action == 'remove'){
                if(array_key_exists($product->id, $cart)){
                    unset($cart[$product->id]);
                }
            }elseif($action == 'quantity'){
                if(array_key_exists($product->id, $cart)) {
                    $cart[$product->id]['quantity'] = $item['quantity'];
                    $cart[$product->id]['quantity_price'] = $item['quantity_price'];
                }
            }
            customer::updateCart($cart);

            $total_price = customer::totalCartPrice($cart);
            $info = store_identity::first();
            $shipping_cost = floatval($info->shipping_cost);

            return response()->json([
                'success'=>true,
                'cart'=>$cart,
                'cart_count'=>count($cart),
                'view'=> view("mini_cart_sidebar", ['cart'=>$cart, 'total_price'=>$total_price])->render(),
                'total_price' => $total_price,
                'shipping_cost'=>$shipping_cost
            ]);
        }
    }

    public function trackOrderPage(Request $request){
        if(!customer::check()){
            return redirect()->route('login');
        }
        $orders = customer::user()->orders()->orderBy('created_at', 'DESC')->with(['orderDetails', 'OrderStatus'])->simplePaginate(10);

        if($request->ajax()) {
            return view("customer_orders", ['orders'=>$orders])->render();
        }

        return view('track-order',[
            'current' => '',
            'orders'=>$orders
        ]);
    }

    public function filterOrders(Request $request){
        if(!customer::check()){
            return redirect()->route('login');
        }

        if($request->input('order_id')){
            $order = orders::find($request->input('order_id'));
            if($order && $order->customer_id == customer::user()->id){
                return view("customer_orders", ['orders'=>[$order]])->render();
            }
        }

    }

    public function cancelOrder(Request $request){
        if(customer::check() && $request->input('id')){
            $id = $request->input('id');
            $order = orders::find($id);
            if($order && $order->customer_id == customer::user()->id &&
                trim($order->orderStatus->title) == 'Pending'){

                $status = OrderStatus::where('title','User cancelled')->first();
                $order->order_status = $status->id;
                $order->save();

                //log status change
                $order->logStatusChange();

                foreach($order->orderDetails as $detail){
                    $detail->outlet->changeStock($detail->product_id, $detail->quantity, 'cancel');
                }

                $orders = customer::user()->orders()->orderBy('created_at', 'DESC')->with(['orderDetails', 'OrderStatus'])->simplePaginate(10);

                return view("customer_orders", ['orders'=>$orders])->render();
            }
        }
    }

    public function reorder(Request $request, $id){
        if(customer::check() && $id){
            $order = orders::find($id);
            if($order && $order->customer_id == customer::user()->id ){
                $cart = customer::getCart();

                $add_to_cart = [];
                foreach($order->orderDetails as $item){
                    $item = $item->product->formatCartItem($item->quantity);
                    $add_to_cart[$item['product_id']] = $item;
                }

                foreach($add_to_cart as $key => $item){
                    if(!isset($cart[$key])){
                        $cart[$key] = $item;
                    }
                }

                customer::updateCart($cart);

                return redirect()->route('cartPage');
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function storePage(){
        $branches = outlets::orderBy('name_en', 'asc')->get();
        return view('store',[
            'branches' => $branches
        ]);
    }

    public function cartPage(){
        $info = store_identity::first();
        $shipping_cost = floatval($info->shipping_cost);

        return view('cart',[
            'current' => '',
            'shipping_cost'=>$shipping_cost
        ]);
    }

    public function checkout(){
        $cart = customer::getCart();
        if(!$cart){
            return redirect()->back();
        }
        if(!customer::check()){
            return redirect()->route('login');
        }
        $user = customer::user();

        $total_price = customer::totalCartPrice($cart);

        $governs = governs::wherehas('outlets')->with('places')->orderBy('name_en')->get();

        list($outlets, $outlets_status) = orders::findOutlets($user, $cart);
        $disable_checkout = false;
        foreach($outlets_status as $status){
            if($status['type'] == 'unavailable'){
                $disable_checkout = true;
            }
        }

        $info = store_identity::first();
        $shipping_cost = floatval($info->shipping_cost);

        return view('checkout',[
            'current' => '',
            'cart' => $cart,
            'total_price'=>$total_price,
            'user'=>$user,
            'governs'=>$governs,
            'outlets'=>$outlets,
            'outlets_status'=>$outlets_status,
            'disabled_checkout'=>$disable_checkout,
            'shipping_cost'=>$shipping_cost
        ]);
    }

    public function checkOutlets(Request $request){
        if(customer::check() && $request->input('govern_id') && $request->input('place_id')){
            $location = [
                'govern_id' => $request->input('govern_id'),
                'place_id'  => $request->input('place_id')
            ];

            $cart = customer::getCart();

            $user = customer::user();

            list($outlets, $outlets_status) = orders::findOutlets($user, $cart, $location);

            return response()->json(['outlets_status'=>$outlets_status]);
        }
    }

    public function submitCheckout(Request $request){
        $cart = customer::getCart();
        if(!$cart){
            return redirect()->route('home');
        }
        if(!customer::check()){
            return redirect()->route('login');
        }
        $user = customer::user();

        $inputs = $request->all();
        $rules = [
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|digits_between:8,20|numeric',
//            'company' => 'nullable|string',
            'address' => 'required|max:255|string',
            'govern' => 'required|exists:governs,id',
            'place' => 'required|exists:place,id',
            'payment-method' => 'required|numeric'
        ];
        $messages = [];
        $validator = Validator::make($inputs, $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->errors()->messages();

            return back()->withInput(Input::all())->withErrors($validator);
        }

        //create order & delivery address & qr code
        $order = Orders::createOrder($inputs);
        if(!$order){
            return redirect()->route('trackOrder')->with('error', 'Error!');
        }

        $location = [
            'govern_id' => $request->input('govern'),
            'place_id'  => $request->input('place')
        ];
        list($outlets, $outlets_status) = orders::findOutlets($user, $cart, $location);

        try{
            $error = false;
            //add order details
            $order->createDetails($outlets, $cart);
        }catch (\Throwable $e){
            //delete order and everything related
            $order->rollBack();
            $error = true;
        }
        if($error){
            return redirect()->route('trackOrder')->with('error', 'Error!');
        }

        //log status change
        $order->logStatusChange();

        //clearing the cart
        customer::updateCart([]);

        //redirect to track order
        if (app()->getlocale() == 'en') {
            return redirect()->route('trackOrder')->with('success', 'Thanks for purchasing Order #'.$order->id);
        } else {
            return redirect()->route('trackOrder')->with('success', 'شكرا لشرائك الطلب #'.$order->id);
        }
        

    }

}
