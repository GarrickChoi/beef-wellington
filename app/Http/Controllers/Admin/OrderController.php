<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Ordercontroller extends Controller
{
    /**
     * 显示订单页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where[0] = ['id', '>', '0'];
        
        $order_stat = $request->input('order_stat');
        $order_num = $request->input('order_num');

        if ($order_stat) $where[1] = ['status', $order_stat];
        if (strlen($order_num)) $where[2] = ['id', $order_num];

        $order_list_arr = DB::table('shop_orders')
        ->select(['id', 'uid', 'status', 'order_num', 'address', 'uname', 'phone', 'addtime', 'total'])
        ->where($where)
        ->paginate(5);//2为分页的条数

        return view('Admin.Order.order_list', ['order_list_arr' => $order_list_arr, 'order_stat' => $order_stat, 'order_num' => $order_num]);
    }

    /**
     * 显示订单详情页面
     *
     * @return \Illuminate\Http\Response
     */
    public function orderDetail($oid) 
    {   
        $order_detail = DB::table('shop_detail')->where('oid', $oid)->get();

        return view('Admin.Order.order_detail', ['order_detail' => $order_detail]);
    }

    /**
     * 修改订单状态为发货
     *
     * @return \Illuminate\Http\Response
     */
    public function orderChange(Request $request) 
    {
        $id = intval($request->input('id'));

        if ($id < 0 ) {
            return response()->json([
                'code' => 1400,
                'msg' => 'id非法',
            ]);
        }

        $affectedRow = DB::table('shop_orders')
        ->where('id', $id)
        ->update(['status' => 3]);

        if ($affectedRow) {
            
            //更改成功
            return response()->json([
            'code' => 200,
            'msg' => '发货成功',
            ]);
        } else {

            //数据库更改失败
            return response()->json([
                'code' => 400,
                'msg' => '发货失败',
            ]);

        }

        
    }

}
