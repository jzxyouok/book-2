<?php

namespace app\modules\m\controllers;

use app\common\services\ConstantService;
use app\models\book\Book;
use app\models\brand\BrandImages;
use app\models\brand\BrandSetting;
use app\models\member\Fav;
use app\models\member\MemberCart;
use app\modules\m\controllers\common\BaseController;


class DefaultController extends BaseController {
	//http://www.17sucai.com/pins/22261.html
    public function actionIndex(){
    	$info = BrandSetting::find()->one();
    	$image_list = BrandImages::find()->all();

        return $this->render('index',[
        	'info' => $info,
			'image_list' => $image_list
		]);
    }

}
