<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

/**
 *  function    �������ģ��
 *  author      Xĳ��
 *  e-mail      xxx@qq.com
 */
class TypeController extends Controller
{
    // ����������õĿ�����״̬
    public function getAllStatus() 
    {
        $allStatus = DB::table('shop_goods_statusInfo')
                   ->where('status',1)
                   ->get();

        return $allStatus;
    }

    // ����Ƿ���ڸ÷���
    // $field      ����       string
    public function checkType(array $field) 
    {
        $obj =  DB::table('shop_goods_type')
                  ->selectRaw('count(*)')
                  ->where($field)
                  ->first();

        return json_decode(json_encode($obj),true);//����һ������
    }

    // �õ�ָ��where������ָ����ѯ�ֶεķ�����Ϣ
    // $field      ����      string
    // $condition     ����      string
    public function selectType(array $field,array $condition) 
    {
        $str = '';//��ʼ�ֶ�

        //ƴ���������ֶ�
        for ($i = 0; $i < count($field); $i++) { 
            $str .= $field[$i];
            if ($i != count($field)-1) {
                $str .= ',';
            }
        }

        // �õ�һ�������������ݵ�����
        $obj = DB::table('shop_goods_type')
                 ->selectRaw($str)
                 ->where($condition)
                 ->get();

        return json_decode(json_encode($obj),true);//����һ������
    }

    // ��ʾ�����б���ṩ��������
    public function showWithSearch(Request $request)
    {
        $searchInfo = $request->input('type_info');//�����������

        // Ĭ�ϵ���������
        $item = [
            ['status',1]
        ];

        // �ж����������Ƿ�����
        if (is_numeric($searchInfo)) {

            $id = intval($searchInfo);//ת��Ϊint����

            $item[1] = ['id',"$id"];//���뵽Ĭ������������

        } else {

            // �ж��õ������������Ƿ�Ϊ�գ�
            // ������Ĭ�ϵ������������������е�ͬ�����ݣ�
            // ����ͬ�ϣ�����Ĭ�ϵ�����������������
            if (!empty($searchInfo)) {

                $item[1] = ['name','like',"%$searchInfo%"];
            }
        }

        // �õ���ҳ�����Լ������������
        // ʹ��laravel����ṩ��ԭ�������ݿ���䣬�������������
        $allTypes = DB::table('shop_goods_type')
                      ->select(['id','name','pid','path','status'])
                      ->where($item)
                      ->orderByRaw("concat(path,id)") 
                      ->paginate(10);

        // ����һ����ͼ�����Ҹ�����һ�����ݣ��ֱ������еķ������������
        return view('Admin.type.type',['allTypes' => $allTypes,'searchInfo' => $searchInfo]);
    }

    // ��ʾ��ӷ���ҳ��
    public function showAddFace() 
    {
        // ����һ����ͼ�����Ҹ�����һ���������飬������õ����е�����
        return view('Admin.type.add_type',['allStatus' => $this->getAllStatus()]);
    }

    // ��ӷ���
    public function doAddType(Request $request) 
    {   
        $name = $request->input('name');// ��÷�����
        $status = $request->input('status');// ��÷����ʼ״̬

        $num;// ����һ�����������ڴ洢checkType�õ�����������

        if (intval($status) <= 0) 
        {
            // �Եõ����µķ����״̬������֤��С�ڵ���0�򲻴���
            // ������һ������ҳ�棬����ʾ������Ϣ
            return back()->with('msg','No type initial state has been selected!');
        }

        //��checkType���ص�������б���
        foreach (($this->checkType(['name' => $name])) as $v) 
        { 
            $num = $v;// ��ֵ��$num
        }

        // ��$num��õ����������������ж�
        if (intval($num)) 
        {
            // ����0�Ķ��Ǳ�ʾ���ڣ����Է�����һ������ҳ�沢��ʾ����
            return back()->with('msg','This type already exists!');

        }
           
        $item = ['name' => $name,'status' => $status];// ����Ĭ������
       
        $row = DB::table('shop_goods_type')->insert($item);// �õ���Ӱ�������

        if (intval($row)) // �ж�����
        {
            // ��תҳ�棬��ʾ�ɹ�
            return redirect('type')->with('Add type success!');

        } else {
            // ������һ������ҳ�棬����ʾ����
            return back()->with('msg','Add type failure!');

        }
        
    }

