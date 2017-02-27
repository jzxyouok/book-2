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
	<title>我的</title>
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
	<meta name="apple-mobile-web-app-title" content="我的" />
	<meta name="msapplication-TileColor" content="#090a0a">
	<link rel="stylesheet" href="/css/m/css_style.css">
	<script type="text/javascript" src="/js/m/zepto.min.js"></script>
</head>
<body class="grayBy">
<div class="mem_info">
	<span class="m_pic"><img src="/images/m/temp/mpic1.jpg" /></span>
	<p>用户名</p>
</div>
<div class="mtab_list_box">
	<ul class="mtab_list clearfix">
		<li><a href="Order_Confirmation.html"><i class="dingdanqueren_icon"></i><span>订单确认</span><em>1</em></a></li>
		<li><a href="Order_PackIn.html"><i class="dabaozhong_icon"></i><span>打包中</span><em>1</em></a></li>
		<li><a href="Order_PackEnd.html"><i class="dabaowancheng_icon"></i><span>打包完成</span><em>1</em></a></li>
		<li><a href="Order_Shipping.html"><i class="fahuozhong_icon"></i><span>发货中</span></a></li>
		<li><a href="Order_Sentexpress.html"><i class="yifakuaidi_icon"></i><span>已发快递</span><em>1</em></a></li>
	</ul>
</div>
<div class="fastway_list_box">
	<ul class="fastway_list">
		<li><a href="<?=UrlService::buildMUrl("/product/cart");?>"><b class="wl_icon"></b><i class="right_icon"></i><span>购物车</span></a></li>
		<li><a href="<?=UrlService::buildMUrl("/user/order");?>"><b class="morder_icon"></b><i class="right_icon"></i><span>我的订单</span></a></li>
		<li><a href="<?=UrlService::buildMUrl("/user/fav");?>"><b class="fav_icon"></b><i class="right_icon"></i><span>我的收藏</span></a></li>
		<li><a href="<?=UrlService::buildMUrl("/user/comment");?>"><b class="sales_icon"></b><i class="right_icon"></i><span>我的评论</span></a></li>
		<li><a href="<?=UrlService::buildMUrl("/user/address");?>"><b class="locate_icon"></b><i class="right_icon"></i><span>收货地址</span></a></li>
	</ul>
</div>
<div class="footer_fixed clearfix">
    <span><a href="<?=UrlService::buildMUrl("/default/index");?>"><i class="home_icon"></i><b>首页</b></a></span>
    <span><a href="<?=UrlService::buildMUrl("/product/index");?>"><i class="store_icon"></i><b>图书</b></a></span>
    <span><a href="<?=UrlService::buildMUrl("/user/index");?>" class="aon"><i class="member_icon"></i><b>我的</b></a></span>
</div>
</body>
</html>