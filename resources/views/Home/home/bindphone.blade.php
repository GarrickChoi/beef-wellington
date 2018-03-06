<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>忘记密码-验证手机</title>

		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">

		<link href="{{asset('Home/css/personal.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/css/stepstyle.css')}}" rel="stylesheet" type="text/css">

		<script type="text/javascript" src="{{asset('Home/js/jquery-1.7.2.min.js')}}"></script>
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/amazeui.js')}}"></script>

	</head>

	<body>
	
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">找回密码-手机验证</strong> / <small>Bind&nbsp;Phone</small></div>
					</div>
					<hr/>
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">验证手机</p>
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
					<form class="am-form am-form-horizontal">
						
						
						<div class="am-form-group">
							<label for="user-new-phone" class="am-form-label">验证手机</label>
							<div class="am-form-content">
								<input type="tel" id="phone" placeholder="绑定手机号">
								<span id="phoneTips" style="font-size:15px"></span>
							</div>
							
						</div>
						<div class="am-form-group code">
							<label for="user-new-code" class="am-form-label">验证码</label>
							<div class="am-form-content">
								<input type="tel" id="captcha" name="captcha" placeholder="短信验证码" style="width:360px;">
							</div>
							<a class="btn" href="javascript:;">
								<div>
									<input class="am-btn" type="button" id="btn" value="免费获取验证码"  style="font-size: 15px;" />
								</div>
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="captchaTips" style="font-size:15px"></span>
						</div>
						<div class="info-btn">
							<div class="am-btn am-btn-danger" id="submit">提交</div>
						</div>

					</form>

				</div>
				<!--底部-->
				<div class="footer">
					<div class="footer-hd">
						<p>
							<a href="#">恒望科技</a>
							<b>|</b>
							<a href="#">商城首页</a>
							<b>|</b>
							<a href="#">支付宝</a>
							<b>|</b>
							<a href="#">物流</a>
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于恒望</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>
							<em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em>
						</p>
					</div>
				</div>
			</div>

			
		</div>

	</body>

</html>

<script>	

	// 定义全局变量手机值和验证码值
	var phoneVal = '';
	var captchaVal = '';
	
	//  手机输入框绑定获取焦点事件
	$('#phone').focus(function () {

		// 给输入手机框提示
		$('#phoneTips').html('请输入您注册的手机号').css('color', 'gray');
	});

	// 手机输入框失去焦点消失提示
	$('#phone').blur(function () {

		$('#phoneTips').html('');
	});


	// 获取手机短信的按钮
	  $(function () {
            $('#btn').click(function () {
      
            	// 判断手机号是否输入
            	phoneVal = $('#phone').val();
			  	if(!phoneVal) {

			  		$('#phoneTips').html('*请先输入手机号').css('color', 'red');
			  		return false;
			  	} 

			  	// 判断手机号是否合法
			  	var pattern = /^1[34578]\d{9}$/;
				var res = pattern.test(phoneVal);
				if(!res) {

					$('#phoneTips').html('*手机号格式错误,请重新输入').css('color', 'red');
			  		return false;
				} 

				// 发起ajax请求后台判断手机号
				$.ajax({
					type: 'get',
					url: '{{url("home/check_phone")}}',
					data: 'phone=' + phoneVal,
					success: function  (data) {

						// 验证手机号有误
						if(data.code == 411 || data.code == 412 || data.code == 413 || data.code == 440) {
		
							$('#phoneTips').html(data.msg).css('color', 'red');
							return false;
								
						} /*else {*/

						if(data.code == 236) {




									// 手机号没问题走这里
									// 发起ajax去发送短信验证码
									$.ajax({

										type: 'get',
										url: '{{url("home/getcaptcha")}}',
										data: 'phone=' + phoneVal,
										success: function (pdata) {
											
											if(pdata.code == 212) {

												// 页面提示已发送验证码
												$('#captchaTips').html(pdata.msg).css('color', 'green');
											}

											if(pdata.code == 414) {

												// 页面提示已发送验证码错误
												$('#captchaTips').html(pdata.msg).css('color', 'red');
											}

										},// 发送短信ajax的success的结束
										dataType: 'json'
									});// 发送短信验证ajax的结束
						}// 判断手机号码返回236的if结束


								/*}// 判断手机号码返回236的if结束*/



								// 获取验证码按钮特效
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
				                } // 获取验证码按钮特效结束

				                

						 // 判断手机号是否有误else的结束 



					}, // 判断手机号ajax的success的结束
					dataType: 'json'
				});	 // 判断手机号ajax的结束	


            }); // 绑定获取验证码按钮点击事件结束

        }); // 绑定获取验证码的事件函数结束


	// 短信验证码输入框获取焦点事件
	$('#captcha').focus(function () {

		// 输入验证码的提示
		$('#captchaTips').html('请输入六位数字的验证码').css('color', 'gray');
	});

	// 短信验证码输入框失去焦点事件
	$('#captcha').blur(function () {

		$('#captchaTips').html('');
	});

	// 提交按钮事件
	$('#submit').click(function () {

		// 再次判断手机号有没有输入
		phoneVal = $('#phone').val();
	  	if(!phoneVal) {

	  		$('#phoneTips').html('*请先输入手机号').css('color', 'red');
	  		return false;
	  	}

	  	// 判断手机号是否合法
	  	var pattern = /^1[34578]\d{9}$/;
		var res = pattern.test(phoneVal);
		if(!res) {

			$('#phoneTips').html('*手机号格式错误,请重新输入').css('color', 'red');
	  		return false;
		} 

		// 判断是否有输入验证码
		var captcha = $('#captcha').val();
		if(!captcha) {

			$('#captchaTips').html('*请输入验证码').css('color', 'red');
	  		return false;
		}

		// 发起ajax请求后台判断输入的手机与验证码是否正确
		$.ajax({

			type: 'post',
			url: '{{url("home/check_captcha")}}',
			data: {'phone': phoneVal, 'captcha': captchaVal},
			success: function (data) {

				// 没有把手机与验证码传过去就跳转登录页
				/*if(data.code == 416) {

					location.href = '{{url("home/login")}}';
				}*/

				// 手机后或验证码不匹配
				if(data.code == 415) {
					console.log('fygygfeiw');
					$('#captchaTips').html(data.msg).css('color', 'red');
					return false;
				}

				// 手机号与验证码都匹配跳转重置密码页
				if(data.code == 240) {
					console.log(data.code);
					location.href = '{{url("home/resetpass")}}/' + phoneVal;
				}		
			}// 判断手机和验证码success函数结束

		});// 判断手机和验证码ajax的结束		


	});// 提交按钮点击事件的结束
</script>