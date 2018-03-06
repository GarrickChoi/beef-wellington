<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Nowmiddleware create something great!
|
*/

/*Route::get('/', function () {
    return 'welcome';
});*/




//验证用户登录中间件--无崖子
Route::group(['middleware'=>['check.admin.login']], function () {

	//显示后台主页--无崖子
	Route::get('/AdminIndex', function () {
   	 return view('Admin.index');
	}); 
	//后台用户管理控制器--无崖子
	Route::resource('adminuserlist', 'Admin\AdminUserListController');
	//后台角色管理控制器--无崖子
	Route::resource('adminuserrole', 'Admin\AdminUserRoleController');
	//后台权限管理控制器--无崖子
	Route::resource('adminpermission', 'Admin\AdminPermissionController');	
	//处理管理用户列表搜索--无崖子
	Route::get('adminuserlist', 'Admin\AdminUserListController@search');
	//处理后台用户状态--无崖子
	Route::get('adminuserstatus', 'Admin\AdminUserStatusController@doStatus');
	//后台首页welcome--无崖子
	Route::get('welcome', 'Admin\AdminUserListController@welcome');

	//友情链接--星宿老怪
	Route::resource('friendsline', 'Admin\Friendsline');
	Route::get('list', 'Admin\Paging@userList');
	//评价管理--星宿老怪
	Route::resource('evaluate', 'Admin\EvaluateController');
	Route::get('evaluatelist', 'Admin\Paging@evaluateList');
	Route::get('status', 'Admin\Paging@status');

	//测试路由，控制器，用命名空间--蔡锦源
	Route::namespace('Admin')->group(function () { //后缀路由	
		//中间件路由	
		Route::get('index','TestController@index');

		Route::get('select','TestController@select');
		//提交
		Route::post('index','TestController@insert');
		//测试提交成功
		Route::get('insert','TestController@insert');
		//测试模板引擎
		Route::get('list','TestController@list');
		//ajax路由
		Route::get('edit','TestController@edit');
		//跳转页面路由和约束传参
		Route::get('doedit/{uid}','TestController@doedit')->where('uid','[0-9]+ ');
		Route::get('login','TestController@login');
		//seo管理路由
		Route::resource('seo','SeoController');
		//轮播图管理路由
		Route::resource('carousel','CarouselController');
		//ajax路由
		Route::get('ajax','AjaxController@seo');
		//意见反馈路由
		Route::get('adminSuggest','SuggestController@index');
		//操作意见反馈路由
		Route::get('doSuggest/{id}','SuggestController@doedit');
		//意见反馈ajax
		Route::get('ajaxSuggest','SuggestController@doajax');
	});

	//在后台前台用户的列表控制器--欧惠球
	Route::namespace('Admin')->group(function () {
		//显示普通用户列表
		Route::get('homeuser', 'HomeUserController@userList');
		//显示添加普通用户页面
		Route::get('useradd', 'HomeUserController@userAdd');
		//处理修改普通用户状态的路由
		Route::get('changestatus', 'HomeUserController@changeStatus');
		//删除普通用户的路由
		Route::get('userdelete', 'HomeUserController@userDelete');
		//编辑普通用户的路路由
		Route::get('useredit/{uid}', 'HomeUserController@userEdit')->where('uid', '[0-9]+');
		//处理编辑普通用户的路由
		Route::post('douseredit', 'HomeUserController@doEdit');
	});

	// Brand management module ---- 品牌管理模块--张浩航
	Route::namespace('Admin')->group(function() {
	    //显示品牌列表
	    Route::get('brand','BrandController@indexWithSearch');
	    //禁用所有品牌
	    Route::get('disabledAllBrand','BrandController@doDisabledAllBrands');
	    //改变品牌状态
	    Route::get('changeBS','BrandController@changeStatus');
	    //显示编辑页面
	    Route::get('editBS/{id}','BrandController@showBrandInfo')->where('id','[0-9]+');
	    //编辑品牌
	    Route::post('doEditBS','BrandController@editBrandInfo');
	    //删除品牌
	    Route::get('deleteBS/{id}','BrandController@deleteBrandInfo')->where('id','[0-9]+');
	    //显示添加页面
	    Route::get('addBS','BrandController@showAdd');
	    // 添加品牌
	    Route::post('doAddBS','BrandController@addBrandInfo');
	    // 根据初始状态跳转页面
	    Route::get('skipFace/{status}','BrandController@skipFaces')->where('status','[0-9]+');
	    // 显示禁用列表 
	    Route::get('restoreBS','BrandController@showWithSearchAllDisableData');
	    // 显示禁用的品牌
	    Route::get('editRestoreData/{id}','BrandController@showRestoreBrandData')->where('id','[0-9]+');
	    // 编辑禁用品牌
	    Route::post('doEditRestoreData','BrandController@doEditRestoreData');
	    // 删除品牌
	    Route::get('deleteRestoreData','BrandController@doDeleteRestoreData');
	    // 恢复数据
	    Route::get('restoreAllData','BrandController@restoreAllData');
	});
	
	//商品分类路由--张浩航
	Route::namespace('Admin')->group(function() {
	    // 显示分类列表
	    Route::get('type','TypeController@showWithSearch');
	    // 显示添加页面
	    Route::get('addType','TypeController@showAddFace');
	    // 显示添加子分类页面
	    Route::post('addTopLevelType','TypeController@doAddType');
	    // 显示编辑页面
	    Route::get('editType/{id}','TypeController@showEditFace')->where('id','[0-9]+');
	    // 编辑子分类
	    Route::post('editTypes','TypeController@doEditType');
	    // 禁用分类
	    Route::get('deleteType','TypeController@doDisabledType');
	    // 根据父类添加子分类
	    Route::get('addBranch/{id}','TypeController@showAddBranchFace')->where('id','[0-9]+');
	    // 添加子分类
	    Route::post('addBranchType','TypeController@doAddBranchType');
	    // 改变分类状态
	    Route::get('changeTS','TypeController@changeTypeStatus');
	    // 禁用所有分类
	    Route::get('disabledAllType','TypeController@doDisabledAllType');
	    // 显示分类禁用列表 
	    Route::get('restoreT','TypeController@indexWithSearch');
	    // 删除禁用
	    Route::get('deleteT','TypeController@deleteDisabledType');
	    // 恢复禁用
	    Route::get('restoreAllDisabledData','TypeController@restoreAllDisabledData');
	});
	
	//商品模块路由--张浩航
	Route::namespace('Admin')->group(function() {
	    // 显示商品列表
	    Route::get('allgoods','GoodsController@showWithSearchGoods');
	    // 显示添加页面
	    Route::get('addGoods','GoodsController@showAddFace');
	    // 添加新商品
	    Route::post('addNewGoods','GoodsController@doAddNewGoods');
	    // 改变商品状态
	    Route::get('changeGoods','GoodsController@doChangeGoods');
	    // 禁用商品
	    Route::get('disabledAllGoods','GoodsController@doDisabledAllGoods');
	    // 显示编辑页面
	    Route::get('editGoods/{id}','GoodsController@showEditFace')->where('id','[0-9]+');
	    // 编辑商品
	    Route::post('editGoodsInfo','GoodsController@doEditeGoods');
	    // 禁用商品
	    Route::get('disabledGoods','GoodsController@doDisabledGoods');
	    // 显示商品禁用列表
	    Route::get('restoreG','GoodsController@indexWithSearch');
	    // 删除禁用商品
	    Route::get('deleteG/{id}','GoodsController@doDeleteGoods')->where('id','[0-9]+');
	    // 恢复禁用商品
	    Route::get('restoreAllDisabled','GoodsController@doRestoreAllDisabled');
	    // 显示商品分类管理
    	Route::get('manageGT/{id}/{pid}','GoodsController@showManageFace')->where('id','[0-9]+');
	});

	//显示订单列表页面--古焰祥
	Route::get('admin/order_index', 'Admin\OrderController@index');
	//显示订单详情页面--古焰祥
	Route::get('admin/order_detail/{oid}', 'Admin\OrderController@orderDetail');
	//修改订单状态为发货--古焰祥
	Route::get('admin/order_change', 'Admin\OrderController@orderChange');
				
});

