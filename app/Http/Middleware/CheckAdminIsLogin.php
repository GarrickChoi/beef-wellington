<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminIsLogin
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
        
        
        ///判断SESSION
        if (empty($_SESSION['adminInfo'])) {
            
            
            return redirect('adminlogin')->with('msg', '请登录');

        }

        return $next($request);
    }

}
