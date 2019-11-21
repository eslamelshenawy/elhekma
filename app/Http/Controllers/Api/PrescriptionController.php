<?php

namespace App\Http\Controllers\Api;

use App\Models\Prescription;
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
class PrescriptionController extends ApiController
{
    public $lang = 1;

    public function __construct(Request $request){
        if($request->input('lang_id')){
            $this->lang = intval($request->input('lang_id'));
        }
    }

    public function getPrescriptions(Request $request)
    {
        try {
            $customer = customer::user(true);

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = [];
            $prescriptions = $customer->prescriptions()->orderBy('created_at', 'DESC')->get();
            foreach($prescriptions as $prescription){
                $response['data'][] = $prescription->formatObject($this->lang);
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

    public function uploadPrescription(Request $request)
    {
        try {
            $customer = customer::user(true);

            $inputs = $request->all();
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|min:4|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|numeric|digits_between:8,20',
                'address' => 'required|string|min:6|max:255',
                'state_id' => 'required|exists:governs,id',
                'city_id' => 'required|exists:place,id',
                'image' => 'required|base64image'
            ]);
            if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                return response()->json($response, $statusCode);
            }

            $inputs['image'] = $this->saveImageBase64($request->image);
            $inputs['address'] = $inputs['address'];
            $inputs['govern'] = $inputs['state_id'];
            $inputs['place'] = $inputs['city_id'];
            $prescription = Prescription::create($inputs);
            if(!$prescription){
                $statusCode = 200;
                $response["status"] = -3;
                $response['message'] = 'Error!';
                return response()->json($response, $statusCode);
            }

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data sent successfully";
            $response['data'] = $prescription->formatObject($this->lang);

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    protected function saveImageBase64($request_image)
    {
        $path = public_path('uploads/prescriptions');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        $file_data = substr($request_image, strpos($request_image, ",")+1);

        //generating unique file name;
        $file_name = 'image_'.str_random(30).'.png';

        $image = base64_decode($file_data);
        $path = public_path() . "/uploads/" ."prescriptions/". $file_name;
        file_put_contents($path, $image);
        return  "prescriptions/".$file_name;
    }
}
