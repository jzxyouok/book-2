<?php

namespace app\modules\m\controllers;

use app\models\brand\BrandSetting;
use app\modules\m\controllers\common\BaseController;


class DefaultController extends BaseController {
//http://www.17sucai.com/pins/22261.html
    public function actionIndex(){
    	$info = BrandSetting::find()->one();
        return $this->render('index',[
        	'info' => $info
		]);
    }
}
