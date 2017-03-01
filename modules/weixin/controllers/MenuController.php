<?php
namespace app\modules\weixin\controllers;

use common\service\GlobalUrlService;
use common\service\weixin\RequestService;

class MenuController extends BaseController{

	public function actionSet(){
		$menu  = [
			"button" => [
				[
					"name"       => "域名",
					"sub_button" => [
						[
							"type" => "view",
							"name" => "新增备案",
							"url"  => GlobalUrlService::buildMUrl("/beian/index")
						]
					]
				],
				[
					"name" => "我",
					"type" => "view",
					"url" => GlobalUrlService::buildMUrl("/user/index")
				]
			]
		];
		$config = \Yii::$app->params['weixin'];
		RequestService::setConfig( $config['appid'],$config['token'],$config['sk'] );
		$access_token = RequestService::getAccessToken();
		if( $access_token ){
			$url = "menu/create?access_token={$access_token}";
			$ret = RequestService::send( $url,json_encode($menu,JSON_UNESCAPED_UNICODE), 'POST' );
			var_dump( $ret );
		}
	}
}
