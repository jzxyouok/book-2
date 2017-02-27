<?php

namespace app\modules\web\controllers\common;
use app\common\services\UrlService;
use app\models\User;
use yii\web\Controller;
class BaseController extends Controller {

	public $enableCsrfValidation = false;
	protected  $auth_cookie_name = "mooc_book";
	protected  $salt = "dm3HsNYz3Uy46Rjg";
	protected $current_user = null;

	public $allowAllAction = [
		'web/user/login',
		'web/user/logout'
	];

	public function __construct($id, $module, $config = []){
		parent::__construct($id, $module, $config = []);
		$this->layout = "main";
	}

	public function beforeAction( $action ){
		$is_login = $this->checkLoginStatus();

		if ( in_array($action->getUniqueId(), $this->allowAllAction ) ) {
			return true;
		}

		if(!$is_login) {
			if ( \Yii::$app->request->isAjax) {
				$this->renderJSON([], "未登录,请返回用户中心", -302);
			} else {
				$this->redirect( UrlService::buildWebUrl("/user/login") );
			}
			return false;
		}

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
		$this->setCookie($this->auth_cookie_name,$auth_token."#".$user_info['uid']);
	}

	protected  function removeAuthToken(){
		$this->removeCookie($this->auth_cookie_name);
	}

	public function geneAuthToken( $user_info ){
		return md5( $this->salt."-{$user_info['login_name']}-{$user_info['login_pwd']}-{$user_info['login_salt']}");
	}

	protected function geneReqId() {
		return uniqid();
	}

	public function post($key, $default = "") {
		return \Yii::$app->request->post($key, $default);
	}


	public function get($key, $default = "") {
		return \Yii::$app->request->get($key, $default);
	}


	protected function setCookie($name,$value,$expire = 0){
		$cookies = \Yii::$app->response->cookies;
		$cookies->add( new \yii\web\Cookie([
			'name' => $name,
			'value' => $value,
			'expire' => $expire
		]));
	}

	protected  function getCookie($name,$default_val=''){
		$cookies = \Yii::$app->request->cookies;
		return $cookies->getValue($name, $default_val);
	}


	protected function removeCookie($name){
		$cookies = \Yii::$app->response->cookies;
		$cookies->remove($name);
	}

	protected function renderJSON($data=[], $msg ="ok", $code = 200)
	{
		header('Content-type: application/json');
		echo json_encode([
			"code" => $code,
			"msg"   =>  $msg,
			"data"  =>  $data,
			"req_id" =>  $this->geneReqId(),
		]);

		return \Yii::$app->end();
	}

	protected  function renderJS($msg,$url = "/"){
		return $this->renderPartial("@app/views/common/js",['msg' => $msg,'location' => $url ]);
	}

}