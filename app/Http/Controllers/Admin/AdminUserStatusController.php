<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminUserStatusController extends Controller
{
    public function doStatus(Request $request)
    {

    	$uid = $request->input('uid');
    	$status = $request->input('status') == 1? 2 : 1;

    	$info = DB::table('users')->where('id', $uid)->update(['status' => $status]);

    	//return $info;
    	$statustxt = $status == 1? '已启用':'已禁用';
    	if ($info) {
    		return response()->json([
    			'code' => '200',
    			'status' => $status,
    			'statustxt' => $statustxt
			]);
    	}
    }
}
