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
    <title>商品详情页</title>
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--<meta name="format-detection" content="telephone = no" />-->
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="商品详情页"/>
    <meta name="msapplication-TileColor" content="#090a0a">
    <link rel="stylesheet" href="/css/m/css_style.css">
    <script type="text/javascript" src="/js/m/zepto.min.js"></script>
    <script type="text/javascript" src="/js/m/TouchSlide.1.1.js"></script>
</head>
<body class="grayBy">
<div class="pro_tab clearfix">
    <span>图片详情</span>
</div>
<div class="proban">
    <div id="slideBox" class="slideBox">
        <div class="bd">
            <ul>
                <li><img src="/images/m/temp/p2.jpg"/></li>
                <li><img src="/images/m/temp/p3.jpg"/></li>
                <li><img src="/images/m/temp/p4.jpg"/></li>
                <li><img src="/images/m/temp/p5.jpg"/></li>
            </ul>
        </div>
        <div class="hd">
            <ul></ul>
            <span class="pageState"></span></div>
    </div>
</div>
<div class="pro_header">
    <div class="pro_tips">
        <h2>韩版冬季长款徽章系收腰修身显瘦高领连衣裙</h2>
        <h3><b>¥188</b><font>3件</font>起批</h3>
    </div>
    <span class="share_span"><i class="share_icon"></i><b>分享商品</b></span>
</div>
<div class="pro_express">快递：6.00<span>杭州</span><b>月度热销55</b></div>
<div class="pro_virtue">
    <div class="pro_vlist">
        <b>数量</b>
        <div class="quantity-form">
            <a class="icon_lower"></a>
            <input type="text" class="input_quantity" value="1" readonly="readonly" max="10"/>
            <a class="icon_plus"></a>
        </div>
    </div>
</div>
<div class="pro_warp">
    <p>三只松鼠_小贱牛板筋120gx2袋休闲零食特产麻辣/烧烤味 烧烤味</p>
    <img src="/images/m/temp/p2.jpg"/>
    <img src="/images/m/temp/p3.jpg"/>
    <img src="/images/m/temp/p4.jpg"/>
</div>
<div class="pro_fixed clearfix">
    <a href="<?= UrlService::buildMUrl("/"); ?>"><i class="sto_icon"></i><span>店铺</span></a>
    <a href="javascript:"><i class="keep_icon"></i><span>收藏</span></a>
    <input type="button" value="立即订购" class="order_now_btn"/>
    <input type="button" value="加入购物车" class="add_cart_btn"/>
</div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        TouchSlide({
            slideCell: "#slideBox",
            titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
            mainCell: ".bd ul",
            effect: "left",
            autoPage: true,//自动分页
            autoPlay: false //自动播放
        });
        //加减效果 start
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
        //加减效果 end
        $(".pro_vlist span").click(function () {
            $(this).parent().find("span").removeClass("aon");
            $(this).addClass("aon");
        });
    });
</script>