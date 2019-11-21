<?php

namespace App\Http\Controllers\Api;

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
class CustomerController extends ApiController
{
    public $lang = "";
    use SendsPasswordResetEmails;


    public function Register(Request $request)
    {

        try {
            $lang_id = $request->input('lang_id');
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:customer',
                'phone_number' => 'required|numeric|unique:customer',
                'address' => 'required|string|min:6|max:100',
                'city_id' => 'required',
                'state_id' => 'required',
                'password' => 'required|min:6|string|max:255|confirmed',
                'password_confirmation' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
            } else {
                $response = [];
                $statusCode = 200;
                $customer = new customer;

                $customer->full_name = $request->input('full_name');
                $customer->email = $request->input('email');
                $customer->phone_number = $request->input('phone_number');
                $customer->address = $request->input('address');
                $customer->city_id = $request->input('city_id');
                $customer->state_id = $request->input('state_id');
                $customer->password = Hash::make($request->input('password'));
                $customer->save();

                //Send email
                $customer->sendActivationMail();

                $response['status'] = 1;
                if (isset($lang_id)) {
                    $lang_id = $request->input('lang_id');
                } else {
                    $lang_id = 1;
                }
                $response['message'] = customer::MESSAGE_TYPE[0][$lang_id]; // 0 indicator for register cycle
                $response['data'] = $this->getCustomerObject($customer, $lang_id);
            }

        } catch (\Exception $e) {
            logger($e);
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function login(Request $request)
    {

        try {
            $lang_id = $request->input('lang_id');
            $statusCode = 200;
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if (isset($lang_id)) {
                $lang_id = $request->input('lang_id');
            } else {
                $lang_id = 1;
            }
            $response = [];
            if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
            } else {
                $customer = customer::where('email', '=', $request->email)->first();

                if ($customer && Hash::check($request->password, $customer->password)) {

                    if($customer && $customer->verified == 0){
                            $customer->sendActivationMail();
                            $statusCode = 200;
                            $response["status"] = -2;
                            $response['message'] = Customer::MESSAGE_TYPE[6][$lang_id];// 2 indicator for verify email cycle
                    } else {
                            $statusCode = 200;
                            $response['status'] = 1;
                            $response['message'] = customer::MESSAGE_TYPE[1][$lang_id]; // 1 indicator for success cycle
                            $response['data'] = $this->getCustomerObject($customer, $lang_id);
                    }


                        } else {
                    $statusCode = 200;
                    $response["status"] = -2;
                    $response['message'] = Customer::MESSAGE_TYPE[2][$lang_id];// 2 indicator for fail cycle
                		}
            }
        } catch (\Exception $e) {
            $statusCode = 200;
            $response["status"] = 0;
            $response['message'] = $e->getMessage();
        } finally {
            return response()->json($response, $statusCode);
        }

    }

    public function getProfile(Request $request)
    {
        try {
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $current_user = Auth::guard('customer-api')->user();
            $response['data'] = $this->getCustomerObject($current_user, $lang_id);

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function editProfile(Request $request)
    {
        try {
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;
            $current_user = Auth::guard('customer-api')->user();
            $validator = Validator::make($request->all(), [
                'full_name' => 'nullable|min:4|string|max:255',
                'email' => 'nullable|email|max:255|unique:customer,email,'.$current_user->id.',id',
                'phone_number' => 'nullable|numeric|unique:customer,phone_number,'.$current_user->id.',id',
                'address' => 'nullable|string|min:6|max:100',
                'city_id' => 'nullable|max:255',
                'state_id' => 'nullable|max:255',
                'image' => 'nullable|base64image'
            ]);
            if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
            } else {
                $current_user->full_name = empty($request->full_name) ? $current_user->full_name : $request->full_name;
                $current_user->email = empty($request->email) ? $current_user->email : $request->email;
                $current_user->phone_number = empty($request->phone_number) ? $current_user->phone_number : $request->phone_number;
                $current_user->address = empty($request->address) ? $current_user->address : $request->address;
                $current_user->city_id= empty($request->city_id) ? $current_user->city_id : $request->city_id;
                $current_user->state_id = empty($request->state_id) ? $current_user->state_id : $request->state_id;

                if(isset($request->image)){
                    $file_name = $this->saveImageBase64($request->image);
                }
                $current_user->image = empty($file_name) ? $current_user->image : $file_name;

                $current_user->save();

                if (isset($lang_id)) {
                    $lang_id = $request->input('lang_id');
                } else {
                    $lang_id = 1;
                }
                $response['status'] = 1;
                $response['message'] = customer::MESSAGE_TYPE[3][$lang_id];// 3 indicator for update cycle
            $response['data'] = $this->getCustomerObject($current_user, $lang_id);
}

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;
            $current_user = Auth::guard('customer-api')->user();

            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_new_password' => 'required',
            ]);

            if ($validator->fails()) {
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
            } else {
                if (isset($lang_id)) {
                    $lang_id = $request->input('lang_id');
                } else {
                    $lang_id = 1;
                }
                if ($request->new_password <> $request->confirm_new_password) {
                    $response["status"] = -1;
                    $response['message'] = 'Password not match';
                    return response()->json($response, $statusCode);
                }
                if (!Hash::check($request->input('old_password'), $current_user->password)) {
                    $response["status"] = -1;
                    $response['message'] = Customer::MESSAGE_TYPE[5][$lang_id];
	            } else {
                    $response['status'] = 1;
                    $response['message'] = Customer::MESSAGE_TYPE[4][$lang_id];
	                $current_user->password = Hash::make($request->new_password);
	                $current_user->save();
	                $response['data'] = $this->getCustomerObject($current_user, $lang_id);
	            }
            }

        } catch (\Exception $e) {
            $statusCode = 200;
            $response["status"] = 0;
            $response['message'] = $e->getMessage();

        } finally {
            return response()->json($response, $statusCode);
        }
    }



    protected function saveImageBase64($request_image)
    {
        $path = public_path('uploads/customer_image');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        $file_data = substr($request_image, strpos($request_image, ",")+1);

        //generating unique file name;
        $file_name = 'image_'.str_random(5).'.png';

        $image = base64_decode($file_data);
        $path = public_path() . "/uploads/" ."customer_image/". $file_name;
        file_put_contents($path, $image);
        return 'customer_image/'.$file_name;
    }
}
