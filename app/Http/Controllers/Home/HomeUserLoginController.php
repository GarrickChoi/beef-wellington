<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class HomeUserLoginController extends Controller
{
	// 显示登录页
    public function login()
    {
    	return view('Home.home.login');
    }

    // 处理登录
    public function doLogin(Request $request)
    {
    	// 接收数据
    	/*$info = $request->input('info');
    	$user_pwd = explode('-', $info);*/
    	$name = $request->input('username');
        $pass = $request->input('password');
    	$remember = $request->input('remember');

    	// 先查询数据库用户名是否存在和状态
    	$userInfo = DB::table('shop_home_user')
    				->select(['id', 'status', 'pwd'])
    				->where('username', $name)
    				->orwhere('phone', $name)
    				->orwhere('email', $name)
    				->first();	

    	// 判断用户是否存在
     	if(!$userInfo) {

    		return response()->json(['msg' => '用户不存在,请重新输入']);
    	} else {

    		// 先拿出用户的id 下面代码要用 作为密码输入错误的缓存的键 
    		$userId = $userInfo->id;
    	}

    	// 判断用户有没有被禁用
    	if($userInfo->status != 1) {

    		return response()->json(['msg' => '您的账户已被禁用,请稍后再试']);
    	}


    	// 判断用户是否是密码连续错误5次 
    	if(Redis::get($userId.'dis')) {

    		return response()->json(['msg' => '您的账户密码连续5次输错,请20分钟后再登录']);
    	}

    	// 查询出用户在数据库的密码(数据库密码已哈希加密)
    	/*$userPwd = DB::table('shop_home_user')
                    ->select('pwd')
    				->where([['username', $name]])
    				->orwhere([['phone', $name]])
    				->orwhere([['email', $name]])
    				->first();*/

        // 用Hash::check判断用户信息与密码是否匹配
        $userPass = Hash::check($pass, $userInfo->pwd);            

    	// 判断用户是否输错密码 输入错误了走进来
    	if(!$userPass) { 

    		//判断有没有记录错误的缓存键
    		if(Redis::get($userId.':wrongtime')) {
    			
	    		// 判断输入错误次数达到5次时,redis禁用该用户20分钟
	    		if (Redis::get($userId.':wrongtime') >= 5) {

	    			// 设置一个禁用缓存键,有效期为20min 
	    			Redis::setex($userId.'dis', 1200, 'aa');

	    			return response()->json(['msg' => '您的账户密码连续5次输错,请20分钟后再登录']);

	    		} else {

					// 有记录错误的缓存键则每次输错加一
		    		Redis::incr($userId.':wrongtime');
	    			return response()->json(['msg' => '用户名或密码错误' ]);
	    		}

    		} else {

	    		// 没有记录错误的键则设置一个输入错误次数缓存键,拿用户名ID来区分
	    		Redis::setex($userId.':wrongtime', 3600, 1);

    			return response()->json(['msg' => '用户名或密码错误' ]);	
    		}
    	}

        // 如果密码匹配
    	if ($userPass) {

            // 查数据库用户信息去登录
            $userData = DB::table('shop_home_user')
                        -> select([
                            'id', 'username',
                            'phone', 'email', 
                            'status', 'role', 
                            'sex', 'pic',
                            'age', 'create_time'
                             ])
                        ->where('id', $userInfo->id)
                        ->first();

        	// 若成功登陆,删除redis禁用键、记录错误键
        	Redis::del($userId.'wrongtime');
        	Redis::del($userId.'dis');

        	// 把用户信息存放到session
        	session(['homeUser' => $userData]);

            //登录之后将购物车的数据存到redis里面(gyx)
            $shopcar = $request->session()->get('shopcar');
            if ($shopcar) {

                //遍历购物车
                $uid = session('homeUser')->id;

                foreach ($shopcar  as $gid => $goodInfo) {

                    $cartHashKey = 'cart:data:'.$uid.':'.$gid;//hash键存法:商品id拼接用户id

                    $cartIdsKey = 'cart:ids:data:'.$uid;//集合存法:用户id

                    //看是否有这个商品的hash键
                    if (!Redis::exists($cartHashKey)) {

                        //存进集合里
                        Redis::sAdd($cartIdsKey, $gid);

                        //用hash存商品的数据
                        Redis::hMset($cartHashKey, [

                            'id' => $goodInfo->id,                   
                            'pic' => $goodInfo->pic,
                            'desc' => $goodInfo->desc,
                            'name' => $goodInfo->name,
                            'store' => $goodInfo->store,
                            'price' => $goodInfo->price,
                            'num' => $num,
                            ]);
                    } else {

                        //这个是有hash这个键的
                        Redis::hIncrBy($cartHashKey, 'num', $goodInfo->num);
                    }
                }
            }
            //删除session的数据
            $request->session()->forget('shopcar');

            // 如果接收到remember,说明用户点了记住密码键,则把用户信息存cookie记住7天
            /*if($remember == 'remember') {

                $res = Cookie::make('homeUser', $userData, time() + 3600*24*7);
            }*/
       	
        	return response()->json([
        		'code' => 1200,
        		'msg' => '登陆成功'
        		]);    	
        	//return redirect('home')->with('msg', '登陆成功');	

    	}
    }
}



