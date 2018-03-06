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

		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-address">
						<!--标题 -->

						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
						</div>
						@include ('Common.msg')
						@include ('Common.errormsg')
						@include ('Common.pattern')
						<hr/>
						<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">

							<!-- 遍历地址 -->

							<span style="color: red; font-size: 20px">{{empty(count($address_info))? '亲，你还没有收货地址，快去新添加一个吧' : ''}}
							</span>
							
							@foreach ($address_info as $v)
							<li date-id="{{$v->id}}" class="user-addresslist {{$v->status == 1? 'defaultAddr' : ''}}">
								<span class="new-option-r"><i class="am-icon-check-circle"></i>{{$v->status == 1? '当前收货地址' : '设为收货地址'}}</span>
								<p class="new-tit new-p-re">
									<span class="new-txt">{{$v->name}}</span>
									<span class="new-txt-rd2">{{$v->phone}}</span>
								</p>
								<div class="new-mu_l2a new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：</span>
										<span class="province">{{$v->province}}</span>省
										<span class="city">{{$v->city}}</span>市
										<span class="dist">{{$v->county}}</span>区
										<span class="street">{{$v->address}}</span></p>
								</div>
								<div class="new-addr-btn" date-id="{{$v->id}}">
									<a href="{{url('home/address_alter'.$v->id)}}"><i class="am-icon-edit"></i>编辑</a>
									<span class="new-addr-bar">|</span>
									<a href="javascript:void(0);" class="del"><i class="am-icon-trash"></i>删除</a>
								</div>
							</li>
							@endforeach

						</ul>

						<div class="clear"></div>
						<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
						<!--例子-->
						<div class="am-modal am-modal-no-btn" id="doc-modal-1">

							<div class="add-dress">

								<!--标题 -->
								<div class="am-cf am-padding">
									<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
								</div>
								<hr/>

								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">


									<!-- 表单开始 -->
									<form class="am-form am-form-horizontal" method="post" action="{{url('home/address_add')}}">
										{{csrf_field()}}
										<div class="am-form-group">
											<label for="user-name" class="am-form-label">收货人</label>
											<div class="am-form-content">
												<input type="text" id="user-name" placeholder="收货人" tips="请输入2-8位的中文" name="getname">
												<span>.</span>
											</div>
										</div>

										<div class="am-form-group">
											<label for="user-phone" class="am-form-label">手机号码</label>
											<div class="am-form-content">
												<input id="user-phone" placeholder="手机号必填" type="text" tips="请输入11位数字的手机号码" name="phone">
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
												<input type="text" id="address-detail" placeholder="输入你的详细地址" tips="请30字以内写出你的详细地址" name="detail_address">
												<span>.</span>
											</div>
										</div>

										<div class="am-form-group">
											<div class="am-u-sm-9 am-u-sm-push-3">
												<input type="submit" id="submit" class="am-btn am-btn-danger" value="保存">
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
	<!-- 设置默认收货地址的ajax -->
	<script type="text/javascript">
		$(document).ready(function() {							
			$(".new-option-r").click(function() {

				var edit_id = $(this).parent('.user-addresslist').attr('date-id');

				var that = $(this);

				$.ajax({ 

					type: 'post',
					dataType: 'json',
					url: '{{url("home/address_edit")}}',
					data: 'id='+edit_id,

					success: function (msg) {

						alert(msg.rel);

						that.html('<i class="am-icon-check-circle"></i>当前收货地址').parent('.user-addresslist').siblings().children(".new-option-r").html('<i class="am-icon-check-circle"></i>设为收货地址')

						that.parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
					}
				});
				
			});
			
			var $ww = $(window).width();
			if($ww>640) {
				$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
			}
			
		})
	</script>

	<script>

		//处理ajax删除的
		$(".del").click(function () {

			var del_id = $(this).parent().attr('date-id');

			var that = $(this);

			$.ajax({

				type: 'post',
				url: '{{url("home/address_del")}}',
				dataType: 'json',
				data: 'id=' + del_id,

				success:function (msg) {

					if (msg.code == 200) alert(msg.msg);
					that.parent().parent().remove();
				} 

			});

		});




	</script>




	<script> 
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

//--></SCRIPT>0