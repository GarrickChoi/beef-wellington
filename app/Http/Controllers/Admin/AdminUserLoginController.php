<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Hash;

class AdminUserLoginController extends Controller
{
    
    public function login()
    {

    	return view('Admin.AdminUser.login');

    }


    public function doLogin(Request $request)
    {

    	$name = $request->input('username');
    	$pwd = $request->input('password');

        // dump($name);die;
		$info = DB::table('users')->where('name', $name)->first();

    	if (!$info) {

            return response()->json([
                'code' => '111', 
                ]);

    	} 

        if ($info->status != 1) {
            return response()->json([
                'code' => '101',   
                ]);
        }

		if (Hash::check($pwd, $info->password)) {

			$role = DB::table('role_user')->where('user_id', $info->id)->first();
            //dd($role);
            //查询该用户所拥有的权限
            $rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$role->role_id)
            ->pluck('permission_role.permission_id','permission_role.permission_id');

            $rolePermissions = json_decode(json_encode($rolePermissions), true);

            $_SESSION['adminInfo'] = $info;
            $_SESSION['adminPermissionId'] = $rolePermissions;
            
            return response()->json([
                'code' => '200',
                ]);
		} else {

            return response()->json([
                'code' => '222',
                ]);
		}

    }

     public function logout()
    {
        
        unset($_SESSION['adminInfo']);
        return redirect('adminlogin');
        
    }
    
}

/*$rolePermissions = array_column($rolePermissions, 'permission_id');

            $rolePermissions = DB::table('permissions')
                            ->whereIn('id', $rolePermissions)
                            ->pluck('name');
                            
            $rolePermissions = json_decode(json_encode($rolePermissions), true);

            $rolePermissions = array_flip($rolePermissions);*/