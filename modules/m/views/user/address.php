<?php
use \app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppJsStatic( "/js/m/user/address.js",\app\assets\MAsset::className() );
?>
<ul class="address_list">
	<li>
		<p><span>张小明</span>13811223344</p>
		<p>浙江省杭州市西湖区文三西路西湖文化广场120号</p>
		<div class="addr_op">
			<em class="del"><i class="del_icon"></i>删除</em>
			<a href="<?=UrlService::buildMUrl("/user/address_set");?>"><i class="edit_icon"></i>编辑</a>
			<span class="default_set aon"><i class="check_icon"></i>默认地址</span>
		</div>
	</li>
	<li>
		<p><span>张小明</span>13811223344</p>
		<p>浙江省杭州市西湖区文三西路西湖文化广场120号西路西湖文化广场120号</p>
		<div class="addr_op">
			<em class="del"><i class="del_icon"></i>删除</em>
			<a href="<?=UrlService::buildMUrl("/user/address_set");?>"><i class="edit_icon"></i>编辑</a>
			<span class="default_set"><i class="check_icon"></i>默认地址</span>
		</div>
	</li>
	<li>
		<p><span>张小明</span>13811223344</p>
		<p>浙江省杭州市西湖区文三西路西湖文化广场120号</p>
		<div class="addr_op">
			<em class="del"><i class="del_icon"></i>删除</em>
			<a href="<?=UrlService::buildMUrl("/user/address_set");?>"><i class="edit_icon"></i>编辑</a>
			<span class="default_set"><i class="check_icon"></i>默认地址</span>
		</div>
	</li>
</ul>
<div class="op_box">
	<a href="<?=UrlService::buildMUrl("/user/address_set");?>" class="red_btn">添加新地址</a>
</div>