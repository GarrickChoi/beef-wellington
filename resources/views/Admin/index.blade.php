<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台系统管理</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="{{asset('Admin/favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('Admin/css/font.css')}}">
	<link rel="stylesheet" href="{{asset('Admin/css/xadmin.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('Admin/js/xadmin.js')}}"></script>

</head>
<body>
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="https://www.baidu.com">后台管理系统</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav left fast-add" lay-filter="">
          <li class="layui-nav-item">
            <!-- <a href="javascript:;">+新增</a>
            <dl class="layui-nav-child"> 二级菜单
              <dd><a onclick="x_admin_show('资讯','http://www.baidu.com')"><i class="iconfont">&#xe6a2;</i>资讯</a></dd>
              <dd><a onclick="x_admin_show('图片','http://www.baidu.com')"><i class="iconfont">&#xe6a8;</i>图片</a></dd>
               <dd><a onclick="x_admin_show('用户','http://www.baidu.com')"><i class="iconfont">&#xe6b8;</i>用户</a></dd>
            </dl> -->
          </li>
        </ul>
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">{{$_SESSION['adminInfo']->name}}</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <!-- <dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')">个人信息</a></dd>
              <dd><a onclick="x_admin_show('切换帐号','http://www.baidu.com')">切换帐号</a></dd> -->
              <dd><a href="{{url('adminlogout')}}">退出登录</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item to-index"><a href="{{asset('/')}}">前台首页</a></li>
        </ul>
        
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
    <div class="left-nav">
      <div id="side-nav"> 
        <ul id="nav">
            @if(array_key_exists(1,$_SESSION['adminPermissionId']))
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe726;</i>
                    <cite>后台用户管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{url('adminuserlist')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>用户管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{{url('adminuserrole')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>角色管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{{url('adminpermission')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限管理</cite>
                        </a>
                    </li >
                </ul>
            </li>
            @endif
            @if(array_key_exists(5,$_SESSION['adminPermissionId'])) 
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>会员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{url('homeuser')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员列表</cite>    
                        </a>
                    </li >
                </ul>
            </li>
            @endif
            @if(array_key_exists(2,$_SESSION['adminPermissionId'])) 
             <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>订单管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{url('admin/order_index')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{{url('admin/order/create')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单操作</cite>
                            
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <!-- 友情链接：无崖子新添加 -->
            @if(array_key_exists(6,$_SESSION['adminPermissionId']))
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>友情链接</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{url('friendsline')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>链接列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            @endif
            <!-- 评价管理：无崖子新添加 -->
            @if(array_key_exists(8,$_SESSION['adminPermissionId']))
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>评价管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{url('evaluate')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>评价列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            @endif
            @if(array_key_exists(4,$_SESSION['adminPermissionId']) && array_key_exists(7,$_SESSION['adminPermissionId']) && array_key_exists(10,$_SESSION['adminPermissionId']))
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>网站管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">             
                    <li>
                        <a _href="{{url('seo')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>网站优化与信息</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="{{url('carousel')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>首页轮播图管理</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="{{url('adminSuggest')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>客户意见反馈</cite>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if(array_key_exists(3,$_SESSION['adminPermissionId']))
             <li>
                <a _href="javascript:;">
                    <i class="iconfont">&#xe6b4;</i>
                    <cite>商品相关操作</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont">&#xe6b5;</i>
                            <cite>商品管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a _href="{{url('allgoods')}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>商品列表</cite>
                                    
                                </a>
                            </li >
                            <li>
                                <a _href="{{url('addGoods')}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>添加商品</cite>
                                    
                                </a>
                            </li>
                            <li>
                                <a _href="javascript:;">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>商品分类</cite>
                             
                                </a>
                            </li>
                            <li>
                                <a _href="javascript:;">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>商品相册</cite>
                    
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a _href="javascript:;">
                                        <i style="width:400px;">　　</i>
                                            <cite>详情图片</cite>

                                        </a>
                                    </li >
                                    <li>
                                        <a _href="javascript:;">
                                        <i style="width:400px;">　　</i>
                                            <cite>展示图片</cite>
                                            
                                        </a>
                                    </li>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
                <!-- ------------------------------ -->
                <ul class="sub-menu">
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont">&#xe6b5;</i>
                            <cite>分类管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a _href="{{url('type')}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>分类列表</cite>
                                </a>
                            </li >
                            <li>
                                <a _href="{{url('addType')}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>添加分类</cite>  
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
                <!-- ------------------------------ -->
                <ul class="sub-menu">
                    <li>
                        <a _href="javascript:;">
                            <i class="iconfont">&#xe6b5;</i>
                            <cite>品牌管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a _href="{{url('brand')}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>品牌列表</cite>    
                                </a>
                            </li >
                            <li>
                                <a _href="{{url('addBS')}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>添加品牌</cite> 
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endif

        </ul>
      </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li>我的桌面</li>
          </ul>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='{{url("welcome")}}' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <div class="footer">
        <div class="copyright">Copyright ©2017 All Rights Reserved</div>  
    </div>
    <!-- 底部结束 -->
    
</body>
</html>