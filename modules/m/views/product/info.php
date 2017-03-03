<?php
use \app\common\services\UrlService;
use \app\common\services\UtilService;
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
                <li><img src="<?=UrlService::buildPicUrl("book",$info['main_image'] );?>"/></li>
            </ul>
        </div>
    </div>
</div>
<div class="pro_header">
    <div class="pro_tips">
        <h2><?=UtilService::encode( $info['name'] );?></h2>
        <h3><b>¥<?=UtilService::encode( $info['price'] );?></b></h3>
    </div>
    <span class="share_span"><i class="share_icon"></i><b>分享商品</b></span>
</div>
<div class="pro_express">月销量：600<b>累计评价：100</b></div>
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
	<?=nl2br($info['summary']);?>
</div>
<div class="pro_fixed clearfix">
    <a href="<?= UrlService::buildMUrl("/"); ?>"><i class="sto_icon"></i><span>首页</span></a>
    <a href="javascript:"><i class="keep_icon"></i><span>收藏</span></a>
    <input type="button" value="立即订购" class="order_now_btn"/>
    <input type="button" value="加入购物车" class="add_cart_btn"/>
</div>
