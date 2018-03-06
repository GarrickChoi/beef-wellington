<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckAddress;
use DB;

class AddressController extends Controller
{
    /**
     * 显示地址页面  
     *
     * @return view address
     */
    public function index () 
    {
        //模拟拿到uid
        $uid = session('homeUser')->id;
        

        $address_info = DB::table('shop_address')
        ->select('id', 'name', 'phone', 'province', 'city', 'county', 'address', 'status')
        ->where('uid', $uid)
        ->get(); 

        return view('Home.Person.address', ['address_info' => $address_info]);
    }

    /**
     * 处理用户地址添加
     *
     * @return \Illuminate\Http\Response
     */
    public function addressAdd (CheckAddress $request) 
    {   
        //获得前端传来的地址信息,存进insert数组里
        $insert['name'] = $request->input('getname');
        $insert['phone'] = $request->input('phone');
        $insert['province'] = $request->input('s_province');
        $insert['city'] = $request->input('s_city');
        $insert['county'] = $request->input('s_county');
        $insert['address'] = $request->input('detail_address');

        //测试id
        $insert['uid'] = session('homeUser')->id;
        $uid = session('homeUser')->id;
       
        //查看时候有此这个用户的地址信息
        $address_info = DB::table('shop_address')
        ->select('id')
        ->where('uid', $uid)
        ->first();

        //没有这个地址设为默认收货地址
        if (!$address_info) $insert['status'] = 1;

        //插入数据库
        $rel =  DB::table('shop_address')
                    ->insert($insert);
        
        if ($rel) {

            return back()->with('msg', '新增地址成功');

        } else {

            return back()->with('msg', '新增地址失败');

        }

    }

    /**
     * ajax处理修改默认收货地址状态的 
     *
     * @param int edit_id
     * @return \Illuminate\Http\Response
     */
    public function addressEdit(Request $request) 
    {   

        $id = intval($request->input('id'));

        $uid = session('homeUser')->id;


        //事物回滚失败
        //更改默认状态的时候需要加上用户id
        //改变有的这个用户的默认地址状态改为2，传进来的id的地址改为默认的1
        //$uid = session('homeUser')->id;
        //DB::transaction(function () {

            DB::table('shop_address')->where([ ['uid', $uid], ['status', 1] ] )->update(['status' => '2']);

            DB::table('shop_address')->where([['id', $id], ['uid', $uid]])->update(['status' => '1']);

        //});

        return response()->json(['rel' => '修改成功']);
    }


    /**
     * 删除用户的地址
     * 
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function addressDel(Request $request) 
    {
        $id = intval($request->input('id'));

        //!删除用户地址的时候需要加用户id的条件
        $uid = session('homeUser')->id;
        $rel = DB::table('shop_address')->where([['id', $id], ['uid', $uid]])->delete();

        if ($rel) {
                
            return response()->json([
                'code' => '200',
                'msg' => '删除成功',
            ]);

        }
    }

     /**
     * 编辑用户的地址
     * 
     * @param  id edit_id
     * @return return address_edit
     */
    public function addressAlter($id) 
    {
        //!根据这个id，以及用户id搜索这个地址信息
        $uid = session('homeUser')->id;

        $address_info = DB::table('shop_address')->where([['id', $id], ['uid', $uid]])->first();

        return view('Home.Person.address_edit', ['address_info' => $address_info]);
    }

    /**
     * 处理真正的编辑
     * 
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function addressDoAlter(CheckAddress $request) 
    {
        //获得前段传来的地址信息,存进insert数组里
        $update['name'] = $request->input('getname');
        $update['phone'] = $request->input('phone');
        $update['province'] = $request->input('s_province');
        $update['city'] = $request->input('s_city');
        $update['county'] = $request->input('s_county');
        $update['address'] = $request->input('detail_address');

        $id = intval($request->input('id'));

        $uid = session('homeUser')->id;
        $rel = DB::table('shop_address')->where([['id', $id], ['uid', $uid]])->update($update);
        
        if($rel) {
            return redirect('home/address')->with('msg', '修改成功');
        } else {
            return redirect('home/address')->with('msg', '修改失败');
        }

    }
}
