<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta  charset="utf-8"/>		
		<title>{{$seo->title}}</title>
		<meta content="{{$seo->keyword}}" name="keywords">
		<meta content="{{$seo->des}}" name="description">
		<link href="{{asset('Home/css/amazeui.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('Home/css/admin.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('Home/css/demo.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('Home/css/hmstyle.css')}}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="{{asset('Home/css/normalize.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{asset('Home/css/htmleaf-demo.css')}}">
		<link href="{{asset('Home/css/indexStyle.css')}}" rel="stylesheet" />
		<link rel="icon" href='{{asset("storage/$logo")}}' type="image/x-icon"/>
	</head>

	<body>
		<div class="hmtop">
			<!--顶部导航条 -->
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
						<div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
					</div>
					<div class="topMessage favorite">
						<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
				</ul>
			</div>

			<!--悬浮搜索框-->
			<div class="nav white">
				<div class="logo"><img src="{{asset('storage/logo.png')}}" /></div>
				<div class="logoBig">
					<li><img src="{{asset('storage/logobig.png')}}" /></li>
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
		</div>
			
			
		<div class="banner">
          	<!--轮播 -->
			<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
				<ul class="am-slides">
					@foreach ($carousel as $v)
					<li><img src='{{asset("storage/$v->picture")}}' style="width:1030px"/></li>
					@endforeach
				</ul>
			</div>
			<div class="clear"></div>	
		</div>						
			
		<div class="shopNav">
			<div class="slideall">			        
				<div class="long-title"><span class="all-goods">全部分类</span></div>
			    <div class="nav-cont">
					<ul>
						<li class="index"><a href="#">首页</a></li>
                        <li class="qc"><a href="#">闪购</a></li>
                        <li class="qc"><a href="#">限时抢</a></li>
                        <li class="qc"><a href="#">团购</a></li>
                        <li class="qc last"><a href="#">大包装</a></li>
					</ul>
				    <div class="nav-extra">
				    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
				    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
				    </div>
				</div>		        				
				<!--侧边导航 -->
				<div id="nav" class="navfull">
					<div class="area clearfix">
						<div class="category-content" id="guide_2">
							<div class="category" >
								<ul class="category-list" id="js_climit_li" msg="on">
									<li class="appliance js_toggle relative first" id="0">
										<div class="category-info">
											<h3 class="category-name b-category-name">
												<i><img src="{{asset('storage/candy.png')}}"></i><a class="ml-22"></a></h3>
											</div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
													</div>
												</div>
											</div>
										</div>
									<b class="arrow"></b>	
									</li>
									<li class="appliance js_toggle relative" id="1">
										<div class="category-info">
											<h3 class="category-name b-category-name"><i><img src="{{asset('storage/candy.png')}}"></i><a class="ml-22"></a></h3>
											</div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
													</div>
												</div>
											</div>
										</div>
                                    <b class="arrow"></b>
									</li>
									<li class="appliance js_toggle relative" id="2">
										<div class="category-info">
											<h3 class="category-name b-category-name">
												<i><img src="{{asset('storage/candy.png')}}"></i><a class="ml-22"></a></h3>
										</div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
													</div>
												</div>
											</div>
										</div>
									<b class="arrow"></b>	
									</li>
									<li class="appliance js_toggle relative" id="3">
										<div class="category-info">
											<h3 class="category-name b-category-name">
												<i><img src="{{asset('storage/candy.png')}}"></i><a class="ml-22"></a></h3>
										</div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
													</div>
												</div>
											</div>
										</div>
									<b class="arrow"></b>	
									</li>
									<li class="appliance js_toggle relative" id="4">
										<div class="category-info">
											<h3 class="category-name b-category-name">
												<i><img src="{{asset('storage/candy.png')}}"></i><a class="ml-22"></a></h3>
										</div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
													</div>
												</div>
											</div>
										</div>
									<b class="arrow"></b>	
									</li>
									<li class="appliance js_toggle relative" id="5">
										<div class="category-info">
											<h3 class="category-name b-category-name">
												<i><img src="{{asset('storage/candy.png')}}"></i><a class="ml-22"></a></h3>
										</div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
													</div>
												</div>
											</div>
										</div>
									<b class="arrow"></b>	
									</li>
									<li class="appliance js_toggle relative" id="6">
										<div class="category-info">
											<h3 class="category-name b-category-name">
												<i><img src="{{asset('storage/candy.png')}}"></i><a class="ml-22"></a></h3>
										</div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
													</div>
												</div>
											</div>
										</div>
									<b class="arrow"></b>	
									</li>
									<li class="appliance js_toggle relative" id="7">
										<div class="category-info">
											<h3 class="category-name b-category-name">
												<i><img src="{{asset('storage/candy.png')}}"></i><a class="ml-22"></a></h3>
										</div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
													</div>
												</div>
											</div>
										</div>
									<b class="arrow"></b>	
									</li>
									<li class="appliance js_toggle relative" id="8">
										<div class="category-info">
											<h3 class="category-name b-category-name">
												<i><img src="{{asset('storage/candy.png')}}"></i><a class="ml-22"></a></h3>
										</div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
													</div>
												</div>
											</div>
										</div>
									<b class="arrow"></b>	
									</li>
									<li class="appliance js_toggle relative" id="9">
										<div class="category-info">
											<h3 class="category-name b-category-name">
												<i><img src="{{asset('storage/candy.png')}}"></i><a class="ml-22"></a></h3>
										</div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
													</div>
												</div>
											</div>
										</div>
									<b class="arrow"></b>	
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!--小导航-->
				<div class="am-g am-g-fixed smallnav">
					<div class="am-u-sm-3">
						<a href="sort.html"><img src="{{asset('storage/navsmall.jpg')}}" />
							<div class="title">商品分类</div>
						</a>
					</div>
					<div class="am-u-sm-3">
						<a href="#"><img src="{{asset('storage/huismall.jpg')}}" />
							<div class="title">大聚惠</div>
						</a>
					</div>
					<div class="am-u-sm-3">
						<a href="#"><img src="{{asset('storage/mansmall.jpg')}}" />
							<div class="title">个人中心</div>
						</a>
					</div>
					<div class="am-u-sm-3">
						<a href="#"><img src="{{asset('storage/moneysmall.jpg')}}" />
							<div class="title">投资理财</div>
						</a>
					</div>
				</div>					
			</div>
		</div>
		<div class="shopMainbg">
			<div class="shopMain" id="shopmain">
				<div class="am-g am-g-fixed recommendation">
					<div class="clock am-u-sm-3" >
						<img src="{{asset('storage/2016.png')}}">
						<p>今日<br>推荐</p>
					</div>
					<div class="am-u-sm-4 am-u-lg-3 ">
						<div class="info ">
							<h3>真的有鱼</h3>
							<h4>开年福利篇</h4>
						</div>
						<div class="recommendationMain ">
							<img src="{{asset('storage/tj.png')}}">
						</div>
					</div>						
					<div class="am-u-sm-4 am-u-lg-3 ">
						<div class="info ">
							<h3>囤货过冬</h3>
							<h4>让爱早回家</h4>
						</div>
						<div class="recommendationMain ">
							<img src="{{asset('storage/tj1.png')}}">
						</div>
					</div>
					<div class="am-u-sm-4 am-u-lg-3 ">
						<div class="info ">
							<h3>浪漫情人节</h3>
							<h4>甜甜蜜蜜</h4>
						</div>
						<div class="recommendationMain ">
							<img src="{{asset('storage/tj2.png')}}">
						</div>
					</div>
				</div>
				<!--秒杀抢购-->
				<div class="am-container" id="close">	
					@if(session('msg'))
					    <script>
					    	alert('{{session("msg")}}');
					    </script>			       					   
					@endif			
                    <div class="sale-mt">
		                <i></i>
		                <em class="sale-title">限时秒杀</em>
		                <div class="s-time" id="countdown" count_down="100">
			                <span class="hh" time_id="h">0</span>
			                <span class="mm" time_id="m">0</span>
			                <span class="ss" time_id="s">0</span>
		                </div>
	                </div>
					<div class="am-g am-g-fixed sale" id="sale"></div>
                </div>
                <div class="clear "></div>
				<!--选项卡--> 
				<div class="clear" id="option"></div>
				<div class='am-container activity'>
					<div class='tabox' style='width:1200px'>
						<div class='hd' id="f1">
							<ul>
								<li class='on' style='width:240px'>疯狂抢购</li>
								<li class=" " style='width:241px'>猜您喜欢</li>
								<li class=" " style='width:241px'>热卖商品</li>
								<li class=" " style='width:241px'>热评商品</li>
								<li class=" " style='width:241px'>新品上架</li>
							</ul>
						</div>
						<div class='bd'>
							<ul class='lh' style='display: none;' >
								
							</ul>
							<ul class='lh' style='display: none;' >
								
							</ul>
							<ul class='lh' style='display: none;' >
								
							</ul>
							<ul class='lh' style='display: none;' >
								
							</ul>
							<ul class='lh' style='display: block;' >
								
							</ul>
						</div>
					</div>
				</div>
			
					
				<!--选项卡-->
				<div class="clear" ></div>
				<!--海味-->
				<div class="footer" id="water">
					<div class="footer-hd ">
						<p>
							@foreach ($friendsline as $v)
								<a href="{{$v->url}}">{{$v->name}}<span style="color: orange"><strong style="margin-left: 10px">|</strong></span></a>
							@endforeach
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
						
				<!--引导 -->

				<div class="navCir">
					<li class="active"><a href="home3.html"><i class="am-icon-home "></i>首页</a></li>
					<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
					<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
					<li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>					
				</div>
				<!--菜单 -->
				<div class=tip>
					<div id="sidebar">
						<div id="wrap">
							<div id="prof" class="item ">
								<a href="# ">
									<span class="setting "></span>
								</a>
								<div class="ibar_login_box status_login ">
									<div class="avatar_box ">
										<p class="avatar_imgbox "><img src="{{asset('storage/no-img_mid_.jpg')}}" /></p>
										<ul class="user_info ">
											<li>用户名：sl1903</li>
											<li>级&nbsp;别：普通会员</li>
										</ul>
									</div>
									<div class="login_btnbox ">
										<a href="# " class="login_order ">我的订单</a>
										<a href="# " class="login_favorite ">我的收藏</a>
									</div>
									<i class="icon_arrow_white "></i>
								</div>
							</div>
							<div id="shopCart " class="item ">
								<a href="# ">
									<span class="message "></span>
								</a>
								<p>
									购物车
								</p>
								<p class="cart_num ">0</p>
							</div>
							<div id="asset " class="item ">
								<a href="# ">
									<span class="view "></span>
								</a>
								<div class="mp_tooltip ">
									我的资产
									<i class="icon_arrow_right_black "></i>
								</div>
							</div>

							<div id="foot " class="item ">
								<a href="# ">
									<span class="zuji "></span>
								</a>
								<div class="mp_tooltip ">
									我的足迹
									<i class="icon_arrow_right_black "></i>
								</div>
							</div>

							<div id="brand " class="item ">
								<a href="#">
									<span class="wdsc "><img src="{{asset('storage/wdsc.png')}}" /></span>
								</a>
								<div class="mp_tooltip ">
									我的收藏
									<i class="icon_arrow_right_black "></i>
								</div>
							</div>
							<div id="broadcast " class="item ">
								<a href="# ">
									<span class="chongzhi "><img src="{{asset('storage/chongzhi.png')}}" /></span>
								</a>
								<div class="mp_tooltip ">
									我要充值
									<i class="icon_arrow_right_black "></i>
								</div>
							</div>
							<div class="quick_toggle ">
								<li class="qtitem ">
									<a href="# "><span class="kfzx "></span></a>
									<div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
								</li>
								<!--二维码 -->
								<li class="qtitem ">
									<a href="#none "><span class="mpbtn_qrcode "></span></a>
									<div class="mp_qrcode " style="display:none; "><img src="{{asset('storage/weixin_code_145.png')}}" /><i class="icon_arrow_white "></i></div>
								</li>
								<li class="qtitem ">
									<a href="#top " class="return_top "><span class="top "></span></a>
								</li>
							</div>
							<!--回到顶部 -->
							<div id="quick_links_pop " class="quick_links_pop hide "></div>
						</div>
					</div>
					<div id="prof-content " class="nav-content ">
						<div class="nav-con-close ">
							<i class="am-icon-angle-right am-icon-fw "></i>
						</div>
						<div>我</div>
					</div>
					<div id="shopCart-content " class="nav-content ">
						<div class="nav-con-close ">
							<i class="am-icon-angle-right am-icon-fw "></i>
						</div>
						<div>购物车</div>
					</div>
					<div id="asset-content " class="nav-content ">
						<div class="nav-con-close ">
							<i class="am-icon-angle-right am-icon-fw "></i>
						</div>
						<div>资产</div>
						<div class="ia-head-list ">
							<a href="# " target="_blank " class="pl ">
								<div class="num ">0</div>
								<div class="text ">优惠券</div>
							</a>
							<a href="# " target="_blank " class="pl ">
								<div class="num ">0</div>
								<div class="text ">红包</div>
							</a>
							<a href="# " target="_blank " class="pl money ">
								<div class="num ">￥0</div>
								<div class="text ">余额</div>
							</a>
						</div>
					</div>
					<div id="foot-content " class="nav-content ">
						<div class="nav-con-close ">
							<i class="am-icon-angle-right am-icon-fw "></i>
						</div>
						<div>足迹</div>
					</div>
					<div id="brand-content " class="nav	-content ">
						<div class="nav-con-close ">
							<i class="am-icon-angle-right am-icon-fw "></i>
						</div>
						<div>收藏</div>
					</div>
					<div id="broadcast-content " class="nav-content ">
						<div class="nav-con-close ">
							<i class="am-icon-angle-right am-icon-fw "></i>
						</div>
						<div>充值</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="{{asset('Home/js/jquery.js')}}"></script>
		<script src="{{asset('Home/js/amazeui.min.js')}}"></script>
		<script src="{{asset('Home/js/quick_links.js')}}"></script>
		<script>
			window.jQuery || document.write('<script src="basic/js/jquery.min.js "><\/script>');
		</script>
		<script>
			if ($(window).width() < 640) {
				function autoScroll(obj) {
					$(obj).find("ul").animate({
						marginTop: "-39px"
					}, 500, function() {
						$(this).css({
							marginTop: "0px"
						}).find("li:first").appendTo(this);
					})
				}
				$(function() {
					setInterval('autoScroll(".demo")', 3000);
				})
			}
		</script>
		<!--秒杀倒计时-->
		<script>	
		   function takeCount() {
		    setTimeout("takeCount()", 1000);
		    $(".s-time").each(function(){
		        var obj = $(this);
		        var tms = obj.attr("count_down");
		        if (tms>0) {
		            tms = parseInt(tms)-1;
	                var days = Math.floor(tms / (1 * 60 * 60 * 24));
	                var hours = Math.floor(tms / (1 * 60 * 60)) % 24;
	                var minutes = Math.floor(tms / (1 * 60)) % 60;
	                var seconds = Math.floor(tms / 1) % 60;

	                if (days < 0) days = 0;
	                if (hours < 0) hours = 0;
	                if (minutes < 0) minutes = 0;
	                if (seconds < 0) seconds = 0;
	                obj.find("[time_id='d']").html(days);
	                obj.find("[time_id='h']").html(hours);
	                obj.find("[time_id='m']").html(minutes);
	                obj.find("[time_id='s']").html(seconds);
	                obj.attr("count_down",tms);
			        } 
			    });
			}
			$(function(){
				setTimeout("takeCount()", 1000);
			});
			//结束抢购
			$(function(){ 
				setTimeout(function(){ 
					$('#close').remove();
				},101000);
			});
		</script>
		<!--三级导航-->
		<script>
			//一级导航
			$('#js_climit_li').mouseenter(function () { 
				if (!$(this).attr('msg')) {
					return false;
				};
				$(this).removeAttr("msg");
				$.ajax({ 
					type: 'get',
					url: '{{url("one")}}',
					dataType: 'json',
					success:function (data) { 
						//console.log(data);
						for (var i = 0; i < data.data.length; i++) {
							$('#'+i).children().children().children().next().html(data.data[i].name);
							$('#'+i).children().first().append('<em>&gt;</em>');
							$('#'+i).attr('data-id',data.data[i].id);
						};
					}
				});
			});
			//二级导航
			$('#js_climit_li li').mouseenter(function () { 
				//console.log($(this).attr('data-id'));
				var id = $(this).attr('data-id');
				var that = $(this);

				if (id) { 
					that.removeAttr('data-id');
					$.ajax({ 
						type: 'get',
						url: '{{url("two")}}',
						dataType: 'json',
						data: 'id='+id,
						success:function(data) { 
							for (var i = 0; i < data.data.length; i++) {
								that.children().next().children().children().children().append('<div class="sort-side"><dl class="'+data.data[i].id+'"><dt><a href="{{url("Home/list?pid=")}}'+data.data[i].pid+'&id='+data.data[i].id+'"><span>'+data.data[i].name +'</span></a></dt></dl></div>');
								for (var j = 0; j < data.goods.length; j++) {
									if (data.data[i].id == data.goods[j].tid) { 
										$('.'+data.data[i].id+'').append('<dd><a href="{{url("detail?gid=")}}'+data.goods[j].id+'"><span>'+data.goods[j].name+'</span></a></dd>');
									};
								};
							};	
						}
					});
				};
			});
			//三级导航			
		</script>
		<!--轮播 -->
		<script>
			(function() {
				$('.am-slider').flexslider();
			});
			$(document).ready(function() {
				$("li").hover(function() {
					$(".category-content .category-list li.first .menu-in").css("display", "none");
					$(".category-content .category-list li.first").removeClass("hover");
					$(this).addClass("hover");
					$(this).children("div.menu-in").css("display", "block")
				}, function() {
					$(this).removeClass("hover")
					$(this).children("div.menu-in").css("display", "none")
				});
			})
		</script>
		<!--选项卡-->
		<script>
			$('#f1 li').mouseenter(function () { 
				var res = $(this).parent().parent().next().children().eq($(this).index());
				//console.log(res);return false;
				var that = $(this);
				//先判断是否有数据
				if (that.attr('msg') == 'on') { 
					return false;
				};
				that.attr('msg','on');
				$.ajax({ 
					type: 'get',
					url: '{{url("f1")}}',
					dataType: 'json',
					success:function(data) { 

						for (var i = 0; i < data.data.length; i++) {
							$(res).append("<li style='width:20%'><div class='p-img ld'><a href='{{url('detail?gid=')}}"+data.data[i].gid+"'><img src='{{asset('storage')}}"+"/"+data.data[i].album+"/"+data.data[i].pic_name+"')}}'></a></div><div class='p-name'><a href='#'>"+data.data[i].name+"</a></div><div class='p-price'>劲爆价：<strong>"+data.data[i].price+"</strong></div></li>");
						};
						
					}
				});
			});
		</script>
		<!--瀑布流-->	
		<script>
			var number = 0;
			var sale = 1;
			window.onscroll = function () { 

				if (number == 3) { 
					return false;
				};
				
				//离上方的距离
				var t = document.documentElement.scrollTop || document.body.scrollTop; 
				//可见宽度
    			var h =window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight; 
    			//加载抢购
    			if (sale == 1) { 
    				if (t >= (document.documentElement.scrollHeight - h)*0.5) { 
    					$.ajax({ 
    						type: 'get',
							url: '{{url("sale")}}',
							dataType: 'json',
							success:function(data) { 
								//console.log(data.data);return false;
								$('#sale').append('<div class="am-u-sm-3 sale-item"><div class="s-img"><img src="{{asset("storage")}}'+'/'+data.pic.album+'/'+data.pic.pic_name+'"/></div><div class="s-info"><p class="s-title">'+data.data.name+'</p><div class="s-price">￥<b>'+data.data.price+'</b><a class="s-buy" href="{{url("dosale")}}'+'/'+data.data.id+'">秒杀</a></div></div></div>');
							}
	    				});
    					sale++;
    				};
    			};
    			
    			//加载尾部列表			
    			if(t >= document.documentElement.scrollHeight - h) {
    				$.ajax({ 
						type: 'get',
						url: '{{url("under")}}',
						dataType: 'json',
						success:function(data) {
    						$('#water').before("<div class='am-container '><div class='shopTitle '><h4>"+number+"</h4><h3>你是我的优乐美么？不，我是你小鱼干</h3><span class='more '><a class='more-link ' href='# '>更多美味</a></span></div></div><div class='am-g am-g-fixed flood method3 '><ul class='am-thumbnails '></ul></div>");
    						for (var i = 0; i < data.data.length; i++) {
    							$('#water').prev().children().append("<li><div class='list '><a href='{{url('detail?gid=')}}"+data.data[i].gid+"'><img src='{{asset('storage')}}"+"/"+data.data[i].album+"/"+data.data[i].pic_name+"'><div class='pro-title '>"+data.data[i].name+"</div><span class='e-price '>"+data.data[i].price+"</span></a></div></li>");
    						};					
    					}
	    			});
        			number++;
    			}
			}
		</script>
		<!--选项卡-->
		<script>
			$('.hd li').mouseenter(function () { 
				//上面div
				$(this).attr('class','on').siblings().attr('class','');
				//下面div
				//console.log($(this).index());
				var ul = $(this).parent().parent().next().children().eq($(this).index());
				ul.show().siblings().hide();
			});
		</script>
	</body>
</html>