<?php

namespace App\Http\Middleware;

use Closure;

class CheckHomeUserIsLogin
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
        if(!session('homeUser')) {

            return redirect('home/login')->with('msg', '请先登录');
        }
        
        return $next($request);
    }
}
