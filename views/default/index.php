<?php
use \app\common\services\UrlService;
?>
<div class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-collapse collapse pull-left">
            <ul class="nav navbar-nav ">
                <li><a href="<?= UrlService::buildWwwUrl("/"); ?>">首页</a></li>
                <li><a target="_blank" href="<?= UrlService::buildBlogUrl("/"); ?>">博客</a></li>
                <li><a href="<?= UrlService::buildWebUrl("/user/login"); ?>">管理后台</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="jumbotron body-content">
    <div class="jumbotron text-center">
        <img src="<?= UrlService::buildWwwUrl("/images/common/qrcode.jpg"); ?>"/>
        <h3>扫码关注服务号体验会员端功能</h3>
    </div>
</div>
