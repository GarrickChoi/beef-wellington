<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>订单管理</title>

		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">

		<link href="{{asset('Home/css/personal.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('Home/css/orstyle.css')}}" rel="stylesheet" type="text/css">

		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('Home/AmazeUI-2.4.2/assets/js/amazeui.js')}}"></script>

	</head>

	<body>
		<!--头 -->
		
		@include('Common.header')
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-order">

						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
						</div>
						<hr/>

						<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>
						@include('Common.msg')
						@include('Common.errormsg')
							<div class="am-tabs-bd">
								<div class="am-tab-panel am-fade am-in am-active" id="tab1">
									<div class="order-top">
										<div class="th th-item">
											<td class="td-inner">商品</td>
										</div>
										<div class="th th-price">
											<td class="td-inner">单价</td>
										</div>
										<div class="th th-number">
											<td class="td-inner">数量</td>
										</div>
										<div class="th th-operation">
											<td class="td-inner">商品操作</td>
										</div>
										<div class="th th-amount">
											<td class="td-inner">合计</td>
										</div>
										<div class="th th-status">
											<td class="td-inner">交易状态</td>
										</div>
										<div class="th th-change">
											<td class="td-inner">交易操作</td>
										</div>
									</div>

									<div class="order-main">
										<div class="order-list">

											@if(empty(count($orderarr)))
											<span style="color: red; font-size: 20px">亲，你的购物车是空的,快去添加吧
											</span>
											@else
											@foreach ($orderarr as $v)
											<div class="order-status2">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{$v->order_num}}</a></div>
													<span>成交时间：{{$v->addtime}}</span>
													<!--    <em>店铺：小桔灯</em>-->
												</div>
												<div class="order-content">
													<div class="order-left">

														<!-- 遍历ul -->
														@foreach ($order_detail as $v2)
														@if ( $v->id == $v2->id )
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="#" class="J_MakePoint">
																		<img src="{{asset($v2->gimg)}}" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info">
																	<div class="item-basic-info">
																		<a href="#">
																			<p>{{$v2->name}}</p>
																			<p class="info-little">颜色：12#川南玛瑙
																				<br/>包装：裸装 </p>
																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{number_format($v2->count_num)}}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{$v2->num}}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	<!-- <a href="refund.html">退款</a> -->
																</div>
															</li>
														</ul>
														@endif
														@endforeach
													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{number_format($v->total, '2')}}
																<p>含运费：<span>10.00</span></p>
															</div>
														</li>
														<div class="move-right">
															<li class="td td-change">
																<div class="am-btn am-btn-danger anniu">
																订单详情</div>
															</li>
															<li class="td td-change">
																<div ><a class="am-btn am-btn-danger anniu" href="{{url('home/order_status_change/'.$v->id)}}">
																@switch($v->status)
													              @case(1)
													                立即付款
													              @break

													              @case(2)
													                提醒发货
													              @break

													              @case(3)
													                确认收货
													              @break

													              @case(4)
													                已完成
													              @break

													              @case(5)
													                已取消
													              @break

													              @case(6)
													                待评价
													              @break

													              @default
													                订单有误
													            @endswitch
													            </a>
																</div>
															</li>
														</div>
													</div>
												</div>
											</div>
											@endforeach
											@endif

										</div>

									</div>

								</div>
							</div>

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