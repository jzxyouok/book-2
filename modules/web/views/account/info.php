<?php
use \app\common\services\UrlService;
?>
<?php echo Yii::$app->view->renderFile("@app/modules/web/views/common/tab_account.php",[ 'current' => 'index' ]);?>
<div class="row m-t">
	<div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-b-md">
                    <a class="btn btn-outline btn-primary pull-right">
                        <i class="fa fa-pencil"></i>编辑</a>
                    <h2>账户信息</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 text-center">
                <img class="img-circle circle-border" src="<?=UrlService::buildWwwUrl("/images/common/qrcode.jpg");?>" width="100px" height="100px"/>
            </div>
            <div class="col-lg-10">
                <p class="m-t">姓名：编程浪子</p>
                <p>手机：123456789</p>
                <p>手机：apanly@163.com</p>
            </div>
        </div>
        <div class="row m-t">
            <div class="col-lg-12">
                <div class="panel blank-panel">
                    <div class="panel-heading">
                        <div class="panel-options">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="<?=UrlService::buildNull();?>" data-toggle="tab" aria-expanded="false">访问记录</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>访问时间</th>
                                            <th>访问Url</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                2017-02-25 10:10:01
                                            </td>
                                            <td>
                                                /web/account/index
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2017-02-25 10:10:01
                                            </td>
                                            <td>
                                                /web/account/index
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
