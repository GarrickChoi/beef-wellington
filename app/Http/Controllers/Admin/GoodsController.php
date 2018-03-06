<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\CheckUpGoodsPost;
use App\Http\Requests\CheckUpEditPost;

class GoodsController extends Controller
{

    public function selectAllTables(array $allTableName,array $allTableField) 
    {
        $allAttributes = [];

        for ($i=0; $i < count($allTableName); $i++) { 

            $index = explode('_', $allTableName[$i]);
            $idnex_name = $index[count($index)-1];

            $allAttributes[$idnex_name] = DB::table($allTableName[$i])
                                            ->select($allTableField)
                                            ->where('status',1)
                                            ->get();
        }

        return $allAttributes;
    }

    public function showManageFace(int $id,string $name,int $pid) 
    {
        if ($pid >= 1 || $pid < 0) {
            return back();
        }

        $allParentsType = [];
        $allParentsType['goods_id'] = $id;
        $allParentsType['goods_name'] = $name;
        $allParentsType['type_parents'] = DB::table('shop_goods_type')->where('pid',0)->get();
        dump($allParentsType);
        return view('Admin.goods.manage_type',['allParentsType' => $allParentsType]);
    }

    public function getAllNeeds() 
    {
        $allNeedInfo = [];

        $allNeedInfo['brand'] = DB::table('shop_goods_brand')
                                  ->where('status',1)
                                  ->select('id','name')
                                  ->get();
        $allNeedInfo['type'] = DB::table('shop_goods_type')
                                 ->where('pid',1)
                                 ->select('id','name','pid')
                                 ->get();

        return $allNeedInfo;
    }

    public function doDisabledGoods(Request $request) 
    {
        $id = $request->input('id');

        if (!is_numeric($id)) 
        {
            return response()->json([
                        'code' => '2222',
                        'msg' => 'This is not a goods-id.'
                    ]);
        }

        if ($id < 0) 
        {
            return response()->json([
                        'code' => '3333',
                        'msg' => 'This goods_id is does not exists.'
                    ]);
        }

        DB::table('shop_goods')->where('id',$id)->delete();
        DB::table('shop_goods_details')->where('gid',$id)->delete();
        DB::table('shop_goods_attributes')->where('gid',$id)->delete();
        DB::table('shop_goods_discount')->where('gid',$id)->delete();

        return response()->json([
                        'code' => '2444',
                        'msg' => 'operation successful.'
                    ]);
    }


    //
    public function showWithSearchGoods(Request $request) 
    {
        $searchInfo = $request->input('goods_info');

        $item = [
            ['shop_goods.status','>',0]
        ];

        if (is_numeric($searchInfo)) {

            $id = intval($searchInfo);//转换为int类型

            $item[1] = ['shop_goods.id',"$id"];//加入到默认搜索的条件

        } else {

            // 判断拿到的搜索内容是否为空，
            // 是则用默认的搜索条件搜索出所有的同类数据，
            // 否则同上，加入默认的搜索条件进行搜索
            if (!empty($searchInfo)) {

                $item[1] = ['shop_goods.name','like',"%$searchInfo%"];
            }
        }

        $goodsInfo = DB::table('shop_goods')
                       ->join('shop_goods_attributes',function($join) {
                           $join->on('shop_goods.id','=','shop_goods_attributes.gid');
                       })
                       ->join('shop_goods_brand',function($join) {
                           $join->on('shop_goods.bid','=','shop_goods_brand.id');
                       })
                       ->join('shop_goods_type',function($join) {
                           $join->on('shop_goods.tid','=','shop_goods_type.id');
                       })
                       ->select(['shop_goods.*','shop_goods_attributes.store',
                        'shop_goods_brand.name as brand_name',
                        'shop_goods_type.name as type_name','shop_goods_type.pid as type_pid'])
                       ->where($item)
                       ->paginate(12);

                      /* dump($goodsInfo);
                       dump(($this->getAllNeeds())['type'][0]);*/
        return view('Admin.goods.goods',['goodsInfo' => $goodsInfo,'allNeedInfo' => $this->getAllNeeds(),'searchInfo' => $searchInfo]);
    }

