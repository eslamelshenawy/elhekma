<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\customer;
use App\Models\ReminderDetails;
use App\Models\ReminderWater;
use App\Models\DeliveryAddresses;
use App\Models\ReminderFood;
use App\Models\ReminderWaterSetting;

class ApiController extends Controller
{
    
     protected function getStoreremind($obj)
    {
        $response = new ReminderDetails;
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->title = strval($obj['title']);
        $response->uint = strval($obj['unit']);
        $response->inventory_q = intval($obj['inventory_q']);
        $response->prn_status = intval($obj['prn_status']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->duration = strval($obj['duration']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
         $response->save();
        return $response;

    }
    
    protected function getupdateremind($obj,$id)
    {
        $response =  ReminderDetails::find($id);
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->title = strval($obj['title']);
        $response->uint = strval($obj['unit']);
        $response->inventory_q = intval($obj['inventory_q']);
        $response->prn_status = intval($obj['prn_status']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->duration = strval($obj['duration']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
         $response->save();
        return $response;

    }
    
     protected function getStoresetting($obj)
    {
       
        $response = new ReminderWaterSetting;
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->height = strval($obj['height']);
        $response->weight = strval($obj['weight']);
        $response->sleep_from = strval($obj['sleep_from']);
        $response->sleep_to = strval($obj['sleep_to']);
        $response->remind_every = strval($obj['remind_every']);
        $response->notification_status = intval($obj['notification_status']);
         $response->save();
        return $response;

    }
    
      protected function getStoreReminderWater($obj)
    {
        $response = new ReminderWater;
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->water_take = strval($obj['water_take']);
         $response->save();
        return $response;

    }
    
    
      protected function getStoreReminderfood($obj)
    {
        $response = new ReminderFood;
        $response->meal_id = intval($obj['meal_id']);
        $response->user_id = intval($obj['user_id']);
         $response->save();
        return $response;

    }
    
       protected function getStoreReminderexercise($obj)
    {
        $response = new ReminderDetails;
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->remind_exercise_status = intval($obj['exercise_status']);
        $response->remind_time_exercise = intval($obj['time_exercise']);
        $response->user_reminder = strval($obj['user_reminder']);
         $response->save();
        return $response;

    }

        protected function getupdateReminderexercise($obj,$id)
    {
        $response =  ReminderDetails::find($id);
        $response->remind_exercise_status = intval($obj['exercise_status']);
        $response->remind_time_exercise = intval($obj['time_exercise']);
        $response->user_reminder = strval($obj['user_reminder']);
         $response->save();
        $response =  ReminderDetails::select('remind_exercise_status','user_reminder','remind_time_exercise')->find($id);

        return $response;
    }
    

     protected function getupdatesetting($obj,$id)
    {
       
        $response =  ReminderWaterSetting::find($id);
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->height = strval($obj['height']);
        $response->weight = strval($obj['weight']);
        $response->sleep_from = strval($obj['sleep_from']);
        $response->sleep_to = strval($obj['sleep_to']);
        $response->remind_every = strval($obj['remind_every']);
        $response->notification_status = intval($obj['notification_status']);
         $response->save();
        return $response;

    }

       protected function getStorebloodpressure($obj)
    {
        $response = new ReminderDetails;
        
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->prn_status = intval($obj['prn_status']);
        $response->blood_pressure = strval($obj['blood_pressure']);
        $response->duration = strval($obj['duration']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
        $response->save();
        
        return $response;

    }
    
    
     protected function getupdatebloodpressure($obj,$id)
    {
        
        $response =  ReminderDetails::find($id);
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->prn_status = intval($obj['prn_status']);
        $response->blood_pressure = strval($obj['blood_pressure']);
        $response->duration = strval($obj['duration']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
        $response->save();
        
        $response =  ReminderDetails::select('blood_pressure','duration','user_reminder','frequency_intake','remind_time','type_id','id')->find($id);

        return $response;

    }


   protected function getStoreheart($obj)
    {
        $response = new ReminderDetails;
        
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->prn_status = intval($obj['prn_status']);
        $response->heart_rate = strval($obj['heart_rate']);
        $response->duration = strval($obj['duration']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
        $response->save();
        
        return $response;

    }
    
    
       protected function getupdateheart($obj,$id)
    {
        
        $response =  ReminderDetails::find($id);
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->prn_status = intval($obj['prn_status']);
        $response->heart_rate = strval($obj['heart_rate']);
        $response->duration = strval($obj['duration']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
        $response->save();
        
        $response =  ReminderDetails::select('heart_rate','duration','user_reminder','frequency_intake','remind_time','type_id','id')->find($id);

        return $response;

    }


  protected function getStorebloodsugar($obj)
    {
        $response = new ReminderDetails;
        
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->prn_status = intval($obj['prn_status']);
        $response->blood_sugar = strval($obj['blood_sugar']);
        $response->blood_sugar_B_meal = strval($obj['blood_sugar_B_meal']);
        $response->duration = strval($obj['duration']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
        $response->save();
        
        return $response;

    }
    
    
       protected function getupdatebloodsugar($obj,$id)
    {
        
        $response =  ReminderDetails::find($id);
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->prn_status = intval($obj['prn_status']);
        $response->blood_sugar = strval($obj['blood_sugar']);
        $response->blood_sugar_B_meal = strval($obj['blood_sugar_B_meal']);
        $response->duration = strval($obj['duration']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
        $response->save();
        
        $response =  ReminderDetails::select('blood_sugar','blood_sugar_B_meal','user_reminder','duration','frequency_intake','remind_time','type_id','id')->find($id);

        return $response;

    }

 protected function getStoreweight($obj)
    {
        $response = new ReminderDetails;
        
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->prn_status = intval($obj['prn_status']);
        $response->weight = strval($obj['weight']);
        $response->duration = strval($obj['duration']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
        $response->save();
        
        return $response;

    }
    
    
       protected function getupdateweight($obj,$id)
    {
        
        $response =  ReminderDetails::find($id);
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->prn_status = intval($obj['prn_status']);
        $response->weight = strval($obj['weight']);
        $response->duration = strval($obj['duration']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
        $response->save();
        
        $response =  ReminderDetails::select('weight','duration','user_reminder','frequency_intake','remind_time','type_id','id')->find($id);

        return $response;

    }
    
     protected function getStoreheight($obj)
    {
        $response = new ReminderDetails;
        
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->prn_status = intval($obj['prn_status']);
        $response->height = strval($obj['height']);
        $response->duration = strval($obj['duration']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
        $response->save();
        
        return $response;

    }
    
    
       protected function getupdateheight($obj,$id)
    {
        
        $response =  ReminderDetails::find($id);
        $response->type_id = intval($obj['typeremind']);
        $response->user_id = intval($obj['user_id']);
        $response->prn_status = intval($obj['prn_status']);
        $response->height = strval($obj['height']);
        $response->duration = strval($obj['duration']);
        $response->user_reminder = strval($obj['user_reminder']);
        $response->frequency_intake = strval($obj['frequency_intake']);
        $response->remind_time = strval($obj['remind_time']);
        $response->save();
        
        $response =  ReminderDetails::select('height','duration','user_reminder','frequency_intake','remind_time','type_id','id')->find($id);

        return $response;

    }

    
    protected function getCustomerObject($obj, $lang)
    {

        if ($lang == 2 && isset($obj->place['name_ar'])) {
            $name = 'name_ar';
        } else {
            $name = 'name_en';
        }
        
        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->full_name = strval($obj->full_name);
        $response->email = strval($obj->email);
        $response->phone_number = strval($obj->phone_number);
        $address = array();
        $addresslist = DeliveryAddresses::where('customer_id',intval($obj->id))->select('address','id')->get();
        foreach($addresslist as $add){
            array_push($address,$add);
        }
        if(empty($address)){
            $data['customer_id'] = intval($obj->id);
            $data['full_name'] = strval($obj->full_name);
            $data['address'] = strval($obj->address);
            $data['email'] = strval($obj->email);
            $data['phone'] = intval($obj->phone_number);
            $data['govern'] = intval($obj->state_id);
            $data['place'] = intval($obj->city_id);
            $address = DeliveryAddresses::createFromData($data, True);
            $addresslist = DeliveryAddresses::where('customer_id',intval($obj->id))->select('address','id')->get();
        }
        $response->addresslist = $addresslist;
        $response->photo = '';
        if ($obj->image) {
            $response->photo = url('uploads/' . strval($obj->image));
        } else {
            $response->photo = '';
        }
        $response->state_id = intval($obj->state_id);
        $response->city_id = intval($obj->city_id);
        $response->city_name = strval($obj->place[$name]);
        $response->api_token = strval($obj->api_token);
        $response->password = '';
        $response->verified = intval($obj->verified);

        return $response;

    }

    protected function getDepartmentObject($obj, $lang)
    {

        if ($lang == 2 && isset($obj->name_ar)) {
            $name = 'name_ar';
        } else {
            $name = 'name_en';
        }

        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->title = strval($obj->$name);
        return $response;
    }

//{
//     "status": 1,
//     "message": "data retrieved",
//     "product": {
//         "id":1,
//     "title":"title",
//     "photo":"path/to/photo",
//     "discription":"",
//     "price":0.00,
//     "rate":3.4,
//     "availability":1,
//     "category_id":1,
//     "category_name":"",
//     "pack_detials":"",
//     "target_audience":"",
//     "slide": ["link","link"],
//     "effective_material":["tit1","title2"],
//     "tags":["tag2","tag3"]
//     }
// }
//
    protected function getProductFavorite($obj, $lang)
    {
        if ($lang == 2 && isset($obj->name_ar)) {
            $name = 'name_ar';
        } else {
            $name = 'name_en';
        }
        $current_user = auth('customer-api')->user();
        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->title = strval($obj->$name);
        if (isset($obj->photo)) {
            $response->photo = url('uploads/' . strval($obj->photo));
        } else {
            $response->photo = '';
        }

        $response->price = doubleval($obj->price);
        $response->price_before = doubleval($obj->price_before);
        $response->is_offer = intval($obj->is_offer);        
        $response->is_fav = $this->is_fav($current_user->id,$obj->id) ? 1 : 0;
        $response->is_cart = $this->is_cart($obj->id);
        $response->rate = doubleval($obj->rating);
        return $response;
    }

    
    protected function getProductsObject($obj, $lang = 1)
    {
        if ($lang == 2 && isset($obj->name_ar)) {
            $name = 'name_ar';
            if (isset($obj->desc_ar)) {
                $description = 'desc_ar';
            } else {
                $description = 'desc_en';
            }
        } else {
            $name = 'name_en';
            $description = 'desc_en';
        }
        $availability = 0;
        foreach ($obj->productdetails()->get() as $c) {
            $availability = $availability + intval($c->quantity);
        };
        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->title = strval($obj->$name);
        
        if (isset($obj->photo)) {
            $response->photo = url('uploads/' . strval($obj->photo));
        } else {
            $response->photo = '';
        }
        $response->price_before = doubleval($obj->price_before);
        $response->is_offer = intval($obj->is_offer);       
        $response->discription = strval($obj->$description);
        $response->price = doubleval($obj->price);
        $response->rate = doubleval($obj->rating);
        $response->availability = intval($availability);
        $response->category_id = strval($obj->category_id);
        $response->category_name = strval($obj->category->$name);
        $response->pack_detials = strval($obj->pack_details);
        $response->target_audience = strval($obj->target_audience->$name);
        $response->slide = $this->get_product_images($obj);//->product_images;
        $response->effective_material = $this->get_product_effective_material($obj, $lang);
        $response->desc = $this->get_product_details($obj, $lang);
        $response->tags = $this->get_product_tag($obj, $lang);
                

        return $response;

    }
    protected function getSearchProductObj($obj, $customer_id,$lang)
    {
        if ($lang == 2 && isset($obj->name_ar)) {
            $name = 'name_ar';
            if (isset($obj->desc_ar)) {
                $description = 'desc_ar';
            } else {
                $description = 'desc_en';
            }
        } else {
            $name = 'name_en';
            $description = 'desc_en';
        }
        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->title = strval($obj->$name);
        if (isset($obj->photo)) {
            $response->photo = url('uploads/' . strval($obj->photo));
        } else {
            $response->photo = '';
        }
        // $response->photo = url('uploads/' . strval($obj->photo));
        $response->description = strval($obj->discription);
        $response->price = doubleval($obj->price);
        $response->is_fav = $this->is_fav($customer_id,$obj->id) ? 1 : 0;
        $response->is_cart = $this->is_cart($obj->id);//0;//intval($obj->is_offer)
     
        return $response;
    }

    protected function is_fav($customer_id,$product_id)
    {
        $is_fav = Favorite::where('customer_id',$customer_id)->where('product_id',$product_id)->exists();
        return $is_fav;
    }
    public function is_cart($product_id)
    {
        $is_cart = customer::getCart(true);
        
        foreach ($is_cart as $cart) {
            
            if ($cart['product_id'] == $product_id) {
                return 1;
            }
        }
              return 0;
            
    }
    protected function getStoreObj($obj, $lang)
    {
        if ($lang == 2 && isset($obj->name_ar)) {
            $name = 'name_ar';
        } else {
            $name = 'name_en';
        }
        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->title = strval($obj->$name);
        $response->address = strval($obj->address);
        $response->phone = strval($obj->phone);
        $response->email = strval($obj->email);
        return $response;

    }


    
    protected function get_store_contact($obj)
    {
        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->address = strval($obj->address);
        $response->phone = strval($obj->phone);
        $response->email = strval($obj->email);
        $response->website = strval($obj->website);
        return $response;
    }

    public function get_product_tag($product, $lang)
    {
        $tags = [];
        if ($lang == 2) {
            $name = 'name_ar';
        } else {
            $name = 'name_en';
        }
        if ($product->pharma_tag1->$name && !empty($product->pharma_tag1->$name)) {
            $tags[] = $product->pharma_tag1->$name;
        } else {
            $tags[] = $product->pharma_tag1->name_en;
        }
        if ($product->pharma_tag2->$name && !empty($product->pharma_tag1->$name)) {
            $tags[] = $product->pharma_tag2->$name;
        } else {
            $tags[] = $product->pharma_tag2->name_en;
        }
        if ($product->pharma_tag3->$name && !empty($product->pharma_tag1->$name)) {
            $tags[] = $product->pharma_tag3->$name;
        } else {
            $tags[] = $product->pharma_tag3->name_en;
        }

        return $tags;
    }

    public function get_product_images($product)
    {

       if(!$product->product_images == null){
           if(!empty($product->product_images->image)){
              foreach ($product->product_images->image as $image) {
            $images[] = url('uploads/' . strval($image));

             }
            }else{
             $images=[];   
            }
       }else{
           
           $images=[];
       }
        
        return $images;
    }
    
        public function get_product_details($product, $lang)
    {
        $product_desc = [];
        
       
            if ($lang == 2 && isset($product->desc_ar)) {
                $desc = 'desc_ar';
            } else {
                $desc = 'desc_en';
            }

        return $product->$desc;
    }


    public function get_product_effective_material($product, $lang)
    {
        $effective_material = [];
        foreach ($product->product_effective_material()->get() as $effective_material) {
            if ($lang == 2 && isset($effective_material->name_ar)) {
                $name = 'name_ar';
            } else {
                $name = 'name_en';
            }
            $effective_material_tags[] = $effective_material->$name;
        }
        return $effective_material_tags;

    }

    protected function get_review_object($obj)
    {
        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->product_id = intval($obj->product_id);
        $response->customer_id = intval($obj->customer_id);
        $response->fullname = strval($obj->customer->full_name);
        if (isset($obj->photo)) {
            $response->user_photo = url('uploads/' . strval($obj->photo));
        } else {
            $response->user_photo = '';
        }
        $response->rate = doubleval($obj->rating);
        $response->review = strval($obj->review);
        $response->created_at = strval($obj->created_at);

        return $response;
    }

    protected function getMobileSliderObject($obj, $lang = 1)
    {
        if ($lang == 2 && isset($obj->title_ar)) {
            $title = 'title_ar';
        } else {
            $title = 'title';
        }
        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->title = strval($obj->$title);
        if (isset($obj->image)) {
            $response->photo = url('uploads/' . strval($obj->image));
        } else {
            $response->photo = '';
        }
        // $response->photo = url('uploads/' . strval($obj->image));
        $response->product_id = intval($obj->product_id);
        return $response;
    }

    protected function getHomeProductsObject($obj, $lang)
    {

        if ($lang == 2 && isset($obj->name_ar)) {
            $name = 'name_ar';
        } else {
            $name = 'name_en';
        }
        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->title = strval($obj->$name);
        if (isset($obj->photo)) {
            $response->photo = url('uploads/' . strval($obj->photo));
        } else {
            $response->photo = '';
        }
        // $response->photo = url('uploads/' . strval($obj->photo));
        $response->price_before = doubleval($obj->price_before);
        $response->price = doubleval($obj->price);
        $response->is_offer = intval($obj->is_offer);
        return $response;


    }

    protected function getStateObject($obj, $lang)
    {

        if ($lang == 2 && isset($obj->name_ar)) {
            $name = 'name_ar';
        } else {
            $name = 'name_en';
        }

        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->title = strval($obj->$name);
        return $response;
    }

    protected function getCityObject($obj, $lang)
    {

        if ($lang == 2 && isset($obj->name_ar)) {
            $name = 'name_ar';
        } else {
            $name = 'name_en';
        }

        $response = new \stdClass();
        $response->id = intval($obj->id);
        $response->title = strval($obj->$name);
        $response->state_id = intval($obj->govern['id']);

        return $response;
    }

    protected function getFaqObject($obj, $lang)
    {

        if ($lang == 2 && isset($obj->question_ar) && isset($obj->answer_ar)) {
            $question = 'question_ar';
            $answer = 'answer_ar';
        } else {
            $question = 'question';
            $answer = 'answer';
        }

        $response = new \stdClass();
        //    $response->id = intval($obj->id);
        $response->question = strval($obj->$question);
        $response->answer = strval($obj->$answer);

        return $response;
    }

    protected function getTargetAudinceObj($obj,$lang)
    {
        if ($lang == 2 && isset($obj->name_ar)) {
            $name = 'name_ar';
        } else {
            $name = 'name_en';
        }        
        $response = new \stdClass();
        $response->id = $obj->id;
        $response->title = $obj->$name;
        return $response;        
    }
    protected function getSpecialistObj($obj,$lang)
    {
        if ($lang == 2 && isset($obj->name_ar)) {
            $name = 'name_ar';
        } else {
            $name = 'name_en';
        }        
        $response = new \stdClass();
        $response->id = $obj->id;
        $response->title = $obj->$name;
        return $response;        
    }    
    protected function getPharmaceuticalFormObj($obj,$lang)
    {
        if ($lang == 2 && isset($obj->name_ar)) {
            $name = 'name_ar';
        } else {
            $name = 'name_en';
        }        
        $response = new \stdClass();
        $response->id = $obj->id;
        $response->title = $obj->$name;
        return $response;        
    }       

    protected function getSettingObject()
    {

        $response = new \stdClass();

        $response->about_link = url('/page/1');
        $response->terms_link = url('/page/2');
        $response->payment_link = url('/page/3');
        $response->shipping_link = url('/page/4');


        return $response;
    }
}









