<!DOCTYPE html>
<html>
  
  	<head>
	    <meta charset="UTF-8">
	    <title>首页广告图管理</title>
	    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
		<link rel="stylesheet" href="{{asset('Admin/css/bootstrap.css')}}">
	    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
		<script src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
	    <script src="{{'Admin/js/xadmin.js'}}"></script>
	    <script src="{{'Admin/js/bootstrap.min.js'}}"></script>
  	</head>
  
  	<body>
	    <div>
	        <form action="{{url('carousel')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
	        	{{csrf_field()}}
	        	@if (session('msg'))
			    <div class="alert alert-danger">
			        {{ session('msg') }}
			    </div>
				@endif
	        	<div class="form-group"></div>
	        	<!--轮播图-->
	        	<div id="myCarousel" class="carousel slide" style="width:550px;height:350px;overflow:hidden;position:absolute;margin-left:470px;margin-top:10px">
					<!-- 轮播（Carousel）指标 -->
					<ol class="carousel-indicators" id="des">
						@for($i = 0; $i < count($data);$i++)
						<li data-target="#myCarousel" data-slide-to="{{$i}}" ></li>
						@endfor
					</ol>   
					<!-- 轮播（Carousel）项目 -->
					<div class="carousel-inner" id="picture">
						@foreach($data as $v)
						<div class="item">
							<img src="{{asset('storage/'.$v->picture)}}">
							<div class="carousel-caption">{{$v->picture_des}}</div>
						</div>
						@endforeach
					</div>
					<!-- 轮播（Carousel）导航 -->
					<a class="carousel-control left" href="#myCarousel" 
					   data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#myCarousel" 
					   data-slide="next">&rsaquo;</a>
				</div>
	        	@foreach($data as $v)
	          	<div class="form-group">
	              	<label for="exampleInputEmail1" class="col-sm-2 control-label">
	                  	轮播图
	              	</label>
	              	<div class="form-group">
	              	    <input class="form-control" id="disabledInput" type="text" placeholder="{{$v->picture_des}}" style="width:100px" disabled >
	              	    <a type="button" class="btn btn-danger" style="position:absolute;margin-left:370px;margin-top:-35px" href='{{url("carousel/$v->id")}}' onclick="return del()">
	              	    	删除
	              	    </a>	             	
	              	</div>
	          	</div>
	            @endforeach
	            <div class="form-group">
	            	<label class="col-sm-5 control-label">
	                    ============================================
	                </label>
	            </div>
	         	<div class="form-group" >
	                <label for="exampleInputEmail1" class="col-sm-2 control-label">
	                    图片描述
	                </label>
	                <div class="col-sm-10">
	                    <input type="text" id="inputEmail3" name="des" class="form-control" style="width:250px">
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="exampleInputFile" class="col-sm-2 control-label" >
	                    上传图片
	                </label>
	                <div class="col-sm-10">
	                	<input type="file" id="exampleInputFile" name="picture">    	
	                </div>
	            </div>
	          	<div>
	              	<label class="col-sm-2 control-label">
	              	</label>
	              	<button type="submit" class="btn btn-info">
	                    添加
	              	</button>
	          	</div>
	      	</form>
	    </div> 
		<script>
			$('#picture').children(':first').attr('class','item active');
			$('#des').children(':first').attr('class','active');
			$('.carousel').carousel();
		</script>
	    
		<script type="text/javascript"> 
			function del(){ 
				if(!confirm("确认要删除？")){ 
					window.event.returnValue = false; 
				} 
			} 
		</script>  
  	</body>
</html>