<?php

namespace app\common\services;
use  yii\helpers\Html;

class UtilService {
	public static function getRootPath(){
		$vendor_path = \Yii::$app->vendorPath;
		return dirname($vendor_path);
	}

	public static function encode( $dispaly_text ){
		return  Html::encode($dispaly_text);
	}
}