<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReminderType;
use App\Models\ReminderWaterSetting;
use App\Models\ReminderDetails;
use App\Models\ReminderWater;
use App\Models\RemindTimeMeal;
use App\Http\Controllers\ApiController;
use Validator;
use App\Http\lib\Helper;

class RemindController extends ApiController
{


   public function gettype(Request $request)
    {
        try {
            
            $ReminderType = ReminderType::select('id','title_ar','title_en')->get();

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $ReminderType;

        } catch (\Exception $e) {
            
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
        
            return response()->json($response, $statusCode);
        }
    }
    
    
     public function medicationRemind(Request $request)
    {
        
        try {
            
            // 	$current_user = auth('customer-api')->user();
            // 	 $Reminder_user = ReminderDetails::where('user_id', $current_user->id)->where('type_id', 1)->first();

            $validator = Validator::make($request->all(), [
                'typeremind' => 'required',
                'user_id' => 'required',
            ]);
            
              if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
            } else {
             $ReminderDetails= $this->getStoreremind($request->all());
          
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $ReminderDetails;

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
    
    
     public function settingRemind(Request $request)
    {
        try {
            
             $validator = Validator::make($request->all(), [
                'typeremind' => 'required',
                'user_id' => 'required',
            ]);
            
              if ($validator->fails()) {
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
            } else {
                
               	$current_user = auth('customer-api')->user();
           
           	 $ReminderSet_user = ReminderWaterSetting::where('user_id', $current_user->id)->first();
           	 
           	
           	 if($ReminderSet_user != null ){
           	     $ReminderSetting= $this->getupdatesetting($request->all(),$ReminderSet_user->id);
           	 }else{
           	           $ReminderSetting= $this->getStoresetting($request->all());
           	 }

          
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $ReminderSetting;

                
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
    
    
      public function addreminderwaters(Request $request)
    {
        try {
            
             $validator = Validator::make($request->all(), [
                'typeremind' => 'required',
                'user_id' => 'required',
            ]);
            
              if ($validator->fails()) {
                  
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                
            } else {
            
               	$current_user = auth('customer-api')->user();
           	//  $ReminderSet_user = ReminderWater::where('user_id', $current_user->id)->first();
           	  $ReminderWater= $this->getStoreReminderWater($request->all());
           	  
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $ReminderWater;

                
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
    
      public function getreminderwaters(Request $request)
    {
        try {
            
               	$current_user = auth('customer-api')->user();
           	 $ReminderSet_user = ReminderWater::where('user_id', $current_user->id)->get();

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $ReminderSet_user;

                
           

        } catch (\Exception $e) {
            
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
        
            return response()->json($response, $statusCode);
        }
    }
    
    
      public function getreminderfood(Request $request)
    {
        try {
            
               	$current_user = auth('customer-api')->user();
           	 $Remindermeals = RemindTimeMeal::with('food')->get();
           	 $Remindermeals_details =[];
           	 foreach($Remindermeals  as $Remindermeal){
           	     $meal=[];
           	     $meal['name_meal']=$Remindermeal->name_meal;
           	     foreach($Remindermeal->food as $Remindermeal_food){
           	         $meal['id'] =$Remindermeal_food->id;
           	         $meal['title'] =$Remindermeal_food->title;
           	         $meal['fav_status'] =$Remindermeal_food->fav_status;
           	         $meal['my_food'] =$Remindermeal_food->my_food;
           	        $Remindermeals_details[]= $meal;
           	     }
           	      
           	 }

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $Remindermeals_details;
           

        } catch (\Exception $e) {
            
            $statusCode = 200;
            $response['status'] = -3;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
        
            return response()->json($response, $statusCode);
        }
    }
    
    
    
        public function addreminderfood(Request $request)
    {
        try {
            
             $validator = Validator::make($request->all(), [
                'meal_id' => 'required',
                'user_id' => 'required',
            ]);
            
              if ($validator->fails()) {
                  
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                
            } else {
            
               	$current_user = auth('customer-api')->user();
           	  $ReminderWater= $this->getStoreReminderfood($request->all());
           	  
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $ReminderWater;

                
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
    
    
    
       public function addreminderexercise(Request $request)
    {
        try {
            
             $validator = Validator::make($request->all(), [
                'typeremind' => 'required',
                'exercise_status' => 'required',
                'time_exercise' => 'required',
                'user_id' => 'required',
            ]);
            
              if ($validator->fails()) {
                  
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                
            } else {
            
               	$current_user = auth('customer-api')->user();
               	
               $Remindererexercise = ReminderDetails::where('user_id', $current_user->id)->where('type_id', 6)->first();
           	 
           	
           	 if($Remindererexercise != null ){
           	     $Reminderexercise= $this->getupdateReminderexercise($request->all(),$Remindererexercise->id);
           	 }else{
           	  $Reminderexercise= $this->getStoreReminderexercise($request->all());
           	 }

           	  
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $Reminderexercise;

                
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
    
    
    
        public function addbloodpressure(Request $request)
    {
        try {
            
             $validator = Validator::make($request->all(), [
                'typeremind' => 'required',
                'user_id' => 'required',
                'blood_pressure' => 'required',
                'prn_status' => 'required',
                'duration' => 'required',
                'frequency_intake' => 'required',
                'remind_time' => 'required',
            ]);
            
              if ($validator->fails()) {
                  
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                
            } else {
            
               	$current_user = auth('customer-api')->user();
                $Remindbloodpressure = ReminderDetails::where('user_id', $current_user->id)->where('type_id', 2)->first();
           	
           	 if($Remindbloodpressure != null ){
           	     $Reminderbloodpressure= $this->getupdatebloodpressure($request->all(),$Remindbloodpressure->id);
           	 }else{
           	  $Reminderbloodpressure= $this->getStorebloodpressure($request->all());
           	 }

           	  
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $Reminderbloodpressure;

                
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
    
    
        public function addheart(Request $request)
    {
        try {
            
             $validator = Validator::make($request->all(), [
                'typeremind' => 'required',
                'user_id' => 'required',
                'heart_rate' => 'required',
                'prn_status' => 'required',
                'duration' => 'required',
                'frequency_intake' => 'required',
                'remind_time' => 'required',
            ]);
            
              if ($validator->fails()) {
                  
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                
            } else {
            
               	$current_user = auth('customer-api')->user();
                $Remindheart = ReminderDetails::where('user_id', $current_user->id)->where('type_id', 2)->first();
           	
           	 if($Remindheart != null ){
           	     $Reminderheart_de= $this->getupdateheart($request->all(),$Remindheart->id);
           	 }else{
           	  $Reminderheart_de= $this->getStoreheart($request->all());
           	 }

           	  
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $Reminderheart_de;

                
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


     public function addbloodsugar(Request $request)
    {
        try {
            
             $validator = Validator::make($request->all(), [
                'typeremind' => 'required',
                'user_id' => 'required',
                'blood_sugar' => 'required',
                'blood_sugar_B_meal' => 'required',
                'prn_status' => 'required',
                'duration' => 'required',
                'frequency_intake' => 'required',
                'remind_time' => 'required',
            ]);
            
              if ($validator->fails()) {
                  
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                
            } else {
            
               	$current_user = auth('customer-api')->user();
                $Remindbloodsugar = ReminderDetails::where('user_id', $current_user->id)->where('type_id', 2)->first();
           	
           	 if($Remindbloodsugar != null ){
           	     $Reminderbloodsugar= $this->getupdatebloodsugar($request->all(),$Remindbloodsugar->id);
           	 }else{
           	  $Reminderbloodsugar= $this->getStorebloodsugar($request->all());
           	 }

           	  
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $Reminderbloodsugar;

                
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
    
        public function addweight(Request $request)
    {
        try {
            
             $validator = Validator::make($request->all(), [
                'typeremind' => 'required',
                'user_id' => 'required',
                'weight' => 'required',
                'prn_status' => 'required',
                'duration' => 'required',
                'frequency_intake' => 'required',
                'remind_time' => 'required',
            ]);
            
              if ($validator->fails()) {
                  
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                
            } else {
            
               	$current_user = auth('customer-api')->user();
                $Remindweight = ReminderDetails::where('user_id', $current_user->id)->where('type_id', 2)->first();
           	
           	 if($Remindweight != null ){
           	     $Reminderweight= $this->getupdateweight($request->all(),$Remindweight->id);
           	 }else{
           	  $Reminderweight= $this->getStoreweight($request->all());
           	 }

           	  
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $Reminderweight;

                
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
    
    
       public function addheight(Request $request)
    {
        try {
            
             $validator = Validator::make($request->all(), [
                'typeremind' => 'required',
                'user_id' => 'required',
                'height' => 'required',
                'prn_status' => 'required',
                'duration' => 'required',
                'frequency_intake' => 'required',
                'remind_time' => 'required',
            ]);
            
              if ($validator->fails()) {
                  
                $statusCode = 200;
                $response["status"] = -2;
                $response['message'] = Helper::ArrayToString($validator->errors()->all());
                
            } else {
            
               	$current_user = auth('customer-api')->user();
                $Remindheight = ReminderDetails::where('user_id', $current_user->id)->where('type_id', 2)->first();
           	
           	 if($Remindheight != null ){
           	     $Reminderheight= $this->getupdateheight($request->all(),$Remindheight->id);
           	 }else{
           	  $Reminderheight= $this->getStoreheight($request->all());
           	 }

           	  
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $Reminderheight;

                
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


}
