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
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('Admin/js/xadmin.js')}}"></script>
  </head>
  
  <body>
    <div class="x-body">
        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="{{$data->name}}" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">咨询时间</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="{{$data->date}}" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">意见类型</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="@switch($data->type) @case(1) 产品问题 @break @case(2) 促销问题 @break @case(3) 支付问题 @break @case(4) 退款问题 @break @case(5) 配送问题 @break @case(6) 售后问题 @break @case(7) 发票问题 @break @case(8) 退换货 @break @case(9) 其他 @break @endswitch" disabled>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">
                意见内容
            </label>
            <div class="layui-input-block">
                <textarea class="layui-textarea" disabled>{{$data->question}}</textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>回复
            </label>
            <div class="layui-input-block">
                <textarea class="layui-textarea" id="answer" data="{{$id}}">{{$data->answer}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
        	@if($button)
        		<button class="layui-btn" lay-submit="" lay-filter="add" name="answer">回复</button>
        	@endif     	
        	<button class="layui-btn" lay-submit="" lay-filter="quit">返回</button>
      	</div>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form,layer = layui.layer;
          //监听提交       
	        form.on('submit(add)', function(){
	            //发异步，把数据提交给php
	            var data = $('#answer').val();
	            var id = $('#answer').attr('data');
	            $.ajax({ 
	    			type: 'get', 
	    			url: '{{url("ajaxSuggest")}}',
	    			data: 'data='+data+'&id='+id , 
	    			dataTpye: 'json' ,
	    			success: function (data) { 
	    				//判断信息执行前端页面更新
	    				//console.log(data);
	    				layer.alert("回复成功，请点击右上角刷新页面", {icon: 6},function () {
			            // 获得frame索引
			            var index = parent.layer.getFrameIndex(window.name);
			            //关闭当前frame
			            parent.layer.close(index);
			          	});
			          	return false;				
	    			}
	    			
	    		}); 
	        });
        });
    </script>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form,layer = layui.layer;
          //监听提交
          form.on('submit(quit)', function(){
            //发异步，把数据提交给php        
            layer.alert("好的", {icon: 6},function () {
                // 获得frame索引
                var index = parent.layer.getFrameIndex(window.name);
                //关闭当前frame
                parent.layer.close(index);
            });
            return false;
          });       
        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();
    </script>
  </body>

</html>