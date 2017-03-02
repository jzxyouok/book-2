<?php
use \app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppJsStatic( "/js/m/product/cart.js",\app\assets\MAsset::className() );
?>
<div class="order_pro_box">
	<ul class="order_pro_list">
		<li>
			<i><input id='check-1' type="checkbox" name='check-1' /><label for="check-1">&nbsp;</label></i>
			<a href="proinfo.html" class="pic"><img src="/images/m/temp/pic.jpg" /></a>
			<h2><a href="proinfo.html">韩版冬季中长款显瘦高领针织连衣裙长裙 </a></h2>
			<h3>M<span>黑色</span></h3>
			<div class="order_c_op">
				<b>¥188.00</b>
				<span class="delC_icon"></span>
				<div class="quantity-form">
					<a class="icon_lower"></a>
					<input type="text" class="input_quantity" value="1" readonly="readonly" max="10" />
					<a class="icon_plus"></a>
				</div>
			</div>
		</li>
		<li>
			<i><input id='check-2' type="checkbox" name='check-1' checked='checked' /><label for="check-2">&nbsp;</label></i>
			<a href="proinfo.html" class="pic"><img src="/images/m/temp/pic.jpg" /></a>
			<h2><a href="proinfo.html">韩版冬季中长款显瘦高领针织连衣裙长裙 </a></h2>
			<h3>M<span>黑色</span></h3>
			<div class="order_c_op">
				<b>¥ 188.00</b>
				<span class="delC_icon"></span>
				<div class="quantity-form">
					<a class="icon_lower"></a>
					<input type="text" class="input_quantity" value="1" readonly="readonly" max="10" />
					<a class="icon_plus"></a>
				</div>
			</div>
		</li>
		<li>
			<i><input id='check-3' type="checkbox" name='check-1' /><label for="check-3">&nbsp;</label></i>
			<a href="proinfo.html" class="pic"><img src="/images/m/temp/pic.jpg" /></a>
			<h2><a href="proinfo.html">韩版冬季中长款显瘦高领针织连衣裙长裙 </a></h2>
			<h3>M<span>黑色</span></h3>
			<div class="order_c_op">
				<b>¥ 188.00</b>
				<span class="delC_icon"></span>
				<div class="quantity-form">
					<a class="icon_lower"></a>
					<input type="text" class="input_quantity" value="1" readonly="readonly" max="10" />
					<a class="icon_plus"></a>
				</div>
			</div>
		</li>
	</ul>
</div>
<div class="cart_fixed">
	<a href="#" class="billing_btn">结算</a>
	<span><input id='check-0' type="checkbox" name='check-1'  /><label for="check-0">全选</label></span>
	<b>合计：<strong>¥</strong><font id="price">188.00</font></b>
</div>