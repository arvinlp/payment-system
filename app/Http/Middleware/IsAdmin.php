<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
        if(Auth::check()){
            if(Auth::user()->type == 'staff'){
                return $next($request);
            }else{
                return redirect()->route(getPrefixLevel().'.dashboard')->with('error',__('دسترسی به این بخش برای کاربری شما مجاز نمی‌باشد.'));
            }
        }else{
            return redirect()->route('auth.login.pass');
        }
    }
}
