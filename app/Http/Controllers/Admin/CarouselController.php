<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;//删除文件
/**
 *  处理首页轮播图管理控制器
 *  @author Choi <[309432711@qq.com]>
 *  @date  2018-01-22
 */
class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data = DB::table('shop_carousel')->get();
    	//dd($data);
        return view('Admin.carousel',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 处理添加图片
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$count = DB::table('shop_carousel')->count();

    	if ($count >= 5) {
    		return back()->with('msg','不能超过5张图片');
    	}
        $des = $request->input('des');        
        if ($des) {
        	if ($request->hasFile('picture')) {
        		$picture = $request->file('picture')->store('public');

        		$insert = DB::table('shop_carousel')->insert(
        				['picture_des' => $des ,'picture' => ltrim($picture, 'public/')]
        			);
        		$data = DB::table('shop_carousel')->get();
        		return view('Admin.carousel',['data' => $data]);
        	}
        }

		return back();
    }

    /**
     * Display the specified resource.
     * 删除标签
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$url = DB::table('shop_carousel')->select('picture')->where('id',$id)->first();
    	//dd($url);
        $id = DB::table('shop_carousel')->where('id',$id)->delete();
        if ($id) {
        	 Storage::delete('public/'.$url->picture);
        }        

        $data = DB::table('shop_carousel')->get();
        return view('Admin.carousel',['data' => $data]);
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