//跳转至后台用户登录--无崖子
Route::get('adminlogin', 'Admin\AdminUserLoginController@login');
//跳转至处理后台登录数据--无崖子 
Route::post('admindologin', 'Admin\AdminUserLoginController@doLogin');
//后台管理人员退出登录--无崖子
Route::get('adminlogout', 'Admin\AdminUserLoginController@logout');
//权限与验证登录--无崖子
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');




/*=============================================前台路由==================================================*/

//跳转至商品列表页--无崖子
Route::get('/Home/list', 'Home\ListController@list');
//处理商品搜索--无崖子
Route::get('/Home/search', 'Home\ListController@search');

//商品详情--星宿老怪
Route::get('detail', 'Home\DetailController@detail');
Route::get('Stock', 'Home\DetailController@Stock');

//网站首页--蔡锦源
Route::get('/','Home\HomeController@index');
//网站后台个人中心我的消息--蔡锦源
Route::get('news','Home\PersonController@news');
Route::post('news','Home\PersonController@newsAjax');
//显示反馈详情--蔡锦源
Route::get('blog/{id}','Home\PersonController@blog')->where('id', '[0-9]+');
//网站后台个人中心意见反馈--蔡锦源
Route::get('suggest','Home\PersonController@suggest');
Route::post('suggest','Home\PersonController@doSuggest');
//首页抢购ajax请求数据--蔡锦源
Route::get('sale','Home\HomeController@saleAjax');
//处理抢购路由--蔡锦源
Route::get('dosale/{id}','Home\HomeController@dosale');
//测试ajax--蔡锦源
//Route::post('aa','Home\HomeController@testAjax');
//首页one的ajax请求--蔡锦源
Route::get('one','Home\HomeController@oneAjax');
//首页two的ajax请求--蔡锦源
Route::get('two','Home\HomeController@twoAjax');
//首页地下瀑布流
Route::get('under','Home\HomeController@under');
//首次加载选项卡
Route::get('f1','Home\HomeController@f1Ajax');


