<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckActivation
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
        $user = auth('customer')->user();
        if($user && $user->verified == 0 ){
            if( app()->getLocale() == "en"){
                Session::flash("registermessage", "Please confirm you email !");
            }else{
                Session::flash("registermessage", "من فضلك قم بنفعيل حسابك !");
            }
            return redirect()->route('home');
            }
        return $next($request);
    }
}
