<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

/**
 *  品牌管理模块
 *  author    翰高歌
 *  e-mail    zhhxxxx@xx.com
 */
class BrandController extends Controller
{
    /**
     *  显示启用的品牌或者搜索品牌
     */
    public function indexWithSearch (Request $request)
    {
        $searchInfo = $request->input('brand_name');//获得搜索内容

        //默认的搜索条件
        $item = [
            ['status',1],
        ];

        //判断是否为纯数字
        if (is_numeric($searchInfo)) {

            $id = intval($searchInfo);
            $item[1] = ['id','like',"%$id%"];//插入新的搜索内容

        } else {
            //判断是否为空
            if (!empty($searchInfo)) {

                $item[1] = ['name','like',"%$searchInfo%"];

            } else {

                // 为空则使用默认的条件
                
            }

        }

        //得到分页需要用到的内容数组
        $bs = DB::table('shop_goods_brand')
            ->select(['id','name','album','status'])
            ->where($item)
            ->orderBy('id','desc')
            ->paginate(8);//每个分页显示的条数

        //返回一个视图并附带上一组数据
        return view('Admin.brand.brand',['allBrands' => $bs,'searchInfo' => $searchInfo]);
    }

    /**
     * 提供所有可用的状态
     */
    public function getAllStatus() {

         //显示所有的状态
        $allStatus = DB::table('shop_goods_statusInfo')
                       ->select('id','name')
                       ->where('status',1)
                       ->get();
                       
        return $allStatus;
    }

    /**
     *  禁用选中的品牌
     */
    public function doDisabledAllBrands(Request $request) 
    {
        $ids = explode('-',($request->input('id')));//获得id数组

        //获得受影响的行数
        $row = intval(DB::table('shop_goods_brand')
                        ->whereIn('id',$ids)
                        ->update(['status' => 2]));

        // 判断是否为纯数字
        if ($row > 0) {

            //成功
            return response()->json([
                'code' => '666',
                'msg' => 'Successful delete data!'
            ]);

        } else {

            //失败
            return response()->json([
                'code' => '741',
                'msg' => 'Data delete failed,operation error!'
            ]);

        }
    }

    /**
     *  修改品牌状态
     */
    public function changeStatus(Request $request) {

        //获得品牌id
        $bid = intval($request->input('bid'));

        //获得该品牌的状态值
        $status = intval($request->input('status')) == 1? 2 : 1;//1为启用  2为禁用

        //获得受影响的行数
        $row = intval(DB::table('shop_goods_brand')
                        ->where('id',$bid)
                        ->update(['status' => $status]));

        //判断
        if (is_numeric($row)) {

            //成功
            return response()->json([
                'code' => '666',
                'msg' => 'Successful status modification!',
                'status' => $status
            ]);

        } else {

            //失败
            return response()->json([

                'code' => '444',
                'msg' => 'The data has been modified or modified to fail!',
                'status' => false
            ]);

        }
    }

    /**
     *  显示品牌信息
     */
    public function showBrandInfo(int $bid) {

        //获得品牌id
        $bid = intval($bid);

        //判断品牌是否存在
        if ($bid < 0) {

            return back()->with('msg', "This brand doesn't exist.");

        }

        //获得受影响的行数，需要像是的品牌信息
        $binfo = DB::table('shop_goods_brand')
                   ->select('id','name','album','status')
                   ->where('id',$bid)
                   ->first();

        //获得受影响的行数，显示现有启用的状态
        $allStatus = DB::table('shop_goods_statusInfo')
                       ->select('id','name')
                       ->where('status',1)
                       ->get();

        //返回一个视图并附带上一组数据
        return view('Admin.brand.edit_brand',['binfo' => $binfo,'allStatus' => $allStatus]);
    }

    /**
     * 根据状态判断返回的页面
     */
    public function skipFaces(int $oldStatus) 
    {
        $face = 'brand';
        if ($oldStatus == 2) 
        {
            $face = 'restoreBS';
        }

        return redirect($face);
    }

