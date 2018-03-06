<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Hash;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        



        //清空权限相关的数据表
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Permission::truncate();
        Role::truncate();
        User::truncate();
        DB::table('role_user')->delete();
        DB::table('permission_role')->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        //创建初始的管理员用户
        $wuxuying = User::create([
                'name' => '吴旭颖',
                'email' => '912667240@qq.com',
                'password' => bcrypt('123456'),
            ]);

        //创建初始的role(初始的角色设定)
        $admin = Role::create([
                'name' => 'super_admin',
                'display_name' => '超级管理员',
                'description' => '神一般的存在' 
            ]);

        //创建相应的初始权限
        $permissions = [
            [
                'name' => 'users_manage',
                'display_name' => '用户管理',
                'description' => '拥有对后台用户的管理权限',
            ],
            [
                'name' => 'orders_manage',
                'display_name' => '订单管理',
                'description' => '拥有对订单的管理权限',
            ],
            [
                'name' => 'goods_manage',
                'display_name' => '商品管理',
                'description' => '拥有对商品的管理权限',
            ],
            [
                'name' => 'carousel_figure_manage',
                'display_name' => '轮播图管理',
                'description' => '拥有对轮播图的管理权限',
            ],
            [
                'name' => 'member_manage',
                'display_name' => '会员管理',
                'description' => '拥有对前台会员的管理权限',
            ],
            [
                'name' => 'friends_line_manage',
                'display_name' => '友链管理',
                'description' => '拥有对友情链接的管理权限',
            ],
            [
                'name' => 'web_manage',
                'display_name' => '站点管理',
                'description' => '拥有对网站站点的管理权限',
            ],
            [
                'name' => 'evaluate_manage',
                'display_name' => '订单评价管理',
                'description' => '拥有对订单评价的管理权限',
            ],
    
        ];

        foreach ($permissions as $permission) {
            $manage_user = Permission::create($permission);
             //给角色赋予相应的权限
            $admin->attachPermission($manage_user);
        }
             
        //给用户赋予相应的角色
        $wuxuying->attachRole($admin);
    }

}
