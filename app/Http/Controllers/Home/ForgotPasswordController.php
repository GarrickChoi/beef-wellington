<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Lixunguan\Yuntongxun\Sdk as Yuntongxun;
use Illuminate\Support\Facades\Redis;

// 找回密码类
class ForgotPasswordController extends Controller
{
    // 显示验证验证绑定手机页面
    public function showBindPhone()
    {
    	return view('Home.home.bindphone');
    }

    // 判断手机号
    public function checkPhone(Request $request)
    {
    	/*// 防止非法操作
    	if(!$request->ajax()) {

    		return redirect('');
    	}*/

    	// 接收输入的手机号
    	$phone = $request->input('phone');

    	// 判断手机号是否为空
    	if(!$phone) {

    		return response()->json([
    		'msg' => '*请输入手机号~',
    		'code' => '411',
    		]);
    	}

    	// 判断手机号是否合法
    	$bool = preg_match('/^1[345789]\d{9}$/', $phone);
    	if(!$bool) {

    		return response()->json([
    		'msg' => '*手机号格式错误',
    		'code' => '412',
    		]);
    	}

    	// 判断手机号是否存在数据库
    	$status = DB::table('shop_home_user')
    					->select('status')
    					->where('phone', $phone)
    					->first();

    	if(!$status) {

    		return response()->json([
    		'msg' => '*该手机号未注册,请梢后再试',
    		'code' => '413',
    		]);
    	} 

    	if($status->status == 2) {

    		return response()->json([

    		'msg' => '*该用户已被禁用,请稍后再试',
    		'code' => '440',
    		]);
    	} else {

    		return response()->json([   		
    		'code' => '236',
    		]);
    	}


    }

    public function getCaptcha(Request $request)
    {
    	// 接收到手机号
    	$phone = $request->input('phone');
    	/*return response()->json([
    		'msg' => $phone,
    		
    		]);*/
		if(!$phone) {

            return false;
        }
    	
    	// 在容联云里是使用‘紫光阁测试’这个应用
    	// $sdk = new Yuntongxun('紫光阁测试的APP ID', '主账户ACCOUNT SID', '主账户AUTH TOKEN');
		$sdk = new Yuntongxun('8a216da86150f04301615c683aa20324', '8a216da86150f0430161549da0ac00ec', 'bb851489d9204f62af3d54464f453552');

		// 自定义手机验证码
		$str = '01234567890123456789';
		// str_shuffle()随机打乱字符串  substr()截取字符串
		$phone_code = substr(str_shuffle($str), 2, 6);
		
		// 将手机号与验证码存放到redis,2分钟有效点击注册时用于匹配,考虑到延迟,多存20秒      
		Redis::setex('rphone:'.$phone, 140, $phone);
		Redis::setex('rphone_code:'.$phone_code, 140, $phone_code);
		

		// 发送验证码到手机
		$sms = $sdk->sendTemplateSMS($phone, array($phone_code), 1); 

		if($sms) {

			return response()->json([
    		'msg' => '已发送验证码,2分钟内输入有效,请在手机查看',
    		'code' => '212',
    		]);
		}

		if(!$sms) {

			return response()->json([
    		'msg' => '*验证码发送失败,请稍后再试',
    		'code' => '414',
    		]);
		} 

    }

    // 验证手机号与短信验证码
    public function checkCaptcha(Request $request)
    {
    	// 接收到手机与验证码
    	$phone = $request->input('phone');
    	$captcha = $request->input('captcha');

    	// 没有接收到
    	/*if(!$phone || !$captcha) {

    		return response()->json([
    		'code' => '416',
    		]);
    	}*/

    	// 拿到redis中找回密码的手机号与短信验证码
    	$rphone = Redis::get('rphone:'.$phone);
    	$rcaptcha = Redis::get('rphone_code:'.$captcha);

    	// 判断输入的手机与验证码与存在redis的是都一样
    	if($phone == $rphone && $captcha == $rcaptcha) {

    		// 将要修改密码的手机号存到redis,设置过期时间
    		Redis::setex('resetAount:'.$phone, 1200, $phone);

    		// 如果一样则跳到重置密码页面
    		return response()->json([
    			'msg' => '验证通过',
    			'code' => '240'
    			]);

    	} else {

    		// 如果不一样, 返回提示
    		return response()->json([
    		'msg' => '*验证码过期或输入错误,请重试',
    		'code' => '415',
    		]);
    	}
    }


    // 重置密码页面
    public function showResetPass($phone)
    {
   		//$phone = $request->input('phone');
   		
    	return view('Home.home.repassword', compact('phone'));
    	
    }

    public function savePass(Request $request)
    {
    	// 接收数据
    	$phone = $request->input('phone');
    	$pass = password_hash($request->input('password'), PASSWORD_DEFAULT);

    	// 去数据库修改密码
    	$row = DB::table('shop_home_user')
    				->where('phone', $phone)
    				->update(['pwd' => $pass]);

    	// 修改成功
    	if($row) {

    		return response()->json([
    		'msg' => '修改密码成功',
    		'code' => '222',
    		]);
    	} else {

    		// 修改失败
    		return response()->json([
    		'msg' => '修改密码失败,请稍后再试',
    		'code' => '456',
    		]);

    	}

    }



}
