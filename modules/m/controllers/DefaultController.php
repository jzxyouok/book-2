<?php

namespace app\modules\m\controllers;

use app\modules\m\controllers\common\BaseController;


class DefaultController extends BaseController {
//http://www.17sucai.com/pins/22261.html
    public function actionIndex(){
        return $this->render('index');
    }
}
