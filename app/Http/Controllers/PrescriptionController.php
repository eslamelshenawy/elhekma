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
use App\Models\Prescription;
use App\Models\products;
use App\Models\store_identity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Storage;
use File;


class PrescriptionController extends Controller
{


    public function prescriptionHistory(Request $request){
        if(!customer::check()){
            return redirect()->route('login');
        }
//
        $prescriptions = customer::user()->prescriptions()->orderBy('created_at', 'DESC')->simplePaginate(10);

        return view('prescriptions',[
            'current' => '',
            'prescriptions'=>$prescriptions
        ]);
    }


    public function showUploadPrescription(Request $request){
        if(!customer::check()){
            return redirect()->route('login');
        }

        $user = customer::user();

        $governs = governs::wherehas('outlets')->with('places')->orderBy('name_en')->get();

        return view('uploadPrescription',[
            'current' => '',
            'user'=>$user,
            'governs'=>$governs,
        ]);
    }

    public function uploadPrescription(Request $request){
        if(!customer::check()){
            return redirect()->route('login');
        }

        $inputs = $request->all();
        $rules = [
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|digits_between:8,20|numeric',
            'address' => 'required|max:255|string',
            'govern' => 'required|exists:governs,id',
            'place' => 'required|exists:place,id',
            'image' => 'required|image'
        ];
        $messages = [];
        $validator = Validator::make($inputs, $rules, $messages);
        if ($validator->fails()) {
            return back()->withInput(Input::all())->withErrors($validator);
        }

        $file = $request->file("image");
        $image = $this->uploadImage($request->file("image"));
        $inputs['image'] = $image;

        $message = '';
        $error = false;

        //create prescription
        try{
            $prescription = Prescription::create($inputs);
        }catch (\Throwable $e){
            $error = true;
            if(\App::isLocale('en')){
                $message = 'Error';
            }else{
                $message = 'خطأ';
            }
        }

        if(!$error){
            if(\App::isLocale('en')){
                $message = 'Your prescription #'.$prescription->id.' is added successfully';
            } else {
                $message = 'تم إضافة الروشته بنجاح';
            }
        }

        if($error){
            $type = 'error';
        }else{
            $type = 'success';
        }

        return redirect()->route('prescriptionHistory')->with($type, $message);
    }

    private function uploadImage($file)
    {
        $folder = 'prescriptions';
        $path = public_path('uploads/'.$folder);
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        $name = rand(1000, 10000).time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/'.$folder);
        $file = $file->move($destinationPath, $name);
        return $folder.'/'.$name;
    }
}