//命名空间'Home'前缀，前台用户登录注册--欧惠球
Route::namespace('Home')->group(function () {

	// 路由名前缀
	Route::prefix('home')->group(function () {
	// 前台登录页面
	Route::get('login', 'HomeUserLoginController@login');
	// 处理前台登录
	Route::post('dologin', 'HomeUserLoginController@doLogin');
	// 前台注册页面
	Route::get('register', 'HomeUserRegisterController@register');
	// 图片验证码的路由
	Route::get('getcaptcha', 'Captcha\CaptchaController@buildCode');
	// 处理前台用户名注册
	Route::get('dousernameregister', 'HomeUserRegisterController@doUsernameRegister');
	// 处理前台用户密码
	Route::post('dopasswordregister', 'HomeUserRegisterController@doPasswordRegister');
	// 处理前台用户再次输入密码
	Route::post('dorepasswordregister', 'HomeUserRegisterController@doRepasswordRegister');
	// 处理前台用户输入手机号
	Route::get('dophoneregister', 'HomeUserRegisterController@doPhoneRegister');
	// 处理前台注册获取手机验证码的路由
	Route::get('getpyzm', 'HomeUserRegisterController@getPhoneYzm');
	// 处理前台所有资料注册、手机验证码与手机是否匹配
	Route::post('doregister', 'HomeUserRegisterController@doRegister');
	});
});

