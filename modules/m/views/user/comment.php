<?php
use \app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppJsStatic( "/js/m/user/comment.js",\app\assets\MAsset::className() );
?>
<div class="feedback_box">
	<div class="feed_title"><i class="sm_icon"></i>售后说明<b class="x_icon"></b></div>
	<div class="feed_box">
		<textarea id="literal" rows="2" cols="20" class="textarea_txt" placeholder="请描述您所遇到的问题..."></textarea>
		<span><font>0</font>/200</span>
	</div>
	<div class="picture_title"><i class="picture_icon"></i>添加照片</div>
	<ul class="picture_list clearfix">
		<li>
			<div class="pic_box">
				<em></em>
				<i class="pic_icon"></i>
				<span>最多5张</span>
			</div>
		</li>
		<li>
			<div class="pic_box">
				<em><img src="/images/m/temp/p1.jpg" /></em>
				<i class="pic_icon"></i>
				<span>最多5张</span>
				<b class="pic_close"><i></i></b>
			</div>
		</li>
		<li>
			<div class="pic_box">
				<em></em>
				<i class="pic_icon"></i>
				<span>最多5张</span>
			</div>
		</li>
		<li>
			<div class="pic_box">
				<em></em>
				<i class="pic_icon"></i>
				<span>最多5张</span>
			</div>
		</li>
		<li>
			<div class="pic_box">
				<em></em>
				<i class="pic_icon"></i>
				<span>最多5张</span>
			</div>
		</li>
	</ul>
</div>
<div class="op_box"><input id="Button1" type="button" value="提交申请" class="red_btn" onclick=" window.location.href = 'member.html';" /></div>
