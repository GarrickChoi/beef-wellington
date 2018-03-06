<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>遍历数据表</title>
	<link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('Admin/css/bootstrap.css')}}">
	
    <script src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
</head>
<body>
	<!--搜索功能-->
	<form action="{{url('list')}}" method="get">
		<div class="form-group">
			搜索:<input type="text" name="keyword" class="form-control" value="{{$keys}}">
		
			<button class="btn btn-success">搜索</button>
		</div>
	</form>

	<!--输出传过来的变量-->
	{{$name}}
	<table class='table table-hover'>
		<tr>
			<th>序号</th>
			<th>姓名啊</th>
			<th>修改时间</th>
			<th>操作</th>
		</tr>
		@foreach($list as $v)
		<tr>
			<th>{{$v->id}}</th>
			<th>{{$v->username}}</th>
			<th>{{date('Y-m-d H:i:s',$v->addtime)}}</th>
			<th>
				<a href="javascript:;" class="edit" data-id="{{$v->id}}">编辑</a>
				<a href="{{url('doedit',[$v->id])}}" class="doedit">跳转</a>
			</th>
		</tr>
		@endforeach
	</table>
	<!--分页按钮（样式兼容bootstrap框架）-->
	<!--键名跟name属性一致-->
	{{$list->appends(['keyword' => $keys])->links()}}

	<!--导入JQ-->
    <script src="{{asset('Admin/js/jquery.js')}}"></script>
    <script>
    	$('.edit').click(function (){ 
    		// attr 获取标签的属性值
    		var id = $(this).attr('data-id');
    		//存储接收id
    		var that = $(this);
    		//通过ajax将数据带给php，然后让php操作数据库，最后php响应数据
    		$.ajax({ 
    			type: 'get', //请求方式
    			url: '{{url("edit")}}', //请求路径
    			data: 'id='+id , //发送的数据
    			success: function (data) { //当响应成功（200）时执行 
    				//console.log(data); 
    				//判断信息执行前端页面更新
    				if (data.code == 200) { 
    					//prev()上一个兄弟节点,html()获取标签包裹的值
    					that.parent().prev().html(data.time);
    				};
    				//提示用户
    				alert(data.msg);
    			},
    			dataTpye: 'json' //解码方式
    		});
    	});
    </script>
</body>
</html>