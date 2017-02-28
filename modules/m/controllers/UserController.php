<?php

namespace app\modules\m\controllers;

use app\common\services\ConstantService;
use app\common\services\member\MemberService;
use app\common\services\UrlService;
use app\common\services\UtilService;
use app\models\member\Member;
use app\models\oauth\OauthMemberBind;
use app\models\sms\SmsCaptcha;
use app\modules\m\controllers\common\BaseController;


class UserController extends BaseController {

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionBind(){
		if( \Yii::$app->request->isGet ){
			return $this->render("bind",[
				'referer' => trim( $this->get("referer") )
			]);
		}
		$mobile = trim( $this->post("mobile") );
		$img_captcha = trim( $this->post("img_captcha") );
		$captcha_code = trim( $this->post("captcha_code") );
		$referer = trim( $this->post("referer","") );
		$openid   = $this->getCookie($this->auth_cookie_current_openid);
		$unionid   = $this->getCookie($this->auth_cookie_current_unionid,'');
		$date_now = date("Y-m-d H:i:s");

		if( mb_strlen($mobile,"utf-8") < 1 || !preg_match("/^[1-9]\d{10}$/",$mobile) ){
			return $this->renderJSON([],"请输入符合要求的手机号码~~",-1);
		}

		if (mb_strlen( $img_captcha, "utf-8") < 1) {
			return $this->renderJSON([], "请输入符合要求的图像校验码~~", -1);
		}

		if (mb_strlen( $captcha_code, "utf-8") < 1) {
			return $this->renderJSON([], "请输入符合要求的手机验证码~~", -1);
		}


		if ( !SmsCaptcha::checkCaptcha($mobile, $captcha_code ) ) {
			return $this->renderJSON([], "请输入正确的手机验证码~~", -1);
		}

		$user_info = Member::find()->where([ 'mobile' => $mobile,'status' => 1 ])->one();

		if( !$user_info ){
			$ret = MemberService::set( [ 'mobile' => $mobile,'passwd' => '' ] );
			if( !$ret ){
				return $this->renderJSON([],MemberService::getLastErrorMsg(),-1);
			}
			$user_info = Member::find()->where([ 'uid' => $ret,'status' => 1 ])->one();
		}

		if ( !$user_info || !$user_info['status']) {
			return $this->renderJSON([], "您的账号已被禁止，请联系客服解决~~", -1);
		}

		if ($openid) {
			//检查该手机号是否绑定过其他微信（一个手机号只能绑定一个微信,也只能绑定一个支付宝）
			$client_type = ConstantService::$client_type_wechat;
			$bind_info = OauthMemberBind::findOne([ 'member_id' => $user_info['id'], "openid" => $openid ,'type' => $client_type ]);
			if ( ! $bind_info) {
				$model_bind  = new OauthMemberBind();
				$model_bind->member_id   = $user_info['id'];
				$model_bind->type = $client_type;
				$model_bind->client_type = ConstantService::$client_type_mapping[ $client_type ];
				$model_bind->openid = $openid ?: '';
				$model_bind->unionid = $unionid ?: '';
				$model_bind->extra = '';
				$model_bind->updated_time = $date_now;
				$model_bind->created_time = $date_now;
				$model_bind->save(0);
			}
		}

		//如果用户头像或者unionid没有，就获取//这个时候做登录特殊处理，例如更新用户名和头像等等新
		$url = ( $referer && $referer != "/m/user/bind" )?$referer:UrlService::buildMUrl("/");
		if( UtilService::isWechat() && ( $user_info->avatar == ConstantService::$default_avatar || $user_info->nickname == $user_info->mobile ) ){
			$url = $this->getAuthLoginUrl('snsapi_userinfo',$referer);
		}

		$this->setLoginStatus( $user_info );
		return $this->renderJSON([ 'url' => $url  ],"绑定成功~~");
	}

	public function actionOrder(){
		return $this->render('order');
	}

	public function actionFav(){
		return $this->render('fav');
	}

	public function actionComment(){
		return $this->render('comment');
	}

	public function actionAddress(){
		return $this->render('address');
	}

	public function actionAddress_set(){
		return $this->render('address_set');
	}

}
