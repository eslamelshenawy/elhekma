<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\customer;
use App\Http\Helpers\ServiceResponse;
use App\Http\Helpers\ServiceResponseFailure;
use Mail;
use Validator;
use Session;
use Illuminate\Support\Facades\Input;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use SendsPasswordResetEmails;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest');
        $this->lang = $request->input('lang_id') ? 2 : 1;
    }

    public function sendResetPasswordEmailWeb(Request $request){
        // Validation
        $input = [
            'email'   => $request->input('email'),
        ];
        $rules = [
            'email'   => 'required|email',
        ];
        $messages = [
            'required' => 'The email field is required',
            'email'  => 'The email must be a valid email address'
        ];
        $messages = [];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            $message = implode(' ', $validator->errors()->all());
            logger($message);
            return back()->withInput(Input::all())->with("message", $message);

        }
        $customer = customer::where('email', $request->input('email'))->first();
        if($customer == null){
            logger('Not User');
            return back()->withInput(Input::all())->with("message", "this email not match with any account");
        }
         $email_user = $customer;

        $reset_token = $this->broker()->createToken($email_user);
        $data = ['reset_token' => $reset_token, 'user' => $email_user];
        try{

            Mail::send(['html'=>'auth.passwords.linkEmail'], $data, function($message) use ($email_user) {
                $message
                    ->to($email_user->email, $email_user->full_name)
                    ->subject('H&S Password Reset Link');
                $message
                    ->from('hs-test@pbc-egy.com','H&S');
            });


        }catch(\Exception $e){
            logger($e->getMessage());
            return back()->withInput(Input::all())->with("message", "Server Error");
        }


        if( app()->getLocale() == "en"){
            Session::flash("registermessage", "Password Reset Instructions Sent Successfully, ");
        }else{
            Session::flash("registermessage", "تم ارسال بتعليمات اعاده كلمه السر, ");
        }
        return redirect()->back();
    }

    public function sendResetPasswordMobile(Request $request){
        // Validation
        $input = [
            'email'   => $request->input('email'),
        ];
        $rules = [
            'email'   => 'required|email',
        ];
        $messages = [
            'required' => 'The email field is required',
            'email'  => 'The email must be a valid email address'
        ];
        $validator = \Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            $resp = new ServiceResponseFailure;
            // $resp->message = 'Errors occured while sending the reset code';
            $resp->status = 0;
            $errors = $validator->errors();
            foreach ($errors->get('email') as $count => $message) {
                // If first message
                if (!$count) {
                    $resp->message .= $message.'.';
                }
                // Else
                else {
                    $resp->message .= ' '.$message.'.';
                }
            }
            return response()->json($resp, 200);
        }

        $customer = customer::where('email', $request->input('email'))->first();

        if (!$customer) {

                $resp = new ServiceResponseFailure;
                // $resp->message = 'Email not found';
                $resp->status = 0;
                $resp->message = trans('passwords.user');
                return response()->json($resp, 400);
        } else {
            $email_user = $customer;
        }

        $reset_token = $this->broker()->createToken($email_user);
        $data = ['reset_token' => $reset_token, 'user' => $email_user];
        try{

                Mail::send(['html'=>'auth.passwords.linkEmail'], $data, function($message) use ($email_user) {
                    $message
                        ->to($email_user->email, $email_user->full_name)
                        ->subject('H&S Password Reset Link');
                    $message
                        ->from('hs-test@pbc-egy.com','H&S');
                });


        }catch(\Exception $e){
            logger($e->getMessage());
        }


        $resp = new ServiceResponseFailure();
        if ($this->lang == 2) {
        $resp->message = 'تم ارسال بتعليمات اعاده كلمه السر';
        }else{
        $resp->message = 'Password Reset Instructions Sent Successfully';
        }

        $resp->status = 1;
        // $resp->innerdata = '';

        return response()->json($resp, 200);
    }
}
