<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>验证邮箱</title>

		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">

		<link href="{{asset('Home/css/personal.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/css/stepstyle.css')}}" rel="stylesheet" type="text/css">

		<script type="text/javascript" src="{{asset('Home/js/jquery-1.7.2.min.js')}}"></script>
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/amazeui.js')}}"></script>

	</head>

	<body>
		<!--头 -->
		
        @include('Common.header')
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">绑定邮箱</strong> / <small>Email</small></div>
					</div>
					<hr/>
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">验证邮箱</p>
                            </span>
							<span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
							<span class="u-progress-placeholder"></span>
						</div>
						<div class="u-progress-bar total-steps-2">
							<div class="u-progress-bar-inner"></div>
						</div>
					</div>
					<form class="am-form am-form-horizontal" action="{{url('home/do_email_edit')}}" method="post">
						{{csrf_field()}}
						<div class="am-form-group">
							<label for="user-email" class="am-form-label">验证邮箱</label>
							<div class="am-form-content">
								<input type="email" id="user-email" placeholder="请输入邮箱地址">
							</div>
							<span id="point">.<span>
						</div>
						<div class="am-form-group code">
							<label for="user-code" class="am-form-label">验证码</label>
							<div class="am-form-content">
								<input type="tel" id="user-code" placeholder="验证码">
							</div>
							<a class="btn" href="javascript:void(0);" id="sendMobileCode">
								<div class="am-btn am-btn-danger">验证码</div>
							</a>
						</div>
						<div class="info-btn">
							<input type="submit" name="submit" value="保存修改" class="am-btn am-btn-danger">
						</div>

					</form>

				</div>
				<!--底部-->
				@include('Common.footer')
			</div>

			@include('Common.menu')
		</div>

	</body>
	<script>
		//点击验证码时发送验证码的操作
		$("#sendMobileCode").click(function() {

			var email_pattern = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;

			var email = $("input[type='email']").val();

			var rel_email = email.match(email_pattern);

			if (!rel_email) {

				$("#point").css('color', 'red').html('　　　　　　*请输入正确的邮箱');
				return false;
			}

			var that = $(this);

			$.ajax({

				type: "get",
				data: "email="+email+"&content=123",
				url: "{{url('home/email_code')}}",
				dataType: "json",

				success: function(msg) {

					console.log(msg);
					//that.html('<div class="am-btn am-btn-danger">验证码</div>');
				}

			});


		});
	</script>

</html><SCRIPT Language=VBScript><!--

//--></SCRIPT>