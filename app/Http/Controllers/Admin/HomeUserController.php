<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\Admin\CheckHomeUserEdit;

class HomeUserController extends Controller
{
    //显示前台用户列表
   	public function userList(Request $request)
   	{	
   		//设计一个默认条件
   		$where[0] = ['id', '>', '0'];
   		//获取搜索的关键字
   		$homeuser_role = $request->input('homeuser_role');
   		$homeuser_status = $request->input('homeuser_status');
   		$username = $request->input('username');

   		if($homeuser_role) $where[1] = ['role','=', $homeuser_role];
   		if($homeuser_status) $where[2] = ['status', '=' ,$homeuser_status];
   		if($username) $where[3] = ['username', 'like', "%$username%"];

   		//dd($where);
   		
   		//查询前台用户信息
   		$userdatas = DB::table('shop_home_user')->orderBy('create_time', 'desc')->where($where)->paginate(5);
        
       	return view('Admin.HomeUser.user_list', [

       		'list' => $userdatas,
       		'role' => $homeuser_role,
       		'status' => $homeuser_status,
       		'username' => $username

       		]);
   	}

   	/**
   	* 显示后台添加普通用户用户页面
   	* 
   	*/
   	/*public function userAdd()
   	{
   		return view('Admin.HomeUser.user_add');
   	}*/

   

   	/**
   	* 处理修改普通用户的状态
   	*/
   	public function changeStatus(Request $request)
   	{
   		//接收到id
   		$id = intval($request->input('id'));
   		//$status = intval($request->input('status'));
   		
   		//改变用户的状态
   		$s = DB::table('shop_home_user')->where('id', $id)->select(['status'])->first();

   		$status = $s->status;
   		if ($status == 1) {

   			$a = DB::table('shop_home_user')->where('id', $id)->update(['status' => 2]);
   			if ($a) {
	   			$data = [
	   				'status' => $status,
	   				'code' => "已改为禁用"
	   			];
   			}
   		} else {
   			
   			$a = DB::table('shop_home_user')->where('id', $id)->update(['status' => 1]);
   			if ($a) {
   				$data = [
   				'status' => $status,
   				'code' => "已改为正常"
   				];
   			}
   		}
   		echo json_encode($data);
   	}


   	/**
   	* 处理删除普通用户
   	*/
   	public function userDelete(Request $request)
   	{
   		/*dd(1);*/
   		//接收到要删除的id
   		$id = intval($request->input('uid'));
		
   		//判断id是否合法
   		if($id < 0) {

   			return response()->json([
				'code' => 1403,
				'msg' => '非法ID',
   			]);
   		}

   		//删除普通用户，返回受影响行数
   		$row = DB::table('shop_home_user')->where('id', $id)->delete();

   		if ($row) {

   			//删除成功
   			return response()->json([
   				'code' => 1200,
   				'msg' => '删除成功',
   			]);
   		} else {

   			//删除失败
   			return response()->json([
   				'code' => 1400,
   				'msg' => '删除失败',
   			]);
   		}
   	}


   	/**
   	* 显示编辑普通用户页面
   	*/
   	/*public function userEdit($uid)
   	{	
   		$uInfo = DB::table('shop_home_user')->where('id', $uid)
   					->select(['id', 'username', 'phone', 'email', 'role'])
   					->first();
   		//dd($uInfo);
   		return view('Admin.HomeUser.user_edit', ['userInfo' => $uInfo]);
   	}*/


   	/**
   	* 处理修改普通用户
   	*/
   	/*public function doEdit(Request $request)
   	{
   		//接收数据
   		$id = $request->input('uid');
   		$username = $request->input('username');
   		$email = $request->input('email');
   		$phone = $request->input('phone');
   		$pass = $request->input('pass');

   		//查询出要修改用户的信息
   		$userdata = DB::table('shop_home_user')->where('id', $id)
   					->select('id', 'username', 'phone', 'email')
   					->first();
   		dd($userdata);
   		
   		$where = ['username' => $username];
   		$where = ['email' => $email];
   		$where = ['phone' => $phone];

   		//判断是否修改密码
   		if ($pass) {

   			$where['pwd'] = bcrypt($pass);
   		}

   		$affected_Row = DB::table('shop_home_user')->where('id', $id)->update($where);

   		if ($affected_Row) {
   			return back()->with('msg', '修改成功');
   		}

   	}*/


}
