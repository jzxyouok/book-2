<?php
use \app\common\services\UrlService;
use \app\common\services\StaticService;
StaticService::includeAppJsStatic( "/plugins/highcharts/highcharts.js",\app\assets\WebAsset::className() );

StaticService::includeAppCssStatic( "/plugins/datetimepicker/jquery.datetimepicker.min.css",\app\assets\WebAsset::className() );

StaticService::includeAppJsStatic( "/plugins/datetimepicker/jquery.datetimepicker.full.min.js",\app\assets\WebAsset::className() );


StaticService::includeAppJsStatic( "/js/web/stat/index.js",\app\assets\WebAsset::className() );
?>

<?php echo Yii::$app->view->renderFile("@app/modules/web/views/common/tab_stat.php",[ 'current' => 'index' ]);?>
<div class="row m-t">
    <div class="col-lg-12" id="container" style="height: 400px;">

    </div>
    <div class="col-lg-12 m-t">
        <div class="form-inline" id="search_form_wrap">
            <div class="row p-w-m">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" placeholder="请选择开始时间" name="date_from" class="form-control">
                    </div>
                </div>
                <div class="form-group m-r m-l">
                    <label>至</label>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" placeholder="请选择结束时间" name="date_to" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-w-m btn-outline btn-primary">搜索</a>
                </div>
            </div>
            <hr/>
        </div>
        <table class="table table-bordered m-t">
            <thead>
            <tr>
                <th>序号</th>
                <th>图书名称</th>
                <th>图书主图</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
        </table>
		<?php echo \Yii::$app->view->renderFile("@app/modules/web/views/common/pagination.php", [ 'page' => [] ]); ?>
    </div>
</div>