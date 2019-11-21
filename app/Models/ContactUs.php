<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mail;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    public function sendInfoMail(){
        $data = ['user'=>$this];

        try{
            Mail::send(['html' => 'email.contact_us'], $data, function ($message) {
                $message
                    ->to( 'hs-test@pbc-egy.com', 'ContactUs Message')
                    ->subject('ContactUs message');
                $message
                    ->from('hs-test@pbc-egy.com','H&S');

            });
        }catch (\Exception $e){
            
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
        }
    }

}
