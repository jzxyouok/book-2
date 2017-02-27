
<?php
use \app\common\services\UrlService;
?>

<?php echo Yii::$app->view->renderFile("@app/modules/web/views/common/tab_account.php",[ 'current' => 'index' ]);?>

<div class="row">
	<div class="col-lg-12">
		<div class="form-inline">
			<div class="row m-t p-w-m">
				<div class="form-group">
					<div class="input-group">
						<input type="text" placeholder="请输入搜索关键词" class="form-control">
						<span class="input-group-btn">
                            <button type="button" class="btn  btn-primary">
                                <i class="fa fa-search"></i>搜索
                            </button>
                        </span>
					</div>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-lg-12">
					<a class="btn btn-w-m btn-outline btn-primary pull-right" href="<?=UrlService::buildWebUrl("/account/set");?>">
						<i class="fa fa-plus"></i>账号
					</a>
				</div>
			</div>
		</div>
        <table class="table table-bordered m-t">
            <thead>
            <tr>
                <th>序号</th>
                <th>姓名</th>
                <th>手机</th>
                <th>邮箱</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>
                    <a href="<?=UrlService::buildWebUrl("/account/set");?>">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>
                    <a href="<?=UrlService::buildWebUrl("/account/info");?>">
                        <i class="fa fa-eye fa-lg"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
		<?php echo \Yii::$app->view->renderFile("@app/modules/web/views/common/pagination.php", [ 'page' => [] ]); ?>
	</div>
</div>

