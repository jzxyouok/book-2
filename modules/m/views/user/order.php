<?php
use \app\common\services\UrlService;
?>
<!doctype html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>我的订单</title>
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
	<!-- No Baidu Siteapp-->
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<!--<meta name="format-detection" content="telephone = no" />-->
	<!-- Add to homescreen for Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<!-- Add to homescreen for Safari on iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="我的订单" />
	<meta name="msapplication-TileColor" content="#090a0a">
	<link rel="stylesheet" href="/css/m/css_style.css">
	<script type="text/javascript" src="/js/m/zepto.min.js"></script>
</head>
<body class="grayBy">
<div class="order_box">
	<div class="order_header">
		<h2>订单编号: 5566778899</h2>
		<p>2016.11.6 23:30</p>
		<span class="up_icon"></span>
	</div>
	<ul class="order_list">
		<li>
			<a href="proinfo.html">
				<i class="pic"><img src="/images/m/temp/p2.jpg" /></i>
				<h2>韩版冬季中长款显瘦高领针织连衣裙长裙 </h2>
				<h3>M<span>黑色</span></h3>
				<h4>x 1</h4>
				<b>¥ 188.00</b>
			</a>
		</li>
		<li>
			<a href="proinfo.html">
				<i class="pic"><img src="/images/m/temp/p2.jpg" /></i>
				<h2>韩版冬季中长款显瘦高领针织连衣裙长裙 </h2>
				<h3>M<span>黑色</span></h3>
				<h4>x 1</h4>
				<b>¥ 188.00</b>
			</a>
		</li>
		<li>
			<a href="proinfo.html">
				<i class="pic"><img src="/images/m/temp/p2.jpg" /></i>
				<h2>韩版冬季中长款显瘦高领针织连衣裙长裙 </h2>
				<h3>M<span>黑色</span></h3>
				<h4>x 1</h4>
				<b>¥ 188.00</b>
			</a>
		</li>
	</ul>
</div>
<div class="order_box">
	<div class="order_header">
		<h2>订单编号: 55667763663</h2>
		<p>2016.11.16 23:50</p>
		<span class="up_icon"></span>
	</div>
	<ul class="order_list">
		<li>
			<a href="proinfo.html">
				<i class="pic"><img src="/images/m/temp/p2.jpg" /></i>
				<h2>韩版冬季中长款显瘦高领针织连衣裙长裙 </h2>
				<h3>M<span>黑色</span></h3>
				<h4>x 1</h4>
				<b>¥ 188.00</b>
			</a>
		</li>
		<li>
			<a href="proinfo.html">
				<i class="pic"><img src="/images/m/temp/p2.jpg" /></i>
				<h2>韩版冬季中长款显瘦高领针织连衣裙长裙 </h2>
				<h3>M<span>黑色</span></h3>
				<h4>x 1</h4>
				<b>¥ 188.00</b>
			</a>
		</li>
		<li>
			<a href="proinfo.html">
				<i class="pic"><img src="/images/m/temp/p2.jpg" /></i>
				<h2>韩版冬季中长款显瘦高领针织连衣裙长裙 </h2>
				<h3>M<span>黑色</span></h3>
				<h4>x 1</h4>
				<b>¥ 188.00</b>
			</a>
		</li>
	</ul>
</div>
<div class="footer_fixed clearfix">
	<span><a href="<?=UrlService::buildMUrl("/default/index");?>"><i class="home_icon"></i><b>首页</b></a></span>
	<span><a href="<?=UrlService::buildMUrl("/product/index");?>"><i class="store_icon"></i><b>图书</b></a></span>
	<span><a href="<?=UrlService::buildMUrl("/user/index");?>" class="aon"><i class="member_icon"></i><b>我的</b></a></span>
</div>
</body>
</html>
<script type="text/javascript">
    $(".order_box").click(function () {
        $(this).find(".order_list").toggle();
    });
</script>