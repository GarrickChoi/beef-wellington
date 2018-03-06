<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use App\User;
use App\Role;
use App\Permission;


class CheckPermission
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
       /*$permission=Route::currentRouteName();
        $user=$request->user();
        if(!$user->hasRole('super_admin')){
            if(!$user->can($permission)){
                abort(403, '您没有权限访问，如需要请联系超级管理员.');
            }
        }*/

        return $next($request);
    }
}
