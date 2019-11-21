<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use File;
use URL;

class Orders extends Model
{
    use SoftDeletes;

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status', 'id');
    }

    public function orderStatusLog()
    {
        return $this->hasMany(OrderStatusLog::class, 'order_id', 'id');
    }

    public function deliveryAddress()
    {
        return $this->hasOne(DeliveryAddresses::class, 'id', 'address_id');
    }

    public function prescription(){
        return $this->belongsTo(Prescription::class, 'prescription_id', 'id');
    }

    public function formatObject($lang_id){
        $obj = new \stdClass();
        $obj->id = $this->id;
        $obj->total = floatval($this->total);
        $obj->status = $lang_id == 1 ? strval($this->orderStatus->title) : strval($this->orderStatus->title_ar);
        $obj->shipping_cost = floatval($this->shipping_cost);
        $obj->fullname = strval($this->deliveryAddress->first_name)." ".strval($this->deliveryAddress->last_name);
        $obj->phone = strval($this->deliveryAddress->phone_number);
        $obj->email = strval($this->deliveryAddress->email);
        $obj->address = strval($this->deliveryAddress->address);
        $obj->address_id = intval($this->deliveryAddress->id);

        $obj->state_id = $this->deliveryAddress->state_id;
        $obj->state_name = "";
        if($this->deliveryAddress->state){
            $obj->state_name = $lang_id == 2 && strval($this->deliveryAddress->state->name_ar) ?
                strval($this->deliveryAddress->state->name_ar) :
                strval($this->deliveryAddress->state->name_en);
        }

        $obj->city_id = $this->deliveryAddress->city_id;
        $obj->city_name = "";
        if($this->deliveryAddress->city){
            $obj->city_name = $lang_id == 2 && strval($this->deliveryAddress->city->name_ar) ?
                strval($this->deliveryAddress->city->name_ar) :
                strval($this->deliveryAddress->city->name_en);
        }


        $obj->created_at = $this->created_at->format('d-m-Y H:i');

        $obj->products = [];

        foreach($this->orderDetails as $item){
            $product = [];
            $product['id'] = $item->product_id;
            $product['title'] = $lang_id == 2 && strval($item->product->name_ar) ?
                strval($item->product->name_ar) :
                strval($item->product->name_en);
            $product['photo'] = '';
            if($item->product->photo){
                $product['photo'] = strval($item->product->photo);
            }elseif($item->product->product_images){
                $images = $item->product->product_images->image;
                if($images){
                    $product['photo'] = strval($images[0]);
                }
            }
            if($product['photo']){
                $product['photo'] = urldecode(URL::to('/uploads',$product['photo']));
            }else{
                $product['photo'] = urldecode(URL::to('assets/images/product/product-1.png'));
            }
            $product['qty'] = intval($item->quantity);
            $product['price'] = floatval($item->price);
            $product['subtotal'] = floatval($item->sub_total);
            $product['branch'] = $lang_id == 2 && strval($item->outlet->name_ar) ?
                strval($item->outlet->name_ar) :
                strval($item->outlet->name_en);

            $obj->products[] = $product;
        }
        return $obj;
    }

    public function formatStatusObject($lang_id, $log){
        $obj = new \stdClass();
        $obj->status = $lang_id == 1 ? strval($log->status->title) : strval($log->status->title_ar);
        $obj->created_at = $log->created_at->format('d-m-Y H:i');
        return $obj;
    }

    public function logStatusChange($type='customer', $admin_id=''){
        $log = new OrderStatusLog();
        if($type == 'customer'){
            $log->customer_id = $this->customer_id;
        }else{
            $log->admin_id = $admin_id;
        }
        $log->order_id = $this->id;
        $log->status_id = $this->order_status;
        $log->save();
    }

    public static function createOrder($data, $cart=[], $api=false){
        try{
           
           if($data['oldid']){
               $address = DeliveryAddresses::where('id',$data['oldid'])->first();
           }else{
              $address = DeliveryAddresses::createFromData($data, $api);
           }
            

             

            $info = store_identity::first();
            $shipping_cost = floatval($info->shipping_cost);

            if(!$cart){
                $cart = customer::getCart($api);
            }
            $total_price = customer::totalCartPrice($cart);

            $status = OrderStatus::where('title', 'Pending')->first();

            $order = new self();
            $order->customer_id = isset($data['customer_id']) ? $data['customer_id'] : customer::user($api)->id;
            $order->total = $total_price + $shipping_cost;
            $order->shipping_cost = $shipping_cost;
            $order->order_status = $status->id;
//        $order->company_id = ;
            //maybe this will be payment method!
            $order->payment_id = $data['payment-method'];
            $order->address_id = $address->id;
            if(isset($data['prescription_id']) && $data['prescription_id']){
                $order->prescription_id = $data['prescription_id'];
            }
            $order->save();

            $order->generateQR($data);

            return $order;
        }catch (\Throwable $e){
            logger($e);
            if(isset($order) && $order){
                $order->rollBack();
            }
        }
    }

    public function generateQR($data){
        $govern = governs::where('id',$data['govern'])->first();
        $place  = place::where('id',$data['place'])->first();

        $address = $this->deliveryAddress;

        $path = public_path('uploads/order_qrCode');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        $qr_code_img = 'order_qrCode/'.'qr_code_'.str_random(5).'_'.$this->customer_id.'.png';
        $qr_code_str = $this->id.', '.$address->first_name.' '.$address->last_name.', '.$address->phone_number.', '.$address->address.', '.$place->name_en.', '.$govern->name_en;
        $qr_code_image = base64_encode(QrCode::encoding('UTF-8')->format('png')->size(400)->backgroundColor(255, 255, 255)->errorCorrection('H')->generate($qr_code_str, public_path('uploads/'.$qr_code_img)));

        $this->qr_code_str = $qr_code_str;
        $this->qr_code_img = $qr_code_img;

        $this->save();
    }

    public function createDetails($outlets, $cart){
        foreach($cart as $item){
            //if product found in branch
            if($outlets[$item['product_id']]){
                $details = new OrderDetails();
                $details->product_id = $item['product_id'];
                $details->order_id = $this->id;
                $details->outlet_id = $outlets[$item['product_id']]['outlet']->id;
                $details->quantity = $item['quantity'];
                $details->price = $item['item_price'];
                $details->sub_total = $item['quantity_price'];
                $details->save();

                $outlets[$item['product_id']]['outlet']->changeStock($details->product_id, $details->quantity, 'order');
            }else{
                return false;
            }
        }
        return true;
    }

    public function rollBack(){
        if($this->id){
            $details = $this->orderDetails;
            $address = $this->deliveryAddress;
            $order = $this;

            if($address){
                $address->delete();
            }
            foreach($details as $item){
                $item->outlet->changeStock($item->product_id, $item->quantity, 'cancel');
                $item->delete();
            }
            $order->delete();
        }
    }

    public static function findOutlets($user, $cart, $location=[]){
        if(!$location){
            if(!$user->state_id || !$user->city_id){
                return [ [], [] ];
            }
            $location['govern_id'] = $user->state_id;
            $location['place_id'] = $user->city_id;
        }

        $outlets = [];
        foreach($cart as $item){
            //find the outlet in his local area
            $potential_outlet = outlets::where('place_id', $location['place_id'])->where('govern_id', $location['govern_id'])
                                        ->whereHas('products', function ($query) use ($item) {
                                            $query->where('products_id', $item['product_id']);
                                            $query->where('quantity', '>=', intval($item['quantity']));
                                        })->first();

            //no branch in his local area or the local branch doesn't have the product
            //find any branch in the same city that has the product
            if(!$potential_outlet){
                $potential_outlet = outlets::where('govern_id', $location['govern_id'])
                                            ->whereHas('products', function ($query) use ($item) {
                                                $query->where('products_id', $item['product_id']);
                                                $query->where('quantity', '>=', intval($item['quantity']));
                                            })->first();
                if($potential_outlet){
                    $outlets[$item['product_id']] = ['outlet'=>$potential_outlet, 'location'=>'govern'];
                }else{
                    $outlets[$item['product_id']] = [];
                }
            }else{
                $outlets[$item['product_id']] = ['outlet'=>$potential_outlet, 'location'=>'place'];
            }
        }

        //hints
        $outlets_status = [];
        foreach($outlets as $product_id => $value){
            if(!$value){
                if(\App::isLocale('en')){
                    $outlets_status[] =
                        ['id'=>$product_id, 'type'=>'unavailable', 'text'=> 'Product "'.$cart[$product_id]['product_name'].'" in not available in any of our branches in this area at the moment'.'.'];
                }else{
                    $outlets_status[] =
                        ['id'=>$product_id, 'type'=>'unavailable', 'text'=> 'المنتج '.$cart[$product_id]['product_name_ar'].' غير متاح ف فروعنا القريبة منك.'];
                }
            }

            if($value && $value['location'] == 'govern'){
                if(\App::isLocale('en')){
                    $outlets_status[] =
                        ['id'=>$product_id, 'type'=>'different_outlet', 'text'=> 'Product "'.$cart[$product_id]['product_name'].'" will be shipped from our branch in '.$value['outlet']->place->name_en.'.'];
                }else{
                    $outlets_status[] =
                        ['id'=>$product_id, 'type'=>'different_outlet', 'text'=> 'سيتم توصيل المنتج '.$cart[$product_id]['product_name_ar'].' من فرعنا في '.$value['outlet']->place->name_ar.' .'];
                }

            }
        }

        return [$outlets, $outlets_status];
    }


    public function sendPlaceOrderMail(){
        $data = ['order'=>$this];

        try{
            Mail::send(['html' => 'email.placeOrder'], $data, function ($message) {
                $message
                    ->to($this->customer->email, $this->customer->full_name)
                    ->subject('Thanks for purchasing Order #'.$this->id);
                $message
                    ->from('hs-test@pbc-egy.com', config('H&S'));

            });
        }catch (\Exception $e){
            logger($e);
        }
    }




}
