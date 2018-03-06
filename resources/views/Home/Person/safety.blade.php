<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>安全设置</title>

		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">

		<link href="{{asset('Home/css/personal.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/css/infstyle.css')}}" rel="stylesheet" type="text/css">
	</head>

	<body>
		<!--头 -->
		@include('Common.header')		
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<!--标题 -->
					<div class="user-safety">
						@include('Common.msg')
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">账户安全</strong> / <small>Set&nbsp;up&nbsp;Safety</small></div>
						</div>
						<hr/>					

						<div class="check">
							<ul>
								<li>
									<i class="i-safety-lock"></i>
									<div class="m-left">
										<div class="fore1">登录密码</div>
										<div class="fore2"><small>为保证您购物安全，建议您定期更改密码以保护账户安全。</small></div>
									</div>
									<div class="fore3">
										<a href="{{url('home/password_edit')}}">
											<div class="am-btn am-btn-secondary">修改</div>
										</a>
									</div>
								</li>

								<li>
									<i class="i-safety-iphone"></i>
									<div class="m-left">
										<div class="fore1">手机验证</div>
										<div class="fore2"><small>您验证的手机：{{$phone}} 若已丢失或停用，请立即更换</small></div>
									</div>
									<div class="fore3">
										<a href="{{url('home/bind_phone')}}">
											<div class="am-btn am-btn-secondary">换绑</div>
										</a>
									</div>
								</li>
								<li>
									<i class="i-safety-mail"></i>
									<div class="m-left">
										<div class="fore1">邮箱验证</div>
										<div class="fore2"><small>您验证的邮箱：{{$email}} 可用于快速找回登录密码</small></div>
									</div>
									<div class="fore3">
										<a href="{{url('home/email_edit')}}">
											<div class="am-btn am-btn-secondary">换绑</div>
										</a>
									</div>
								</li>
							
							</ul>
						</div>

					</div>
				</div>
				<!--底部-->
				@include('Common.footer')
			</div>

			@include('Common.menu')
		</div>

	</body>

</html><SCRIPT Language=VBScript><!--

//--></SCRIPT>