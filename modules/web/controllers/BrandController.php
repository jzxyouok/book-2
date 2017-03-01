<?php

namespace app\modules\web\controllers;

use app\common\services\UrlService;
use app\models\brand\BrandSetting;
use app\modules\web\controllers\common\BaseController;

class BrandController extends BaseController{

    public function actionInfo(){
    	$info = BrandSetting::find()->one(  );
        return $this->render("info",[
        	"info" => $info
		]);
    }

	public function actionSet(){
    	if( \Yii::$app->request->isGet ){
			$info = BrandSetting::find()->one(  );
			return $this->render("set",[
				'info' => $info
			]);
		}

		$name = trim( $this->post("name","") );
		$logo = trim( $this->post("logo","") );
		$mobile = trim( $this->post("mobile","") );
		$address = trim( $this->post("address","") );
		$description = trim( $this->post("description","") );
		$date_now  = date("Y-m-d H:i:s");

		if( mb_strlen( $name,"utf-8" ) < 1 ){
			return $this->renderJSON( [] , "请输入符合规范的品牌名称~~" ,-1);
		}

		if( mb_strlen( $logo,"utf-8" ) < 1 ){
			return $this->renderJSON( [] , "请上传品牌Logo~~" ,-1);
		}

		if( mb_strlen( $mobile,"utf-8" ) < 1 ){
			return $this->renderJSON( [] , "请输入符合规范的手机号码~~" ,-1);
		}

		if( mb_strlen( $address,"utf-8" ) < 1 ){
			return $this->renderJSON( [] , "请输入符合规范的地址~~" ,-1);
		}

		if( mb_strlen( $description,"utf-8" ) < 1 ){
			return $this->renderJSON( [] , "请输入符合规范的品牌介绍~~" ,-1);
		}

		$info = BrandSetting::find()->one(  );
		if( $info ){
			$model_brand = $info;
		}else{
			$model_brand = new BrandSetting();
			$model_brand->created_time = $date_now;
		}
		$model_brand->name = $name;
		$model_brand->logo = $logo;
		$model_brand->mobile = $mobile;
		$model_brand->address = $address;
		$model_brand->description = $description;
		$model_brand->updated_time = $date_now;
		$model_brand->save( 0 );

		return $this->renderJSON( [],"操作成功~~" );
	}
}