    public function doChangeGoods(Request $request) 
    {
        $gid = $request->input('gid');
        $status = $request->input('gstatus');

        if (!is_numeric($gid)) 
        {
            return response()->json([
                        'code' => '777',
                        'msg' => 'This goods-id is not exists.'
                    ]);
        }

        $gid = intval($gid);

        if (!is_numeric($status)) 
        {
            return response()->json([
                        'code' => '888',
                        'msg' => 'This goods-status is not exists.'
                    ]);
        }

        $status = intval($status);

        $status = $status == 1 ? 2 : ($status == 2 ? 3 : 1);

        DB::table('shop_goods')->where('id',$gid)->update(['status' => $status]);

        return response()->json([
                    'code' => '666',
                    'status' => $status,
                    'msg' => 'Change the goods of status is successful.'
                ]);
    }

    public function doDisabledAllGoods(Request $request) 
    {
        $gids = explode('-',($request->input('id')));

        $row = intval(DB::table('shop_goods')->whereIn('id',$gids)->delete());
        DB::table('shop_goods_details')->whereIn('gid',$gids)->delete();
        DB::table('shop_goods_attributes')->whereIn('gid',$gids)->delete();
        DB::table('shop_goods_discount')->whereIn('gid',$gids)->delete();

        if ($row) 
        {
            return response()->json([
                        'code' => '666',
                        'msg' => 'operation successful.'
                    ]);
        }

        return response()->json([
                    'code' => '777',
                    'msg' => 'operation failed.'
                ]);
    }

    public function showEditFace(int $gid)
    {
        if (!is_numeric($gid)) 
        {
            return back()->with('msg','This data is not a number.');
        }

        $goodsInfo = DB::table('shop_goods')
                       ->where('id',$gid)
                       ->select('id','name','price','status')
                       ->get();
        $goodsInfo[1] = DB::table('shop_goods_details')
                          ->where('gid',$gid)
                          ->select('desc')
                          ->get();
        $goodsInfo[2] = DB::table('shop_goods_attributes')
                          ->where('gid',$gid)
                          ->select('store')
                          ->get();
        $goodsInfo[3] = DB::table('shop_goods_discount')
                        ->where('gid',$gid)
                        ->select('discount','status')
                        ->get();
                       
        $allTablesName = [
            'shop_goods_brand','shop_goods_type',
            'shop_goods_colors','shop_goods_ingredient',
            'shop_goods_market','shop_goods_style',
            'shop_goods_season','shop_goods_objects',
            'shop_goods_status'
        ];

        $selectAllField = ['id','name'];

        $allAttributes = $this->selectAllTables(
            $allTablesName,$selectAllField
        );

        $goodsAttributes = DB::table('shop_goods_attributes')
                            ->join('shop_goods_brand',function($join) {
                                $join->on('shop_goods_attributes.bid','=','shop_goods_brand.id')
                                ->where('shop_goods_brand.status','=',1);
                            })
                            ->join('shop_goods_type',function($join) {
                                $join->on('shop_goods_attributes.tid','=','shop_goods_type.id')
                                ->where([
                                        ['shop_goods_type.status','=',1],
                                        ['shop_goods_type.pid','=',1]
                                    ]);
                            })
                            ->join('shop_goods_colors',function($join) {
                                $join->on('shop_goods_attributes.cid','=','shop_goods_colors.id')
                                ->where('shop_goods_colors.status','=',1);
                            })
                            ->join('shop_goods_ingredient',function($join) {
                                $join->on('shop_goods_attributes.iid','=','shop_goods_ingredient.id')
                                ->where('shop_goods_ingredient.status','=',1);
                            })
                            ->join('shop_goods_market',function($join) {
                                $join->on('shop_goods_attributes.mid','=','shop_goods_market.id')
                                ->where('shop_goods_market.status','=',1);
                            })
                            ->join('shop_goods_style',function($join) {
                                $join->on('shop_goods_attributes.sid','=','shop_goods_style.id')
                                ->where('shop_goods_style.status','=',1);
                            })
                            ->join('shop_goods_season',function($join) {
                                $join->on('shop_goods_attributes.seaid','=','shop_goods_season.id')
                                ->where('shop_goods_season.status','=',1);
                            })
                            ->join('shop_goods_objects',function($join) {
                                $join->on('shop_goods_attributes.oid','=','shop_goods_objects.id')
                                ->where('shop_goods_objects.status','=',1);
                            })
                            ->join('shop_goods_status',function($join) {
                                $join->on('shop_goods_attributes.oid','=','shop_goods_status.id')
                                ->where('shop_goods_status.status','=',1);
                            })
                            ->select(['shop_goods_brand.id as brand_id','shop_goods_brand.name as brand_name',
                                'shop_goods_type.id as type_id','shop_goods_type.name as type_name',
                                'shop_goods_colors.id as color_id','shop_goods_colors.name as color_name',
                                'shop_goods_ingredient.id as ingredient_id','shop_goods_ingredient.name as ingredient_name',
                                'shop_goods_market.id as market_id','shop_goods_market.name as market_name',
                                'shop_goods_style.id as style_id','shop_goods_style.name as style_name',
                                'shop_goods_season.id as season_id','shop_goods_season.name as season_name',
                                'shop_goods_objects.id as objects_id','shop_goods_objects.name as objects_name',
                                'shop_goods_status.id as status_id','shop_goods_status.name as status_name'])
                            ->get();
                        // dump($allAttributes);exit;
                            // dump($goodsInfo[3][0]->status);exit;
        return view('Admin.goods.edit_goods',['goodsInfo' => $goodsInfo,'allAttributes' => $allAttributes,'goodsAttributes' => $goodsAttributes]);
    }

