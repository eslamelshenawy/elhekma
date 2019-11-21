<?php

namespace App\Http\Middleware;
use App\Http\Helpers\ServiceResponseFailure;
use Closure;
use Auth;


class CheckActivationMobile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('customer-api')->user();
        if($user && $user->verified == 0){
            $resp = new ServiceResponseFailure();
            $resp->status = 0;
            if (isset($request->lang_id ) && $request->lang_id == 1) {
                $resp->message = 'Please confirm you email';
            } else {
                $resp->message = 'من فضلك قم بتفعيل حسابك';
            }
            return response()->json($resp, 200);
        }
        return $next($request);
    }
}
