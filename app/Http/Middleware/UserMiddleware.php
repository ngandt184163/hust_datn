<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::guard('cus')->check()) {
            return redirect()->route('get.login')->with('no', 'vui long dang nhap');;

        }elseif(Auth::guard('cus')->user()->status === 0){
            Auth::guard('cus')->logout();
            return redirect()->route('get.login')->with('no', 'tai khoan cua ban chua duoc kich hoat');
        }
        return $next($request);
    }
}