    /**
     *  需要编辑的品牌
     */
    public function editBrandInfo(Request $request) 
    {
        $flag = 0;//记录用的变量
        $bid = $request->input('bid');//获取品牌Id
        $oldStatus = intval($request->input('os'));//拿到原先的状态

        if ($bid <= 0) 
        {
            return back()->with('msg','This is brand-id does not exists.');
        }

        //获取该品牌的基本信息对象
        $binfo = DB::table('shop_goods_brand')
                   ->select(['name','album','status'])
                   ->where('id',$bid)
                   ->first();
        
        //默认的更新内容
        $brand_info = [
            'name' => $request->input('name'),//品牌名
            'status' => $request->input('status')];//品牌状态

        //判断是否上传了图片，是就执行以下代码
        if ($request->hasFile('brand_pic')) {

            $album_Path = '/brand/_bid'.$bid;//拼接存放品牌图片的文件名

            //指定图片上传的路径，并获得上传成功后的图片的完整路径
            $path = $request->file('brand_pic')->store('public/'.$album_Path);

            $pic = substr(strrchr($path, '/'), 1);//获取图片名

            $brand_info['pic'] = $pic;//插入新的更新内容-----图片名

            $brand_info['album'] = 'public/'.$album_Path.'/';//插入新的更新内容-----相册

        } else {

            $flag++;//否区间，如果图片没有执行上传，则该变量加1，当等于2的时候，判断为什么都没有操作

        }

        //判断是否没有修改品牌名和品牌状态
        if (($brand_info['name'] == $binfo->name) && ($brand_info['status'] == $binfo->status)) {
            $flag++;//同上
        }

        if ($flag == 2) {//当该记录变量等于2的时候，返回原先页面，并提示错误
            return back()->with('msg',"You haven't changed it yet.");
        }

        $viewname = 'brand';
        if ($oldStatus == 2) {
            $viewname = 'restoreBS';
        }


        //返回更新数据的影响行数
        $row = DB::table('shop_goods_brand')
                 ->where('id',$bid)
                 ->update($brand_info);

        //对返回的行数进行判断
        if (is_numeric($row)) 
        {

            return redirect($viewname)->with('msg','Modify the success.');//成功
        } else {

            return back()->with('msg',"Incorrect operation.");//错误

        }

    }

    /**
     *  禁用品牌
     */
    public function deleteBrandInfo(int $bid){

        //判断要删除的品牌是否存在
        if ($bid <= 0) 
        {
            return back()->with('msg',"The brand does not exist.");//错误提示
        }

        //返回受影响的条数
        $row = intval(DB::table('shop_goods_brand')
        ->where('id',$bid)
        ->update(['status' => 2]));

        //判断
        if ($row >= 0) 
        {
            return redirect('brand')->with('msg',"Delete operation successful");
        } else {

            return back()->with('msg',"Delete operation error");
        }
    }

    /**
     *  显示添加页面
     */
    public function showAdd() 
    {
        //返回一个视图，并附带上一组数据
        return view('Admin.brand.add_brand',['allStatus' => $this->getAllStatus()]);
    }

    /**
     *  添加品牌信息
     */
    public function addBrandInfo(Request $request) 
    {
        //获取状态值
        $status = $request->input('status');
        
        //获取品牌名
        $name = $request->input('name');

        //判断状态值是否存在
        if (!is_numeric($status)) 
        {
            return back()->with('msg','Invalid state value.');
        }

        //判断状态是否存在
        if (intval($status) <= 0) 
        {
            return back()->with('msg','Invalid state value.');
        }

        //判断品牌图片是否上传
        if (!$request->hasFile('brand_pic')) 
        {
            return back()->with('msg','There are no pictures uploaded.');//提示品牌图片未上传
        }

        //获取添加成功后的品牌id
        $bid = DB::table('shop_goods_brand')
                 ->insertGetId([
                    'name' => $name,
                    'pic' => '',
                    'album' => '',
                    'status' => $status]);

        $album_Path = '/brand/_bid'.$bid;//品牌图片存放的目录名

        $brand_info = [];//品牌信息

        //获取图片上传成功后的完整路径
        $path = $request->file('brand_pic')->store('public/'.$album_Path);

        //获取图片名
        $pic = substr(strrchr($path, '/'), 1);

        //插入更新内容-----图片名
        $brand_info['pic'] = $pic;

        //插入更新内容-----图片目录
        $brand_info['album'] = 'public/'.$album_Path.'/';

        //返回受影响的行数
        $row = intval(DB::table('shop_goods_brand')
                        ->where('id',$bid)
                        ->update($brand_info));

        //判断
        if ($row == 1) 
        {
            return redirect('brand')->with('msg','Additive operation successful.');//成功
            
        } else {

            return back()->with('msg',"Incorrect operation.");//错误

        }

    }