    public function doEditeGoods(CheckUpEditPost $request) 
    {
        $id = $request->input('gid');
        $name = $request->goodsname;
        $brand = $request->brand;
        $type = $request->type;
        $color = $request->color;
        $ingredient = $request->ingredient;
        $market = $request->market;
        $style = $request->input('Basic_style');
        $season = $request->season;
        $objects = $request->objects;
        $price = $request->price;
        $store = $request->store;
        $status = $request->status;
        $desc = $request->desc;
        $discount = $request->discount;

        $album = 'public/goods/';

        $goodsAttributes = [
            'gid' => $id,
            'cid' => $request->input('color'),
            'bid' => $request->input('brand'),
            'tid' => $request->input('type'),
            'iid' => $request->input('ingredient'),
            'mid' => $request->input('market'),
            'sid' => $request->input('Basic_style'),
            'seaid' => $request->input('season'),
            'oid' => $request->input('objects'),
            'store' => $request->input('store')
        ];

        $new_content = '';
        foreach ($goodsAttributes as $v) {
            $new_content .= $v;
        }

        $goodsDetails = [
            'gid' => $id,
            'content' => $new_content,
            'desc' => $request->input('desc'),
            'album' => $album,
            'pic_name' => 'all_pictures.jpg',
            'status' => 2
        ];

        if ($request->hasFile('pic')) 
        {
            $album = 'public/goods/_gid' . $id;
            foreach (($request->file('pic')) as $v) 
            {
                $pic = substr(strrchr($v->store($album), '/'), 1);
                DB::table('shop_goods_details')->insert($goodsDetails);
            }
        }

        DB::table('shop_goods')
          ->where('id',$id)
          ->update(['name' => $name,'tid' => $type,
                  'bid' => $brand,'price' => $price
              ]);

        DB::table('shop_goods_attributes')
          ->where('gid',$id)
          ->update([
                'cid' => $color,'bid' => $brand,'tid' => $type,
                'iid' => $ingredient,'mid' => $market,'sid' => $style,
                'seaid' => $season,'oid' => $objects,'store' => $store
            ]);

        DB::table('shop_goods_details')->where('gid',$id)->update(['desc' => $desc,'status' => $status]);

        if (!is_null($discount)) 
        {
            DB::table('shop_goods_discount')
              ->where('gid',$id)
              ->update(['discount' => $discount,'WDC' => 1,'status' => 1]);
        }

        return redirect('allgoods');
    }

    public function showAddFace() 
    {
        $allTablesName = [
            'shop_goods_brand','shop_goods_type',
            'shop_goods_colors','shop_goods_ingredient',
            'shop_goods_market','shop_goods_style',
            'shop_goods_season','shop_goods_objects',
            'shop_goods_status'
        ];
        
        $selectAllField = ['id','name'];

        $allAttributes = $this->selectAllTables(
            $allTablesName,$selectAllField
        );

        return view('Admin.goods.add_goods',['allAttributes' => $allAttributes]);
    }

    public function doAddNewGoods(CheckUpGoodsPost $request) 
    {
        $goodsInfo = [
            'name' => $request->input('goodsname'),
            'tid' => $request->input('type'),
            'bid' => $request->input('brand'),
            'price' => $request->input('price'),
            'addtime' => date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),
            'status' => $request->input('status')
        ];

