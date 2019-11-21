<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use URL;

class Prescription extends Model
{
    use SoftDeletes;

    protected $table = 'prescription';

    const STATUS_PENDING = 0;
    const STATUS_ORDERED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_CANCELLED = 3;

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }

    public function order()
    {
        return $this->hasOne(Orders::class, 'prescription_id', 'id');
    }

    public function govern()
    {
        return $this->belongsTo(governs::class, 'govern_id', 'id');
    }

    public function place()
    {
        return $this->belongsTo(place::class, 'place_id', 'id');
    }


    public static function create($data)
    {
        $user = customer::user();
        if(!$user){
            $user = customer::user(true);
        }
        $user->firstLastName($data['full_name']);

        $prescription = new self();
        $prescription->status = self::STATUS_PENDING;
        $prescription->customer_id = $user->id;
        $prescription->first_name = $user->first_name;
        $prescription->last_name = $user->last_name;
        $prescription->address = $data['address'];
        $prescription->email = $data['email'];
        $prescription->phone_number = $data['phone'];
        $prescription->image = $data['image'];
        $prescription->govern_id = $data['govern'];
        $prescription->place_id = $data['place'];
        $prescription->save();
        return $prescription;
    }


    public function getStatus(){
        $status = '';
        if(\App::isLocale('en')) {
            switch ($this->status){
                case self::STATUS_PENDING:
                    $status = 'Pending';
                    break;
                case self::STATUS_ORDERED:
                    $status = 'Ordered';
                    break;
                case self::STATUS_REJECTED:
                    $status = 'Rejected';
                    break;
                case self::STATUS_CANCELLED:
                    $status = 'Cancelled';
                    break;
            }
        }else {
            switch ($this->status){
                case self::STATUS_PENDING:
                    $status = 'جارية';
                    break;
                case self::STATUS_ORDERED:
                    $status = 'تم الطلب';
                    break;
                case self::STATUS_REJECTED:
                    $status = 'تم الرفض';
                    break;
                case self::STATUS_CANCELLED:
                    $status = 'تم الإلغاء';
                    break;
            }
        }

        return $status;
    }

    public function formatObject($lang_id){
        if($lang_id == 1){
            \App::setLocale('en');
        }else{
            \App::setLocale('ar');
        }
        $obj = new \stdClass();
        $obj->id = $this->id;
        $obj->image = urldecode(URL::to('/uploads',$this->image));
        $obj->status = $this->getStatus();
        $obj->created_at = $this->created_at->format('d-m-Y H:i');
        return $obj;
    }



}
