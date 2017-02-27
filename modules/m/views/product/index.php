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
<div class="search_header">
    <a href="category.html" class="category_icon"></a>
    <input id="skey" type="text" class="search_input" placeholder="请输入您搜索的关键词" />
    <i class="search_icon" onclick="search();"></i>
</div>
<div class="sort_box">
    <ul class="sort_list clearfix">
        <li><a href="#" class="aon"><span>默认</span></a></li>
        <li><a href="#"><span>销量<i></i></span></a></li>
        <li><a href="#"><span>人气<i class="high_icon"></i></span></a></li>
        <li><a href="#"><span>价格<i class="lowly_icon"></i></span></a></li>
    </ul>
</div>
<div class="probox">
    <ul class="prolist">
        <li>
            <a href="<?=UrlService::buildMUrl("/product/info");?>">
                <i><img src="/images/m/temp/pic.jpg" /></i>
                <span>韩版冬季中长款徽章连衣裙徽章</span>
                <b><label>月度热销500</label>¥188.00</b>
            </a>
        </li>
        <li>
            <a href="<?=UrlService::buildMUrl("/product/info");?>">
                <i><img src="/images/m/temp/pic.jpg" /></i>
                <span>韩版冬季中长款徽章连衣裙徽章</span>
                <b><label>月度热销500</label>¥188.00</b>
            </a>
        </li>
        <li>
            <a href="<?=UrlService::buildMUrl("/product/info");?>">
                <i><img src="/images/m/temp/pic.jpg" /></i>
                <span>韩版冬季中长款徽章连衣裙徽章</span>
                <b><label>月度热销500</label>¥188.00</b>
            </a>
        </li>
        <li>
            <a href="<?=UrlService::buildMUrl("/product/info");?>">
                <i><img src="/images/m/temp/pic.jpg" /></i>
                <span>韩版冬季中长款徽章连衣裙徽章</span>
                <b><label>月度热销500</label>¥188.00</b>
            </a>
        </li>
    </ul>
</div>
<div class="footer_fixed clearfix">
    <span><a href="<?=UrlService::buildMUrl("/default/index");?>" ><i class="home_icon"></i><b>首页</b></a></span>
    <span><a href="<?=UrlService::buildMUrl("/product/index");?>" class="aon"><i class="store_icon"></i><b>图书</b></a></span>
    <span><a href="<?=UrlService::buildMUrl("/user/index");?>"><i class="member_icon"></i><b>我的</b></a></span>
</div>
</body>
</html>