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
	<title>购物车</title>
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
	<meta name="apple-mobile-web-app-title" content="购物车" />
	<meta name="msapplication-TileColor" content="#090a0a">
	<link rel="stylesheet" href="/css/m/css_style.css">
	<script type="text/javascript" src="/js/m/zepto.min.js"></script>
</head>
<body class="grayBy">
<div class="order_pro_box">
	<ul class="order_pro_list">
		<li>
			<i><input id='check-1' type="checkbox" name='check-1' /><label for="check-1">&nbsp;</label></i>
			<a href="proinfo.html" class="pic"><img src="/images/m/temp/pic.jpg" /></a>
			<h2><a href="proinfo.html">韩版冬季中长款显瘦高领针织连衣裙长裙 </a></h2>
			<h3>M<span>黑色</span></h3>
			<div class="order_c_op">
				<b>¥188.00</b>
				<span class="delC_icon"></span>
				<div class="quantity-form">
					<a class="icon_lower"></a>
					<input type="text" class="input_quantity" value="1" readonly="readonly" max="10" />
					<a class="icon_plus"></a>
				</div>
			</div>
		</li>
		<li>
			<i><input id='check-2' type="checkbox" name='check-1' checked='checked' /><label for="check-2">&nbsp;</label></i>
			<a href="proinfo.html" class="pic"><img src="/images/m/temp/pic.jpg" /></a>
			<h2><a href="proinfo.html">韩版冬季中长款显瘦高领针织连衣裙长裙 </a></h2>
			<h3>M<span>黑色</span></h3>
			<div class="order_c_op">
				<b>¥ 188.00</b>
				<span class="delC_icon"></span>
				<div class="quantity-form">
					<a class="icon_lower"></a>
					<input type="text" class="input_quantity" value="1" readonly="readonly" max="10" />
					<a class="icon_plus"></a>
				</div>
			</div>
		</li>
		<li>
			<i><input id='check-3' type="checkbox" name='check-1' /><label for="check-3">&nbsp;</label></i>
			<a href="proinfo.html" class="pic"><img src="/images/m/temp/pic.jpg" /></a>
			<h2><a href="proinfo.html">韩版冬季中长款显瘦高领针织连衣裙长裙 </a></h2>
			<h3>M<span>黑色</span></h3>
			<div class="order_c_op">
				<b>¥ 188.00</b>
				<span class="delC_icon"></span>
				<div class="quantity-form">
					<a class="icon_lower"></a>
					<input type="text" class="input_quantity" value="1" readonly="readonly" max="10" />
					<a class="icon_plus"></a>
				</div>
			</div>
		</li>
	</ul>
</div>
<div class="cart_fixed">
	<a href="#" class="billing_btn">结算</a>
	<span><input id='check-0' type="checkbox" name='check-1'  /><label for="check-0">全选</label></span>
	<b>合计：<strong>¥</strong><font id="price">188.00</font></b>
</div>
<div class="footer_fixed clearfix">
	<span><a href="<?=UrlService::buildMUrl("/default/index");?>" ><i class="home_icon"></i><b>首页</b></a></span>
	<span><a href="<?=UrlService::buildMUrl("/product/index");?>" class="aon"><i class="store_icon"></i><b>图书</b></a></span>
	<span><a href="<?=UrlService::buildMUrl("/user/index");?>"><i class="member_icon"></i><b>我的</b></a></span>
</div>
</body>
</html>
<script type="text/javascript">
    $(".quantity-form .icon_lower").click(function () {
        var num = parseInt($(this).next(".input_quantity").val());
        if (num > 1) {
            $(this).next(".input_quantity").val(num - 1);
        }
    });
    $(".quantity-form .icon_plus").click(function () {
        var num = parseInt($(this).prev(".input_quantity").val());
        var max = parseInt($(this).prev(".input_quantity").attr("max"));
        if (num < max) {
            $(this).prev(".input_quantity").val(num + 1);
        }
    });
    //全选效果
    $(".cart_fixed input[type='checkbox']").click(function () {
        var name = $(this).attr("name");
        $(".order_pro_box input[name='" + name + "']").prop('checked', $(this).prop('checked'));
    });
    //删除
    $(".delC_icon").click(function () {
        $(this).parent().parent().remove();
    });
</script>