<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Requests\Home\CheckHomeUserRegister;
use App\Http\Requests\Home\CheckHomeUserPasswordRegister;
use App\Http\Requests\Home\CheckHomeUserRepasswordRegister;
use App\Http\Requests\Home\CheckHomeUserPhoneRegister;
use Lixunguan\Yuntongxun\Sdk as Yuntongxun;
use Illuminate\Support\Facades\Redis;


class HomeUserRegisterController extends Controller
{
    // 显示注册页面
    public function register()
    {
    	return view('Home.home.register');
    }

    // 处理前台用户名注册
    public function doUsernameRegister(CheckHomeUserRegister $request)
    {
    	return response()->json(['msg' => '用户名可用']);
    }

    // 处理前台注册密码
   public function doPasswordRegister(CheckHomeUserPasswordRegister $request)
    {
    	return response()->json(['msg' => 'ok']);
    }

    // 处理前台注册再次输入密码
    public function doRepasswordRegister(CheckHomeUserRepasswordRegister $request)
    {
    	return response()->json(['msg' => 'ok']);
    }

    // 处理前台注册手机号
    public function doPhoneRegister(CheckHomeUserPhoneRegister $request)
    {
    	return response()->json([
    		'msg' => 'ok',
    		'code' => '123',
    		]);
    }

    // 处理前台获取验证码,接收到输入的手机号
    public function getPhoneYzm(Request $request)
    {
    	// 接收到手机号
    	$phone = $request->input('phone');
		if(!$phone) {

            return false;
        }
    	
    	// 在容联云里是使用‘紫光阁’这个应用
    	// $sdk = new Yuntongxun('紫光阁的APP ID', '主账户ACCOUNT SID', '主账户AUTH TOKEN');
		$sdk = new Yuntongxun('8a216da86150f043016154c65d0b0126', '8a216da86150f0430161549da0ac00ec', 'bb851489d9204f62af3d54464f453552');

		// 自定义手机验证码
		$str = '01234567890123456789';
		// str_shuffle()随机打乱字符串  substr()截取字符串
		$phone_code = substr(str_shuffle($str), 2, 6);

		// 将验证码存到session 想办法给session设置过期时间 不然就存redis
		//$request->session()->put('captcha', $phone_code);

		// 将手机号与验证码存放到redis,点击注册时用于匹配  
        // 用户收到信息提示2分钟有效,考虑延迟多给20秒
		Redis::setex('phone:'.$phone, 140, $phone);
		Redis::setex('phone_code:'.$phone_code, 140, $phone_code);
		

		// 发送验证码到手机
		$sms = $sdk->sendTemplateSMS($phone, array($phone_code), 1); 

		return response()->json([
    		'msg' => 'send message success',
    		]); 
    } 


    // 判断手机验证码与手机是否匹配 是匹配则注册成功 
    public function doRegister(Request $request)
    {
        // 接收数据 手机号和验证码
        $phone = $request->input('phone');
        $pyzm = $request->input('pyzm');
        $username = $request->input('username');
        $create_time = date('Y-m-d H:i:s', time());
        
        // 将接受到的密码加密
        $password = password_hash($request->input('password'), PASSWORD_DEFAULT);

        // 拿到存在redis的手机号和验证码 在getPhoneYzm方法存在了
        $rphone = Redis::get('phone:'.$phone);
        $ryzm = Redis::get('phone_code:'.$pyzm);

        // 判断输入的手机号与验证码是否一致 一致的话就将用户资料插入数据库
        if($phone == $rphone && $pyzm == $ryzm) {

            // 将用户数据查到数据库
            $res = DB::table('shop_home_user')->insert([

                    'username' => $username,
                    'pwd' => $password,
                    'phone' => $phone,
                    'create_time' => $create_time,
                ]);

            // 注册成功
            if ($res) {

                // 注册成功后把存在redis的手机和验证码删除
                Redis::delete('phone:'.$phone, 'phone_code:'.$pyzm);

                return response()->json([
                    'code' => 220,
                    'msg' => '注册成功',
                    ]);                
            }

            // 注册失败
            if(!$res) {

                return response()->json([
                    'code' => 230,
                    'msg' => '注册失败,请稍后再试',
                    ]); 
            }


        } else {

            return response()->json([
                'code' => 440,
                'msg'=> '验证码过期或输入错误',
                ]);
            
        }



    }


    // 处理注册
    /*public function doRegister(Request $request)
    {
    	return view('');
  	     
    }*/


}
