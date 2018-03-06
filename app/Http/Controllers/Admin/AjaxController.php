<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 *  后台站点管理请求的Ajax文件
 *  @author Choi <[309432711@qq.com]>
 *  @date  2018-01-23
 */
class AjaxController extends Controller
{
    public function seo(Request $request)
    { 
    	$id = $request->input('id');

    	$data = DB::table('shop_web_name')
    	->select('title','keyword','des')
    	->where('id',$id)
    	->first();

		return response()->json([
    				'title' => $data->title,
    				'keyword' => $data->keyword,
    				'des' => $data->des
    			]);
    }
}
