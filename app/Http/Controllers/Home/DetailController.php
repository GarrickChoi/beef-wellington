<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DetailController extends Controller
{
	public function detail(Request $request)
	{   
		$gid = $request->input('gid');
		//评价列表
		$list = DB::table('shop_evaluate')->where('gid',$gid)->paginate(5);

		//评价好评率
		$sum = DB::table('shop_evaluate')->select('id')->where('gid',$gid)->get();
		$evaluatesum = DB::table('shop_evaluate')->select('evaluate')->where('evaluate',3)->where('gid',$gid)->get();
		
		if ($sum) {
			$evaluate = 0;
		} else {
			$evaluate = count($evaluatesum)/count($sum)*100;
		}

		$center = DB::table('shop_evaluate')->select('evaluate')->where('evaluate',2)->where('gid',$gid)->get();
		$difference = DB::table('shop_evaluate')->select('evaluate')->where('evaluate',1)->where('gid',$gid)->get();


		//查出商品名、累积评价等数据
		$goods = DB::table('shop_goods')->where('id',$gid)->where('status',2)->first();

		//查出点击量多的5件商品
		$clicknum_goods = DB::table('shop_goods')
				->where([
					['shop_goods.status',2],
					['shop_goods_details.status',1],
					])
				->orderBy('shop_goods.clicknum', 'desc')
				->leftJoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
				->limit(5)
				->get();
		//查出购买量多的8件商品
		$buynum_goods = DB::table('shop_goods')
				->where([
					['shop_goods.status',2],
					['shop_goods_details.status',1],
					])
				->orderBy('shop_goods.buynum', 'desc')
				->leftJoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
				->limit(8)
				->get();


		//查出商品图片放大镜
		$pictures = DB::table('shop_goods_details')->select('album','pic_name')->where('gid',$gid)->get();

				// dd($pictures);
		//查出商品详情图片
		// $details = DB::table('shop_goods_details')->select('album','pic_name')->where('gid',$gid)->where('status',1)->get();
		//'details' => $details

		//查出商品参数
		$parameter = DB::table('shop_goods_attributes')
				->leftJoin('shop_goods_ingredient', 'shop_goods_attributes.iid', '=', 'shop_goods_ingredient.id')
				->leftJoin('shop_goods_brand', 'shop_goods_attributes.bid', '=', 'shop_goods_brand.id')
				->leftJoin('shop_goods_colors', 'shop_goods_attributes.cid', '=', 'shop_goods_colors.id')
				->leftJoin('shop_goods_market', 'shop_goods_attributes.mid', '=', 'shop_goods_market.id')
				->leftJoin('shop_goods_style', 'shop_goods_attributes.sid', '=', 'shop_goods_style.id')
				->leftJoin('shop_goods_season', 'shop_goods_attributes.seaid', '=', 'shop_goods_season.id')
				->leftJoin('shop_goods_objects', 'shop_goods_attributes.oid', '=', 'shop_goods_objects.id')
				->where([
					['shop_goods_attributes.gid',$gid],
					['shop_goods_ingredient.status',1],
					['shop_goods_market.status',1],
					['shop_goods_style.status',1],
					])
				->select('shop_goods_ingredient.name as ingredient_name','shop_goods_market.name as market_name','shop_goods_style.name  as style_name','shop_goods_colors.name  as colors_name','shop_goods_brand.name  as brand_name','shop_goods_season.name  as season_name','shop_goods_objects.name  as objects_name')
				->get();
		
		//查出商品价格等
		// $price = DB::table('shop_goods_price')
		// 		->where([
		// 			['shop_goods_price.gid',$gid],
		// 			['shop_goods_price.status',1],
		// 			['shop_goods_price.store','>',0]
		// 			])
		// 		->leftJoin('shop_goods_colors', 'shop_goods_price.cid', '=', 'shop_goods_colors.id')
		// 		->select('shop_goods_price.store','shop_goods_colors.name as n','shop_goods_price.cid','shop_goods_price.gid')
		// 		->get();
		
		//查出商品颜色
		$price = DB::table('shop_goods_attributes')
				->where([
					['shop_goods_attributes.gid',$gid],
					['shop_goods_attributes.status',1],
					['shop_goods_attributes.store','>',0]
					])
				->leftJoin('shop_goods_colors', 'shop_goods_attributes.cid', '=', 'shop_goods_colors.id')
				->select('shop_goods_attributes.store','shop_goods_colors.name as n','shop_goods_attributes.cid','shop_goods_attributes.gid')
				->get();

		// echo '<pre>';
		// var_dump($price);
		// exit;


		return view('Home.Detail.detail',['list' => $list,'goods' => $goods,'evaluate' => $evaluate,'price' => $price,'sum' => $sum,'good' => $evaluatesum,'center' => $center,'difference' => $difference,'pictures' => $pictures,'parameter' => $parameter,'clicknum_goods' => $clicknum_goods,'buynum_goods' => $buynum_goods]);
	}

	/**
	 * 根据颜色查库存
	 * @param Request $request [description]
	 */
	public function Stock(Request $request)
	{   
		$gid = $request->input('gid');
		$cid = $request->input('cid');

		$data = DB::table('shop_goods_details')->where('cid',$cid)->select('store')->first();

		if ($data) {
            return response()->json([
            'code' => 200,
            'number' => $data->store,
            ]);
        }
	}
}
