<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="UTF-8">
		<title>欢迎页面-X-admin2.0</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
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
				<a href="">评价管理</a>
				<a>
					<cite>评价列表</cite>
				</a>
			</span>
			<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
			<i class="layui-icon" style="line-height:30px">ဂ</i></a>
		</div><br>
		<div class="x-body">
			<div class="layui-row">
				<form class="layui-form layui-col-md12 x-so" action="{{url('evaluatelist')}}" method="get">
					<div style="display:inline-block;">
						<select name="keyword">
							<option value="">--请选择好评度--</option>
							<option value="1">差评</option>
							<option value="2">中评</option>
							<option value="3">好评</option>
						</select>
					</div>
					<button class="layui-btn" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
				</form>
			</div>
			<table class="layui-table">
				<thead>
					<tr>
						<th>序号</th>
						<th>商品id</th>
						<th>用户id</th>
						<th>订单id</th>
						<th>评价内容</th>
						<th>好评度</th>
						<th>添加时间</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $v)
						<tr>
							<td>{{$v->id}}</td>
							<td>{{$v->gid}}</td>
							<td>{{$v->uid}}</td>
							<td>{{$v->oid}}</td>
							<td>{{$v->content}}</td>
							<td>{{$evaluate[$v->evaluate]}}</td>
							<td>{{$v->addtime}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="page">
				<div>
					@if (isset($key))  
					{{$data->appends(['keyword' => $key])->links()}}
					@else
					{{$data->links()}}
					@endif         
				</div>
			</div>
		</div>
	</body>

</html>