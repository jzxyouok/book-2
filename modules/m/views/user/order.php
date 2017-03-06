<?php
use \app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppJsStatic( "/js/m/user/order.js",\app\assets\MAsset::className() );
?>
<?php if( $list ):?>
    <?php foreach( $list as $_item ):?>
<div class="order_box">
	<div class="order_header">
		<h2>订单编号: <?=$_item['sn'];?></h2>
		<p>下单时间：<?=$_item['created_time'];?> 状态：<?=$_item['status_desc'];?></p>
		<span class="up_icon"></span>
	</div>
	<ul class="order_list">
        <?php foreach( $_item['items'] as $_item_info ):?>
		<li>
			<a href="<?=UrlService::buildMUrl("/pay/buy",[ 'pay_order_id' => $_item['id']  ]);?>">
				<i class="pic">
                    <img src="<?=$_item_info['book_main_image'];?>" />
                </i>
				<h2><?=$_item_info['book_name'];?> </h2>
				<h3>&nbsp;</h3>
				<h4>&nbsp;</h4>
				<b>¥ <?=$_item_info['pay_price'];?></b>
			</a>
		</li>
		<?php endforeach;?>
	</ul>
</div>
        <?php if( $_item['status'] == -8 ):?>
        <div class="op_box">
            <a style="width: 100%;"  class="red_btn" href="<?=$_item["pay_url"];?>" />微信支付</a>
        </div>
        <?php endif;?>
        <?php endforeach;?>
<?php else:?>
    悲剧啦，连个订单都咩有了~~
<?php endif;?>