    // ��ʾ�༭ҳ��
    public function showEditFace(int $id) 
    {
        // �ж�$id�Ƿ����
        if ($id <= 0 )
        {
            // ������һ������ҳ�棬����ʾ����
            return back()->with('msg','This is Id does not exists!');
        }

        // �õ���id����Ϣ
        $typeInfo = DB::table('shop_goods_type')
                      ->select('id','name','status')
                      ->where('id',$id)
                      ->first();

        // ����һ����ͼ�����Ҹ�����һ�����ݣ��ֱ��Ƿ�����Ϣ������״̬
        return view('Admin.type.edit_type',['typeInfo' => $typeInfo,'allStatus' => $this->getAllStatus()]);
    }

    // �༭����
    public function doEditType(Request $request) 
    {
        $id = intval($request->input('tid'));// �õ�����id

        $name = $request->input('name');// �õ�������

        $oldStatus = intval($request->input('os'));// �õ��༭ǰ��״̬

        $status = intval($request->input('status'));// �õ���ǰ״̬

        $num;// ����һ���������ڴ洢��ѯ��������

        // ����checkType�õ���������󣬵õ�����
        foreach (($this->checkType(['name' => $name])) as $v) 
        { 
            $num = $v;
        }

        if (intval($num)) // �ж�����
        {
            // �ж�״̬
            if (($this->selectType(['status'],['id' => $id]))[0] == $status) 
            {
                // ������һ������ҳ�棬����ʾ������Ϣ
                return back()->with('msg','This type already exists!');
            }

        }

        if ($status <= 0) //�ж�״̬�Ƿ����
        {
            // ������һ������ҳ�棬����ʾ������Ϣ
            return back()->with('msg','No type initial state has been selected!');

        }

        $viewname = 'type';// �洢Ĭ��·��

        if ($oldStatus == '2') // ���ݱ༭ǰ��״̬�ж���״��·��
        {
            $viewname = 'restoreT';
        }

        // ������Ҫ���µ�����
        $num = ['id' => $id,'name' => $name,'status' => $status];

        // �����Ӱ�������
        $row = intval(DB::table('shop_goods_type')
                 ->where('id',$id)
                 ->update($num));

        // �жϵõ�������
        if (is_numeric($row)) 
        {
            // ��תҳ��,����ʾ��Ϣ
            return redirect($viewname)->with('msg','This is type added success��');

        } else {
            // ������һ������ҳ��,����ʾ����
            return back()->with('msg','This type is not added');

        }

    }

    // ���÷���
    public function doDisabledType(Request $request) 
    {
        $tid = $request->input('id'); // ��÷���id

        $pid = $request->input('pid'); // ��÷���pid

        $path = $pid . ',' . $tid . ','; // ƴ��path

        $num = ''; // �洢��ѯ�����ı���

        if (!is_numeric($tid)) 
        {
            // �жϷ���id�Ƿ����
            return response()->json([
                        'code' => '2222',
                        'msg' => 'This is not a type-id.'
                    ]);
        }

        if (!is_numeric($pid)) 
        {
            // �жϷ���pid�Ƿ���ȷ
            return response()->json([
                        'code' => '2222',
                        'msg' => 'This is not a pid-id.'
                    ]);
        }

        // ����checkType�õ���������󣬵õ�����
        foreach (($this->checkType(['path' => $path])) as $v) 
        { 
            $num = $v;
        }

        if (intval($num)) {//�����࣬����ɾ��

            return response()->json([
                    'code' => '2333',
                    'msg' => 'There are other branches under this Type.'
                    ]);

        } else {//����

            $row = intval(DB::table('shop_goods_type')
                            ->where('id',$tid)
                            ->update(['status' => 2]));//����״̬

            if (is_numeric($row)) {//��������

                return response()->json([//�ɹ�
                            'code' => '2444',
                            'msg' => 'Modify the success.'
                        ]);

            } else {

                return response()->json([//ʧ��
                            'code' => '2555',
                            'msg' => 'Modify the failure.'
                        ]);

            }

        }

    }

