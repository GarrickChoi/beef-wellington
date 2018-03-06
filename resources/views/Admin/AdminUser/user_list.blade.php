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
		<a href="">用户管理</a>
		<a>
		  <cite>用户列表</cite></a>
	  </span>
	  <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
		<i class="layui-icon" style="line-height:30px">ဂ</i></a>
	</div>
	<div class="x-body">
	  <div class="layui-row">
		<form class="layui-form layui-col-md12 x-so" action="{{url('adminuserlist')}}">
		  <input type="text" name="keyword" value = ""  placeholder="请输入用户名" autocomplete="off" class="layui-input">
		  <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
		</form>
	  </div>
	  <xblock>
		<a class="layui-btn" href="{{url('adminuserlist/create')}}"><i class="layui-icon"></i>添加用户</a>
	  </xblock>
	  <!-- @if (Session('success'))
		<div class="alert alert-success">
			<p>{{Session('success')}}</p>
		</div>
	  @endif -->
	  <table class="layui-table">
		<thead>
		  <tr>
			<th>ID</th>
			<th>登录名</th>
			<th>邮箱</th>
			<th>角色</th>
			<th>添加时间</th>
			<th>状态</th>
			<th>操作</th>
		  </tr>
		</thead>
		<!-- <pre>
		  {{var_dump($list)}}
		</pre> -->
		<tbody>
		  @foreach($list as $v)
		  <tr>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->email}}</td>
			@if($v->display_name != '超级管理员')
			<td><span class="btn btn-success">{{$v->display_name}}</span></td>
			@else
			<td><span class="btn btn-warning">{{$v->display_name}}</span></td>
			@endif
			<td>{{$v->created_at}}</td>
			<td class="td-status">
				@if($v->display_name != '超级管理员')	
			  	<a id="changit" style="text-decoration:none; background: {{$v->status == 1?'rgb(30,159,255)':'gray'}}" href="javascript:;" data-id="{{$v->id}}" data-status="{{$v->status}}" name="status" class="layui-btn layui-btn-normal layui-btn-mini">{{$v->status == 1?'已启用':'已禁用'}}
                </a>
			  	@endif
			  </td>
			<td class="td-manage">
			  	<a title="编辑" style = "text-decoration:none" href="{{url('adminuserlist/'.$v->id.'/edit')}}">
				<i class="layui-icon">&#xe642;</i>
			  	</a>
			  	@if($v->display_name != '超级管理员')
			  	<form style="display:inline-block" action="{{url('adminuserlist/'.$v->id)}}')" method="post"> 
                  {{csrf_field()}}
                  {{ method_field('DELETE') }}
                  <button title="删除" style="border:0;background: white; cursor:pointer"><i class="layui-icon ">&#xe640;</i></button>
              </form><br>
			  	@endif
			</td>
		  </tr>
		  @endforeach
		</tbody>
	  </table>
	 <div class="page">
	   <div>
		 @if (isset($key)) 
		 {{ $list->appends(['keyword' => $key])->links() }}
		 @else
		 {{ $list->links() }}
		 @endif    
	   </div>
	 </div>

	</div>

	<script>
		//修改状态
		$('a[name=status]').click('click', function () {

			var uid = $(this).attr('data-id');
			var status = $(this).attr('data-status')
			//alert(status);
			var that = $(this);
			$.ajax({
				type: 'get',
				url: '{{url("adminuserstatus")}}',
				data:'uid='+uid+'&status='+status,
				success:function (data) {
					
					if (data.code == 200) {

						that.attr("data-status",data.status);
						that.html(data.statustxt);
						if (data.status == 1) {
							that.css('background','rgb(30,159,255)');
						} else {
							that.css('background','gray');
						}
					}
				},
				dataType: 'json'
			});
		});


	</script>

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
              $.ajax({
              	type：'get',
              	url: '{{url("adminusersdel")}}',
              	data: 'uid='+id,
              	success:function (data) {
              		if (data.code == 200) {
	              		$(obj).parents("tr").remove();
	                    layer.msg('已删除!',{icon:1,time:1000});
              		}
              	},
              	dataType: 'json',
              });

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