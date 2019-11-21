<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Validator;
use Redirect;
use URL;
use App\Mail\WelcomeMail;
use Intervention\Image\Facades\Image;
use App\Models\customer;
use App\Models\governs;
use App\Models\place;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class CustomerController extends Controller
{
    public $lang = "";
    use SendsPasswordResetEmails;

    public function registerPage(){

        $customer = auth('customer')->user();
        if($customer){
            return redirect()->route('profile');
        }
        $governs = governs::wherehas('places')->with('places')->orderBy('name_en')->get();
        return view('register',[
            'current' => '',
            'governs'=>$governs
        ]);
    }

    public function loginPage(){

        if (auth('customer')->check()) {
            return redirect()->route('profile');
        }
        Session::put('url.intended',URL::previous());
        return view('login',[
            'current' => ''
        ]);
    }

    public function places(Request $request){

        $places = place::where('govern_id',$request->govern_id)->orderBy('name_en')->get();
       logger($places);
        return response()->json($places);
    }

    public function wishlist(){

        if (auth('customer')->check() == false) {
            return redirect()->route('login');
        }
        return view('wishlist',[
            'current' => ''
        ]);
    }

    public function Register(Request $request)
    {

        try{
            $inputs = [

                'full_name'   => $request->input('full_name'),
                'email'   => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'country'   => $request->input('country'),
                'city_id'   => $request->input('city_id'),
                'state_id' => $request->input('state_id'),
                'zip_code' => $request->input('zip_code'),
                'password'   => $request->input('password'),
                'password_confirmation'   => $request->input('password_confirmation'),


            ];
            $rules = [
                'full_name' => 'required|min:4|string|max:255',
                'email' => 'required|email|max:255|unique:customer',
                'phone_number' => 'required|numeric|unique:customer',
                'address' => 'required|string|min:6|max:100',
                // 'country' => 'required|string|max:255',
                'city_id' => 'required',
                'state_id' => 'required',
                'zip_code' => 'nullable|numeric|min:5',
                'password' => 'required|min:6|string|max:255|confirmed',
                'password_confirmation' => 'required|min:6',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'

            ];
            $messages = [];
            $validator = Validator::make($inputs, $rules, $messages);
            if ($validator->fails()) {
                $message = implode(' ', $validator->errors()->all());
                return back()->withInput(Input::all())->with("message", $message);

            }

            $customer = new customer;

            $customer->full_name = $inputs['full_name'];
            $customer->email = $inputs['email'];
            $customer->phone_number = $inputs['phone_number'];
            $customer->address = $inputs['address'];
            // $customer->country = $inputs['country'];
            $customer->city_id = $inputs['city_id'];
            $customer->state_id = $inputs['state_id'];
            if($inputs['zip_code']);
            $customer->zip_code = $inputs['zip_code'];

            $customer->password = Hash::make($inputs['password']);

            $file = $request->file("image");
            if(!empty($file)){
                $customer->image = $this->uploadImage($request->file("image"));
            }
            $customer->save();
            //Send email
            $customer->sendActivationMail();
            // auth('customer')->login($customer);
            if( app()->getLocale() == "en"){
                Session::flash("registermessage", "register success, you must verify your email to login ".$customer->full_name);
            }else{
                Session::flash("registermessage", "تم التسجيل بنجاح لكن يجب تفعيل بريدك لتسجيل الدخول  ".$customer->full_name);
            }
            return redirect()->route("home");
        }catch (\Exception $e){
            logger($e);
            return back()->withInput(Input::all())->with("message", "Server Error");
        }
    }

    public function submitLogin(Request $request)
    {
        try {
            $cart = customer::getCart();

            $input = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|min:6|max:100|string',
            ];
            $messages = [];
            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                $message = implode(' ', $validator->errors()->all());
                return back()->withInput(Input::all())->with("message", $message);
            }


            $customer = customer::withTrashed()->where('email', '=', $input['email'])->get()->first();
            if (!$customer) {
                return back()->withInput(Input::all())->with("message", 'Provided email is not associated with any account in our database');
            }

            if (Hash::check($input['password'], $customer->password)) {

            }else {
                return back()->withInput(Input::all())->with("message", 'Wrong email or password');
            }

            if($customer && $customer->verified == 0){

                $customer->sendActivationMail();

                if (app()->getLocale() == "en") {
                    return back()->withInput(Input::all())->with("message", 'You must verify your E-mail please');
                } else {
                    return back()->withInput(Input::all())->with("message", 'من فضلك قم بتفعيل حسابك');
                }

            }else{
                auth('customer')->login($customer);

            if (app()->getLocale() == "en") {
                Session::flash("registermessage", "Welcome to our site, " . $customer->full_name);
            } else {
                Session::flash("registermessage", "أهلا بك في موقعنا " . $customer->full_name);
            }

            if($cart){
                customer::updateCart($cart);
            }
             //return redirect()->route("home");
             return Redirect::to(Session::get('url.intended'));
        }
        } catch (\Exception $e) {
            return back()->withInput(Input::all())->with("message", 'Server Error');
        }
    }


    public function verify($activation_code)
    {

            $customer = customer::where('activation_code', '=', $activation_code)->first();

            if (!$customer) {
                return redirect()->route('home');
            } else {
                $customer->verified = 1;
                $customer->activation_code = null;
                $customer->save();

                if (app()->getLocale() == "en") {
                    Session::flash("registermessage", "Success activation, " . $customer->full_name);
                } else {
                    Session::flash("registermessage", "تم تفعيل حسابك بنجاح " . $customer->full_name);
                }
                return redirect()->route('home');
            }


    }


    public function profile()
    {

      $customer = auth('customer')->user();
      if(!$customer){
          return redirect()->route('\home');
      }

      return view('profile', [
            'title' => 'profile',
            'current' => 'profile',
        ]);
    }

    public function editProfilePage()
    {

      $customer = auth('customer')->user();
      if(!$customer){
          return redirect()->route('\home');
      }
      $governs = governs::wherehas('places')->with('places')->orderBy('name_en')->get();
      return view('editProfile', [
            'title'    => 'edit profile',
            'current'  => 'edit profile',
            'governs'  => $governs,
            'customer' => $customer
         ]);
    }


    public function editProfile(Request $request)
    {
        $customer = auth('customer')->user();
        if(!$customer){
            return redirect()->route('\home');
        }

        try{
            $inputs = [

                'full_name'   => $request->input('full_name'),
                'email'   => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'country'   => $request->input('country'),
                'city_id'   => $request->input('city_id'),
                'state_id' => $request->input('state_id'),
                'zip_code' => $request->input('zip_code'),

            ];
            $rules = [
                'full_name' => 'nullable|min:4|string|max:255',
                'email' => 'nullable|email|max:255|unique:customer,email,'.$customer->id.',id',
                'phone_number' => 'nullable|numeric|unique:customer,phone_number,'.$customer->id.',id',
                'address' => 'nullable|string|min:6|max:100',
                'city_id' => 'nullable|max:255',
                'state_id' => 'nullable|max:255',
                'zip_code' => 'nullable|numeric|min:5',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'

            ];
            $messages = [];
            $validator = Validator::make($inputs, $rules, $messages);
            if ($validator->fails()) {
                $message = implode(' ', $validator->errors()->all());
                return back()->withInput(Input::all())->with("message", $message);

            }

            $customer->full_name = $inputs['full_name']?$inputs['full_name']:$customer->full_name;
            $customer->email = $inputs['email']?$inputs['email']:$customer->email;
            $customer->phone_number = $inputs['phone_number']?$inputs['phone_number']:$customer->phone_number;
            $customer->address = $inputs['address']?$inputs['address']:$customer->address;
            $customer->city_id = $inputs['city_id']?$inputs['city_id']:$customer->city_id;
            $customer->state_id = $inputs['state_id']?$inputs['state_id']:$customer->state_id;
            $customer->zip_code = $inputs['zip_code'];

            $file = $request->file("image");
            if(!empty($file)){
                $customer->image = $this->uploadImage($request->file("image"));
            }else{
                $customer->image = $customer->image;
            }
            $customer->save();

            if( app()->getLocale() == "en"){
                Session::flash("registermessage", "your profile updated successfully, ".$customer->full_name);
            }else{
                Session::flash("registermessage", "تم تحديث بياناتك بنجاح , ".$customer->full_name);
            }
            return redirect()->route("profile");
        }catch (\Exception $e){
            logger($e);
            return back()->withInput(Input::all())->with("message", "Server Error");
        }
    }

    public function forgotPasswordPage()
    {
        return view('forgotPassword', [
            'title' => 'forgot Password',
            'current' => 'forgot Password',
        ]);
    }



    public function logout()
    {

        if (auth("customer")->check()) {
            auth("customer")->logout();
        }
        if (app()->getLocale() == "en") {
            Session::flash("registermessage", "Successfully logout");
        } else {
            Session::flash("registermessage", "تم تسجيل الخروج بنجاح");
        }
        return redirect()->route("home");
    }

    public function uploadImage($file)
    {
        $path = public_path('uploads/customer_image');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        $name = time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/customer_image');
        $file = $file->move($destinationPath, $name);
        return 'customer_image/'.$name;

    }
}
