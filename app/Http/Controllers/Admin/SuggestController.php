<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SuggestController extends Controller
{
    public function index(Request $request) 
    { 
    	$name = $request->input('name');
    	$type = $request->input('type');
    	$status = $request->input('status');

    	

    	$data = DB::table('shop_suggest')
    	->when($type, function ($query) use ($type) {
                    return $query->where('type', $type);
                })
    	->when($status, function ($query) use ($status) {
                    return $query->where('status', $status);
                })
    	->where('name','like',"%$name%")
    	->paginate(1);

    	return view('Admin.suggest',['data' => $data , 'name' => $name ]);
    }

    public function doedit($id)
    { 
    	$data = DB::table('shop_suggest')->select('name','type','question','answer','date')->where('id',$id)->first();
    	$answer = $data->answer;
    	
    	if (empty($answer)) {
    		$button = 1;
    		return view('Admin.dosuggest',['data' => $data , 'id' => $id , 'button' => $button]);
    	}
    		$button = 0;
    	return view('Admin.dosuggest',['data' => $data , 'id' => $id , 'button' => $button]);
    }

    //回复客户信息的ajax
    public function doajax(Request $request)
    { 
    	$data = $request->input('data');
    	$id = $request->input('id');

    	if ($data) {
    		$ok = DB::table('shop_suggest')->where('id',$id)->update(['answer' => $data ,'status' => 2]);
    	}
    	
    	$ok = '';
    	return response()->json([
    				'data' => $ok
    			]);

    }

    /*页面更新的ajax
    public function change(Request $request)
    { 
    	$id = $request->input('id');

    	$data = DB::table('shop_suggest')->select('status')->where('id',$id)->first();
    	return response()->json([
    				'data' => $data->status
    			]);
    }*/
}