    // ��ʾ����ӷ���ҳ��
    // $tid    ����id        int
    public function showAddBranchFace(int $tid)
    {
        // �жϷ���id�Ƿ����
        if ($tid <= 0) 
        {
            // ������һ������ҳ�棬����ʾ������Ϣ
            return back()->with('msg','This is Type-id does not exists!');
        }

        // ��������id���Ӧ������
        $info = DB::table('shop_goods_type')
                  ->select('name','pid','path')
                  ->where('id',$tid)
                  ->first();

        // ����һ����ͼ�����Ҹ�����һ�����ݣ��ֱ��Ǹ��������ݡ��������id�����е�״̬
        return view('Admin.type.add_branch',['info' => $info,'tid' => $tid,'allStatus' => $this->getAllStatus()]);

    }

    // ����ӷ���
    public function doAddBranchType(Request $request) 
    {
        $name = $request->input('name'); // ��ȡ�ӷ���ķ�����

        $status = $request->input('status'); // ����ӷ���ĳ�ʼ״̬

        $pid = intval($request->input('pid')); // ��ȡ�����pid

        if ($pid != 0)// �жϸ������pid
        {
            return back()->with('msg','This is type not a parent of type');
        }

        if (!is_numeric($status)) // �ж�״̬�Ƿ����
        {
            return back()->with('msg','This is status does not exists.');// ���صĴ�����Ϣ

        } else {

            $status = intval($status);// ת����int����

        }

        $path = $request->input('path') . ($request->input('tid')) . ','; // ƴ���ӷ����path

        $num;

        // ����checkType�õ���������󣬵õ�����
        foreach (($this->checkType(['name' => $name])) as $v)
        { 
            $num = intval($v);
        }

        // �ж�����
        if ($num > 0) 
        {
            // ����������0�����ʾ���ӷ����Ѵ���
            return back()->with('msg','This is branch type already exists!');

        } else {

            // ������ӵ�����
            $item = ['name' => $name,'pid' => 1,'path' => $path,'status' => 1];

            if ($num == 0) // ����0��ʾ�����ڣ��������
            {
                // �����Ӱ�������
                $row = intval(DB::table('shop_goods_type')->insert($item));

                if ($row) // ��ӳɹ�
                {
                    // ��תҳ�棬����ʾ��Ϣ
                    return redirect('type')->with('msg','The branch of type added successful!');
                    
                } else {

                    // ������һ������ҳ�棬����ʾ������Ϣ
                    return back()->with('msg','The branch of type operation is failed!');

                }

            } else { // ��С��0��ʱ�򣬶���Ϊ�Ƿ�

                return back()->with('msg','Error,the operation of illegal!');

            }

        }

    }

    // �ı����״̬
    public function changeTypeStatus(Request $request) 
    {
        $id = intval($request->input('tid'));// ��÷���id

        $status = intval($request->input('status'));// ��÷����״̬

        if ($status <= 0) // �ж�״̬�Ƿ����
        {
            // ŵ�����ڣ��򷵻���һ������ҳ�棬����ʾ��Ϣ
            return back()->with('msg','This status of type is does not exists!');
        }

        $status = ($status == 1 ? 2 : 1);// �ظ�ֵ״ֵ̬

        // �����Ӱ�������
        $row = intval(DB::table('shop_goods_type')
                        ->where('id',$id)
                        ->update(['status' => $status]));

        if ($row) // �ж�
        {
            //�ɹ�
            return response()->json([
                        'code' => "666",
                        'status' => $status,
                        'msg' => 'Successful state modification!'
                    ]);
        }
        //����
        return response()->json([
                    'code' => '777',
                    'status' => $status,
                    'msg' => 'Modify the failure!'
                ]);

    }

