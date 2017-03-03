<?php
use \app\common\services\UrlService;
?>
<div class="search_header">
    <a href="<?=UrlService::buildNull();?>" class="category_icon"></a>
    <input name="kw" type="text" class="search_input" placeholder="请输入您搜索的关键词" />
    <i class="search_icon"></i>
</div>
<div class="sort_box">
    <ul class="sort_list clearfix">
        <li><a href="<?=UrlService::buildNull();?>" class="aon" data="default"><span>默认</span></a></li>
        <li><a href="<?=UrlService::buildNull();?>" data="total_count"><span>销量<i></i></span></a></li>
        <li><a href="<?=UrlService::buildNull();?>" data="view_count"><span>人气<i class="high_icon"></i></span></a></li>
        <li><a href="<?=UrlService::buildNull();?>" data="price"><span>价格<i class="lowly_icon"></i></span></a></li>
    </ul>
</div>
<div class="probox">
    <?php if( $list ):?>
        <ul class="prolist">
            <?php foreach( $list as $_item ):?>
            <li>
                <a href="<?=UrlService::buildMUrl("/product/info",[ 'id' => $_item['id'] ]);?>">
                    <i><img src="<?=$_item['main_image_url'];?>"  style="width: 100%;height: 200px;"/></i>
                    <span><?=$_item['name'];?></span>
                    <b><label>月度热销500</label>¥<?=$_item['price'];?></b>
                </a>
            </li>
            <?php endforeach;?>
    </ul>
    <?php else:?>

    <?php endif;?>
</div>