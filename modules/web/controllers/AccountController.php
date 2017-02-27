<?php
/**
 * Class UserController
 */

namespace app\modules\web\controllers;


use app\common\services\UrlService;
use app\modules\web\controllers\common\BaseController;

class AccountController extends  BaseController{
	public function actionIndex(){
		return $this->render("index");
	}

	public function actionSet(){
		return $this->render("set");
	}

	public function actionInfo(){
		return $this->render("info");
	}

}