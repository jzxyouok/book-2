<?php
use \app\common\services\UrlService;
?>

<?php echo \Yii::$app->view->renderFile("@app/modules/web/views/common/tab_book.php", ['current' => 'book']); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="form-inline">
            <div class="row  m-t p-w-m">
                <div class="form-group">
                    <select class="form-control inline">
                        <option value="0">请选择分类</option>
                        <option value="1">Option 2</option>
                        <option value="2">Option 3</option>
                        <option value="3">Option 4</option>
                    </select>
                </div>
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
                    <a class="btn btn-w-m btn-outline btn-primary pull-right" href="<?=UrlService::buildWebUrl("/book/set");?>">
                        <i class="fa fa-plus"></i>图书
                    </a>
                </div>
            </div>

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
