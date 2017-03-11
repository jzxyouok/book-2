<?php

namespace app\modules\m\controllers;

use app\common\services\ConstantService;
use app\common\services\DataHelper;
use app\common\services\member\MemberService;
use app\common\services\UrlService;
use app\common\services\UtilService;
use app\models\book\Book;
use app\models\member\Member;
use app\models\member\MemberFav;
use app\models\oauth\OauthMemberBind;
use app\models\pay\PayOrder;
use app\models\pay\PayOrderItem;
use app\models\sms\SmsCaptcha;
use app\modules\m\controllers\common\BaseController;


class UserController extends BaseController {

    public function actionIndex(){
        return $this->render('index',[
        	'current_user' => $this->current_user
		]);
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

		$member_info = Member::find()->where([ 'mobile' => $mobile,'status' => 1 ])->one();

		if( !$member_info ){
			$ret = MemberService::set( [ 'mobile' => $mobile,'passwd' => '' ] );
			if( !$ret ){
				return $this->renderJSON([],MemberService::getLastErrorMsg(),-1);
			}
			$member_info = Member::find()->where([ 'id' => $ret,'status' => 1 ])->one();
		}

		if ( !$member_info || !$member_info['status']) {
			return $this->renderJSON([], "您的账号已被禁止，请联系客服解决~~", -1);
		}

		if ($openid) {
			//检查该手机号是否绑定过其他微信（一个手机号只能绑定一个微信,也只能绑定一个支付宝）
			$client_type = ConstantService::$client_type_wechat;
			$bind_info = OauthMemberBind::findOne([ 'member_id' => $member_info['id'], "openid" => $openid ,'type' => $client_type ]);
			if ( ! $bind_info) {
				$model_bind  = new OauthMemberBind();
				$model_bind->member_id   = $member_info['id'];
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
		if( UtilService::isWechat() && ( $member_info->avatar == ConstantService::$default_avatar || $member_info->nickname == $user_info->mobile ) ){
			$url = $this->getAuthLoginUrl('snsapi_userinfo',$referer);
		}

		$this->setLoginStatus( $member_info );
		return $this->renderJSON([ 'url' => $url  ],"绑定成功~~");
	}

	public function actionOrder(){
    	$pay_order_list = PayOrder::find()->where([ 'member_id' => $this->current_user['id'] ])
			->orderBy([ 'id' => SORT_DESC ])->asArray()->all();

    	$list = [];
    	if( $pay_order_list ) {
			$pay_order_items_list = PayOrderItem::find()->where(['member_id' => $this->current_user['id'], 'pay_order_id' => array_column($pay_order_list, 'id')])->asArray()->all();

			$book_mapping = Book::find()->where(['id' => array_column($pay_order_items_list, 'target_id')])->indexBy('id')->all();

			$pay_order_items_mapping = [];
			foreach ($pay_order_items_list as $_pay_order_item) {
				$tmp_book_info = $book_mapping[$_pay_order_item['target_id']];
				if (!isset($pay_order_items_mapping[$_pay_order_item['pay_order_id']])) {
					$pay_order_items_mapping[$_pay_order_item['pay_order_id']] = [];
				}
				$pay_order_items_mapping[$_pay_order_item['pay_order_id']][] = [
					'pay_price'       => $_pay_order_item['price'],
					'book_name'       => UtilService::encode($tmp_book_info['name']),
					'book_main_image' => UrlService::buildPicUrl("book", $tmp_book_info['main_image']),
				];
			}

			foreach ($pay_order_list as $_pay_order_info) {
				$list[] = [
					'id' => $_pay_order_info['id'],
					'sn' => date("YmdHi", strtotime($_pay_order_info['created_time'])) . $_pay_order_info['id'],
					'created_time' => date("Y-m-d H:i", strtotime($_pay_order_info['created_time'])),
					'pay_order_id' => $_pay_order_info['id'],
					'pay_price'    => $_pay_order_info['pay_price'],
					'items' => $pay_order_items_mapping[$_pay_order_info['id']],
					'status' => $_pay_order_info[ 'status' ],
					'status_desc' => ConstantService::$pay_status_mapping[ $_pay_order_info[ 'status' ] ],
					'pay_url' => UrlService::buildMUrl("/pay/buy/?pay_order_id={$_pay_order_info['id']}")
				];

			}
		}

		return $this->render('order',[
			'list' => $list
		]);
	}

	public function actionFav(){
		$list = MemberFav::find()->where([ 'member_id' => $this->current_user['id'] ])->orderBy([ 'id' => SORT_DESC ])->all();
		$data = [];
		if( $list ){
			$book_mapping = DataHelper::getDicByRelateID( $list ,Book::className(),"book_id","id",[ 'name','price','main_image','stock' ] );
			foreach( $list as $_item ){
				$tmp_book_info = $book_mapping[ $_item['book_id'] ];
				$data[] = [
					'id' => $_item['id'],
					'book_id' => $_item['book_id'],
					'book_price' => $tmp_book_info['price'],
					'book_name' => UtilService::encode( $tmp_book_info['name'] ),
					'book_main_image' => UrlService::buildPicUrl( "book",$tmp_book_info['main_image'] )
				];
			}
		}
		return $this->render("fav",[
			'list' => $data
		]);
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
