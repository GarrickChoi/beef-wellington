<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
     /**
     * 显示下订单页面页面
     *
     * @param
     * @return view index
     */
    public function order(Request $request) 
    {   
        //接受过来的id
        $gids = $request->input('check');

        if (empty($gids)) return back()->with('errormsg', '你还没有选择商品');

        //得到登录的用户id
        $uid = session('homeUser')->id;

        $arr = ['id', 'pic', 'desc', 'name', 'store', 'price', 'num'];

        $orderinfo = [];

        $total = 0;

        foreach ($gids as $gid) {
            
            $cartHashKey = 'cart:data:'.$uid.':'.$gid;

            //根据这个gid,查找这个商品的数据
            $info = Redis::hmGet($cartHashKey, array('id', 'pic', 'desc', 'name', 'store', 'price', 'num'));

            $info = array_combine($arr, $info);//键值对匹配

            $objectinfo = (object)$info;//数组转换成对象

            //得到总钱数
            $total += $objectinfo->num * $objectinfo->price;   

            $orderinfo[$gid] = $objectinfo;//存在shopcar数组中,下标为商品id,值为对象
 
        }

        //查找地址的数据
        $address_info = DB::table('shop_address')
                                ->select('id', 'name', 'phone', 'province', 'city', 'county', 'address', 'status')
                                ->where([ ['uid', $uid], ['status', 1] ])
                                ->first();

        //得到地址的拼接
        $address = $address_info->province.$address_info->city.$address_info->county.$address_info->address;

        //得到所有id的数组转换成的字符串
        $gids_str = json_encode($gids);

        return view('Home.Person.order', ['orderinfo' => $orderinfo, 'total' => $total, 'address_info' => $address_info, 'gids_str' => $gids_str, 'address' => $address]);  
    }



    /**
     * 显示未付款的页面
     *
     * @param $address  收货地址
     * @param $name 收货人姓名
     * @param $phone 收货人电话
     * @param $gids 购买商品的id
     * @return view index
     */
    public function noPay(Request $request) 
    {
        $address = $request->input('address');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $gids = json_decode($request->input('gids_str'));
        $time = time();

        $total = 0;

        //得到登录的用户id
        $uid = session('homeUser')->id;

        $arr = ['id', 'pic', 'desc', 'name', 'store', 'price', 'num'];

        //添加到订单表
        //1:待付款 2：待发货 3：待收货 4：已完成 5：已取消 6：待评价

        $oid = DB::table('shop_orders')->insertGetId(
                ['uid' => $uid, 'status' => '1', 'order_num' => $time, 'address' => $address, 'uname' => $name, 'phone' => $phone, 'total' => '0']
            );

        foreach ($gids as $gid) {
                        
            $cartHashKey = 'cart:data:'.$uid.':'.$gid;

            //根据这个gid,查找这个商品的数据
            $info = Redis::hmGet($cartHashKey, array('id', 'pic', 'desc', 'name', 'store', 'price', 'num'));

            $info = array_combine($arr, $info);//键值对匹配

            $objectinfo = (object)$info;//数组转换成对象

            //得到小计的钱
            $part = $objectinfo->num * $objectinfo->price;

            $total += $part;

            // 修改.删除库存,改变pid分类,tid品牌,gid商品,num商品数量,price价格,gimg图片,count_num商品总价
            DB::table('shop_detail')->insert(
                ['oid' => $oid, 'num' => $objectinfo->num, 'price' => $objectinfo->price, 'gimg' => $objectinfo->pic, 'count_num' => $part, 'name' => $objectinfo->name,]
            );

            //删除hash,与集合里的东西
            //删除集合里的数据
            $cartIdsKey = 'cart:ids:data:'.$uid;
            Redis::sRem($cartIdsKey, $gid);

            //hash键
            $cartHashKey = 'cart:data:'.$uid.':'.$gid;
            Redis::delete($cartHashKey);

        }

        $row = DB::table('shop_orders')->where('id', $oid)->update(['total' => $total]);

        return view('Home.Person.pay', ['address' => $address, 'name' => $name, 'phone' => $phone, 'total' => $total, 'oid' => $oid]);
    }

    /**
     * 处理立即付款的
     * @param $oid  订单id
     * @return view index
    */
    public function payOver(Request $request) 
    {
        $oid = $request->input('oid');

        $status = DB::table('shop_orders')->where('id', $oid)->value('status');

        //如果支付过了,跳到个人页面
        if($status == 2) return view('Home.Person.person');

        $row = DB::table('shop_orders')->where('id', $oid)->update(['status' => 2]);

        if ($row) {
            return view('Home.Person.pay_over', ['msg' => '付款成功']);
        } else {
            return view('Home.Person.pay_over', ['errormsg' => '付款失败']);
        }
    }

    /**
     * 订单列表页面
     * @param 
     * @return view index
    */
    public function orderList() 
    {
        $uid = session('homeUser')->id;
      
        $orderarr = DB::table('shop_orders')->select('id', 'uid', 'status', 'order_num', 'addtime', 'uname', 'phone', 'address', 'total')->where('uid', $uid)->orderBy('addtime', 'name')->get();

        $order_detail = DB::table('shop_orders')
                            ->where('uid', $uid)
                            ->join('shop_detail', 'shop_orders.id', '=', 'shop_detail.oid')
                            ->select('shop_orders.*', 'shop_detail.num', 'shop_detail.price','shop_detail.gimg','shop_detail.count_num', 'shop_detail.name')
                            ->get();

        return view('Home.Person.order_list', ['orderarr' => $orderarr, 'order_detail' => $order_detail]);
    }

    /**
     * 修改订单的状态
     * @param 
     * @return view index
    */
    public function orderStatusChange($oid) 
    {
        
        $oid = intval($oid);

        $uid = session('homeUser')->id;

        $status = DB::table('shop_orders')
                    ->where([
                        ['uid', $uid],
                        ['id', $oid],
                    ])
                    ->value('status');

         // <!-- 1:待付款 2：待发货 3：待收货 4：已完成 5：已取消 6：待评价 -->

        if ( strlen($status) == '') return back()->with('msg', '操作有误');

        if ($status == '1') {

            $row = DB::table('shop_orders')->where('id', $oid)->update(['status' => '2']);

            if ($row) {

                return back()->with('msg', '付款成功');
            } else {

                return back()->with('errormsg', '操作失败');
            }
        }

        if ($status == '2') return back()->with('msg', '我已经提醒发货了');

        if ($status == '3') {

            $row = DB::table('shop_orders')->where('id', $oid)->update(['status' => '6']);

            if ($row) {

                return back()->with('msg', '确认收货成功');
            } else {

                return back()->with('errormsg', '操作失败');
            }
        }

        if ($status == '6') {}//根据订单id,出所有id的数据,然后返回到评价视图里


     }
}
