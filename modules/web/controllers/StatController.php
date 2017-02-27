<?php

namespace app\modules\web\controllers;

use app\common\services\UrlService;
use app\modules\web\controllers\common\BaseController;

class StatController extends BaseController{

    public function actionIndex(){
        return $this->render("index");
    }

}
