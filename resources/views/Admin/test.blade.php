<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>测试代码</title>
	<link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('Admin/css/bootstrap.css')}}">
	
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{'Admin/js/xadmin.js'}}"></script>
</head>
<body>
	<div class="container">

		<form action="{{url('index')}}" method="post">
			<!--每个表单必加-->
			{{csrf_field()}}
			<!--输出错误信息-->
			@if (session('msg'))
			    <div class="alert alert-danger">
			        {{ session('msg') }}
			    </div>
			@endif
			<!--输出表单验证错误信息-->
			@if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<div class="form-group">
				用户名：<input type='text' name='user' class='form-control'>
			</div>	
			<div class="form-group">
				<button class="btn btn-success">提交</button>
			</div>	
		</form>
	</div>
</body>
</html>