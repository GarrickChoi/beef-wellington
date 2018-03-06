<!DOCTYPE html>
<html> 

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>地址管理</title>

		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">

		<link href="{{asset('Home/css/personal.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/css/addstyle.css')}}" rel="stylesheet" type="text/css">
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/jquery.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/amazeui.js')}}"></script>
		

	</head>

	<body>
		<!--头 -->
		@include('Common.header') 

		<b class="line"></b>

		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-address">
						<hr/>
						<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
						</ul>

						<div class="clear"></div>
						<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
						<!--例子-->
						<div class="am-modal am-modal-no-btn" id="doc-modal-1">

							<div class="add-dress">

								<!--标题 -->
								<div class="am-cf am-padding">
									<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改地址</strong> / <small>Add&nbsp;address</small></div>
								</div>
								<hr/>

								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">

									@include ('Common.msg')
									@include ('Common.errormsg')
									@include ('Common.pattern')

									<!-- 表单开始 -->
									<form class="am-form am-form-horizontal" method="post" action="{{url('home/address_doalter')}}">
										{{csrf_field()}}
										<input type="hidden" name="id" value="{{$address_info->id}}">
										<div class="am-form-group">
											<label for="user-name" class="am-form-label">收货人</label>
											<div class="am-form-content">
												<input type="text" id="user-name" placeholder="收货人" tips="请输入2-8位的中文" name="getname" value="{{$address_info->name}}">
												<span>.</span>
											</div>
										</div>

										<div class="am-form-group">
											<label for="user-phone" class="am-form-label">手机号码</label>
											<div class="am-form-content">
												<input id="user-phone" placeholder="手机号必填" type="text" tips="请输入11位数字的手机号码" name="phone" value="{{$address_info->phone}}">
												<span>.</span>
											</div>
										</div>

										<div class="am-form-group info">
											<label for="user-address" class="am-form-label">所在地</label>
											<div class="am-form-content address">

												<select id="s_province" class="ellipsis" name="s_province">
												</select>

												<select id="s_city" class="ellipsis" name="s_city">
												</select>

												<select id="s_county" class="ellipsis" class="ellipsis" name="s_county">
												</select>
											</div>
											<div id="three" style="margin-left:110px; color:red">
											</div>
										</div>

										<div class="am-form-group">
											<label for="address-detail" class="am-form-label">详细地址</label>
											<div class="am-form-content">
												<input type="text" id="address-detail" placeholder="输入你的详细地址" tips="请30字以内写出你的详细地址" name="detail_address" value="{{$address_info->address}}">
												<span>.</span>
											</div>
										</div>

										<div class="am-form-group">
											<div class="am-u-sm-9 am-u-sm-push-3">
												<input type="submit" id="submit" class="am-btn am-btn-danger" value="保存修改">
												<input type="reset" class="am-close am-btn am-btn-danger" data-am-modal-close value="重置">
											</div>
										</div>
									</form>
								</div>

							</div>

						</div>

					</div>
					<div class="clear"></div>
				</div>
				<!--底部-->
				@include('Common.footer')
			</div>
			@include('Common.menu')
		</div>
	</body>

	<script> 

		var $ww = $(window).width();
		if($ww>640) {
			$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
		}



 		//获取焦点的事件
		$("input[tips^='请']").focus(function () {

			$(this).next().css('color', 'gray');
			$(this).next().html($(this).attr('tips'));

		});

		//失去焦点事的事件
		$("input[tips^='请']").blur(function () {

			$(this).next().css('color', 'gray');
			$(this).next().html('.');

		});

		//前段正则判断
		$('#submit').click(function () {

			//收货人
			var getman_pattern = /^[\u4e00-\u9fa5]{2,8}$/;
			var rel_getman = $("input[name='getname']").val().match(getman_pattern);
			
			if (!rel_getman) {

				$("input[name='getname']").next().css('color', 'red');
				$("input[name='getname']").next().html('*输入有误,请输入2-8位的中文');
				return false;

			}

			//电话号码
			var phone_pattern = /^(1[358]\d|147|17[1687])\d{8}$/;
			var rel_phone = $("input[name='phone']").val().match(phone_pattern);

			if (!rel_phone) {

				$("input[name='phone']").next().css('color', 'red');
				$("input[name='phone']").next().html('*输入有误，请输入11位正确的手机号码');
				return false;

			}

			//省市级是否有选择
			var province = $('#s_province').val();
			var city = $('#s_city').val();
			var county = $('#s_county').val();
			if (province === "省份" || city === "地级市" || county === "县级市") {

				$('#three').html('*省市级未填写');
				return false;

			}

			//详细地址
			var rel_detail = $("input[name='detail_address']").val().length;
			if (!rel_detail) {

				$("input[name='detail_address']").next().css('color', 'red');
				$("input[name='detail_address']").next().html('*输入有误，请输入详细地址');
				return false;

			}

		});

	</script>
	<!--  -->
	<script type="text/javascript" src="{{asset('Home/js/city.js')}}"></script>




</html><SCRIPT Language=VBScript><!--

//--></SCRIPT>