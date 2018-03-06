<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

/**
 *  function    分类管理模块
 *  author      X某人
 *  e-mail      xxx@qq.com
 */
class TypeController extends Controller
{
    // 获得所有启用的可以用状态
    public function getAllStatus() 
    {
        $allStatus = DB::table('shop_goods_statusInfo')
                   ->where('status',1)
                   ->get();

        return $allStatus;
    }

    // 检查是否存在该分类
    // $field      数组       string
    public function checkType(array $field) 
    {
        $obj =  DB::table('shop_goods_type')
                  ->selectRaw('count(*)')
                  ->where($field)
                  ->first();

        return json_decode(json_encode($obj),true);//返回一个数组
    }

    // 得到指定where条件和指定查询字段的分类信息
    // $field      数组      string
    // $condition     数组      string
    public function selectType(array $field,array $condition) 
    {
        $str = '';//初始字段

        //拼接搜索的字段
        for ($i = 0; $i < count($field); $i++) { 
            $str .= $field[$i];
            if ($i != count($field)-1) {
                $str .= ',';
            }
        }

        // 得到一个包含所需内容的数组
        $obj = DB::table('shop_goods_type')
                 ->selectRaw($str)
                 ->where($condition)
                 ->get();

        return json_decode(json_encode($obj),true);//返回一个数组
    }

    // 显示分类列表和提供搜索功能
    public function showWithSearch(Request $request)
    {
        $searchInfo = $request->input('type_info');//获得搜索内容

        // 默认的搜索条件
        $item = [
            ['status',1]
        ];

        // 判断所有条件是否纯数字
        if (is_numeric($searchInfo)) {

            $id = intval($searchInfo);//转换为int类型

            $item[1] = ['id',"$id"];//加入到默认搜索的条件

        } else {

            // 判断拿到的搜索内容是否为空，
            // 是则用默认的搜索条件搜索出所有的同类数据，
            // 否则同上，加入默认的搜索条件进行搜索
            if (!empty($searchInfo)) {

                $item[1] = ['name','like',"%$searchInfo%"];
            }
        }

        // 得到分页内容以及对其进行排序
        // 使用laravel框架提供的原生的数据库语句，对其进行排序处理
        $allTypes = DB::table('shop_goods_type')
                      ->select(['id','name','pid','path','status'])
                      ->where($item)
                      ->orderByRaw("concat(path,id)") 
                      ->paginate(10);

        // 返回一个视图，并且附带上一组数据，分别是所有的分类和搜索内容
        return view('Admin.type.type',['allTypes' => $allTypes,'searchInfo' => $searchInfo]);
    }

    // 显示添加分类页面
    public function showAddFace() 
    {
        // 返回一个视图，并且附带上一个数据数组，该数组得到所有的数组
        return view('Admin.type.add_type',['allStatus' => $this->getAllStatus()]);
    }

    // 添加分类
    public function doAddType(Request $request) 
    {   
        $name = $request->input('name');// 获得分类名
        $status = $request->input('status');// 获得分类初始状态

        $num;// 定义一个变量，用于存储checkType得到的数据条数

        if (intval($status) <= 0) 
        {
            // 对得到的新的分类的状态进行验证，小于等于0则不存在
            // 返回上一个操作页面，并提示错误信息
            return back()->with('msg','No type initial state has been selected!');
        }

        //对checkType返回的数组进行遍历
        foreach (($this->checkType(['name' => $name])) as $v) 
        { 
            $num = $v;// 赋值给$num
        }

        // 对$num里得到的数据条数进行判断
        if (intval($num)) 
        {
            // 大于0的都是表示存在，所以返回上一个操作页面并提示错误
            return back()->with('msg','This type already exists!');

        }
           
        $item = ['name' => $name,'status' => $status];// 设置默认条件
       
        $row = DB::table('shop_goods_type')->insert($item);// 得到受影响的行数

        if (intval($row)) // 判断条数
        {
            // 跳转页面，提示成功
            return redirect('type')->with('Add type success!');

        } else {
            // 返回上一个操作页面，并提示错误
            return back()->with('msg','Add type failure!');

        }
        
    }