// 忘记密码显示验证手机页面--欧惠球
Route::get('home/forgotpass', 'Home\ForgotPasswordController@showBindPhone');
// 找回密页面的验证手机--欧惠球
Route::get('home/check_phone', 'Home\ForgotPasswordController@checkPhone');
// 找回密码页面的发送手机验证码--欧惠球
Route::get('home/getcaptcha', 'Home\ForgotPasswordController@getCaptcha');
// 找回密码判断手机与短信验证码--欧惠球
Route::post('home/check_captcha', 'Home\ForgotPasswordController@checkCaptcha');
// 显示重置密码页面--欧惠球
Route::get('home/resetpass/{phone}', 'Home\ForgotPasswordController@showResetPass');
// 处理修改密码--欧惠球
Route::post('home/editpass', 'Home\ForgotPasswordController@savePass');



//显示地址页面--古焰祥
Route::get('home/address', 'Home\AddressController@index');
//处理添加地址--古焰祥
Route::post('home/address_add', 'Home\AddressController@addressAdd');
//处理改变默认的收货地址--古焰祥
Route::post('home/address_edit', 'Home\AddressController@addressEdit');
//处理删除地址--古焰祥
Route::post('home/address_del', 'Home\AddressController@addressDel');
//处理修改地址--古焰祥
Route::get('home/address_alter{id}', 'Home\AddressController@addressAlter')->where('id', '[0-9]+');
//处理真正的修改地址--古焰祥
Route::post('home/address_doalter', 'Home\AddressController@addressDoAlter');
//显示个人首页--古焰祥
Route::get('home/person', 'Home\InformationController@index');
//显示个人信息页面--古焰祥
Route::get('home/information', 'Home\InformationController@information');
//显示个人头像--古焰祥
Route::post('home/alter_pic', 'Home\InformationController@alterPic');
//设置安全设置页面--古焰祥
Route::get('home/safety', 'Home\InformationController@safety');
//修改密码页面--古焰祥
Route::get('home/password_edit', 'Home\InformationController@passwordEdit');
//修改做真正的密码修改--古焰祥
Route::post('home/do_password_edit', 'Home\InformationController@doPasswordEdit');
//修改邮箱页面--古焰祥
Route::get('home/email_edit', 'Home\InformationController@emailEdit');
//修改做真正的邮箱修改--古焰祥
Route::post('home/do_email_edit', 'Home\InformationController@doEmailEdit');
//发送邮箱的验证码--古焰祥
Route::any('home/email_code', 'TextContoller@mail');
//手机验证的页面--古焰祥
Route::get('home/bind_phone', 'Home\InformationController@bindPhoneCode');
//生成图片验证码的路由--古焰祥
Route::get('code', 'Common\Common@buildCode');
//邮箱验证的--古焰祥
Route::any('mail/send','Home\InformationController@send');
//测试session--古焰祥
Route::get('home/test', 'Home\ShopcarController@test');
//在商品详情页点击加入购物车--古焰祥
Route::get('home/detail_shopcar_add', 'Home\ShopcarController@detailShopcarAdd');
//购物车页面--古焰祥
Route::get('home/shopcar', 'Home\ShopcarController@shopcar');
//购物车的加减操作--古焰祥
Route::post('home/shopcar_operate', 'Home\ShopcarController@shopcarOperate');
//购物车的删除--古焰祥
Route::post('home/shopcar_delete', 'Home\ShopcarController@shopcarDelete');
//结算页面--古焰祥
Route::post('home/order', 'Home\OrderController@order');
//未付款页面--古焰祥
Route::post('home/no_pay', 'Home\OrderController@noPay');
//付款完成页面--古焰祥
Route::get('home/pay_over', 'Home\OrderController@payOver');
//订单列表页面--古焰祥
Route::get('home/order_list', 'Home\OrderController@orderList');
//处理订单状态的--古焰祥
Route::get('home/order_status_change/{oid}', 'Home\OrderController@orderStatusChange');





//前台检查是否登陆的中间件--欧惠球
Route::middleware(['check.homeuser.login'])->group(function () {

	// 这里面写登录才能访问的路由

});

