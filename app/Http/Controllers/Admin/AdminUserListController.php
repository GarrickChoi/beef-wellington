<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use DB;
use Hash;
use App\Http\Requests\CheckUserAdd;
use App\Http\Requests\CheckUserEdit;

class AdminUserListController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return '123';

        $data = DB::table('users')
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.*', 'roles.display_name')
            ->paginate(5);
        //dd($data);    
        return view('Admin.AdminUser.user_list', ['list' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name','id');
        //dd($roles);
        return view('Admin.AdminUser.admin_user_add',compact('roles'));
        //return view('Admin.AdminUser.admin_user_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckUserAdd $request)
    {
 
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        
        //dd($input);
        $user = User::create($input);
        foreach (array($request->input('roles')) as $key => $value) {
            $user->attachRole($value);
        }
 
        return redirect('adminuserlist')->with('success','用户添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        $roles = Role::pluck('display_name','id');
        //dd($roles);
        $userRole = $user->roles->pluck('id','id')->toArray();
        //dd($userRole);
        $userRole = json_decode(json_encode($userRole), true);
        return view('Admin.AdminUser.admin_user_edit', compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckUserEdit $request, $id)
    {
        //return 'update';
        //dd('edit');
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }
 
        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id',$id)->delete();
 
         
        foreach (array($request->input('roles')) as $key => $value) {
            $user->attachRole($value);
        }
 
        return redirect('adminuserlist')->with('success','编辑用户成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('adminuserlist')->with('success','删除用户成功');
    }


    /**
     * 处理搜索
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //拿到搜索数据
        $keyword = $request->input('keyword');

        //return $keyword;
        //对user表进行分页，每页显示1条
        /*$data = DB::table('users')->select(['id', 'name', 'email', 'created_at', 'updated_at'])
        ->where('name', 'like', "%$keyword%")
        ->paginate(1);*/

        $data = DB::table('users')
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.*', 'roles.display_name')
            ->where('users.name', 'like', "%$keyword%")
            ->paginate(5);
        
        return view('Admin.AdminUser.user_list', ['list' => $data, 'key' => $keyword]);

    }

    public function welcome() {

        return view('Admin.welcome');

    }
}

