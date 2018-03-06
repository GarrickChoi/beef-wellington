<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>登录</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.css')}}" />
		<link href="{{asset('Home/css/dlstyle.css')}}" rel="stylesheet" type="text/css">
		<!-- <script src="{{asset('statics/jquery-1.12.3.min.js')}}"></script> -->
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>

		<!-- 引入登录JS文件 -->
		
	</head>

	<body>

		<div class="login-boxtitle">
			<a href="home.html"><img alt="logo" src="{{asset('Home/images/logobig.png')}}" /></a>
		</div>

		<div class="login-banner">
			<div class="login-main">
				<div class="login-banner-bg"><span></span><img src="{{asset('Home/images/big.jpg')}}" /></div>
				<div class="login-box">

							<h3 class="title">登录商城</h3>
							@if (session('msg'))
							    <div class="alert alert-success">
							        {{ session('msg') }}
							    </div>
							@endif
							<span id="tip" style="font-size:10px;color:red"></span>
							<div class="clear"></div>
						
						<div class="login-form">
						  <form action="{{url('home/dologin')}}" method="post">
							
							   <div class="user-name">
								    <label for="user"><i class="am-icon-user"></i></label>
								    <input type="text" name="username" id="user" placeholder="用户名/邮箱/手机"><span></span>
                 </div>
                 
                 <div class="user-pass">

								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="password" id="password" placeholder="请输入密码">
                 </div>
              </form>
           </div>
            
            <div class="login-links">
                <label for="remember-me"><input id="remember-me" type="checkbox" name="remember" name="remember" value="remember">记住密码</label>
								<a href="{{url('home/forgotpass')}}" class="am-fr">忘记密码</a>
								<a href="{{url('home/register')}}" class="zcnext am-fr am-btn-default">注册</a>
								<br />
            </div>
								<div class="am-cf">
									<input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm" id="dologin">
								</div>
						<div class="partner">		
								<h3>合作账号</h3>
							<div class="am-btn-group">
								<li><a href="#"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
								<li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
								<li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
							</div>
						</div>	

				</div>
			</div>
		</div>


					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="# ">商城首页</a>
								<b>|</b>
								<a href="# ">支付宝</a>
								<b>|</b>
								<a href="# ">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="# ">关于恒望</a>
								<a href="# ">合作伙伴</a>
								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em>
							</p>
						</div>
					</div>
	</body>

</html>

 
<script>
	
	//给登录按钮绑定点击事件
	$("#dologin").click(function () {

		var username = $("input[name='username']").val();
		var password = $("input[name='password']").val();
		var remember = $("input[name='remember']").val();

		//判断是否输入了账号密码
		if (!username && !password) {

			$("#tip").html('请输入账号与密码');
			return false;
		}
		if (!username) {
			
			$("#tip").html('请输入登录账号');
			return false;
		}
		if (!password) {

			$("#tip").html('请输入密码');
			return false;
		}

		

//location.href = '';//js的跳转

		$.ajax({
			type: 'post',
			url: '{{url("home/dologin")}}',
			data: 'username='+ username + '&password=' + password + '&remember=' + remember, 
			success: function (data) {
				
				$('#tip').html(data.msg).css('color', 'red');	
				//console.log(data.msg);	

				if (data.code == 1200) {

					$('#tip').html(data.msg).css('color', 'green');
					location.href = '{{url("/")}}';
				}	
			},
			dataType: 'json'
		});
    
	});


	// 获取焦点,提示消失
	$('#user').blur(function () {

		$("#tip").html('');
	});

	$('#user').blur(function () {

		$("#tip").html('');
	});
</script>