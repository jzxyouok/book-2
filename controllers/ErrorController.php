<?php

namespace app\controllers;


use app\common\components\BaseWebController;
use app\common\services\applog\ApplogService;
use Yii;
use yii\log\FileTarget;

class ErrorController extends BaseWebController {

	public function actionError(){
		$error = Yii::$app->errorHandler->exception;

		if ($error) {
			$code = $error->getCode();
			$msg = $error->getMessage();
			$file = $error->getFile();
			$line = $error->getLine();

			$time = microtime(true);
			$log = new FileTarget();
			$log->logFile = Yii::$app->getRuntimePath() . '/logs/err.log';

			$err_msg = $msg . " [file: {$file}][line: {$line}][err code:$code.]".
				"[url:{$_SERVER['REQUEST_URI']}][post:".http_build_query($_POST)."]";


			$log->messages[] = [
				$err_msg,
				1,
				'application',
				$time
			];
			$log->export();
			ApplogService::addErrorLog(Yii::$app->id,$err_msg);
		}

		return 'ok';
	}
}