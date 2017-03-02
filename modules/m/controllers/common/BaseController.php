<?php

namespace app\modules\m\controllers\common;
use app\common\components\BaseWebController;
use app\common\services\UrlService;

class BaseController extends BaseWebController {

	protected  $auth_cookie_name = "mooc_book_member";
	protected  $auth_cookie_current_openid = "sass_idc_m_openid";
	protected  $auth_cookie_current_unionid = "sass_idc_m_unionid";
	protected  $salt = "dm3HsNYz3Uyddd46Rjg";
	protected $current_user = null;

	public function __construct($id, $module, $config = []){
		parent::__construct($id, $module, $config = []);
		$this->layout = "main";
	}

	public function beforeAction( $action ){
		return true;
	}

	protected function checkLoginStatus(){

		$auth_cookie = $this->getCookie( $this->auth_cookie_name );

		if( !$auth_cookie ){
			return false;
		}
		list($auth_token,$uid) = explode("#",$auth_cookie);
		if( !$auth_token || !$uid ){
			return false;
		}
		if( $uid && preg_match("/^\d+$/",$uid) ){
			$user_info = User::findOne([ 'uid' => $uid,'status' => 1 ]);
			if( !$user_info ){
				$this->removeAuthToken();
				return false;
			}
			if( $auth_token != $this->geneAuthToken( $user_info ) ){
				$this->removeAuthToken();
				return false;
			}
			$this->current_user = $user_info;
			\Yii::$app->view->params['current_user'] = $user_info;
			return true;
		}
		return false;
	}

	public function setLoginStatus( $user_info ){
		$auth_token = $this->geneAuthToken( $user_info );
		$this->setCookie($this->auth_cookie_name,$auth_token."#".$user_info['id']);
	}

	protected  function removeAuthToken(){
		$this->removeCookie($this->auth_cookie_name);
	}

	public function geneAuthToken( $user_info ){
		return md5( $this->salt."-{$user_info['id']}-{$user_info['mobile']}-{$user_info['salt']}");
	}

	protected function getBindUrl(){
		$referer = $_SERVER['REQUEST_URI'] ;
		return UrlService::buildMUrl("/user/bind",[ 'referer' => $referer ]);
	}

	protected function getAuthLoginUrl( $type='snsapi_base',$referer = ''){
		$referer = $referer?$referer:$_SERVER['REQUEST_URI'];
		$url = UrlService::buildMUrl("/oauth/login", [ "type" => $type,"referer" => $referer ]);
		return $url;
	}


}