    // 显示编辑页面
    public function showEditFace(int $id) 
    {
        // 判断$id是否存在
        if ($id <= 0 )
        {
            // 返回上一个操作页面，并提示错误
            return back()->with('msg','This is Id does not exists!');
        }

        // 得到该id的信息
        $typeInfo = DB::table('shop_goods_type')
                      ->select('id','name','status')
                      ->where('id',$id)
                      ->first();

        // 返回一个视图，并且附带上一组数据，分别是分类信息和所有状态
        return view('Admin.type.edit_type',['typeInfo' => $typeInfo,'allStatus' => $this->getAllStatus()]);
    }

    // 编辑分类
    public function doEditType(Request $request) 
    {
        $id = intval($request->input('tid'));// 得到分类id

        $name = $request->input('name');// 得到分类名

        $oldStatus = intval($request->input('os'));// 得到编辑前的状态

        $status = intval($request->input('status'));// 得到当前状态

        $num;// 定义一个变量用于存储查询到的条数

        // 遍历checkType得到的数组对象，得到条数
        foreach (($this->checkType(['name' => $name])) as $v) 
        { 
            $num = $v;
        }

        if (intval($num)) // 判断条数
        {
            // 判断状态
            if (($this->selectType(['status'],['id' => $id]))[0] == $status) 
            {
                // 返回上一个操作页面，并提示错误信息
                return back()->with('msg','This type already exists!');
            }

        }

        if ($status <= 0) //判断状态是否存在
        {
            // 返回上一个操作页面，并提示错误信息
            return back()->with('msg','No type initial state has been selected!');

        }

        $viewname = 'type';// 存储默认路由

        if ($oldStatus == '2') // 根据编辑前的状态判断条状的路由
        {
            $viewname = 'restoreT';
        }

        // 设置需要更新的内容
        $num = ['id' => $id,'name' => $name,'status' => $status];

        // 获得受影响的行数
        $row = intval(DB::table('shop_goods_type')
                 ->where('id',$id)
                 ->update($num));

        // 判断得到的条数
        if (is_numeric($row)) 
        {
            // 跳转页面,并提示信息
            return redirect($viewname)->with('msg','This is type added success！');

        } else {
            // 返回上一个操作页面,并提示错误
            return back()->with('msg','This type is not added');

        }

    }

    // 禁用分类
    public function doDisabledType(Request $request) 
    {
        $tid = $request->input('id'); // 获得分类id

        $pid = $request->input('pid'); // 获得分类pid

        $path = $pid . ',' . $tid . ','; // 拼接path

        $num = ''; // 存储查询条数的变量

        if (!is_numeric($tid)) 
        {
            // 判断分类id是否存在
            return response()->json([
                        'code' => '2222',
                        'msg' => 'This is not a type-id.'
                    ]);
        }

        if (!is_numeric($pid)) 
        {
            // 判断分类pid是否正确
            return response()->json([
                        'code' => '2222',
                        'msg' => 'This is not a pid-id.'
                    ]);
        }

        // 遍历checkType得到的数组对象，得到条数
        foreach (($this->checkType(['path' => $path])) as $v) 
        { 
            $num = $v;
        }

        if (intval($num)) {//有子类，不能删除

            return response()->json([
                    'code' => '2333',
                    'msg' => 'There are other branches under this Type.'
                    ]);

        } else {//否则

            $row = intval(DB::table('shop_goods_type')
                            ->where('id',$tid)
                            ->update(['status' => 2]));//更新状态

            if (is_numeric($row)) {//返回数据

                return response()->json([//成功
                            'code' => '2444',
                            'msg' => 'Modify the success.'
                        ]);

            } else {

                return response()->json([//失败
                            'code' => '2555',
                            'msg' => 'Modify the failure.'
                        ]);

            }

        }

    }

