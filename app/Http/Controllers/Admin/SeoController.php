<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
/**
 *  处理网站优化管理控制器
 *  @author Choi <[309432711@qq.com]>
 *  @date  2018-01-22
 */
class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	//网页管理表
    	$datas = DB::table('shop_web_name')->select('id','name')->get();
    	//网页信息表
    	$data = DB::table('shop_seo')->first();
    	//将数据提交到显示页面
        return view('Admin.seo',['data' => $data, 'datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接收数据
        $number = $request->input('number');//备案号     
        if ($number) {
         	DB::table('shop_seo')->where('id', 1)->update(['web_number' => $number]);
        } 
        
        if ($request->hasFile('logo')) {
        	$logo = $request->file('logo')->store('public'); //接收图片，会放到public目录
        	DB::table('shop_seo')->where('id', 1)->update(['web_logo' => $logo]);
        }
        
        $web = $request->input('web');//要修改的网页       
        if ($web != '--请选择--') {
        	$title = $request->input('title');//网页标签
        	$keyword = $request->input('keyword');//网页关键字
        	$des = $request->input('des');//网页描述

        	DB::table('shop_web_name')->where('name',$web)->update([
        			'title' => $title,
        			'keyword' => $keyword,
        			'des' => $des
        		]);
        }

        $datas = DB::table('shop_web_name')->select('id','name')->get();
        $data = DB::table('shop_seo')->first();
        return view('Admin.seo',['data' => $data, 'datas' => $datas]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    	
    	
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
