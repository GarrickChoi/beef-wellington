<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>忘记密码-重置密码</title>

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
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">找回密码-重置密码</strong> / <small>Reset&nbsp;Password</small></div>
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
					<form class="am-form am-form-horizontal">
						
						<div class="am-form-group">
							<label for="user-new-password" class="am-form-label">新密码</label>
							<div class="am-form-content">
								<input type="password" id="pass" name="pass" placeholder="由数字、字母组合">
								<span id="passtips" style="font-size:15px"></span>
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-confirm-password" class="am-form-label">确认密码</label>
							<div class="am-form-content">
								<input type="password" id="repass" placeholder="请再次输入上面的密码">
								<span id="repasstips" style="font-size:15px"></span>
							</div>
						</div>
						<div class="info-btn">
							<div class="am-btn am-btn-danger" id="save">保存修改</div>
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

			$('#passtips').html('密码必须包含字母和数字,防止被盗风险1').css('color', 'red');
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

/*var phone = {{$phone}};
console.log(phone);*/

	// 提交修改密码
	$('#save').click(function () {

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

			$('#passtips').html('密码必须包含字母和数字,防止被盗风险2').css('color', 'red');
			return false;
		} 


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



		// 拿到要修改密码的手机号
		var phone = {{$phone}};
		// 发起ajax去修改密码
		$.ajax({
     		
     		type: 'post',
			url: '{{url("home/editpass")}}',
			data: {'password': passVal, 'phone': phone},
			success: function (data) {
				
				if(data.code == 222) {

					alert(data.msg);
					location.href = '{{url("home/login")}}';
					return false;
				}

				if(data.code == 456) {

					alert(data.msg);
					return false;
				}
			},

		});

	});
</script>