    // 显示添加子分类页面
    // $tid    分类id        int
    public function showAddBranchFace(int $tid)
    {
        // 判断分类id是否存在
        if ($tid <= 0) 
        {
            // 返回上一个操作页面，并提示错误信息
            return back()->with('msg','This is Type-id does not exists!');
        }

        // 搜索出该id相对应的内容
        $info = DB::table('shop_goods_type')
                  ->select('name','pid','path')
                  ->where('id',$tid)
                  ->first();

        // 返回一个视图，并且附带上一组数据，分别是父分类内容、父分类的id和所有的状态
        return view('Admin.type.add_branch',['info' => $info,'tid' => $tid,'allStatus' => $this->getAllStatus()]);

    }

    // 添加子分类
    public function doAddBranchType(Request $request) 
    {
        $name = $request->input('name'); // 获取子分类的分类名

        $status = $request->input('status'); // 获得子分类的初始状态

        $pid = intval($request->input('pid')); // 获取分类的pid

        if ($pid != 0)// 判断父分类的pid
        {
            return back()->with('msg','This is type not a parent of type');
        }

        if (!is_numeric($status)) // 判断状态是否存在
        {
            return back()->with('msg','This is status does not exists.');// 返回的错误信息

        } else {

            $status = intval($status);// 转换成int类型

        }

        $path = $request->input('path') . ($request->input('tid')) . ','; // 拼接子分类的path

        $num;

        // 遍历checkType得到的数组对象，得到条数
        foreach (($this->checkType(['name' => $name])) as $v)
        { 
            $num = intval($v);
        }

        // 判断条数
        if ($num > 0) 
        {
            // 若条数大于0，则表示该子分类已存在
            return back()->with('msg','This is branch type already exists!');

        } else {

            // 设置添加的内容
            $item = ['name' => $name,'pid' => 1,'path' => $path,'status' => 1];

            if ($num == 0) // 等于0表示不存在，可以添加
            {
                // 获得受影响的行数
                $row = intval(DB::table('shop_goods_type')->insert($item));

                if ($row) // 添加成功
                {
                    // 跳转页面，并提示信息
                    return redirect('type')->with('msg','The branch of type added successful!');
                    
                } else {

                    // 返回上一个操作页面，并提示错误信息
                    return back()->with('msg','The branch of type operation is failed!');

                }

            } else { // 当小于0的时候，定义为非法

                return back()->with('msg','Error,the operation of illegal!');

            }

        }

    }

    // 改变分类状态
    public function changeTypeStatus(Request $request) 
    {
        $id = intval($request->input('tid'));// 获得分类id

        $status = intval($request->input('status'));// 获得分类的状态

        if ($status <= 0) // 判断状态是否存在
        {
            // 诺不存在，则返回上一个操作页面，并提示信息
            return back()->with('msg','This status of type is does not exists!');
        }

        $status = ($status == 1 ? 2 : 1);// 重复值状态值

        // 获得受影响的行数
        $row = intval(DB::table('shop_goods_type')
                        ->where('id',$id)
                        ->update(['status' => $status]));

        if ($row) // 判断
        {
            //成功
            return response()->json([
                        'code' => "666",
                        'status' => $status,
                        'msg' => 'Successful state modification!'
                    ]);
        }
        //错误
        return response()->json([
                    'code' => '777',
                    'status' => $status,
                    'msg' => 'Modify the failure!'
                ]);

    }

