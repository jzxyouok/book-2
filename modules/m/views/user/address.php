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
	<title>收货地址</title>
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
	<meta name="apple-mobile-web-app-title" content="收货地址" />
	<meta name="msapplication-TileColor" content="#090a0a">
	<link rel="stylesheet" href="/css/m/css_style.css">
	<script type="text/javascript" src="/js/m/zepto.min.js"></script>
</head>
<body class="grayBy">
<ul class="address_list">
	<li>
		<p><span>张小明</span>13811223344</p>
		<p>浙江省杭州市西湖区文三西路西湖文化广场120号</p>
		<div class="addr_op">
			<em class="del"><i class="del_icon"></i>删除</em>
			<a href="<?=UrlService::buildMUrl("/user/address_set");?>"><i class="edit_icon"></i>编辑</a>
			<span class="default_set aon"><i class="check_icon"></i>默认地址</span>
		</div>
	</li>
	<li>
		<p><span>张小明</span>13811223344</p>
		<p>浙江省杭州市西湖区文三西路西湖文化广场120号西路西湖文化广场120号</p>
		<div class="addr_op">
			<em class="del"><i class="del_icon"></i>删除</em>
			<a href="<?=UrlService::buildMUrl("/user/address_set");?>"><i class="edit_icon"></i>编辑</a>
			<span class="default_set"><i class="check_icon"></i>默认地址</span>
		</div>
	</li>
	<li>
		<p><span>张小明</span>13811223344</p>
		<p>浙江省杭州市西湖区文三西路西湖文化广场120号</p>
		<div class="addr_op">
			<em class="del"><i class="del_icon"></i>删除</em>
			<a href="<?=UrlService::buildMUrl("/user/address_set");?>"><i class="edit_icon"></i>编辑</a>
			<span class="default_set"><i class="check_icon"></i>默认地址</span>
		</div>
	</li>
</ul>
<div class="op_box">
	<a href="<?=UrlService::buildMUrl("/user/address_set");?>" class="red_btn">添加新地址</a>
</div>
</body>
</html>
<script type="text/javascript">
    $(".default_set").click(function () {
        $(".default_set").removeClass("aon");
        $(this).addClass("aon");
    });
    $(".del").click(function () {
        $(this).parent().parent().remove();
    });

</script>