<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use DB;
use App\Http\Requests\CheckRoleAdd;
use App\Http\Requests\CheckRoleEdit;

class AdminUserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $roles = Role::orderBy('id')->paginate(5);
        return view('Admin.AdminUser.role_list',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(1);
        $permission = Permission::get();
        return view('Admin.AdminUser.admin_role_add',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckRoleAdd $request)
    {
        //dd('111');
        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();
 
        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }
 
        return redirect('adminuserrole')->with('success','添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd('123');
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$id)
            ->pluck('permission_role.permission_id','permission_role.permission_id');
        //dd($rolePermissions);    
        $rolePermissions = json_decode(json_encode($rolePermissions), true);
        
        return view('Admin.AdminUser.admin_role_edit',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckRoleEdit $request, $id)
    {
        //dd($id);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();
 
        DB::table("permission_role")->where("permission_role.role_id",$id)
            ->delete();
 
        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }
 
        return redirect('adminuserrole')->with('success','编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd('123');
        DB::table("roles")->where('id',$id)->delete();
        return redirect('adminuserrole')->with('success','删除角色成功');
    }
}
