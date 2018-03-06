<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>注册</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.min.css')}}" />
		<link href="{{asset('Home/css/dlstyle.css')}}" rel="stylesheet" type="text/css">
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/amazeui.min.js')}}"></script>

	</head>

	<body>

		<div class="login-boxtitle">
			<a href="home/demo.html"><img alt="" src="{{asset('Home/images/logobig.png')}}" /></a>
		</div>

		<div class="res-banner" style="height:640px">
			<div class="res-main">
				<div class="login-banner-bg"><span></span><img src="{{asset('Home/images/big.jpg')}}" /></div>
				<div class="login-box" style="height:610px">

						<div class="am-tabs" id="doc-my-tabs">
							<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
								<!-- <li class="am-active"><a href="">邮箱注册</a></li> -->
								<li><a href="javascript:;" style="font-size:20px">新用户注册</a></li>
							</ul>
							<a href="{{url('home/login')}}" style="font-size:10px">已有账号?请登录</a>
							
						

							<!-- div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
									<form method="post">
										
							   <div class="user-email">
										<label for="email"><i class="am-icon-envelope-o"></i></label>
										<input type="email" name="" id="email" placeholder="请输入邮箱账号">
							                 </div>										
							                 <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="" id="password" placeholder="设置密码">
							                 </div>										
							                 <div class="user-pass">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password" name="" id="passwordRepeat" placeholder="确认密码">
							                 </div>	
							                 
							                 </form>
							                 
								 <div class="login-links">
										<label for="reader-me">
											<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
										</label>
							  	</div>
										<div class="am-cf">
											<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
										</div>
							
								</div>
							 -->


								    
								<div class="am-tab-panel">
									 
									<form action="" method="post">

				 <div class="user-name">
								    <label for="user"><i class="am-icon-user"></i></label>
								    <input type="text" name="username" id="username" placeholder="用户名">
                 </div>
                 <div>
										<span id="usernametips" style="color:red;font-size:15px;"></span>
				 </div>
				@if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif

                 <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="pass" id="pass" placeholder="设置密码">
                 </div>
                 <div>
										<span id="passtips" style="color:red;font-size:10px;"></span>
				 </div>										
                 <div class="user-pass">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password" name="repass" id="repass" placeholder="确认密码">
                 </div>
                 <div>
										<span id="repasstips" style="color:red;font-size:10px;"></span>
				 </div>			
                 <div class="user-phone">
								    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
								    <input type="tel" name="phone" id="phone" placeholder="请输入手机号">
                 </div>
                 <div>
										<span id="phonetips" style="color:red;font-size:10px;"></span>
				 </div>																				
										<div class="verification">
											<label for="code"><i class="am-icon-code-fork"></i></label>
											<input type="tel" name="pyzm" id="pyzm" placeholder="请输入手机短信验证码">
											
										</div>
				<div>
										<span id="pyzmtips" style="color:red;font-size:10px;"></span>
				 </div>	
										<div>
											<input class="am-btn" type="button" id="btn" value="免费获取验证码"  style="font-size: 15px;" />
										</div>
										 <div>
										<span id="getyzmtips" style="color:red;font-size:10px;"></span>
				 </div>	
                <!--  <div class="user-pass">
                								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                								    <div>
                									    <input style="width:150px;vertical-align:top" type="text" name="yzm" id="yam" placeholder="请输入验证码">
                	                 					<img src="{{url('getcaptcha')}}" onclick="this.src='{{url('getcaptcha')}}?r='+Math.random();" alt="验证码" title="看不清楚?点击更换验证码">
                								    </div>
                </div>		 -->

									</form>
								 
										<div class="am-cf">
											<input type="submit" name="" value="同意条款并注册" class="am-btn am-btn-primary am-btn-sm am-fl" style="font-size: 19px;" id="submit">
										</div>
								
									<hr>
								</div>

								<script>
									$(function() {
									    $('#doc-my-tabs').tabs();
									  })
								</script>

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
	
	// 用户名输入框
	// 定义用户名的全局变量
	var usernameVal = '';
	$('#username').focus(function () {
		
		$('#usernametips').html("中文、英文、数字 '-' '_'的组合,2~20位字符").css('color', 'gray');
	});

	$('#username').blur(function () {

		usernameVal = $('#username').val();
			
		// 判断有没有输入用户名
		if (!usernameVal) {

			$('#usernametips').html('请输入用户名').css('color', 'red');
			return false;
		}

		// 判断用户名是否符合长度
		if (usernameVal.length < 2 || usernameVal.length > 20) {

			$('#usernametips').html('用户名必须是2~20位字符').css('color', 'red');
			return false;
		}

		// 判断用户名是否合法
		var pattern = /^[0-9A-Za-z\u4e00-\u9fa5]+$/;
		
		var res = pattern.test(usernameVal);
		if (!res) {
			
			$('#usernametips').html('用户名格式错误').css('color', 'red');
			return false;
		} else {
			$('#usernametips').html('');
		}

		// 发起ajax判断用户名是否已注册(在表单验证类中判断)
		$.ajax({
			type: 'get',
			url: '{{url("home/dousernameregister")}}',
			data: 'username=' + usernameVal,
			success: function (data) {
				
				$('#usernametips').html(data.msg).css('color', 'green');
			},
			error: function (errordata) {
				if(errordata.responseText) { 
					var error = JSON.parse(errordata.responseText).errors;
					console.log(error);
					for (var key in error) {
						$('#usernametips').html(error[key][0]).css('color', 'red');
						return false;
					}
					/*if (error.username) {

						$('#usernametips').html(error.username[0]).css('color', 'red');
					}*/
				}
			},
			dataType: 'json'
		});

	});  



	// 密码输入框
	// 定义一个密码的全局变量
	var passVal = '';
	$('#pass').focus(function () {
		
		$('#passtips').html("建议使用字母/数字/符号两种或以上的组合,6~18位字符").css('color', 'gray');
	});

	$('#pass').blur(function () {
		
		passVal = $('#pass').val();

		// 判断有没有输入密码
		if (!passVal) {

			$('#passtips').html('请设置密码').css('color', 'red');
			return false;
		}

		// 判断密码是否符合长度
		if (passVal.length < 6 || passVal.length > 18) {

			$('#passtips').html('密码必须是6~18位字符').css('color', 'red');
			return false;
		} 

		// 输入过于简单,提示建议输入组合密码,必须使用字母数字的组合
		var pattern = /^(?![^A-Za-z]+$)(?![^0-9]+$)[\x21-x7e]+$/;
		var res = pattern.test(passVal);
		if (!res) {

			$('#passtips').html('密码必须包含字母和数字,防止被盗风险').css('color', 'red');
			return false;
		} 

		//发起ajax请求去表单验证类
		$.ajax({
			type: 'post',
			url: '{{url("home/dopasswordregister")}}',
			data: 'password=' + passVal,
			success: function (data) {
				
				$('#passtips').html(data.msg).css('color', 'green');
			},
			error: function (errordata) {

				if(errordata.responseText) { 
					var error = JSON.parse(errordata.responseText).errors;
					for (var key in error) {

						$('#passtips').html(error[key][0]).css('color', 'red');
						return false;
					}
				}
			},
			dataType: 'json'
		});
	});  


	// 确认密码框
	// 定义确认密码的全局变量
	var repassVal = '';
	$('#repass').focus(function () {
		
		$('#repasstips').html("请再次输入密码").css('color', 'gray');
	});

	$('#repass').blur(function () {
	
		repassVal = $('#repass').val();

		// 判断有没有确认密码
		if(!repassVal) {

			$('#repasstips').html('请再次输入密码').css('color', 'red');
			return false;
		}

		// 判断两次密码是否相等
		if(passVal != repassVal) {

			$('#repasstips').html('两次密码输入不一致').css('color', 'red');
			return false;
		}

		// 发起ajax请求表单验证
		$.ajax({
			type: 'post',
			url: '{{url("home/dorepasswordregister")}}',
			data: {'password': passVal, 'repassword': repassVal},
			success: function (data) {

				$('#repasstips').html(data.msg).css('color', 'green');
			},
			error: function (errordata) {
				if(errordata.responseText) { 
					var error = JSON.parse(errordata.responseText).errors;
					for (var key in error) {

						$('#repasstips').html(error[key][0]).css('color', 'red');
						return false;
					}
				}
			},
			dataType: 'json'
		});
	});


	// 手机号输入框
	// 定义手机号的全局变量
	var phoneVal = '';

	$('#phone').focus(function () {

		$('#phonetips').html('完成验证后,你可以用该手机登录或找回密码').css('color', 'gray');
	});

	$('#phone').blur(function () {

		// 判断有没有输入手机号
		phoneVal = $('#phone').val();
		if(phoneVal.length == 0) {

			$('#phonetips').html('请输入手机号').css('color', 'red');
			return false;
		}

		// 判断手机号是否合法
		var pattern = /^1[34578]\d{9}$/;
		var res = pattern.test(phoneVal);
		if(!res) {

			$('#phonetips').html('手机号格式错误').css('color', 'red');
			return false;
		}

		// 发起ajax请求表单验证
		$.ajax({
			type: 'get',
			url: '{{url("home/dophoneregister")}}',
			data: 'phone=' + phoneVal,
			success: function  (data) {

				$('#phonetips').html(data.msg).css('color', 'green');
			},
			error: function (errordata) {

				if(errordata.responseText) { 
					var error = JSON.parse(errordata.responseText).errors;
					for (var key in error) {

						$('#phonetips').html(error[key][0]).css('color', 'red');
						return false;
					}
				}
			},
			//dataType: 'json'
		});		
	});




	// 获取手机短信验证的按钮
	$(function () {
            $('#btn').click(function () {
    			 
            	// 获取手机验证码之前,再去判断一次手机号的情况
            	// 判断有没有输入手机号
            	if (phoneVal == '') {

            		$('#phonetips').html('请输入手机号').css('color', 'red');
					return false;
            	}


            	// 判断手机号是否合法
				var pattern = /^1[34578]\d{9}$/;
				var res = pattern.test(phoneVal);
				if(!res) {

					$('#phonetips').html('手机号格式错误').css('color', 'red');
					return false;
				}

				// 发起ajax请求表单验证手机号是否已注册
				$.ajax({
					type: 'get',
					url: '{{url("home/dophoneregister")}}',
					data: 'phone=' + phoneVal,
					success: function  (data) {

						$('#phonetips').html(data.msg).css('color', 'green');
						
						// 判断手机通过所有判断是否ok
						if(data.code == 123) {


							// 走进来则可以发起请求发送
							//console.log('可以发送');


							// 设置获取按钮特效,XX秒后重新获取
			                var count = 120;
			                var countdown = setInterval(CountDown, 1000);
			                function CountDown() {
			                    $("#btn").attr("disabled", true);
			                    $("#btn").val(count + "秒后重新获取");
			                    if (count == 0) {
			                        $("#btn").val("免费获取验证码").removeAttr("disabled");
			                        clearInterval(countdown);
			                    }
			                    count--;
			                }

			                // 页面提示已发送验证码

			                $('#pyzmtips').html('已发送验证码,2分钟内输入有效,请在手机查看').css('color', 'green');


							// 发起发送手机验证码请求
							$.ajax({

								type: 'get',
								url: '{{url("home/getpyzm")}}',
								data: 'phone=' + phoneVal,
								success: function (pdata) {
									console.log(pdata.msg);
								}
							});


						} else { cnosole.log('不能发送'); return false;}


					},//判断手机号success的结束
					
				});//判断手机号ajax的结束		
	
            });// 点击获取验证码事件的结束

        });// 定义点击获取验证码的函数的结束

	

	// 手机验证码输入框
	// 获取焦点提示
	$('#pyzm').focus(function () {

		$('#pyzmtips').html('请输入六位数验证码').css('color', 'gray');
	});

	// 失去焦点消失提示
	$('#pyzm').blur(function () {

		$('#pyzmtips').html('');
	});


	// 注册按钮的点击事件 所有表单重新判断一次是否为空 ajax判断手机验证码是否正确
	// 定义手机验证码的全局变量
	var pyzmVal = '';
	$('#submit').click( function () {


		// 判断有没有输入用户名
		usernameVal = $('#username').val();
		if (!usernameVal) {

			$('#usernametips').html('请输入用户名').css('color', 'red');
			return false;
		}

		// 判断有没有输入密码
		passVal = $('#pass').val();
		if (!passVal) {

			$('#passtips').html('请设置密码').css('color', 'red');
			return false;
		}

		// 判断有没有确认密码
		repassVal = $('#repass').val();
		if(!repassVal) {

			$('#repasstips').html('请再次输入密码').css('color', 'red');
			return false;
		}


		// 判断有没有输入手机号
		phoneVal = $('#phone').val();

		if(phoneVal.length == 0) {

			$('#phonetips').html('请输入手机号').css('color', 'red');
			return false;
		}


		// 判断有没有输入手机验证码
		pyzmVal = $('#pyzm').val();
		if(pyzmVal == '') {

			$('#pyzmtips').html('请输入手机短信验证码').css('color', 'red');
			return false;
		}

		// 发起ajax请求去判断手机验证码是否正确
		$.ajax({

			type: 'post',
			url: '{{url("home/doregister")}}',
			data: {'phone': phoneVal, 'pyzm': pyzmVal, 'username': usernameVal, 'password': passVal},
			success: function (data) {

				if(data.code == 440) {

					$('#pyzmtips').html(data.msg).css('color', 'red');
					return false;
				}	

				if(data.code == 230) {

					alert(data.msg);
				}

				if (data.code == 220) {
 	 
					alert(data.msg);
					location.href = '{{url("home/login")}}';
				}	

			},

			dataType: 'json'
		});
		


	});
</script>
