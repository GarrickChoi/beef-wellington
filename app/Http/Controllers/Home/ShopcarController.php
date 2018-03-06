<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Cookie\CookieJar;
use Illuminate\Support\Facades\Cookie;
use DB;
use Illuminate\Support\Facades\Redis;


class ShopcarController extends Controller
{  

    /**
     * 显示购物车页面
     *
     * @param
     * @return view index
     */
    public function shopcar(Request $request) 
    {   
        //查看用户是否登录
        if (!$request->session()->get('homeUser')) {

            //用户没有登录,从session拿数据
            $shopcar = $request->session()->get('shopcar');


        } else {

            //用户登录了从redis里拿数据
            //得到登录的用户id
            $uid = session('homeUser')->id;

            //$cartHashKey = 'cart:data:'.$uid.':'.$gid;//hash键存法:商品id拼接用户id

            $cartIdsKey = 'cart:ids:data:'.$uid;//集合存法:用户id

            $shopcar = [];

            $arr = ['id', 'pic', 'desc', 'name', 'store', 'price', 'num']; 

            //用户商品id的集合
            $cartIds = Redis::sMembers($cartIdsKey);
            //用户商品id的总数
            $countid = Redis::sCard($cartIdsKey);

            for($i = 0; $i < $countid; $i++) {

                $cartHashKey = 'cart:data:'.$uid.':'.$cartIds[$i];

                $info = Redis::hmGet($cartHashKey, array('id', 'pic', 'desc', 'name', 'store', 'price', 'num'));

                $info = array_combine($arr, $info);//键值对匹配

                $objectinfo = (object)$info;//数组转换成对象

                $shopcar[$cartIds[$i]] = $objectinfo;//存在shopcar数组中,下标为商品id,值为对象              
            }
        }


        //dd($shopcar);
        return view('Home.Person.shopcar', ['shopcar' => $shopcar]);
    }

    /**
     * 处理购物车的加减操作的
     *
     * @param $id 商品id
     * @param $operate 商品操作:1减 2加
     * @return view index
     */
    public function shopcarOperate(Request $request) 
    {
        $id = $request->input('id');

        $operate = $request->input('operate');

        if (!$request->session()->get('homeUser')) {

            $shopcar = $request->session()->get('shopcar');

            //得到当前的数量
            $num = $shopcar[$id]->num;

            //得到商品的最大数
            $store = $shopcar[$id]->store;

            if ($operate == '1') {

                //减,至少买一个
                if ($num == '1') {

                    return response()->json([
                        'code' => '3',//前端不做任何操作
                        'msg' => 'session至少买一个',
                    ]);

                } else {

                    //减少一个的这个商品购物车数量
                    $shopcar[$id]->num = ($shopcar[$id]->num - 1);

                    return response()->json([
                        'code' => '1',//前段数量减少1
                        'msg' => 'session这个购物车数量减1了',
                    ]);
                }
                    
            } else {
                
                if ($num == $store) {

                    return response()->json([
                        'code' => '3',
                        'msg' => 'session这个商品最多'.$store,
                    ]);
                } else {

                    //增加一个这个商品的购物车数量
                    $shopcar[$id]->num = ($shopcar[$id]->num + 1);

                    return response()->json([
                        'code' => '2',//前段数量加1
                        'msg' => 'session我加1了',
                    ]);
                }                            
            }

        } else {

            //用户的id
            $uid = session('homeUser')->id;

            //hash键
            $cartHashKey = 'cart:data:'.$uid.':'.$id;

            //得到当前的数量
            $num = Redis::hGet($cartHashKey, 'num');

            //得到商品的最大数
            $store = Redis::hGet($cartHashKey, 'store');

            if ($operate == '1') {

                //下面是执行减的操作
                if ($num == 1) {

                    return response()->json([
                        'code' => '3',//前端不做任何操作
                        'msg' => 'reids至少买一个',
                    ]);
                } else {

                    //减少一个的这个商品购物车数量
                    Redis::hIncrBy($cartHashKey, 'num', '-1');

                    return response()->json([
                        'code' => '1',//前段数量减少1
                        'msg' => 'redis这个购物车数量减1了',
                    ]);
                }
            } else {

                //下面执行的是加的操作
                if ($num == $store) {

                    return response()->json([
                        'code' => '3',
                        'msg' => 'redis这个商品最多'.$store,
                    ]);
                } else {

                    //减少一个的这个商品购物车数量
                    Redis::hIncrBy($cartHashKey, 'num', '1');

                    return response()->json([
                        'code' => '2',//前段数量减少1
                        'msg' => 'redis我加了1上去了',
                    ]);
                }

            }
        }
    }

