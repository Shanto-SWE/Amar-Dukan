<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class userlogincheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('user')){
            return $next($request);
        }else{
            return redirect()->route('user.loginwithemail')->withErrors(['message'=>'Plese Login First!']);;
        }
    }
}
