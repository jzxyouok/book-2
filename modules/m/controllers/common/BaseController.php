<?php

namespace app\modules\m\controllers\common;
use yii\web\Controller;
class BaseController extends Controller {

	public $enableCsrfValidation = false;

	public function __construct($id, $module, $config = []){
		parent::__construct($id, $module, $config = []);
		$this->layout = false;
	}

	public function beforeAction( $action ){
		return true;
	}

}