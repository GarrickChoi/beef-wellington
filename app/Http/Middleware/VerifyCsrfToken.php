<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'adminuserstatus',
        'adminusersdel',
        'admindologin',
        'adminuserlist',
        'adminuserrole',
        'adminpermission',
        'changestatus',
        'userdelete',
        'home/dologin',
        'home/doregister',
        'home/dousernameregister',
        'home/dopasswordregister',
        'home/dorepasswordregister',
        'home/checkpyzm',
        'home/check_phone',
        'home/getcaptcha',
        'home/check_captcha',
        'home/resetpass',
        'home/editpass',
        'changeBS',
        'doEditBS',
        'searchBS',
        'deleteBS',
        'doEditBS',
        'doAddBS',
        'restoreBS',
        'doEditRestoreData',
        'type',
        'addTopLevelType',
        'editType',
        'editBranchType',
        'deleteType',
        'addBranchType',
        'changeTS',
        'editTypes',
        'addNewGoods',
        'editGoodsInfo',
        //修改订单状态
        'admin/order_change',

        //修改默认地址状态
        'home/address_edit',

        //删除地址
        'home/address_del',

        //更改图片验证码
        'code_alter',

        //接受邮箱验证码
        'home/email_code',

        //购物车加减操作
        'home/shopcar_operate',

        //购物车的删除操作
        'home/shopcar_delete'
    ];
}
