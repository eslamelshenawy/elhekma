<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Transformers\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Helpers\ServiceResponse;
use App\Models\customer;
use Mail;
use App\Http\Helpers\ServiceResponseFailure;
use Config;

class ResetPasswordController extends Controller
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

    use ResetsPasswords;

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
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
        if ($request->wantsJson()) {
            if ($response == Password::PASSWORD_RESET) {
                $resp = new ServiceResponseFailure;
                // $resp->message = 'Password reset successfully';
                $resp->status = 1;
                $resp->message = trans('passwords.reset');
                return response()->json($resp, 200);
            } else {
                $resp = new ServiceResponseFailure;
                // $resp->message = 'Password reset error';
                $resp->status = 0;
                $resp->message = trans($response);
                return response()->json($resp, 202);
            }
        }
        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        // return $response == Password::PASSWORD_RESET
        // ? $this->sendResetResponse($response)
        // : $this->sendResetFailedResponse($request, $response);
    }

    public function showResetForm(Request $request)
    {
        return view('auth.passwords.linkReset')->with(
            ['token' => $request->token, 'email' => $request->email]
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetWeb(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.

        // Find a customer
        $customer = customer::where('email', $request->input('email'))->first();

        if ($customer) {
            Config::set("auth.defaults.passwords","customers");
            Config::set("auth.defaults.guard","customer");
        }
        // Resolves an instance of "Illuminate\Auth\Passwords\PasswordBrokerManager", which lets you pick which broker you wish to use
        if ($customer) {
            $passwordBroker = app('auth.password')->broker('customers');
        }


        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
        if ($request->wantsJson()) {
            if ($response == Password::PASSWORD_RESET) {
                return redirect()->route('resetPassword')->with('success', 'Password reset successfully');
            } else {
                return redirect()->route('resetPassword')->with('error', 'Error occured while reseting the password');
            }
        } else {
            if ($response == Password::PASSWORD_RESET) {
                return redirect()->route('resetPassword')->with('success', 'Password reset successfully');
            } else {
                return redirect()->route('resetPassword')->with('error', 'Error occured while reseting the password');
            }
        }


        return $response == Password::PASSWORD_RESET
        ? $this->sendResetResponse($response)
        : $this->sendResetFailedResponse($request, $response);
    }
}
