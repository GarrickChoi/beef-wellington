 <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>{{$goods->name}}</title>

		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('Home/basic/css/demo.css')}}" rel="stylesheet" type="text/css" />
		<link type="text/css" href="{{asset('Home/css/optstyle.css')}}" rel="stylesheet" />
		<link type="text/css" href="{{asset('Home/css/style.css')}}" rel="stylesheet" />

		<script type="text/javascript" src="{{asset('Home/basic/js/jquery-1.7.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('Home/basic/js/quick_links.js')}}"></script>
		

		<script type="text/javascript" src="{{asset('Home/AmazeUI-2.4.2/assets/js/amazeui.js')}}"></script>
		<script type="text/javascript" src="{{asset('Home/js/jquery.imagezoom.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('Home/js/jquery.flexslider.js')}}"></script>
		<script type="text/javascript" src="{{asset('Home/js/list.js')}}"></script>


		<link rel="stylesheet" href="{{asset('Home/11/css/xadmin.css')}}">



	</head>

	<body>


		<!-- 顶部导航条 -->
		<div class="am-container header">
			<ul class="message-l">
				<div class="topMessage">
					<div class="menu-hd">
						<a href="#" target="_top" class="h">亲，请登录</a>
						<a href="#" target="_top">免费注册</a>
					</div>
				</div>
			</ul>
			<ul class="message-r">
				<div class="topMessage home">
					<div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
				</div>
				<div class="topMessage my-shangcheng">
					<div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
				</div>
				<div class="topMessage mini-cart">
					<div class="menu-hd"><a id="mc-menu-hd" href="{{url('home/shopcar')}}" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
				</div>
				<div class="topMessage favorite">
					<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
			</ul>
			</div>

			<!-- 悬浮搜索框 -->

			<div class="nav white">
				<div class="logo"><img src="{{asset('Home/images/logo.png')}}"/></div>
				<div class="logoBig">
					<li><img src="{{asset('Home/images/logobig.png')}}" /></li>
				</div>
				<div class="search-bar pr">
					<a name="index_none_header_sysc" href="#"></a>
					<form>
						<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
						<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
					</form>
				</div>
			</div>

			<div class="clear"></div>
			<b class="line"></b>
			<div class="listMain">

				<!-- 分类 -->
			<div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="#">首页</a></li>
								<li class="qc"><a href="#">闪购</a></li>
								<li class="qc"><a href="#">限时抢</a></li>
								<li class="qc"><a href="#">团购</a></li>
								<li class="qc last"><a href="#">大包装</a></li>
							</ul>
						</div>
			</div>
				<ol class="am-breadcrumb am-breadcrumb-slash">
					<li><a href="#">首页</a></li>
					<li><a href="#">分类</a></li>
					<li class="am-active">内容</li>
				</ol>
				<script type="text/javascript">
					$(function() {});
					$(window).load(function() {
						$('.flexslider').flexslider({
							animation: "slide",
							start: function(slider) {
								$('body').removeClass('loading');
							}
						});
					});
				</script>
				<div class="scoll">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<img src="{{asset('storage/'.$pictures[0]->album.'/'.$pictures[0]->pic_name)}}" title="pic" />
								</li>
								<li>
									<img src="{{asset('storage/'.$pictures[0]->album.'/'.$pictures[0]->pic_name)}}" />
								</li>
								<li>
									<img src="{{asset('storage/'.$pictures[0]->album.'/'.$pictures[0]->pic_name)}}" />
								</li>
							</ul>
						</div>
					</section>
				</div>

				<!--放大镜 -->

				<div class="item-inform">
					<div class="clearfixLeft" id="clearcontent">

						<div class="box">
							<script type="text/javascript">
								$(document).ready(function() {
									$(".jqzoom").imagezoom();
									$("#thumblist li a").click(function() {
										$(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
										$(".jqzoom").attr('src', $(this).find("img").attr("mid"));
										$(".jqzoom").attr('rel', $(this).find("img").attr("big"));
									});
								});
							</script>

							<div class="tb-booth tb-pic tb-s310">
								<img style="width: 100%;height: 100%" src="{{asset('storage/'.$pictures[0]->album.'/'.$pictures[0]->pic_name)}}" alt="细节展示放大镜特效" rel="{{asset('storage/'.$pictures[0]->album.'/'.$pictures[0]->pic_name)}}" class="jqzoom" />
							</div>
							<ul class="tb-thumb" id="thumblist">
								@foreach($pictures as $v)
									<li class="tb-selected">
										<div class="tb-pic tb-s40">
											<a href="javascript:;"><img src="{{asset('storage/'.$v->album.'/'.$v->pic_name)}}" mid="{{asset('storage/'.$v->album.'/'.$v->pic_name)}}" big="{{asset('storage/'.$v->album.'/'.$v->pic_name)}}"></a>
										</div>
									</li>
								@endforeach
							</ul>
						</div>

						<div class="clear"></div>
					</div>

					<div class="clearfixRight" >

						<!--规格属性-->
						<!--名称-->
						<div class="tb-detail-hd">
							<h1>	
								{{$goods->name}}
							</h1>
						</div>
						<div class="tb-detail-list" >
							<!--价格-->
							<div class="tb-detail-price" style="height: 120px">
									<li class="price iteminfo_price">
										<dt>促销价</dt>
										<dd style="font-size:36px"><em style="font-size:20px;color: #FF0036">¥</em><b style="font-size:36px;color: #FF0036"  class="sys_item_price">{{$goods->price}}</b></dd>                                 
									</li>
									<li class="price iteminfo_mktprice">
										<dt>原价</dt>
										<dd><em>¥</em><b class="sys_item_mktprice">{{round($goods->price*1.5)}}.00</b></dd>
									</li>
								<div class="clear"></div>
							</div>

							<!--地址-->
							<dl class="iteminfo_parameter freight">
								<dt>配送至</dt>
								<div class="iteminfo_freprice" style="width: 115%;">
									<div class="am-form-content address">
										<select id="s_province" name="s_province" style="height:35px"></select>
										<select id="s_city" name="s_city" style="height:35px"></select>
										<select id="s_county" name="s_county" style="height:35px"></select>
									</div>
									<div class="pay-logis">
										快递:<b class="sys_item_freprice">0.00</b>
									</div>
								</div>
							</dl>
							<div class="clear"></div>

							<!--销量-->
							<ul class="tm-ind-panel">
								<li class="tm-ind-item tm-ind-sellCount canClick">
									<div class="tm-indcon"><span class="tm-label">点击量</span><span class="tm-count" style="color: #FF0036">{{$goods->clicknum}}</span></div>
								</li>
								<li class="tm-ind-item tm-ind-sumCount canClick">
									<div class="tm-indcon"><span class="tm-label">累计销量</span><span class="tm-count" style="color: #FF0036">{{$goods->buynum}}</span></div>
								</li>
								<li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
									<div class="tm-indcon"><span class="tm-label">累计评价</span><span class="tm-count" style="color: #FF0036">{{count($sum)}}</span></div>
								</li>
							</ul>
							<div class="clear"></div>

							<!--各种规格-->
							<dl class="iteminfo_parameter sys_item_specpara">
								<dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
								<dd>
									<!--操作页面-->

									<div class="theme-popover-mask"></div>

									<div class="theme-popover">
										<div class="theme-span"></div>
										<div class="theme-poptit">
											<a href="javascript:;" title="关闭" class="close">×</a>
										</div>
										<div class="theme-popbod dform">
											<form class="theme-signin" name="loginform" action="{{url('home/detail_shopcar_add')}}" method="get">

												<div class="theme-signin-left">

													<div class="theme-options">
														<div class="cart-title">尺码</div>
														<ul>
															<li class="sku-line selected">均码<i></i></li>
														</ul>
													</div>
													<div class="theme-options">
														<div class="cart-title">颜色</div>
														<ul>
															@foreach($price as $v)
																<li name="color" data-store="{{$v->store}}" data-color="{{$v->cid}}" data-gid="{{$v->gid}}" class="sku-line">{{$v->n}}<i></i></li>
															@endforeach
														</ul>
													</div>
													<div class="theme-options">
														<div class="cart-title number">数量</div>
														<dd>
																<input id="min" class="am-btn am-btn-default" name="" type="button" value="-" />
																<input id="text_box" name="num" tip="{{$price[0]->store}}" type="text" value="1" style="width:27px;height: 23px" />
																<input type="hidden" name="gid" value="{{$goods->id}}">
																<input id="add" class="am-btn am-btn-default" name="{{$price[0]->store}}" type="button" value="+" />
																<span id="Stock" class="tb-hidden">库存<span id="number" class="stock">{{$price[0]->store}}</span>件</span>
														</dd>
														<span id="text"></span>
													</div>
													<div class="clear"></div>

													<div class="btn-op">
														<div class="btn am-btn am-btn-warning">确认</div>
														<div class="btn close am-btn am-btn-warning">取消</div>
													</div>
												</div>
										</div>
									</div>

								</dd>
							</dl>
							<div class="clear"></div>
							<!--活动	-->
							<div class="shopPromotion gold">
								<div class="hot">
									<dt class="tb-metatit">优惠</dt>
									<div class="gold-list">
										<p>春节期间，全国包邮</p>
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</div>

						<div class="pay">
							<div class="pay-opt">
							<a href="home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
							<a><span class="am-icon-heart am-icon-fw">收藏</span></a>
							
							</div>
							<li>
								<div class="clearfix tb-btn tb-btn-buy theme-login">
									<a id="LikBuy" title="点此按钮到下一步确认购买信息" href="javascript:;">立即购买</a>
								</div>
							</li>
							<li>
								<div class="clearfix tb-btn tb-btn-basket theme-login">
									<a id="LikBasket" title="加入购物车" href="javascript:;"><i></i><button style="background:#F03726;border: 0;margin-bottom: 3px">加入购物车</button></a>
								</div>
								</form>
							</li>
						</div>

					</div>

					<div class="clear"></div>

				</div>		
				<!-- introduce-->
				@include('Common.msg');
				<div class="introduce">
					<div class="browse">
						<div class="mc"> 
							<ul>					    
								<div class="mt">            
									<h2>看了又看</h2>        
								</div>
								
								@foreach($clicknum_goods as $v)
								  	<li class="first">
										<div class="p-img">                    
											<a href="{{url('detail?gid='.$v->id)}}"> <img class="" src="{{asset('storage/'.$v->album.'/'.$v->pic_name)}}"> </a>               
										</div>
										<div class="p-name"><a href="{{url('detail')}}">{{$v->name}}</a>
										</div>
										<div class="p-price"><strong style="color: #FF0036">￥{{$v->price}}</strong></div>
								  	</li>
								@endforeach
								 
							</ul>					
						</div>
					</div>
					<div class="introduceMain">
						<div class="am-tabs" data-am-tabs>
							<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active">
									<a href="#">

										<span class="index-needs-dt-txt">商品详情</span></a>

								</li>

								<li>
									<a href="#">

										<span class="index-needs-dt-txt">商品评价 ({{count($sum)}})</span></a>

								</li>

								<li>
									<a href="#">

										<span class="index-needs-dt-txt">猜你喜欢</span></a>
								</li>
							</ul>

							<div class="am-tabs-bd">

								<div class="am-tab-panel am-fade am-in am-active">
									<div class="J_Brand">

										<div class="attr-list-hd tm-clear">
											<h4>产品参数：</h4></div>
										<div class="clear"></div>
										<ul id="J_AttrUL">
											<li title="">品牌:&nbsp;{{$parameter[0]->brand_name}}</li>
											<li title="">材料:&nbsp;{{$parameter[0]->ingredient_name}}</li>
											<li title="">销售渠道:&nbsp;{{$parameter[0]->market_name}}</li>
											<li title="">基础风格:&nbsp;{{$parameter[0]->style_name}}</li>
											<li title="">颜色:&nbsp;{{$parameter[0]->colors_name}}</li>
											<li title="">适用季节:&nbsp;{{$parameter[0]->season_name}}</li>
											<li title="">适用对象:&nbsp;{{$parameter[0]->objects_name}}</li>
										</ul>
										<div class="clear"></div>
									</div>

									<div class="details">
										<div class="attr-list-hd after-market-hd">
											<h4>商品细节</h4>
										</div>
										<div class="twlistNews">
											
										</div>
									</div>
									<div class="clear"></div>

								</div>

								<div class="am-tab-panel am-fade">
									
									<div class="actor-new">
										<div class="rate">                
											<strong>{{round($evaluate)}}%</strong><br> <span>好评度</span>            
										</div>
										<dl>                    
											<dt>买家印象</dt>                    
											<dd class="p-bfc">
														<q class="comm-tags"><span>味道不错</span><em>(2177)</em></q>
														<q class="comm-tags"><span>颗粒饱满</span><em>(1860)</em></q>
														<q class="comm-tags"><span>口感好</span><em>(1823)</em></q>
														<q class="comm-tags"><span>商品不错</span><em>(1689)</em></q>
														<q class="comm-tags"><span>香脆可口</span><em>(1488)</em></q>
														<q class="comm-tags"><span>个个开口</span><em>(1392)</em></q>
														<q class="comm-tags"><span>价格便宜</span><em>(1119)</em></q>
														<q class="comm-tags"><span>特价买的</span><em>(865)</em></q>
														<q class="comm-tags"><span>皮很薄</span><em>(831)</em></q> 
											</dd>                                           
										 </dl> 
									</div>	
									<div class="clear"></div>
									<div class="tb-r-filter-bar">
										<ul class=" tb-taglist am-avg-sm-4">
											<li class="tb-taglist-li tb-taglist-li-current">
												<div class="comment-info">
													<span>全部评价</span>
													<span class="tb-tbcr-num">({{count($sum)}})</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-1">
												<div class="comment-info">
													<span>好评</span>
													<span class="tb-tbcr-num">({{count($good)}})</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-0">
												<div class="comment-info">
													<span>中评</span>
													<span class="tb-tbcr-num">({{count($center)}})</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li--1">
												<div class="comment-info">
													<span>差评</span>
													<span class="tb-tbcr-num">({{count($difference)}})</span>
												</div>
											</li>
										</ul>
									</div>
									<div class="clear"></div>

									<ul class="am-comments-list am-comments-list-flip">
										@if (!count($list))
											<li>暂无评论~~</li>
										@endif

										@foreach($list as $v)
											<li class="am-comment">
												<!-- 评论容器 -->
												<a href="javascript:;">
													<img class="am-comment-avatar" src="{{asset('Home/images/hwbn40x40.jpg')}}" />
													<!-- 评论者头像 -->
												</a>

												<div class="am-comment-main">
													<!-- 评论内容容器 -->
													<header class="am-comment-hd">
														<!--<h3 class="am-comment-title">评论标题</h3>-->
														<div class="am-comment-meta">
															<!-- 评论元数据 -->
															<a href="javascript:;" class="am-comment-author">{{$v->username}}</a>
															<!-- 评论者 -->
															评论于
															<time datetime="">{{$v->addtime}}</time>
														</div>
													</header>

													<div class="am-comment-bd">
														<div class="tb-rev-item " data-id="255776406962">
															<div class="J_TbcRate_ReviewContent tb-tbcr-content ">{{$v->content}}</div>
															<div class="tb-r-act-bar">
																颜色分类：柠檬黄&nbsp;&nbsp;尺码：S
															</div>
														</div>

													</div>
												</div>
											</li>
										@endforeach
									</ul>

									<div class="clear"></div>

									<!--分页 -->
									<ul class="page">
										<li name="paginate">{{$list->appends(['gid' => $goods->id])->links()}}</li>
									</ul>
									<div class="clear"></div>

									<div class="tb-reviewsft">
										<div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
									</div>

								</div>

								<div class="am-tab-panel am-fade">
									<div class="like">
										<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
											@foreach($buynum_goods as $v)
												<li>
													<div class="i-pic limit">
														<a href="{{url('detail?gid='.$v->id)}}"><img src="{{asset('storage/'.$v->album.'/'.$v->pic_name)}}" />
														<p class="price fl">
															<b style="color: #FF0036;">¥</b>
															<strong style="color: #FF0036">{{$v->price}}</strong>
														</p>
														<p style="width: 210px;height: 37px"><span>{{$v->name}}</span></p></a>
													</div>
												</li>
											@endforeach
										</ul>
									</div>
									<div class="clear"></div>
								</div>

							</div>

						</div>

						<div class="clear"></div>

					</div>

				</div>
			</div>
			<!--菜单 -->
			<div class=tip>
				<div id="sidebar">
					<div id="wrap">
						<div id="prof" class="item">
							<a href="#">
								<span class="setting"></span>
							</a>
							<div class="ibar_login_box status_login">
								<div class="avatar_box">
									<p class="avatar_imgbox"><img src="{{asset('Home/images/no-img_mid_.jpg')}}" /></p>
									<ul class="user_info">
										<li>用户名：sl1903</li>
										<li>级&nbsp;别：普通会员</li>
									</ul>
								</div>
								<div class="login_btnbox">
									<a href="#" class="login_order">我的订单</a>
									<a href="#" class="login_favorite">我的收藏</a>
								</div>
								<i class="icon_arrow_white"></i>
							</div>

						</div>
						<div id="shopCart" class="item">
							<a href="#">
								<span class="message"></span>
							</a>
							<p>
								购物车
							</p>
							<p class="cart_num">0</p>
						</div>
						<div id="asset" class="item">
							<a href="#">
								<span class="view"></span>
							</a>
							<div class="mp_tooltip">
								我的资产
								<i class="icon_arrow_right_black"></i>
							</div>
						</div>

						<div id="foot" class="item">
							<a href="#">
								<span class="zuji"></span>
							</a>
							<div class="mp_tooltip">
								我的足迹
								<i class="icon_arrow_right_black"></i>
							</div>
						</div>

						<div id="brand" class="item">
							<a href="#">
								<span class="wdsc"><img src="{{asset('Home/images/wdsc.png')}}" /></span>
							</a>
							<div class="mp_tooltip">
								我的收藏
								<i class="icon_arrow_right_black"></i>
							</div>
						</div>

						<div id="broadcast" class="item">
							<a href="#">
								<span class="chongzhi"><img src="{{asset('Home/images/chongzhi.png')}}" /></span>
							</a>
							<div class="mp_tooltip">
								我要充值
								<i class="icon_arrow_right_black"></i>
							</div>
						</div>

						<div class="quick_toggle">
							<li class="qtitem">
								<a href="#"><span class="kfzx"></span></a>
								<div class="mp_tooltip">客服中心<i class="icon_arrow_right_black"></i></div>
							</li>
							<!--二维码 -->
							<li class="qtitem">
								<a href="#none"><span class="mpbtn_qrcode"></span></a>
								<div class="mp_qrcode" style="display:none;"><img src="{{asset('Home/images/weixin_code_145.png')}}" /><i class="icon_arrow_white"></i></div>
							</li>
							<li class="qtitem">
								<a href="#top" class="return_top"><span class="top"></span></a>
							</li>
						</div>

						<!--回到顶部 -->
						<div id="quick_links_pop" class="quick_links_pop hide"></div>

					</div>

				</div>
				<div id="prof-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						我
					</div>
				</div>
				<div id="shopCart-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						购物车
					</div>
				</div>
				<div id="asset-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						资产
					</div>

					<div class="ia-head-list">
						<a href="#" target="_blank" class="pl">
							<div class="num">0</div>
							<div class="text">优惠券</div>
						</a>
						<a href="#" target="_blank" class="pl">
							<div class="num">0</div>
							<div class="text">红包</div>
						</a>
						<a href="#" target="_blank" class="pl money">
							<div class="num">￥0</div>
							<div class="text">余额</div>
						</a>
					</div>

				</div>
				<div id="foot-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						足迹
					</div>
				</div>
				<div id="brand-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						收藏
					</div>
				</div>
				<div id="broadcast-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						充值
					</div>
				</div>
			</div>

	</body>

</html>
<SCRIPT Language=VBScript></SCRIPT>

<script>
	//判断购买量不能超过库存
	$('#text_box').blur('blur',function() {
		var numbernum = $(this).attr("tip");
		var number = $('#text_box').val();

		//判断用户输入的是不是数字

		if (isNaN(number)) {
			$('#text_box').val(1);
			$('#text').html('<em style="color:gray">您输入的不是一个有效数字!</em>');
		}

		if (number < 1) {
			$('#text_box').val(1);
			$('#text').html('<em style="color:gray">最少要选一件!</em>');
		}

		if (parseInt(number) > parseInt(numbernum)) {

			$('#text_box').val(parseInt(numbernum));
			$('#text').html('<em style="color:gray">您要购买的商品数量只剩'+parseInt(numbernum)+'件了!</em>');
		}
		
	});

	//失去焦点是删除span里的内容
	$('#text_box').focus('focus',function() {

			$('#text').html('<em style="color:gray"></em>');
		
	});

	//判断购买量不能超过库存
	$('#add').click('click',function() {
		var numbernum = $(this).attr("name");
		var number = $('#text_box').val();
		if (parseInt(number) >= parseInt(numbernum)) {

			$('#text_box').val(parseInt(numbernum) - 1);
			$('#text').html('<em style="color:gray">您要购买的商品数量只剩'+parseInt(numbernum)+'件了!</em>');
		}
		
	});

	//判断购买量不能小于1
	$('#min').click('click',function() {
		var numbernum = $(this).attr("name");
		var number = $('#text_box').val();


		if (parseInt(number) <= 0) {
			$('#text_box').val(parseInt(numbernum) - 1);
			$('#text').html('<em style="color:gray">您要购买的商品数量只剩'+parseInt(numbernum)+'件了!</em>');
		}
		
		if (isNaN(number)) {
			$('#text_box').val(1);
			$('#text').html('<em style="color:gray">您输入的不是一个有效数字!</em>');
		}

		if (number <= 1) {
			$('#text_box').val(2);
			$('#text').html('<em style="color:gray">最少要买一件!</em>');
		}
	});

	//失去焦点是删除span里的内容
	$('#add').focus('focus',function() {

			$('#text').html('<em style="color:gray"></em>');

	});

	//失去焦点是删除span里的内容
	$('#min').focus('focus',function() {

		$('#text').html('<em style="color:gray"></em>');
		
	});

	//颜色一变库存就变
	$('li[name=color]').click('click',function() {
				var number = $('#number').html();
				var cid = $(this).attr("data-color");
				var gid = $(this).attr('data-gid');

				$.ajax({

					type: 'get',
					url: '{{url("Stock")}}',//请求php的路径
					data:{"cid":cid,"gid":gid},
					success:function (data) {
						if (data.code == 200) {
							$('#number').html(data.number);
							$('#add').attr('tip',data.number);
							$('#text_box').attr('tip',data.number);
							$('#text_box').val(1);
						} else {
							alert(data.msg);
						}

					},
					dataType: 'json'
				});
			});

</script>
<script type="text/javascript" src="{{asset('Home/js/city.js')}}"></script>