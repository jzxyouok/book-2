<?php
use \app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppJsStatic( "/js/m/product/order.js",\app\assets\MAsset::className() );
?>
<div class="page_title clearfix">
    <span>订单提交</span>
</div>
<div class="order_box">
    <div class="order_header">
        <h2>确认收货地址</h2>
    </div>


	<div class="order_header">
		<h2>确认订单信息</h2>
	</div>
	<?php if( $product_list ):?>
	<ul class="order_list">
		<?php foreach( $product_list as $_item ):?>
		<li data="<?=$_item["id"];?>" data-quantity="<?=$_item['quantity'];?>">
			<a href="<?=UrlService::buildMUrl("/product/info",[ "id" => $_item['id'] ]);?>">
				<i class="pic">
					<img src="<?=$_item["main_image"];?>" style="width: 100px;height: 100px;"/>
				</i>
				<h2><?=$_item['name'];?> </h2>
				<h4>x <?=$_item['quantity'];?></h4>
				<b>¥ <?=$_item['price'];?></b>
			</a>
		</li>
		<?php endforeach;?>
	</ul>
	<?php endif;?>
	<div class="order_header" style="border-top: 1px dashed #ccc;">
		<h2>总计：<?=$total_pay_money;?></h2>
	</div>
</div>
<div class="op_box">
	<input style="width: 100%;" type="button" value="确定下单" class="red_btn do_order"  />
</div>