        $gid = intval(DB::table('shop_goods')->insertGetId($goodsInfo));

        if ($gid <= 0) 
        {
            return back()->with('msg','insert a new goods error.');
        }

        $goodsAttributes = [
            'gid' => $gid,
            'cid' => $request->input('color'),
            'bid' => $request->input('brand'),
            'tid' => $request->input('type'),
            'iid' => $request->input('ingredient'),
            'mid' => $request->input('market'),
            'sid' => $request->input('Basic_style'),
            'seaid' => $request->input('season'),
            'oid' => $request->input('objects'),
            'store' => $request->input('store')
        ];

        $new_content = '';
        foreach ($goodsAttributes as $v) {
            $new_content .= $v;
        }

        DB::table('shop_goods_attributes')->insert($goodsAttributes);

        $album = 'goods/_gid' . $gid;
        
        $path = [];

        $goodsDetails = [
            'gid' => $gid,
            'content' => $new_content,
            'desc' => $request->input('desc'),
            'album' => 'public/goods/',
            'pic_name' => 'all_pictures.jpg',
            'status' => 2
        ];


        if ($request->hasFile('pic')) 
        {
            foreach (($request->file('pic')) as $k => $v) 
            {
                $path[$k] = substr(strrchr($v->store('public/'.$album), '/'), 1);

                $goodsDetails['album'] = $album;

                if ($k == 0) {
                    $goodsDetails['status'] = 1;
                } else {
                    $goodsDetails['status'] = 2;
                } 
                $goodsDetails['pic_name'] = $path[$k];
                DB::table('shop_goods_details')->insert($goodsDetails);
            }

        }

        $goods_dis = [
            'gid' => $gid,
            'discount' => $request->input('discount')
        ];

        $discount = $request->input('discount');

        if (!is_null($discount)) {
            $goods_dis['WDC'] = 1;
            $goods_dis['status'] = 1;
            $goods_dis['discount'] = $discount;
        }

        DB::table('shop_goods_discount')->insert($goods_dis);

        return redirect('allgoods')->with('msg','addtion operation successful.');
    }

    public function indexWithSearch(Request $request) 
    {
        $searchInfo = $request->input('goodsname');

        $item = [
            ['shop_goods.status',2]
        ];

        if (is_numeric($searchInfo)) {

            $id = intval($searchInfo);//转换为int类型

            $item[1] = ['shop_goods.id',"$id"];//加入到默认搜索的条件

        } else {

            // 判断拿到的搜索内容是否为空，
            // 是则用默认的搜索条件搜索出所有的同类数据，
            // 否则同上，加入默认的搜索条件进行搜索
            if (!empty($searchInfo)) {

                $item[1] = ['shop_goods.name','like',"%$searchInfo%"];
            }
        }

        $goodsInfo = DB::table('shop_goods')
                       ->join('shop_goods_attributes',function($join) {
                           $join->on('shop_goods.id','=','shop_goods_attributes.gid');
                       })
                       ->select('shop_goods.*','shop_goods_attributes.store')
                       ->where($item)
                       ->paginate(12);
                      // dump($goodsInfo);
        return view('Admin.goods.restore',['goodsInfo' => $goodsInfo,'allNeedInfo' => $this->getAllNeeds(),'searchInfo' => $searchInfo]);
    }

    public function doDeleteGoods(int $id) 
    {
        if ($id < 0) 
        {
            return back()->with('msg','This goods_id is does not exists.');
        }

        $row = intval(DB::table('shop_goods')->where('id',$id)->delete());
        DB::table('shop_goods_details')->where('gid',$id)->delete();
        DB::table('shop_goods_attributes')->where('gid',$id)->delete();
        DB::table('shop_goods_discount')->where('gid',$id)->delete();

        if ($row) 
        {
            return redirect('restoreG')->with('msg','operation successful.');
        }

        return back()->with('msg','operation failed.');
    }
    
    public function doRestoreAllDisabled(Request $request)
    {
        $gids = explode('-',($request->input('id')));

        $row = intval(DB::table('shop_goods')->whereIn('id',$gids)->update(['status' => 1]));

        if ($row) 
        {
            return response()->json([
                        'code' => '666',
                        'msg' => 'operation successful.'
                    ]);
        }

        return response()->json([
                    'code' => '777',
                    'msg' => 'operation failed.'
                ]);
    }
}
