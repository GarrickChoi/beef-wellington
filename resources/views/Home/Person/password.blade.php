<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>修改密码</title>

		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">

		<link href="{{asset('Home/css/personal.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/css/stepstyle.css')}}" rel="stylesheet" type="text/css">

		<script type="text/javascript" src="{{asset('Home/js/jquery-1.7.2.min.js')}}"></script>
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/amazeui.js')}}"></script>

	</head>

	<body>
		<!--头 -->
		@include('Common.header');
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
					@include('Common.errormsg')
					@include('Common.pattern')

					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
					</div>
					<hr/>
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
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
					<form class="am-form am-form-horizontal" action="{{url('home/do_password_edit')}}" method="post">
						{{csrf_field()}}
						<img src={{url('code')}}  id="codepic" alt="验证码" style="margin-left:265px;cursor:pointer" onclick="this.src='{{url('code')}}?r='+Math.random();">
						<div class="am-form-group">
							<label for="code" class="am-form-label">验证码</label>
							<div class="am-form-content">
								<input type="text" name="captcha" placeholder="请输入5位的验证码">
							</div>
							<div style="margin-left: 83px">.</div>
						</div>
						<div class="am-form-group">
							<label for="user-old-password" class="am-form-label">原密码</label>
							<div class="am-form-content">
								<input type="password" name="oldpassword" id="user-old-password" placeholder="请输入原登录密码">
							</div>
							<div style="margin-left: 83px">.</div>
						</div>
						<div class="am-form-group">
							<label for="user-new-password" class="am-form-label">新密码</label>
							<div class="am-form-content">
								<input type="password" name="password" id="user-new-password" placeholder="密码由6-18位字母、数字以及下划线（ _ ）">
							</div>
							<div style="margin-left: 83px">.</div>
						</div>
						<div class="am-form-group">
							<label for="user-confirm-password" class="am-form-label">确认密码</label>
							<div class="am-form-content">
								<input type="password" name="repassword" id="user-confirm-password" placeholder="请再次输入上面的密码">
							</div>
							<div style="margin-left: 83px">.</div>
						</div>
						<div class="info-btn">
							<div><input type="submit" value="保存修改" class="am-btn am-btn-danger"></div>
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

		//当失去焦点的时候
		$("input").blur(function () {

			$(this).parent().next().css('color', 'gray');
			$(this).parent().next().html('.');

		});

		//失去焦点的时候判断,验证验证码是否为空,并且是否是5位的
		$("input[name='captcha']").blur(function () {

			var captcha_pattern = /^\w{5}$/;

			var rel_captcha = $(this).val().match(captcha_pattern);

			if (!rel_captcha) {
				$(this).parent().next().css('color', 'red');
				$(this).parent().next().html('*请输入5位验证码');
			}

		});

		//失去焦点的时候判断输入的密码是否由6-18位组成
		var password_pattern = /^\w{6,18}$/;

		$("input[type='password']").map(function () {

			$(this).blur(function () {

				var rel_password = $(this).val().match(password_pattern);

				if (!rel_password) {

				$(this).parent().next().css('color', 'red');
				$(this).parent().next().html('*密码由6-18位字母、数字以及下划线（ _ ）');
				return false;
				}
			});
		});


		//点击保存修改按钮的时候再次判断
		$("input[type='submit']").click(function () {
			
			//验证验证码是否为空,并且是否是5位的
			var captcha_pattern = /^\w{5}$/;

			var rel_captcha = $("input[name='captcha']").val().match(captcha_pattern);

			if (!rel_captcha) {
				$("input[name='captcha']").parent().next().css('color', 'red');
				$("input[name='captcha']").parent().next().html('*请输入5位验证码');
				return false;
			}

			//判断输入的密码是否由6-18位组成
			var password_pattern = /^\w{6,18}$/;

			$("input[type='password']").map(function () {
					
				var rel_password = $(this).val().match(password_pattern);

				if (!rel_password) {

					$(this).parent().next().css('color', 'red');
					$(this).parent().next().html('*密码由6-18位字母、数字以及下划线（ _ ）');
					return false;
				}

			});

		});
	</script>
</html><SCRIPT Language=VBScript><!--

//--></SCRIPT>