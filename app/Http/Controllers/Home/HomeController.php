<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;//导入数据库
use Illuminate\Support\Facades\Redis;//导入redis

use TomLingham\Searchy\Facades\Searchy;

//use App\Http\Model\Post;

/**
 *  网站首页！
 *  @author Choi <[309432711@qq.com]>
 *  @date  2018-01-24
 */
class HomeController extends Controller
{
	//加载数据，要求要用redis技术
    public function Index()
    { 	
    	//商品logo
    	$logo = DB::table('shop_seo')->select('web_logo')->first();
    	$logo = ltrim($logo->web_logo,'public/');
    	//seo管理
    	$seo = DB::table('shop_web_name')->where('id',1)->first();
    	//轮播图管理
    	$carousel = DB::table('shop_carousel')->select('picture')->get();
    	//遍历友情链接--星宿老仙
    	$friendsline = DB::table('shop_friendsline')->select('name','url')->where('status',1)->get();
    	return view('Home.index',[
    		'friendsline' => $friendsline ,
    		'logo' => $logo ,
    		'seo' => $seo ,
    		'carousel' => $carousel
    		]);
    }
    //测试选项卡ajax
    public function testAjax(Request $request)
    { 
    	//Redis::set('name', 'Garrick_Choi');
    	$id = $request->input('id');
    	//$data = DB::table('shop_goods')->select('id','name')->where('tid',$id)->get();
    	$data = Redis::hVals('lunbo');
    	return response()->json([
    			'data' => $data
    		]);
    }
    //首页请求第一次分类列表
    public function oneAjax(Request $request)
    { 
    	//测试redis
    	//$data = Redis::get('name');
    	$data = DB::table('shop_goods_type')->select('name','id')->where('pid',0)->get();
    	return response()->json([
    			'data' => $data
    		]);
    }

    //首页请求第二次分类列表
	public function twoAjax(Request $request)
	{ 
		$id = $request->input('id');
		//拿到商品分类ID 名称
		$data = DB::table('shop_goods_type')->select('name','id','pid')->where('path','like',"%$id%")->get();
		//dd($data);
		$goods = DB::table('shop_goods_type')
				->leftJoin('shop_goods','shop_goods_type.id','=','shop_goods.tid')
				->select('shop_goods.name','shop_goods.tid','shop_goods.id')
				->where('shop_goods_type.pid',$id)
				->get();
		//$goods = DB::table('shop_goods')->select('name','id')->where('tid',$data['id']])->get();

		return response()->json([
    			'data' => $data,
    			'goods' => $goods
    		]);
	}

	/*测试搜索
	public function testSearch(Request $request)
	{ 
		$users = Searchy::search('shop_goods')
		->fields('name','price')
		->select('name','id','tid','price')
		->query($request->input('id'))
		//->having('price', '>', 0)
		//->limit(3)
		->get();	
		dd($users) ;
		//return Post::select('name','tid')->where('id',$request->input('id'))->get();
	}
	*/

	//用ajax加载抢购数据
	public function saleAjax()
	{ 
		$data = DB::table('shop_goods')->select('name','price','id')->first();
		$gid = $data->id;
		$pic = DB::table('shop_goods_details')->select('album','pic_name')->where('gid',$gid)->first();
		$num = DB::table('shop_goods_attributes')->select('store')->where('gid',$gid)->first();
		//思路：判断商品库存，然后把相应库存存到redis列表中，
		//另一种 $count = $num-$len; //实际库存-被抢购的库存 = 剩余可用库存
		$len = Redis::llen("goods:sale:$gid");
		$count = intval($num->store) - $len;
		if ($count > 0) {
			for ($i=1; $i <= $count; $i++) { 
				Redis::lpush("goods:sale:$gid",$i);
			}
		}
		if ($count < 0) {
			for ($i=1; $i <= abs($count); $i++) { 
				Redis::lpop("goods:sale:$gid");
			}
		}
		return response()->json([
    			'data' => $data ,
    			'pic' => $pic
    		]);
	}

	//处理秒杀
	public function dosale($id)
	{ 
		//每买一次之前往redis列表中取值，有才能下单
		//$sum = DB::table('shop_goods')->select('reserve')->where('id',$id)->first();
		if (Redis::lpop("goods:sale:$id")) {

			DB::table('shop_goods_attributes')->where('gid',$id)->decrement('store');

			return back()->with('msg','抢购成功');
					
		}

		return back()->with('msg','抢购失败');
	}

	//瀑布流首页底下
	public function under()
	{ 
		$data = DB::table('shop_goods')
		->leftJoin('shop_goods_details','shop_goods.id','=','shop_goods_details.gid')
		->select('shop_goods.name','shop_goods.price','shop_goods_details.pic_name','shop_goods_details.gid','shop_goods_details.album')
		->limit(12)
		->get();

		return response()->json([
    			'data' => $data,
    		]);
	}

	public function f1Ajax()
	{ 
		$data = DB::table('shop_goods')
		->leftJoin('shop_goods_details','shop_goods.id','=','shop_goods_details.gid')
		->select('shop_goods.name','shop_goods.price','shop_goods_details.pic_name','shop_goods_details.gid','shop_goods_details.album')
		->limit(5)
		->get();

		return response()->json([
    			'data' => $data,
    		]);
	}
}