    // 批量禁用
    public function doDisabledAllType(Request $request) 
    {
        // 获取批量禁用的所有分类的id
        $ids = explode('-',($request->input('id')));

        // 检查禁用的分类下是否存在有商品
        $hasGoods = (DB::table('shop_goods')
                       ->selectRaw('count(*)')
                       ->whereIn('id',$ids)
                       ->get())[0];

        // 得到分类下有商品的条数
        foreach ($hasGoods as $v)
        {
            $hasGoods = $v;
        }

        // 判断条数是否大于0,大于就是提示
        if ($hasGoods > 0) 
        {
            return response()->json([
                        'code' => '999',
                        'msg' => 'There are goods under this type.'
                    ]);
        }

        // 得到$ids这个数组里所对应的所有id的所有path的数组
        $data = DB::table('shop_goods_type')
                     ->select(['id','path'])
                     ->whereIn('id',$ids)
                     ->get();

        // 转换成数组
        $arr = json_decode(json_encode($data),true);

        // 用于存储path的空数组
        $str = [];

        // 拼接path并且赋值给str数组与其相同下标的另一个数组
        foreach ($arr as $k => $v) 
        { 
            $str[$k] = $v['path'].$v['id'].',';
        }

        // 判断是否存在子分类
        $hasBranch = DB::table('shop_goods_type')
                       ->select('path')
                       ->whereIn('path',$str)
                       ->get();

        if (count($hasBranch) > 0) // 当该数组的个数超过0，表示存在同类分支
        {
            // 提示存在子分类
            return response()->json([
                        'code' => '888',
                        'msg' => 'There are other branches under this type.'
                    ]);
        }

        // 禁用$ids数组中所包含的所有id相对应的分类
        $row = intval(DB::table('shop_goods_type')
                        ->whereIn('id',$ids)
                        ->update(['status' => 2]));

        if ($row) // 判断受影响行数
        {
            // 成功
            return response()->json([
                        'code' => '666',
                        'msg' => 'The operation was successfully executed.',
                    ]);
        }

        // 失败
        return response()->json([
                    'code' => '777',
                    'msg' => 'The operation of enforced is failed.'
                ]);

    }

    // 显示与搜索禁用的分类
    public function indexWithSearch(Request $request) 
    {
        // 搜索内容
        $searchInfo = $request->input('type_name');

        // 默认的条件
        $item = [
            ['status',2],
        ];

        // 判断搜索内容是否为纯数字
        if (is_numeric($searchInfo)) 
        {
            // 是纯数字就转换为int类型
            $id = intval($searchInfo);
            $item[1] = ['id','like',"%$id%"];// 添加搜索条件

        } else {
            // 判断是否为空，是空则使用默认的条件，否则插入条件
            if (!empty($searchInfo)) 
            {
                $item[1] = ['name','like',"%$searchInfo%"];
            }
        }

        // 查询分页结果
        $ts = DB::table('shop_goods_type')
                ->select('id','name','pid','path','status')
                ->where($item)
                ->paginate(8);

        // 返回一个视图，并附带上一组数据，分别是所有禁用的分类和搜索条件
        return view('Admin.type.restore',['allDisabledTypes' => $ts,'searchInfo' => $searchInfo]);
    }

    // 删除禁用的分类
    public function deleteDisabledType(Request $request) 
    {
        $id = $request->input('tid');// 获得分类id

        // 判断分类id是否为数字
        if (!is_numeric($id)) 
        {
            return response()->json([
                        'code' => '777',
                        'msg' => 'This is not a type-id.'
                    ]);
        }

        $id = intval($id);// 转换为int类型

        // 判断id是否存在
        if ($id <= 0) 
        {
            return response()->json([
                        'code' => '888',
                        'msg' => 'This type-id is does not exists.'
                    ]);
        }

        // 得到受影响的行数
        $row = intval(DB::table('shop_goods_type')
                        ->where('id',$id)
                        ->delete());

        if ($row) // 判断是否成功删除
        {//成功
            return response()->json([
                        'code' => '666',
                        'msg' => 'Successful delete operation.'
                    ]);

        } else {
            // 失败
            return response()->json([
                        'code' => '233',
                        'msg' => 'The operation failure.'
                    ]);
        }
    }

    // 批量恢复
    public function restoreAllDisabledData(Request $request) 
    {
        $ids = explode('-',($request->input('id')));// 获得恢复的所有分类的id

        // 得到受影响的行数
        $rows = intval(DB::table('shop_goods_type')
                         ->whereIn('id',$ids)
                         ->update(['status' => 1]));

        if ($rows == 0) {// 未修改成功

            return response()->json([
                        'code' => '699',
                        'msg' => 'Error,Please select modify item first.'
                    ]);
        }

        // 修改成功
        return response()->json([
                    'code' => '666',
                    'msg' => 'Modify to be executed.'
                ]);
    }

}
