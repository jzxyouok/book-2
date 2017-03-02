<?php
use \app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppJsStatic( "/js/m/product/index.js",\app\assets\MAsset::className() );
?>
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
