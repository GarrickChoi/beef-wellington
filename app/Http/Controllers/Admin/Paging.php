<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Paging extends Controller
{
    public function userList(Request $request)
    {
        
        $keyword = $request->input('keyword');

        $data = DB::table('shop_friendsline')->where('name','like',"%$keyword%")->paginate(10);
        if ($data) {
            return view('Admin.Friendsline.friendslist',['data' => $data, 'key' => $keyword]);
        } else {
            return view('Admin.AdminUser.login');
        }
    }

    public function evaluateList(Request $request)
    {
        
        $keyword = $request->input('keyword');
        $evaluate = [1 => '差评', 2 => '中评', 3 => '好评'];
        $data = DB::table('shop_evaluate')->where('evaluate','like',"%$keyword%")->paginate(10);
        if ($data) {
            return view('Admin.Evaluate.evaluate',['data' => $data, 'key' => $keyword, 'evaluate' => $evaluate]);
        } else {
            return view('Admin.AdminUser.login');
        }
    }

    public function status(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status') == 1?2:1;
        $statustxt = $status == 1?'已启用':'已禁用';
        $data = DB::table('shop_friendsline')->where('id', $id)->update(['status' => $status]);
        if ($data) {
            return response()->json([
            'code' => 200,
            'status' => $status,
            'statustext' => $statustxt
            ]);
        } else {
            return view('Admin.AdminUser.login');
        }
    }
}
