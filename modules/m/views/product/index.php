<?php
use \app\common\services\UrlService;
?>

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