<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsClient
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
            return $next($request);
            // if(Auth::user()->type == 'cleint'){
            //     return $next($request);
            // }else{
            //     if(Auth::user()->type == 'staff'){
            //         return $next($request);
            //     }else{
            //         return redirect()->route(getPrefixLevel().'.dashboard')->with('error','دسترسی به بخش درخواستی غیر مجاز بوده به داشبورد منتقل شدید');
            //     }
            // }
        }else{
            return redirect()->route('auth.login.pass');
        }
    }
}
