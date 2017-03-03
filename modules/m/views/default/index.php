<?php
use \app\common\services\UrlService;
use \app\common\services\StaticService;
use \app\common\services\UtilService;
StaticService::includeAppJsStatic( "/js/m/default/index.js",\app\assets\MAsset::className() );
?>
<div class="shop_header">
    <i class="shop_icon"></i>
    <strong><?=UtilService::encode($info['name']);?></strong>
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