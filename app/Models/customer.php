<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mail;
use Auth;


class customer extends Authenticatable
{
    use SoftDeletes;


    protected $table = 'customer';

    const MESSAGE_TYPE = [
        //INDICATOR NUMBER
        //1,2,3,4,5,6,7 as a Register && Login
        //0 , 1 TYPE OF MESSAGE ( 1 FOR ENGLISH , 2  FOR ARABIC)
		0 =>[
			//0 Register STATUS
			1 => 'Customer Register Successfully',
			2 => 'تم تسجيل مستخدم جديد بنجاح'
		],
		1 =>[
			//1 LOGIN SUCCESS
			1 => 'Logged In Successfully',
			2 => 'تم تسجيل الدخول بنجاح'
		],
		2 => [
			//2 LOGIN FAIL
			1 => 'Invalid E-mail or Password !',
			2 => 'كلمه السر او البريد الالكتروني غير صحيحه.'
		],
		3 => [
			//3 Update Profile
			1 => 'Your profile has been updated successfully',
			2 => 'تم تحديث معلوماتك بنجاح'
		],
		4 => [
			//4 old password is correct API change password
			1 => 'Password Changed successfully',
			2 => 'تم تغيير كلمه المرور بنجاح'
		],
		5 => [
			//4 old password is NOT correct API change password
			1 => 'Incorrect old password',
			2 => 'خطأ في كلمه المرور القديمة'
        ],
        6 => [
			//6 verify email
			1 => 'please confirm your email !',
			2 => 'من فضلك قم بتفعيل حسابك !'
		],

];

    public function favorite()
    {

        return $this->hasMany(Favorite::class, 'customer_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'customer_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'customer_id', 'id');

    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'customer_id', 'id');
    }

    public function govern()
    {
        return $this->belongsTo(governs::class, 'state_id', 'id');
    }

    public function place()
    {
        return $this->belongsTo(place::class, 'city_id', 'id');
    }

    public function orderStatusLog(){
        return $this->hasMany(OrderStatusLog::class, 'customer_id','id');
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }


    public function sendActivationMail(){
        $data = ['user'=>$this];

        try{
            Mail::send(['html' => 'email.welcomeEmail'], $data, function ($message) {
                $message
                    ->to($this->email, $this->full_name)
                    ->subject('H&S activation mail');
                $message
                    ->from('hs-test@pbc-egy.com','H&S');

            });
        }catch (\Exception $e){

            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
        }
    }

    public function firstLastName($full_name=''){
        $str = $full_name ?: $this->full_name;
        $str = (explode(' ', $str));
        $this->first_name = $str[0];
        $this->last_name = '';
        if(isset($str[1])){
            unset($str[0]);
            $this->last_name = implode(' ', $str);
        }
    }

    public static function check(){
        if(auth("customer")->check() || Auth::guard('customer-api')->check()){
            return true;
        }
        return false;
    }

    public static function user($api=false){
        if($api){
            return Auth::guard('customer-api')->user();
        }else{
            return auth('customer')->user();
        }
    }

    public static function getCart($api=false){
        $cart = [];
        if( !self::check() ){
            //not logged in
            //get cart from session
            if(\Illuminate\Support\Facades\Session::get('cart') && count(\Illuminate\Support\Facades\Session::get('cart'))){
                $cart = \Illuminate\Support\Facades\Session::get('cart');
            }
        }else{
            //logged in
            //get cart from db
            $customer = self::user($api);
            $items_in_db = $customer->cartItems()->orderBy('created_at', 'ASC')->get();
            foreach ($items_in_db as $item){
                $cart[$item->product_id] = $item->product->formatCartItem($item->quantity);
            }

            //update the session with the new data
            \Illuminate\Support\Facades\Session::put('cart', $cart);
        }

        return $cart;
    }


   public static function addCart($qty,$product_id, $api=false){
       
        if(!self::check()){
           
            //not logged in
            //update session
            // \Illuminate\Support\Facades\Session::put('cart', $data);
        }else{
            $customer = self::user($api);
            $items_in_db = $customer->cartItems;
            //add items found in cart and not in db
                if( !$items_in_db->where('product_id', $product_id)->first() ){
                    $cart_item = new Cart();
                    $cart_item->customer_id = $customer->id;
                    $cart_item->product_id = $product_id;
                    $cart_item->quantity = $qty;
                    $cart_item->save();
                   
                }
            
        }
    }


    public static function updateCart($data, $api=false){
        if(!self::check()){
            //not logged in
            //update session
            \Illuminate\Support\Facades\Session::put('cart', $data);
        }else{
            $customer = self::user($api);
            $items_in_db = $customer->cartItems;

            //delete items in db and not in cart
            //update quantity for items in db and cart
            foreach($items_in_db as $item){
                if(!array_key_exists($item->product_id, $data)){
                    $item->delete();
                }else{
                    if($item->quantity != $data[$item->product_id]['quantity']){
                        $item->quantity = $data[$item->product_id]['quantity'];
                        $item->save();
                    }
                }
            }

            //add items found in cart and not in db
            foreach($data as $key => $item){
                if( !$items_in_db->where('product_id', $item['product_id'])->first() ){
                    $cart_item = new Cart();
                    $cart_item->customer_id = $customer->id;
                    $cart_item->product_id = $item['product_id'];
                    $cart_item->quantity = $item['quantity'];
                    $cart_item->save();
                }
            }
        }
    }

    public static function totalCartPrice($cart){
        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item['quantity_price'];
        }
        return round($total_price, 2);
    }
}