    /**
     * 处理购物车的删除的
     *
     * @param $id 商品的id
     * @return view index
     */
    public function shopcarDelete(Request $request) {

        //商品的id
        $id = $request->input('id');

        if (!$request->session()->get('homeUser')) {

            //没有登录的
            //删除这个下标的
            $shopcar = $request->session()->get('shopcar');
            unset($shopcar[$id]);
            session(['shopcar' => $shopcar]);

            return response()->json([

                'code' => '200',
                'msg' => 'session删除成功',

            ]);

        } else {

            //这个是有登录的
            //用户的id
            $uid = session('homeUser')->id;

            //删除集合里的数据
            $cartIdsKey = 'cart:ids:data:'.$uid;

            Redis::sRem($cartIdsKey, $id);

            //hash键
            $cartHashKey = 'cart:data:'.$uid.':'.$id;

            Redis::delete($cartHashKey);

            return response()->json([

                'code' => '200',
                'msg' => 'redis删除成功',
            ]);
        }
    }



    /**
     * 处理商品详情处点击加入购物车的
     *
     * @param 
     * @return view 
     */
    public function detailShopcarAdd(Request $request) 
    {
        //接受的商品id
        $gid = $request->input('gid');

        //加入购物车的数量
        $num = $request->input('num');

        //根据这个查找商品的数据
        $goodInfo = DB::table('shop_goods')
                            ->select('id', 'name', 'tid', 'bid', 'price', 'clicknum', 'buynum')
                            ->where('id', $gid)
                            ->first();

        $picinfo = DB::table('shop_goods_details')
                        ->select('desc', 'album', 'pic_name')
                        ->where([['gid', $gid], ['status', '1']])
                        ->first();

        $store = DB::table('shop_goods_attributes')
                        ->where([['gid', $gid], ['status', '1']])
                        ->value('store');

        $pic = 'storage/'.$picinfo->album.'/'.$picinfo->pic_name;

        $goodInfo->pic = $pic;

        $goodInfo->desc = $picinfo->desc;

        $goodInfo->store = $store;
        
        
        //查看用户是否登录
        if (!$request->session()->get('homeUser')) {

            //查找是否有购物车这个键
            if (!$request->session()->has('shopcar')) {
                
                //$goodInfo数据库查出来的商品数据,追加数量,存进shopcar
                $goodInfo->num = $num;

                session(['shopcar' => [$gid => $goodInfo]]);
            } else {

                //提出购物车的数组.如有这个商品的gid下标,直接添加数量.如果没有,添加新数据.
                $shopcar = $request->session()->get('shopcar');

                if (array_key_exists($gid, $shopcar)) {
                    
                    //有这个商品id的数据,追加这个数量就可以了
                    $shopcar[$gid]->num = ($shopcar[$gid]->num + $num);
                } else {

                    //没有这个id的数据
                    $goodInfo->num = $num;

                    $shopcar[$gid] = $goodInfo;

                    session(['shopcar' => $shopcar]);

                }
            }
        } else{

            //得到登录的用户id
            $uid = session('homeUser')->id;

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
                Redis::hIncrBy($cartHashKey, 'num', $num);
            }

        }
        return back()->with('msg', '添加购物车成功');
 
    }


    //下面是测试的
    public function test(Request $request) 
    {
        
         
       

        // 模拟登陆
        $userInfo = DB::table('shop_home_user')
                    ->select(['id', 'status', 'pwd'])
                    ->where('phone', '13536723795')
                    ->first();  

        // 把用户信息存放到session
        session(['homeUser' => $userInfo]);

        //登陆追加购物车到redis
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
                        'num' => $goodInfo->num,
                        ]);
                } else {

                    //这个是有hash这个键的
                    Redis::hIncrBy($cartHashKey, 'num', $goodInfo->num);
                }

            }
        }

        //删除session的数据
        $request->session()->forget('shopcar');

        //退出登录的
        //$request->session()->forget('homeUser');
        echo '登录成功';
        
    }
}
