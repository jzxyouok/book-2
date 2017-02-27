<?php
namespace app\modules\web\controllers;


use app\common\services\UrlService;
use app\models\User;
use app\modules\web\controllers\common\BaseController;

class UserController extends  BaseController{
	public function actionLogin(){
		if( \Yii::$app->request->isGet ){
			$this->layout = "user";
			return $this->render("login");
		}

		$login_name = trim( $this->post("login_name","") );
		$login_pwd = trim( $this->post("login_pwd","") );

		if( mb_strlen($login_name,"utf-8") < 1 ){
			return $this->renderJS("请输入正确的登录用户名~~",UrlService::buildWebUrl("/user/login"));
		}

		if( mb_strlen($login_pwd,"utf-8") < 1 ){
			return $this->renderJS("请输入正确的登录密码~~",UrlService::buildWebUrl("/user/login"));
		}

		$user_info = User::find()->where([ 'login_name' => $login_name ])->one();
		if( !$user_info ){
			return $this->renderJS("请输入正确的用户名和密码~~",UrlService::buildWebUrl("/user/login"));
		}

		if( !$user_info->verifyPassword($login_pwd) ){
			return $this->renderJS("请输入正确的用户名和密码~~",UrlService::buildWebUrl("/user/login") );
		}

		$this->setLoginStatus( $user_info );
		return $this->redirect( UrlService::buildWebUrl("/default/index") );
	}

	public function actionLogout(){
		$this->removeAuthToken();
		return $this->redirect( UrlService::buildWebUrl("/user/login") );
	}

}