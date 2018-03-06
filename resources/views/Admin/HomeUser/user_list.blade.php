<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('Admin/favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('Admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/css/xadmin.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('Admin/js/xadmin.js')}}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" action="{{url('homeuser')}}" method="get">
          {{csrf_field()}}
          <!-- <input class="layui-input" placeholder="开始日" name="start" id="start">
          <input class="layui-input" placeholder="截止日" name="end" id="end"> -->
          <div class="layui-input-inline">
            <select name="homeuser_role">
              <option value="">请选择用户角色</option>
              <option value="1" {{$role == 1? 'selected' : ''}}>普通用户</option>
              <option value="2" {{$role == 2? 'selected' : ''}}>VIP</option>
              <option value="3" {{$role == 3? 'selected' : ''}}>钻石用户</option>
            </select>
          </div>
          <div class="layui-input-inline">
            <select name="homeuser_status">
              <option value="">请选择用户状态</option>
              <option value="1" {{$status == 1? 'selected' : ''}}>正常</option>
              <option value="2" {{$status == 2? 'selected' : ''}}>禁用</option>
            </select>
          </div>
          <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input" value="{{$username}}">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        
       <span class="x-right" style="line-height:40px">共有数据：88 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>头像</th>
            <th>用户名</th>
            <th>性别</th>
            <th>年龄</th>
            <th>手机</th>
            <th>邮箱</th>
            <th>加入时间</th>
            <th>角色</th>
            <th>状态</th>
            <th>操作</th></tr>
        </thead>

        @foreach ($list as $v) 
          <tbody>
            <tr>
              <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
              </td>
              <td>{{$v->id}}</td>
              <td><img src="{{asset('storage/'.$v->pic)}}" style="width:50px;height:40px"></td>
              <td>{{$v->username}}</td>
              <td>
                @switch($v->sex)
                  @case(1)
                    女
                  @break

                  @case(2)
                    男
                  @break

                  @case(3)
                    保密
                  @break
                @endswitch
              </td>
              <td>{{$v->age}}</td>
              <td>{{$v->phone}}</td>
              <td>{{$v->email}}</td>
              <td>{{$v->create_time}}</td>
              <td>
                @switch($v->role)
                  @case(1)
                    普通用户
                  @break

                  @case(2)
                    VIP
                  @break

                  @case(3)
                    钻石用户
                  @break

                  @default
                    等级异常
                  @break         
                @endswitch
              </td>
              <!-- layui-btn-disabled -->
              <td class="td-status">
                <span class="layui-btn layui-btn-normal layui-btn-mini
                @if ($v->status === 2)
                layui-btn-disabled
                @else

                @endif
                " title="@if ($v->status === 1)启用@else禁用@endif">{{$v->status == 1?'已启用':'已停用'}}</span>
              </td>
              <td class="td-manage">
                <a onclick="member_stop(this,{{$v->id}},{{$v->status}})" href="javascript:;" title="修改状态">
                  <i class="layui-icon">&#xe601;</i>
                </a>
               
                <a title="删除" onclick="member_del(this,{{$v->id}})" href="javascript:;">
                  <i class="layui-icon">&#xe640;</i>
                </a>
              </td>
            </tr>
          </tbody>
        @endforeach


      </table>
      <!-- 分页按钮 -->
      <div class="page">
        <div>
          {{ $list->appends([

            'homeuser_role' => $role,
            'homeuser_status' => $status,
            'username' => $username,

            ])->links() }}
        </div>
      </div>
       
        

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id,status){
          layer.confirm('确认要修改状态吗？',function(index){
               if($(obj).attr('title')=='启用'){
                //console.log(status);
                //发起ajax请求get
                $.ajax({
                  type: 'get',
                  url: '{{url("changestatus")}}?id='+id,//请求php的路径
                  success:function (data) {
                    //发异步把用户状态进行更改
                    $(obj).attr('title','停用')
                    $(obj).find('i').html('&#xe62f;');

                    $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                    layer.msg(data.code,{icon: 5,time:1000});
                  },
                  dataType: 'json'
                });
              }else{
                $.ajax({
                  type: 'get',
                  url: '{{url("changestatus")}}?id='+id,//请求php的路径
                  success:function (data) {
                    $(obj).attr('title','修改状态')
                    $(obj).find('i').html('&#xe601;');

                    $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                    layer.msg(data.code,{icon: 5,time:1000});
                  },
                  dataType: 'json'
                });
              }
          });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除此用户吗？数据将无法恢复！！',function(index){

              $.ajax({
                type: 'get',
                url: '{{url("userdelete")}}',
                data: 'uid=' + id,

                success:function (data) {

                  if (data.code == 1200) {
                    
                      //发异步删除数据
                      $(obj).parents("tr").remove();
                      layer.msg('已删除!',{icon:1,time:1000});
                  } else {

                    alert(data.msg);
                  }
                },
                dataType: 'json'
              });               
          });
      }



      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>