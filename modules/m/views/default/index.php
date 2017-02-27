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
    <title>微店铺首页</title>
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
    <meta name="apple-mobile-web-app-title" content="微店铺首页" />
    <meta name="msapplication-TileColor" content="#090a0a">
    <link rel="stylesheet" href="/css/m/css_style.css">
    <script type="text/javascript" src="/js/m/zepto.min.js"></script>
    <script type="text/javascript" src="/js/m/TouchSlide.1.1.js"></script>
</head>
<body>
<div class="shop_header">
    <i class="shop_icon"></i>
    <strong>春暖花开女装批发店</strong>
</div>



<div id="slideBox" class="slideBox">
    <div class="bd">
        <ul>
            <li><img src="/images/m/temp/ban1.jpg" /></li>
            <li><img src="/images/m/temp/ban2.jpg" /></li>
            <li><img src="/images/m/temp/ban3.jpg" /></li>
        </ul>
    </div>
    <div class="hd"><ul></ul></div>
</div>

<div class="shop_placard">
    <i class="placard_icon"></i>
    <span>最新公告</span>
    <p>&nbsp;</p>
</div>
<ul class="shop_placard_list">
    <li>
        <a href="#">
            <h2>优惠大酬宾了...</h2>
        </a>
    </li>
    <li>
        <a href="#">
            <h2>优惠大酬宾了...</h2>
        </a>
    </li>
</ul>

<div class="footer_fixed clearfix">
    <span><a href="<?=UrlService::buildMUrl("/default/index");?>" class="aon"><i class="home_icon"></i><b>首页</b></a></span>
    <span><a href="<?=UrlService::buildMUrl("/product/index");?>"><i class="store_icon"></i><b>图书</b></a></span>
    <span><a href="<?=UrlService::buildMUrl("/user/index");?>"><i class="member_icon"></i><b>我的</b></a></span>
</div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        TouchSlide({
            slideCell: "#slideBox",
            titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
            mainCell: ".bd ul",
            effect: "leftLoop",
            autoPage: true,//自动分页
            autoPlay: true //自动播放
        });
    });
    function search() {
        window.location.href = "search.html";
    }
</script>