    /**
     *  显示和查询禁用的品牌
     */
    public function showWithSearchAllDisableData(Request $request){

        //需要搜索的字眼
        $searchInfo = $request->input('brand_name');

        //默认搜索条件
        $item = [
            ['status',2],
        ];

        //判断搜索的内容是品牌id还是品牌名
        if (is_numeric($searchInfo)) {

            $id = intval($searchInfo);//强转为int类型
            $item[1] = ['id','like',"%$id%"];//插入搜索条件

        } else {

            if (!empty($searchInfo)) {//判断搜索内容是否为空

                $item[1] = ['name','like',"%$searchInfo%"];//插入搜索条件
                
            }
        }

        //得到搜索内容
        $allDIsableData = DB::table('shop_goods_brand')
                            ->select(['id','name','album','status'])
                            ->where($item)
                            ->paginate(8);

        // 返回一个视图，并附带上一组数据，用于显示分页内容与追加数据到分页链接上
        return view('Admin.brand.restore',['allDIsableData' => $allDIsableData,'searchInfo' => $searchInfo]);
    }

    /**
     *  显示禁用的品牌信息
     */
    public function showRestoreBrandData(int $bid) {

        $bid = intval($bid);//获得品牌id

        //判断此id是否存在
        if ($bid < 0) {

            return back()->with('msg', "This brand doesn't exist.");
        }

        // 获得编辑的品牌的基本信息对象
        $binfo = DB::table('shop_goods_brand')
                    ->select('id','name','pic','album','status')
                    ->where('id',$bid)
                    ->first();

        // 获得所有的状态
        $allStatus = DB::table('shop_goods_statusInfo')
                        ->select('id','name')
                        ->where('status',1)
                        ->get();

        // 返回一个视图，并附带上一组数据，用于显示分页内容与追加数据到分页链接上
        return view('Admin.brand.edit_restore',['binfo' => $binfo,'allStatus' => $allStatus]);
    }

    /**
     *  编辑禁用的品牌
     */
    public function doEditRestoreData(Request $request) {

        $flag = 0;//定义一个记录变量，用于记录位操作的项数目
        $bid = $request->input('bid');//获得品牌id

        // 获得编辑的禁用品牌的信息
        $binfo = DB::table('shop_goods_brand')
                   ->select(['name','album','status'])
                   ->where('id',$bid)
                   ->first();
        
        // 默认的更新条件
        $brand_info = [
             'name' => $request->input('name'),
             'status' => $request->input('status')];

        // 判断图片是否上传，有则执行以下代码
        if ($request->hasFile('brand_pic')) {

            $album_Path = '/brand/_bid'.$bid;//品牌图片存放的目录名

            // 获得图片上传成功后返回的完整路径
            $path = $request->file('brand_pic')->store('public/'.$album_Path);

            // 获取图片名
            $pic = substr(strrchr($path, '/'), 1);

            $brand_info['pic'] = $pic;//插入新的更新内容----图片名

            //插入新的更新内容----图片路径
            $brand_info['album'] = 'public/'.$album_Path.'/';

        } else {

            $flag++;//记录变量累加1
        }

        // 判断图片名和图片状态是否被修改过
        if (($brand_info['name'] == $binfo->name) && ($brand_info['status'] == $binfo->status)) {
            $flag++;
        }

        // 当该变量为2的时候，说明说明操作都没有做
        if ($flag == 2) {
            return back()->with('msg',"You haven't changed it yet.");
        }

        //获得受影响的行数
        $row = intval(DB::table('shop_goods_brand')->where('id',$bid)->update($brand_info));

        //判断
        if (is_numeric($row)) {

            return redirect('Admin.brand.restoreBS')->with('msg','Modify the success.');//成功
            
        } else {

            return back()->with('msg',"Incorrect operation.");//失败

        }

    }

    /**
     *  删除禁用的品牌数据
     */
    public function doDeleteRestoreData(Request $request) {

        // 获得品牌id
        $bid = intval($request->input('bid'));

        //判断该品牌是否存在
        if ($bid < 0) {

            return back()->with('msg',"The brand does not exist.");
        }

        //获得受影响的行数
        $row = intval(DB::table('shop_goods_brand')->where('id',$bid)->delete());

        if (is_numeric($row)) {//判断

            //成功
            return response()->json([
                'code' => '666',
                'msg' => 'Delete operation successful!',
            ]);

        } else {
            //失败
            return response()->json([
                'code' => '444',
                'msg' => 'Delete operation error!',
            ]);
        }
    }

    /**
     *  恢复选中的品牌数据
     */
    public function restoreAllData(Request $request) 
    {
        $ids = explode('-',($request->input('id')));//分割字符串

        //获得受影响的行数
        $row = intval(DB::table('shop_goods_brand')
                  ->whereIn('id',$ids)
                  ->update(['status' => 1]));

        //判断
        if ($row >= 1) 
        {
            //成功
            return response()->json([
                'code' => '666',
                'msg' => 'Successful recovery data!'
            ]);

        } else {
            //失败
            return response()->json([
                'code' => '741',
                'msg' => 'Data recovery failed,operation error!'
            ]);

        }
    } 

}
