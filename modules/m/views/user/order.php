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
		<?php if( $_item['status'] == 1 ):?>
		<p>快递状态：<?=$_item['express_status_desc'];?></p>
            <?php if( $_item['express_info'] ):?>
            <p>快递信息：<?=$_item['express_info'];?></p>
            <?php endif;?>
        <?php endif;?>
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
	<?php if( $_item['status'] == -8 ):?>
        <div class="op_box" style="margin: 2rem 0;padding: 1rem 0 ;">
            <a style="width: 50%;display: block;float: left;text-align: left;" class="close" data="<?=$_item['id'];?>" href="<?=UrlService::buildNull();?>">取消订单</a>
            <a style="width: 50%;display: block;float: right;text-align: right;"   href="<?=$_item["pay_url"];?>">微信支付</a>
        </div>
	<?php elseif( $_item['status'] == 1 ):?>
        <div class="op_box" style="margin: 2rem 0 ;padding: 1rem 0 ;">
			<?php if( $_item['express_status'] == -6 ):?>
                <a style="width: 50%;display: block;float: right;text-align: right;" data="<?=$_item['id'];?>"  href="<?=UrlService::buildNull();?>"  class="confirm_express">确认收货</a>
            <?php elseif( $_item['express_status'] == 1 && !$_item['comment_status']):?>
                <a style="width: 50%;display: block;float: right;text-align: right;"   href="<?=UrlService::buildMUrl("/user/comment_set",[ 'pay_order_id' => $_item['id'] ]);?>">我要评论</a>
			<?php endif;?>
        </div>
	<?php else:?>
        <div style="padding-bottom: 1rem;">&nbsp;</div>
	<?php endif;?>
</div>

<?php endforeach;?>
<?php else:?>
    <div class="no-data">
        悲剧啦，连个订单都咩有了~~
    </div>

<?php endif;?>
