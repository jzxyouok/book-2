<?php

namespace app\modules\m\controllers;
use app\common\services\ConstantService;
use app\common\services\PayOrderService;
use app\models\pay\PayOrder;
use app\modules\m\controllers\common\BaseController;

class OrderController extends BaseController {

	public function actionOps(){
		if( !\Yii::$app->request->isPost ){
			return $this->renderJSON([],ConstantService::$default_syserror,-1);
		}

		$act = $this->post("act","");
		$id = intval( $this->post("id",0) );
		$date_now = date("Y-m-d H:i:s");

		if( !in_array( $act,[ "close" ]) ){
			return $this->renderJSON([],ConstantService::$default_syserror,-1);
		}

		if( !$id ){
			return $this->renderJSON([],ConstantService::$default_syserror,-1);
		}

		$pay_order_info = PayOrder::find()->where([ 'id' => $id,'member_id' => $this->current_user['id'] ])->one();
		if( !$pay_order_info ){
			return $this->renderJSON([],ConstantService::$default_syserror,-1);
		}

		switch ( $act ){
			case "close":
				if( $pay_order_info['status'] == -8  ){
					PayOrderService::closeOrder( $pay_order_info['id'] );
				}
				break;
		}

		return $this->renderJSON([],"操作成功~~");
	}
}