    // ��������
    public function doDisabledAllType(Request $request) 
    {
        // ��ȡ�������õ����з����id
        $ids = explode('-',($request->input('id')));

        // �����õķ������Ƿ��������Ʒ
        $hasGoods = (DB::table('shop_goods')
                       ->selectRaw('count(*)')
                       ->whereIn('id',$ids)
                       ->get())[0];

        // �õ�����������Ʒ������
        foreach ($hasGoods as $v)
        {
            $hasGoods = $v;
        }

        // �ж������Ƿ����0,���ھ�����ʾ
        if ($hasGoods > 0) 
        {
            return response()->json([
                        'code' => '999',
                        'msg' => 'There are goods under this type.'
                    ]);
        }

        // �õ�$ids�������������Ӧ������id������path������
        $data = DB::table('shop_goods_type')
                     ->select(['id','path'])
                     ->whereIn('id',$ids)
                     ->get();

        // ת��������
        $arr = json_decode(json_encode($data),true);

        // ���ڴ洢path�Ŀ�����
        $str = [];

        // ƴ��path���Ҹ�ֵ��str����������ͬ�±����һ������
        foreach ($arr as $k => $v) 
        { 
            $str[$k] = $v['path'].$v['id'].',';
        }

        // �ж��Ƿ�����ӷ���
        $hasBranch = DB::table('shop_goods_type')
                       ->select('path')
                       ->whereIn('path',$str)
                       ->get();

        if (count($hasBranch) > 0) // ��������ĸ�������0����ʾ����ͬ���֧
        {
            // ��ʾ�����ӷ���
            return response()->json([
                        'code' => '888',
                        'msg' => 'There are other branches under this type.'
                    ]);
        }

        // ����$ids������������������id���Ӧ�ķ���
        $row = intval(DB::table('shop_goods_type')
                        ->whereIn('id',$ids)
                        ->update(['status' => 2]));

        if ($row) // �ж���Ӱ������
        {
            // �ɹ�
            return response()->json([
                        'code' => '666',
                        'msg' => 'The operation was successfully executed.',
                    ]);
        }

        // ʧ��
        return response()->json([
                    'code' => '777',
                    'msg' => 'The operation of enforced is failed.'
                ]);

    }

    // ��ʾ���������õķ���
    public function indexWithSearch(Request $request) 
    {
        // ��������
        $searchInfo = $request->input('type_name');

        // Ĭ�ϵ�����
        $item = [
            ['status',2],
        ];

        // �ж����������Ƿ�Ϊ������
        if (is_numeric($searchInfo)) 
        {
            // �Ǵ����־�ת��Ϊint����
            $id = intval($searchInfo);
            $item[1] = ['id','like',"%$id%"];// �����������

        } else {
            // �ж��Ƿ�Ϊ�գ��ǿ���ʹ��Ĭ�ϵ������������������
            if (!empty($searchInfo)) 
            {
                $item[1] = ['name','like',"%$searchInfo%"];
            }
        }

        // ��ѯ��ҳ���
        $ts = DB::table('shop_goods_type')
                ->select('id','name','pid','path','status')
                ->where($item)
                ->paginate(8);

        // ����һ����ͼ����������һ�����ݣ��ֱ������н��õķ������������
        return view('Admin.type.restore',['allDisabledTypes' => $ts,'searchInfo' => $searchInfo]);
    }

    // ɾ�����õķ���
    public function deleteDisabledType(Request $request) 
    {
        $id = $request->input('tid');// ��÷���id

        // �жϷ���id�Ƿ�Ϊ����
        if (!is_numeric($id)) 
        {
            return response()->json([
                        'code' => '777',
                        'msg' => 'This is not a type-id.'
                    ]);
        }

        $id = intval($id);// ת��Ϊint����

        // �ж�id�Ƿ����
        if ($id <= 0) 
        {
            return response()->json([
                        'code' => '888',
                        'msg' => 'This type-id is does not exists.'
                    ]);
        }

        // �õ���Ӱ�������
        $row = intval(DB::table('shop_goods_type')
                        ->where('id',$id)
                        ->delete());

        if ($row) // �ж��Ƿ�ɹ�ɾ��
        {//�ɹ�
            return response()->json([
                        'code' => '666',
                        'msg' => 'Successful delete operation.'
                    ]);

        } else {
            // ʧ��
            return response()->json([
                        'code' => '233',
                        'msg' => 'The operation failure.'
                    ]);
        }
    }

    // �����ָ�
    public function restoreAllDisabledData(Request $request) 
    {
        $ids = explode('-',($request->input('id')));// ��ûָ������з����id

        // �õ���Ӱ�������
        $rows = intval(DB::table('shop_goods_type')
                         ->whereIn('id',$ids)
                         ->update(['status' => 1]));

        if ($rows == 0) {// δ�޸ĳɹ�

            return response()->json([
                        'code' => '699',
                        'msg' => 'Error,Please select modify item first.'
                    ]);
        }

        // �޸ĳɹ�
        return response()->json([
                    'code' => '666',
                    'msg' => 'Modify to be executed.'
                ]);
    }

}
