<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>新闻页面</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  
   <link href="{{asset('Home/css/admin.css')}}" rel="stylesheet" type="text/css">
   <link href="{{asset('Home/css/amazeui.min.css')}}" rel="stylesheet" type="text/css">
   <link href="{{asset('Home/css/personal.css')}}" rel="stylesheet" type="text/css">
   <style>
   		td{ 
    		text-align: center; 
   		}
   </style>
</head>
<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
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
				</div>
			</article>
		</header>
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
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
			</div>
			<b class="line"></b>	

		<!--文章 -->
		<div class="am-g am-g-fixed blog-g-fixed bloglist">
		  	<div class="am-u-md-9" style='float:right'>
		    	<article class="blog-main">
		      		
		      		<table class="am-table am-table-bordered am-table-radius" style="width:500px;height:500px">
   						<tr class="am-success" style="height:100px">
   							<td style="width:20%">咨询日期：</td>
   							<td>{{$date}}</td>
   						</tr>
   						<tr class="am-primary" style="height:100px">
   							<td>意见类型：</td>
   							<td>
   								@switch($type)
								    @case(1)
								        产品问题
								    @break
								    @case(2)
								    	促销问题
								    @break
								    @case(3)
								    	支付问题
								    @break
								    @case(4)
								    	退款问题
								    @break
								    @case(5)
								    	配送问题
								    @break
								    @case(6)
								    	售后问题
								    @break
								    @case(7)
								    	发票问题
								    @break
								    @case(8)
								    	退换货
								    @break
								    @case(9)
								    	其他
								    @break
								@endswitch	
   							</td>
   						</tr>
   						<tr class="am-active">
   							<td>描述内容：</td>
							<td>{{$question}}</td>
   						</tr>
   						<tr class="am-warning">
   							<td>回复内容：</td>
   							<td>{{$answer}}</td>
   						</tr>
					</table>
					<button type="button" class="am-btn am-btn-primary am-round" onclick="javascript:history.back(-1);">确认返回</button>
				</article>
				<hr class="am-article-divider blog-hr">
		    </div>
		    <aside class="menu" style="margin-left:0px">
				<ul>
					<li class="person active">
						<a href="index.html"><i class="am-icon-user"></i>个人中心</a>
					</li>
					<li class="person">
						<p><i class="am-icon-newspaper-o"></i>个人资料</p>
						<ul>
							<li> <a href="information.html">个人信息</a></li>
							<li> <a href="safety.html">安全设置</a></li>
							<li> <a href="address.html">地址管理</a></li>
							<li> <a href="cardlist.html">快捷支付</a></li>
						</ul>
					</li>
					<li class="person">
						<p><i class="am-icon-balance-scale"></i>我的交易</p>
						<ul>
							<li><a href="order.html">订单管理</a></li>
							<li> <a href="change.html">退款售后</a></li>
							<li> <a href="comment.html">评价商品</a></li>
						</ul>
					</li>
					<li class="person">
						<p><i class="am-icon-dollar"></i>我的资产</p>
						<ul>
							<li> <a href="points.html">我的积分</a></li>
							<li> <a href="coupon.html">优惠券 </a></li>
							<li> <a href="bonus.html">红包</a></li>
							<li> <a href="walletlist.html">账户余额</a></li>
							<li> <a href="bill.html">账单明细</a></li>
						</ul>
					</li>

					<li class="person">
						<p><i class="am-icon-tags"></i>我的收藏</p>
						<ul>
							<li> <a href="collection.html">收藏</a></li>
							<li> <a href="foot.html">足迹</a></li>														
						</ul>
					</li>

					<li class="person">
						<p><i class="am-icon-qq"></i>在线客服</p>
						<ul>
							<li> <a href="{{url('suggest')}}">意见反馈</a></li>												
							<li> <a href="{{url('news')}}">我的消息</a></li>
						</ul>
					</li>
				</ul>

			</aside>
		</div>


<div class="footer" >
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
 <em>© 2015-2025 Hengwang.com 版权所有</em>
 </p>
 </div>
</div>



<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{asset('Home/js/jquery.js')}}"></script>
<!--<![endif]-->
<script src="{{asset('Home/js/amazeui.min.js')}}"></script>

</body>
</html>
