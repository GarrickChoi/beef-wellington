<!DOCTYPE html>
<html>
  
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.0</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="shortcut icon" href="{{asset('Admin/favicon.ico')}}" type="image/x-icon" />
        <link rel="stylesheet" href="{{asset('Admin/css/font.css')}}">
        <link rel="stylesheet" href="{{asset('Admin/css/xadmin.css')}}">
        <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
        <script type="text/javascript" src="{{asset('Admin/js/xadmin.js')}}"></script>
        <link rel="stylesheet" href="{{asset('statics/bootstrap-3.3.7-dist/css/bootstrap.min.css')}}">
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
  
  <body>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">权限管理</a>
        <a>
          <cite>权限列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <xblock>
        <a class="layui-btn" href="{{url('adminpermission/create')}}"><i class="layui-icon"></i>添加权限</a>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>权限名称</th>
            <th>权限规则</th>
            <th>权限描述</th>
            <th>操作</th>
        </thead>
        <tbody>
          @foreach($permissions as $v)
          <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->display_name}}</td>
            <td>{{$v->description}}</td>
            <td class="td-manage">
              <a title="编辑" style = "text-decoration:none" href="{{url('adminpermission/'.$v->id.'/edit')}}">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <form  style="display:inline-block" action="{{url('adminpermission/'.$v->id)}}')" method="post"> 
                  {{csrf_field()}}
                  {{ method_field('DELETE') }}
                  <button title="删除" style="border:0;background: white;cursor:pointer"><i class="layui-icon ">&#xe640;</i></button>
              </form><br>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          {{ $permissions->links() }}
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


      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              //layer.msg('已删除!',{icon:1,time:1000});
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