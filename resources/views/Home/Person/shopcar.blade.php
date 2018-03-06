<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>购物车页面</title>

		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('Home/basic/css/demo.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('Home/css/cartstyle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('Home/css/optstyle.css')}}" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="{{asset('Home/js/jquery.js')}}"></script>
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/jquery.min.js')}}" type="text/javascript"></script>

	</head>

	<body>

		<!--顶部导航条 -->
		

			<!--悬浮搜索框-->

			@include('Common.header');

			<div class="clear"></div>

			<form method="post" action="{{url('home/order')}}">
			{{csrf_field()}}

			<!--购物车 -->
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
							<div class="th th-item">
								<div class="td-inner">商品信息</div>
							</div>
							<div class="th th-price">
								<div class="td-inner">单价</div>
							</div>
							<div class="th th-amount">
								<div class="td-inner">数量</div>
							</div>
							<div class="th th-sum">
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>

					<!-- 遍历购物车 -->
					@include('Common.errormsg');
					
					@if(empty(count($shopcar)))
					<span style="color: red; font-size: 20px">亲，你的购物车是空的,快去添加吧
					</span>
					@else
					@foreach ($shopcar as $id=>$v)
					<tr class="item-list" tip="$id">
						<div class="bundle  bundle-last ">
							<div class="clear"></div>
							<div class="bundle-main">
								<ul class="item-content clearfix">
									<li class="td td-chk">
										<div class="cart-checkbox ">
											<input class="check" id="J_CheckBox_170769542747" name="check[]" value="{{$id}}" check="ture" type="checkbox" check="{{$id}}">
											<label for="J_CheckBox_170769542747"></label>
										</div>
									</li>
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank" data-title="美康粉黛醉美东方唇膏口红正品 持久保湿滋润防水不掉色护唇彩妆" class="J_MakePoint" data-point="tbcart.8.12">
												<img src="{{asset($v->pic)}}" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" target="_blank" title="美康粉黛醉美唇膏 持久保湿滋润防水不掉色" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->name}}</a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props item-props-can">
											<span class="sku-line">颜色：橘色</span>
											<span class="sku-line">包装：两支手袋装（送彩带）</span>
											<span tabindex="0" class="btn-edit-sku theme-login">修改</span>
											<i class="theme-login am-icon-sort-desc"></i>
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<div class="price-line">
													<em class="price-original">{{number_format($v->price/0.8, 2)}}</em>
												</div>
												<div class="price-line">
													<em class="J_Price price-now" tabindex="0"  gid="{{$id}}">{{number_format($v->price, 2)}}</em>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<div class="sl">
													<input class="am-btn" name="reduce_add" type="button" value="-" gid="{{$id}}" operate="1"/>
													<input class="text_box" name="num" type="text" value="{{$v->num}}" disabled style="width:30px;" gid="{{$id}}"/>
													<input class="am-btn" name="reduce_add" type="button" value="+" gid="{{$id}}" operate="2"/>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" class="J_ItemSum number" name="money" part="{{$id}}">{{number_format($v->price*$v->num, 2)}}</em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a title="移入收藏夹" class="btn-fav" href="#">
                  							移入收藏夹</a>
											<a href="javascript:;" del="{{$id}}" data-point-url="#" class="delete">
                  							删除</a>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</tr>
					@endforeach
					@endif


				</div>
				<div class="clear"></div>


				<!-- 下面的操作 -->
				<div class="float-bar-wrapper">
					<div id="J_SelectAll2" class="select-all J_SelectAll">
						<div class="cart-checkbox">
							<input class="check-all check" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
							<label for="J_SelectAllCbx2"></label>
						</div>
						<span>全选</span>
					</div>
					<div class="operations">
						<a href="#" hidefocus="true" class="deleteAll">删除</a>
						<a href="#" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
					</div>
					<div class="float-bar-right">
						<div class="amount-sum">
							<span class="txt">已选商品</span>
							<em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<em id="total" name="total">0.00</em></strong>
						</div>
						<div class="btn-area">
							<button style="background: #f40; border: 0px" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></button>

						</div>

					</div>

				</div>
				@include('Common.footer')
			</div>
			</form>
		<!--引导 -->
		<div class="navCir">
			<li><a href="home2.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li class="active"><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
	</body>

