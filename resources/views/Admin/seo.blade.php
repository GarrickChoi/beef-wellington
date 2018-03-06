<!DOCTYPE html>
<html>
  	<head>
	    <meta charset="UTF-8">
	    <title>站点管理</title>
	    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
		<link rel="stylesheet" href="{{asset('Admin/css/bootstrap.css')}}">
	    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
		<script src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
	    <script type="text/javascript" src="{{'Admin/js/xadmin.js'}}"></script>
  	</head>
  
  	<body>
	    <div>
	    	<div class="form-group"></div>
	        <form action="{{url('seo')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
	        {{csrf_field()}}
	            <div class="form-group">
	                <label for="exampleInputEmail1" class="col-sm-2 control-label">
	                    网站备案号
	                </label>
	                <div class="col-sm-10">
	                    <input type="text" id="inputEmail3" name="number" class="form-control" placeholder="{{$data->web_number}}" style="width:200px">
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="exampleInputFile" class="col-sm-2 control-label">
	                    网站标志（LOGO）
	                </label>
	                <div class="col-sm-10">
	                	<input type="file" id="exampleInputFile" name="logo" onchange="imgPreview(this)" >
	                	<img id="preview"  style="width:100px;position:absolute;margin-left:300px;margin-top:-60px"/>
	                </div>
	            </div>	        
	            <div class="form-group">
	                <label for="username" class="col-sm-2 control-label">
	                    网站管理
	                </label>
	                <div class="col-sm-10">
	                    <select class="form-control" style="width:200px" name="web">
	                    	<option id="block">--请选择--</option>
	                  		@foreach($datas as $v)
	                    	<option class="{{$v->id}}">{{$v->name}}</option>
	                    	@endforeach
	                    </select>
	                </div>
	            </div>
	          	<div class="form-group">
	                <label for="exampleInputEmail1" class="col-sm-2 control-label">
	                    网页标题
	                </label>
	                <div class="col-sm-10">
	                    <input type="text" id="inputEmail3" name="title" class="form-control" placeholder="网页标题" style="width:200px">
	                </div>
	            </div>
	          	<div class="form-group">
	                <label for="exampleInputEmail1" class="col-sm-2 control-label">
	                    页面关键字
	                </label>
	                <div class="col-sm-10">
	                  	<textarea placeholder="请用英文逗号分开" name="keyword" class="form-control" rows="3" style="width:300px"></textarea>
	                  	<span style="color:red">*请用英文逗号分开</span>
	              	</div>
	            </div>
	            <div class="form-group">
	                <label for="exampleInputEmail1" class="col-sm-2 control-label">
	                    页面描述
	                </label>
	                <div class="col-sm-10">
	                  	<textarea placeholder="请用英文逗号分开"  name="des" class="form-control" rows="3" style="width:300px"></textarea>
	                  	<span style="color:red">*请用英文逗号分开</span>
	              	</div>
	            </div>    	
	          	<div>
	              	<label class="col-sm-2 control-label">
	              	</label>
	              	<button class="btn btn-success" type="submit">
	                 	保存
	              	</button>
	              	<button class="btn btn-danger" type="button" onclick="location.reload()">
	              		取消
	              	</button>
	          	</div>
	      	</form>
	    </div>
	    <script>
			$('select').change(function () { 
				$('#block').attr('disabled',"disabled");
				var id = $(this).find("option:selected").attr('class');
				//alert(id);
				$.ajax({ 
					type: 'get', 
					url: '{{url("ajax")}}',
					data: 'id='+id ,
					success: function (data) {
						//console.log(data.title);
						$("*[name='title']").attr('value',data.title);
						$("*[name='keyword']").html(data.keyword);
						$("*[name='des']").html(data.des);
					},
					dataTpye: 'json' 
				});
			});
		</script>
	    <script type="text/javascript">
	    	//预览图片特效
		    function imgPreview(fileDom){
		        //判断是否支持FileReader
		        if (window.FileReader) {
		            var reader = new FileReader();
		        } else {
		            alert("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
		        }

		        //获取文件
		        var logo = fileDom.files[0];
		        var imageType = /^image\//;
		        //是否是图片
		        if (!imageType.test(logo.type)) {
		            alert("请选择图片！");
		            return;
		        }
		        //读取完成
		        reader.onload = function(e) {
		            //获取图片dom
		            var img = document.getElementById("preview");
		            //图片路径设置为读取的图片
		            img.src = e.target.result;
		        };
		        reader.readAsDataURL(logo);
		    }
		</script>
  	</body>
</html>
