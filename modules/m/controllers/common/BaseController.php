<?php

namespace app\modules\m\controllers\common;
use app\common\services\UrlService;
use yii\web\Controller;
class BaseController extends Controller {

	public $enableCsrfValidation = false;
	protected  $auth_cookie_name = "mooc_book_member";
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
		$this->setCookie($this->auth_cookie_name,$auth_token."#".$user_info['uid']);
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
		return $this->renderPartial("@app/views/common/js", ['msg' => $msg, 'location' => $url]);
	}

}