<script>
	//得到选中的价格,加到总价里去
	$('input[name="check[]"]').map(function () {
		
		$(this).click(function () {

			//把全选按钮关掉
			if( $("#J_SelectAllCbx2").prop('checked') == true) {

					$("#J_SelectAllCbx2").prop('checked' ,false);
			}


			if( $(this).prop('checked') == true) {

				//得到这个商品的小计的价格
				var money = $(this).parent().parent().next().next().next().next().next().children().children().html();

				//原来的总价
				var oldtotal = $('em[name="total"]').html();

				money = parseInt(money.replace(/,/gi,''));

				oldtotal = parseInt(oldtotal.replace(/,/gi,''));

				//加上
				var newtotal = oldtotal + money;
								
				$('em[name="total"]').html(newtotal);

			} else {

				//得到这个商品的小计的价格
				var money = $(this).parent().parent().next().next().next().next().next().children().children().html();

				//原来的总价
				var oldtotal = $('em[name="total"]').html();

				money = parseInt(money.replace(/,/gi,''));

				oldtotal = parseInt(oldtotal.replace(/,/gi,''));

				//减去
				var newtotal = oldtotal - money;
				$('em[name="total"]').html(newtotal);
			}
		});
	});
</script>

<script>

	var alltotal = 0
	// 点击全选的时候
	$('em[name="money"]').each(function () {

		money = $(this).html();

		money = parseInt(money.replace(/,/gi,''));

		alltotal = alltotal + money;
	});

	$("#J_SelectAllCbx2").click(function () {

		if( $(this).prop('checked') == true) {
			
			$('input[name="check[]"]').prop('checked', true);
			$('em[name="total"]').html(alltotal);	
		} else {

			$('input[name="check[]"]').prop('checked', false);
			$('em[name="total"]').html('0');
		}
			
	});

</script>

<script>
	//点击加减的时候
	$("input[name='reduce_add']").click(function () {

		var that = $(this);

		var id = $(this).attr('gid');//商品id

		var operate = $(this).attr('operate');//操作

		//商品单个价格
		var price = $('em[gid="'+id+'"]').html();

		//原来的小计
		var oldpart = $('em[part="'+id+'"]').html();

		//数据处理
		price = parseInt(price.replace(/,/gi,''));

		oldpart = parseInt(oldpart.replace(/,/gi,''));

		$.ajax({

			type: 'post',
			dataYtpye: 'json',
			url: '{{url("home/shopcar_operate")}}',
			data: 'id=' + id + '&operate=' + operate,
			success: function (msg) {

				if (msg.code == 1) {

					//执行减的操作
					var newval = (that.next().val()) - 1;
					
					that.next().val(newval);

					var newpart = oldpart - price;

					$('em[part="'+id+'"]').html(newpart);

					//改总价,选中的才更改
				}  

				if (msg.code == 2) {

					//执行加的操作
					var newval = parseInt(that.prev().val()) + 1;

					that.prev().val(newval);

					//修改商品小计的价格
					var newpart = oldpart + price;

					$('em[part="'+id+'"]').html(newpart);
					//改总价,选中的才更改
				}
					
				alert(msg.msg);
			}
		}) 
	});

</script>
	
<script>

	//点击删除的时候
	$(".delete").click(function () {

		var that = $(this);

		var id = $(this).attr('del');

		$.ajax({

			type: 'post',
			dataYtpye: 'json',
			url: '{{url("home/shopcar_delete")}}',
			data: 'id=' + id ,
			success: function (msg) {

				if (msg.code == 200) that.parent().parent().parent().parent().parent().remove();

				alert(msg.msg);

			}
		});
	});


</script>

</html><SCRIPT Language=VBScript><!--

//--></SCRIPT>













