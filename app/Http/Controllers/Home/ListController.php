<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ListController extends Controller
{
    
    /**
     * show the list of goods
     *
     */
    public function list(Request $request) 
    {
        //子分类的pid和id
        $pid = $request -> input('pid');
        $id = $request -> input('id');
        //品牌的id
        $bid = $request -> input('bid');

        //接受排序的字段和顺序
        $rank_name = $request -> input('rank_name');
        $rank = $request -> input('rank');

        if ($rank_name == 'id' || empty($rank_name) ) {

            $rank_name = 'shop_goods.id';
            $rank = 'desc';

        } else if ($rank_name == 'price') {

            $rank = $rank == 'desc'? 'asc' : 'desc';
        }
        
        $where_Goods[] = ['shop_goods.status', '2'];

        
        //判断是否非法访问
        if (empty($pid)) {

            //强制返回首页
            return redirect('/')->with('msg', '勿扰');

        } else if (empty($id)) {

            //没传具体子分类的id，就查出顶级分类下的所有商品

            //找出所有子分类的兄弟分类
            $sonTypes = DB::table('shop_goods_type')->where('pid', $pid)->get();
            //找出所有子分类的id
            $array_sonTypes = json_decode(json_encode($sonTypes), true);
            $ids = array_column($array_sonTypes, 'id');
            
        } else {
            
            //传了子分类的id，就查该子分类下的所有商品
            array_push($where_Goods,['tid', $id]);

            //找出所有子分类的兄弟分类
            $sonTypes = DB::table('shop_goods_type')->where('pid', $pid)->get();
        };


        //找出所有的商品和所属品牌(先判断是否通过列表页的品牌标签搜索进来的)
        if (empty($bid)) {

        	//判断是否非传了子分类的id
            if (empty($id)) {

                //没传子分类的id
                //找出商品并分页
                $goods = DB::table('shop_goods')
                        ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                        ->where('shop_goods_details.status', '1')
                        ->whereIn('tid', $ids)
                        ->where($where_Goods)
                        ->orderBy($rank_name, $rank)
                        ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                        ->paginate(8);
                      
                //由于分页的原因，只能另外查询来找出得到商品的品牌        
                $BrandGoods = DB::table('shop_goods')
                        ->select('shop_goods.bid')
                        ->whereIn('tid', $ids)
                        ->where($where_Goods)
                        ->get();

                //拿到查询到的商品的bid
                $BrandGoods = json_decode(json_encode($BrandGoods), true);
                $bids = array_column($BrandGoods, 'bid');

                //拿到搜到商品的条数
                $total = $goods->total();
                
                //拿到搜到的商品的品牌
                $brands = DB::table('shop_goods_brand')
                        ->where([
                                ['status', '1'],
                            ])
                        ->whereIn('id', $bids)
                        ->select('id', 'name')
                        ->get(); 

                //热销商品
                //$Good = json_decode(json_encode($goods), true);       
                if (!$total) {
                   
                    //如果查出来的商品为空，热销商品就为全网销量前三名的商品
                    $hotgoods = DB::table('shop_goods')
                                ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                                ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                                ->where('shop_goods_details.status', '1')
                                ->orderBy('buynum', 'desc')
                                ->limit(3)
                                ->get();
                }else {
                    
                    //如果查出来的商品不为空，热销商品就为该筛选条件下销量前三名的商品
                    $hotgoods = DB::table('shop_goods')
                                ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                                ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                                ->where('shop_goods_details.status', '1')
                                ->whereIn('tid', $ids)
                                ->where($where_Goods)
                                ->orderBy('buynum', 'desc')
                                ->limit(3)
                                ->get();
                                    
                }          
                return view('Home/list', ['goods' => $goods, 'brands' => $brands, 'sonTypes' => $sonTypes, 'total' => $total, 'pid' => $pid, 'id' => $id, 'bid' => $bid, 'rank_name' => $rank_name, 'rank' => $rank, 'hotgoods' => $hotgoods]);
            }

            //传了子分类的id
            //找出商品并分页
            $goods = DB::table('shop_goods')
                        ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                        ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                        ->where('shop_goods_details.status', '1')
                        ->where($where_Goods)
                        ->orderBy($rank_name, $rank)
                        ->paginate(8);
            
             //由于分页的原因，只能另外查询来找出得到商品的品牌 
            $BrandGoods = DB::table('shop_goods')
                        ->select('shop_goods.bid')
                        ->where($where_Goods)
                        ->get();
                                    
            //拿到查询到的商品的bid
            $BrandGoods = json_decode(json_encode($BrandGoods), true);       
            $bids = array_column($BrandGoods, 'bid');
            
            //拿到搜到商品的条数
            $total = $goods->total();
            
            //拿到搜到的商品的品牌
            $brands = DB::table('shop_goods_brand')
                        ->where([
                            ['status', '1'],
                        ])
                        ->whereIn('id', $bids)
                        ->select('id', 'name')
                        ->get();

            //热销商品        
            if (!$total) {

                //如果查出来的商品为空，热销商品就为全网销量前三名的商品
                $hotgoods = DB::table('shop_goods')
                            ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                            ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                            ->where('shop_goods_details.status', '1')
                            ->orderBy('buynum', 'desc')
                            ->limit(3)
                            ->get();
            }else {
                //如果查出来的商品不为空，热销商品就为该筛选条件下销量前三名的商品
                $hotgoods = DB::table('shop_goods')
                        ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                        ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                        ->where('shop_goods_details.status', '1')
                        ->where($where_Goods)
                        ->orderBy('buynum', 'desc')
                        ->limit(3)
                        ->get();            
            }            
                       
            return view('Home/list', ['goods' => $goods, 'brands' => $brands, 'sonTypes' => $sonTypes, 'total' => $total, 'pid' => $pid, 'id' => $id, 'bid' => $bid, 'rank_name' => $rank_name, 'rank' => $rank, 'hotgoods' => $hotgoods]);

        } else {
                
                //传了bid

                //判断有没有传子分类id
                if (empty($id)) {
                    $goods = DB::table('shop_goods')
                        ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                        ->where('shop_goods_details.status', '1')
                        ->whereIn('tid', $ids)
                        ->where($where_Goods)
                        ->orderBy($rank_name, $rank)
                        ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                        ->paginate(8);
                      
                    //由于分页的原因，只能另外查询来找出得到商品的品牌        
                    $BrandGoods = DB::table('shop_goods')
                            ->select('shop_goods.bid')
                            ->whereIn('tid', $ids)
                            ->where($where_Goods)
                            ->get();

                    //拿到查询到的商品的bid
                    $BrandGoods = json_decode(json_encode($BrandGoods), true);
                    $bids = array_column($BrandGoods, 'bid');

                    //拿到搜到商品的条数
                    $total = $goods->total();
                    
                    //拿到搜到的商品的品牌
                    $brands = DB::table('shop_goods_brand')->select('id', 'name')
                                ->where([
                                    ['status', '1'],
                                    ['id', $bid]
                                ])
                                ->get();

                    //热销商品
                    //$Good = json_decode(json_encode($goods), true);       
                    if (!$total) {

                        //如果查出来的商品为空，热销商品就为全网销量前三名的商品
                        $hotgoods = DB::table('shop_goods')
                                    ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                                    ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                                    ->where('shop_goods_details.status', '1')
                                    ->orderBy('buynum', 'desc')
                                    ->limit(3)
                                    ->get();
                    }else {
                        
                        //如果查出来的商品不为空，热销商品就为该筛选条件下销量前三名的商品
                        $hotgoods = DB::table('shop_goods')
                                    ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                                    ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                                    ->where('shop_goods_details.status', '1')
                                    ->whereIn('tid', $ids)
                                    ->where($where_Goods)
                                    ->orderBy('buynum', 'desc')
                                    ->limit(3)
                                    ->get();
                                        
                    }          
                    //dd($id);
                    return view('Home/list', ['goods' => $goods, 'brands' => $brands, 'sonTypes' => $sonTypes, 'total' => $total, 'pid' => $pid, 'id' => $id, 'bid' => $bid, 'rank_name' => $rank_name, 'rank' => $rank, 'hotgoods' => $hotgoods]);

                }

                //传了子分类id和品牌id
                array_push($where_Goods, ['bid', $bid]);

                $goods = DB::table('shop_goods')
                            ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                            ->where('shop_goods_details.status', '1')
                            ->where($where_Goods)
                            ->orderBy($rank_name, $rank)
                            ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                            ->paginate(8);

                //拿到搜到商品的条数
                $array_goods = json_decode(json_encode($goods), true);            
                $total = $array_goods['total'];
                   
                //拿到搜到的商品的品牌
                $brands = DB::table('shop_goods_brand')->select('id', 'name')
                            ->where([
                                ['status', '1'],
                                ['id', $bid]
                            ])
                            ->get();

                //热销商品        
                if (!$total) {

                    //如果查出来的商品为空，热销商品就为全网销量前三名的商品
                    $hotgoods = DB::table('shop_goods')
                                ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                                ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                                ->where('shop_goods_details.status', '1')
                                ->orderBy('buynum', 'desc')
                                ->limit(3)
                                ->get();
                }else {
                
                    //如果查出来的商品不为空，热销商品就为该筛选条件下销量前三名的商品
                    $hotgoods = DB::table('shop_goods')
                            ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                            ->where('shop_goods_details.status', '1')
                            ->where($where_Goods)
                            ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                            ->orderBy('buynum', 'desc')
                            ->limit(3)
                            ->get();           
                }

            return view('Home/list', ['goods' => $goods, 'brands' => $brands, 'sonTypes' => $sonTypes, 'total' => $total, 'pid' => $pid, 'id' => $id, 'bid' => $bid, 'rank_name' => $rank_name, 'rank' => $rank, 'hotgoods' => $hotgoods]);

        }

    }


    /**
    *show the search of list
    *
    */
    public function search(Request $request) 
    {

        $keyword = $request->input('keyword');
        //品牌id
        $bid = $request->input('bid');
        //子分类的id
        $id = $request->input('id');

        //接受排序的字段和顺序
        $rank_name = $request -> input('rank_name');
        $rank = $request -> input('rank');

        if ($rank_name == 'id' || empty($rank_name) ) {

            $rank_name = 'shop_goods.id';
            $rank = 'desc';

        } else if ($rank_name == 'price') {

            $rank = $rank == 'desc'? 'asc' : 'desc';
        }

        //在售中的商品状态为2
        $where_Goods[] = ['shop_goods.status', '2'];
        array_push($where_Goods, ['shop_goods.name', 'like', "%$keyword%"]);
        
        //根据关键字查商品表的name字段,拿到商品信息
        $searchGoods = DB::table('shop_goods')
                ->where($where_Goods)
                ->get(); 
        $searchGoods = json_decode(json_encode($searchGoods), true);

        //判断是初次搜索，还是搜索过后点击品牌或子分类进行二次搜索的
        if (empty($bid)) {
            
            if (empty($id)) {

                //只通过搜索框搜索商品,无品牌或子分类的二次筛选

                //找出的商品对应的子分类
                $tids = array_column($searchGoods, 'tid');                                              
                $sonTypes = DB::table('shop_goods_type')->whereIn('id', $tids)->get();

                //找到商品对应的品牌
                $bids = array_column($searchGoods, 'bid');
                $brands = DB::table('shop_goods_brand')->select('id', 'name')
                            ->whereIn('id', $bids)
                            ->where('status', '1')
                            ->get();
                //dd($brands);            

            } else {

                //搜索过后进行分类筛选

                //找出的商品对应的子分类
                $sonTypes = DB::table('shop_goods_type')->where('id', $id)->get();

                //找到商品对应的品牌
                $bids = array_column($searchGoods, 'bid');
                $brands = DB::table('shop_goods_brand')->select('id', 'name')
                            ->whereIn('id', $bids)
                            ->where('status', '1')
                            ->get();

                array_push($where_Goods, ['shop_goods.tid', $id]);
            }

        } else {

             if (empty($id)) {

                //通过搜索框搜索商品并且通过品牌进行二次筛选

                //找出的商品对应的子分类
                $tids = array_column($searchGoods, 'tid');                                              
                $sonTypes = DB::table('shop_goods_type')->whereIn('id', $tids)->get();

                //找到商品对应的品牌
                $brands = DB::table('shop_goods_brand')->select('id', 'name')
                            ->where([
                                ['status', '1'],
                                ['id', $bid]
                            ])
                            ->get();

                array_push($where_Goods, ['shop_goods.bid', $bid]);           

            } else {

                //通过搜索框搜索商品并且通过品牌和分类进行二次筛选

                //找出的商品对应的子分类
                $sonTypes = DB::table('shop_goods_type')->where('id', $id)->get();

                //找到商品对应的品牌
                $brands = DB::table('shop_goods_brand')->select('id', 'name')
                            ->where([
                                ['status', '1'],
                                ['id', $bid]
                            ])
                            ->get();

                array_push($where_Goods, ['shop_goods.bid', $bid]);
                array_push($where_Goods, ['shop_goods.tid', $id]);
            }

        }
                
        //拿到商品的全部信息与图片并进行分页
        array_push($where_Goods, ['shop_goods_details.status', '1']);
        $goods = DB::table('shop_goods')
                ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                ->where($where_Goods)
                ->orderBy($rank_name, $rank)
                ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                ->paginate(8); 

        //拿到搜到的商品总数
        $total = $goods->total();

        if (!$total) {

            //如果查出来的商品为空，热销商品就为全网销量前三名的商品
            $hotgoods = DB::table('shop_goods')
                    ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                    ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                    ->where('shop_goods_details.status', '1')
                    ->orderBy('buynum', 'desc')
                    ->limit(3)
                    ->get();
        } else {

            //拿到搜索的商品销量前三名作为热销商品
            $hotgoods = DB::table('shop_goods')
                    ->leftjoin('shop_goods_details', 'shop_goods.id', '=', 'shop_goods_details.gid')
                    ->where($where_Goods)
                    ->orderBy('buynum', 'desc')
                    ->select('shop_goods.*', 'shop_goods_details.album', 'shop_goods_details.pic_name')
                    ->limit(3)
                    ->get();    
        }

        return view('Home/search', ['goods' => $goods, 'brands' => $brands, 'sonTypes' => $sonTypes, 'total' => $total, 'id' => $id, 'bid' => $bid, 'rank_name' => $rank_name, 'rank' => $rank, 'hotgoods' => $hotgoods, 'keyword' => $keyword]);

    }

}
