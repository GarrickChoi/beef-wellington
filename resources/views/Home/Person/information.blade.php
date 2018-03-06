<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>个人资料</title>

		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">

		<link href="{{asset('Home/css/personal.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/css/infstyle.css')}}" rel="stylesheet" type="text/css">
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/amazeui.js')}}"></script>			
	</head>

	<body>
		<!--头 -->
		@include('Common.header')
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							@include('Common.errormsg')
							@include('Common.msg')
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
						</div>
						<hr/>

						<!--头像 -->
						<form action="{{url('home/alter_pic')}}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="user-infoPic">
							<div class="filePic">
								<input type="file" name="file" onchange="imgPreview(this)" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
								<img id="preview"  style="width:100px; height:100px" class="am-circle am-img-thumbnail" src="{{asset('storage/'.$userinfo->pic)}}" alt="点击修改图片" />
							</div>

							<p class="am-form-help">头像</p>

							<div class="info-m">
								<div><b>用户名：<i>{{$userinfo->username}}</i></b></div>
								<div class="vip">
                                      <span></span><a href="#">会员专享</a>
								</div>
							</div>
							<div class="info-btn" style="margin-top: 45px">
									<div><input class="am-btn am-btn-danger" type="submit" value="保存修改图片"></div>
							</div>
							</div>
						</form>
						<!--个人信息 -->
						<div class="info-main">
							<form class="am-form am-form-horizontal">

								<div class="am-form-group">
									<label for="user-name2" class="am-form-label">用户名</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" placeholder="" value="{{$userinfo->username}}">
                                          <small>你注册时所填写的用户名</small>
									</div>
								</div>

								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">
										<label class="am-radio-inline">
											<input type="radio" name="radio10" value="male" data-am-ucheck {{$userinfo->sex =='0'? 'checked':''}}> 男
										</label>
										<label class="am-radio-inline">
											<input type="radio" name="radio10" value="female" data-am-ucheck {{$userinfo->sex == '1'? 'checked':''}}> 女
										</label>
										<label class="am-radio-inline">
											<input type="radio" name="radio10" value="secret" data-am-ucheck {{$userinfo->sex == '2'? 'checked':''}}> 保密
										</label>
									</div>
								</div>
								
								<div class="am-form-group">
									<label for="user-phone" class="am-form-label">电话</label>
									<div class="am-form-content">
										<input id="user-phone" placeholder="telephonenumber" type="tel" value="{{$userinfo->phone}}">
									</div>
								</div>
								<div class="am-form-group">
									<label for="user-email" class="am-form-label">电子邮件</label>
									<div class="am-form-content">
										<input id="user-email" placeholder="Email" type="email" value="{{$userinfo->email}}">

									</div>
								</div>
								<div class="am-form-group address">
									<label for="user-address" class="am-form-label">收货地址</label>
									<div class="am-form-content address">
										<a href="address.html">
											<p class="new-mu_l2cw">
												<span class="province">湖北</span>省
												<span class="city">武汉</span>市
												<span class="dist">洪山</span>区
												<span class="street">雄楚大道666号(中南财经政法大学)</span>
												<span class="am-icon-angle-right"></span>
											</p>
										</a>

									</div>
								</div>
								<div class="am-form-group safety">
									<label for="user-safety" class="am-form-label">账号安全</label>
									<div class="am-form-content safety">
										<a href="safety.html">

											<span class="am-icon-angle-right"></span>

										</a>

									</div>
								</div>
							</form>
						</div>

					</div>

				</div>
				<!--底部-->
				@include('Common.footer')
			</div>
			@include('Common.menu')
		</div>
	</body>
	<script type="text/javascript">
    function imgPreview(fileDom){
        //判断是否支持FileReader
        if (window.FileReader) {
            var reader = new FileReader();
        } else {
            alert("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
        }

        //获取文件
        var file = fileDom.files[0];
        var imageType = /^image\//;
        //是否是图片
        if (!imageType.test(file.type)) {
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
        reader.readAsDataURL(file);
    }
	</script>

</html><SCRIPT Language=VBScript><!--

//--></SCRIPT>