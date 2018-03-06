<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeUserLogoutController extends Controller
{
    // 处理前台用户注销
    public function doLogout(Request $request)
    {
    	// 删除session里面的用户信息
    	$request->session()->forget('homeUser');

    	// 跳转到登录页
    	return redirect('home/login');
    }
}
