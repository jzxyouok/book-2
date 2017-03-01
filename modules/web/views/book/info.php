<?php
use \app\common\services\UrlService;
use \app\common\services\UtilService;
use \app\common\services\StaticService;
use \app\common\services\ConstantService;
?>
<?php echo \Yii::$app->view->renderFile("@app/modules/web/views/common/tab_book.php", ['current' => 'book']); ?>
<style type="text/css">
	.wrap_info img{
		width: 70%;
	}
</style>
<div class="row m-t wrap_info">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-12">
				<div class="m-b-md">
					<?php if( $info && $info['status'] ):?>
						<a class="btn btn-outline btn-primary pull-right" href="<?=UrlService::buildWebUrl("/book/set",[ 'id' => $info['id'] ]);?>">
							<i class="fa fa-pencil"></i>编辑
						</a>
					<?php endif;?>
					<h2>图书信息</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<p class="m-t">图书名称：<?=UtilService::encode( $info['name'] ) ;?></p>
				<p>图书售价：<?=UtilService::encode( $info['price'] ) ;?></p>
				<p>库存总量：<?=UtilService::encode( $info['unit'] ) ;?></p>
				<p>图书标签：<?=UtilService::encode( $info['tags'] ) ;?></p>
				<p>封面图：<img src="<?=UrlService::buildPicUrl("book",$info['main_image']);?>" style="width: 50px;height: 50px;"/> </p>
				<p>图书描述：<?=$info['summary'] ;?></p>
			</div>
		</div>
	</div>
</div>
