<!DOCTYPE html>
<html> 
    <head>
	    <meta charset="UTF-8">
	    <title>欢迎页面-X-admin2.0</title>
	    <meta name="renderer" content="webkit">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
	    <link rel="stylesheet" href="{{asset('Admin/css/font.css')}}">
	    <link rel="stylesheet" href="{{asset('Admin/css/xadmin.css')}}">
	    <link rel="stylesheet" href="{{asset('Admin/css/bootstrap.css')}}">
	    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
	    <script type="text/javascript" src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
	    <script type="text/javascript" src="{{asset('Admin/js/xadmin.js')}}"></script>
    </head>
  
    <body>
    <div class="x-body">
        <div class="layui-row">
            <form class="layui-form layui-col-md12 x-so layui-form-pane" method="get" action="{{url('adminSuggest')}}">
		        <div class="layui-input-inline">
		            <select name="status">
		                <option value="">全部</option>
		                <option value="1">未回复</option>
		                <option value="2">以回复</option><!-->=-->
		            </select>
		        </div>
		        <div class="layui-input-inline">
		            <select name="type">
		            	<option value="">请选择意见类型</option>
		                <option value="1">产品问题</option>
						<option value="2">促销问题</option>
						<option value="3">支付问题</option>
						<option value="4">退款问题</option>
						<option value="5">配送问题</option>
						<option value="6">售后问题</option>
						<option value="7">发票问题</option>
						<option value="8">退换货</option>
						<option value="9">其他</option>
		            </select>
		        </div>
	            <input class="layui-input" placeholder="用户名" name="name" >
	            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon"></i>查找</button>
	            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        		<i class="layui-icon" style="line-height:30px">ဂ</i></a>
        	</form>
        </div>
        <table class="layui-table">
            <thead>
                <tr>
            		<th>表单号</th>
            		<th>用户名</th>
            		<th>意见类型</th>
            		<th>填写日期</th>
            		<th>回复</th>
            		<th>操作</th>
            	</tr>
        	</thead>
	        <tbody>
	        	@foreach($data as $v)
	            <tr class="change">	            
		            <td>{{$v->id}}</td>
		            <td>{{$v->name}}</td>
		            <td>
		            @switch($v->type)
					    @case(1)
					        产品问题
					    @break
					    @case(2)
					    	促销问题
					    @break
					    @case(3)
					    	支付问题
					    @break
					    @case(4)
					    	退款问题
					    @break
					    @case(5)
					    	配送问题
					    @break
					    @case(6)
					    	售后问题
					    @break
					    @case(7)
					    	发票问题
					    @break
					    @case(8)
					    	退换货
					    @break
					    @case(9)
					    	其他
					    @break
					@endswitch
		            </td>
		            <td>{{$v->date}}</td>
		            <td style="color:{{$v->status == 1 ? 'red' : 'green'}}">@switch($v->status)
		            	@case(1)未回复@break
					    @default已回复	
					@endswitch</td>
		            <td class="td-manage">
	              		<a title="编辑"  onclick="x_admin_show('编辑','{{url('doSuggest',[$v->id])}}')" href="javascript:;">
	                		<i class="layui-icon">&#xe642;</i>
	              		</a>
	            	</td>
	            </tr>
	            @endforeach	
	        </tbody>
      	</table>
      	<div>
      		<center>{{$data->appends(['name' => $name])->links()}}</center>	
      	</div>
      	
    </div>
    	<script>
    		/*
    		$('.change').mouseenter(function () { 
    			var type = $(this).children().eq(4).html();
    			//console.log(type);
    			//if (type == '未回复') { 
    				var id = $(this).children().first().html();
	    			$.ajax({ 
	    				type:'get',
						url: '{{url("change")}}',
						dataType: 'json',
						data: 'id='+id,
						success:function (data) { 
							if (data == 2) { 
								console.log(1);
							};
						}
	    			});
    			//};
    		});*/
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
    	</script>
	    <script>
	    	var _hmt = _hmt || []; (function() {
		        var hm = document.createElement("script");
		        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
		        var s = document.getElementsByTagName("script")[0];
		        s.parentNode.insertBefore(hm, s);
	        })();
	    </script>
	    <script>
	    	//鼠标移入更新状态
	    </script>
    </body>
</html>