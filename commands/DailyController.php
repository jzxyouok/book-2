<?php

namespace app\commands;

use app\common\services\book\BookService;
use app\common\services\PayOrderService;
use app\models\book\Book;
use app\models\member\Member;
use app\models\pay\PayOrder;
use app\models\pay\PayOrderItem;
use app\models\stat\StatDailySite;
use app\models\WxShareHistory;
use Yii;

class DailyController extends BaseController {

	/*
	 * 每日营收
	 * php yii daily/site
	 * */
	public function actionSite( $date = 'now' ){
		$date = date('Y-m-d', strtotime($date) );
		$date_now = date("Y-m-d H:i:s");
		$time_start = $date.' 00:00:00';
		$time_end = $date.' 23:59:59';
		$this->echoLog( "ID_ACTION:".__CLASS__."_".__FUNCTION__.",date:{$date} " );

		$stat_pay_info = PayOrder::find()->select([ 'SUM(pay_price) as total_pay_money' ])
			->where([ 'status' => 1 ])
			->andWhere([ 'between','created_time',$time_start,$time_end ])
			->asArray()->one();


		$total_member_count = Member::find()->where([ '<=','created_time',$time_end ])->count();
		$total_new_member_count = Member::find()->where([ 'between','created_time',$time_start,$time_end ])->count();
		$total_order_count = PayOrder::find()->where([ 'status' => 1 ])->andWhere([  'between','created_time',$time_start,$time_end ])->count();
		$total_shared_count = WxShareHistory::find()->where( [ 'between','created_time',$time_start,$time_end  ] )->count();

		$stat_site_info = StatDailySite::findOne([ 'date' => $date ]);
		if( $stat_site_info ){
			$model_stat_site = $stat_site_info;
		}else{
			$model_stat_site = new StatDailySite();
			$model_stat_site->date = $date;
			$model_stat_site->created_time = $date_now;
		}

		$model_stat_site->total_pay_money = ( $stat_pay_info && $stat_pay_info['total_pay_money'] )?$stat_pay_info['total_pay_money']:0;
		$model_stat_site->total_member_count = $total_member_count?$total_member_count:0;
		$model_stat_site->total_new_member_count = $total_new_member_count?$total_new_member_count:0;
		$model_stat_site->total_order_count = $total_order_count?$total_order_count:0;
		$model_stat_site->total_shared_count = $total_shared_count?$total_shared_count:0;
		$model_stat_site->updated_time = $date_now;
		$model_stat_site->save( 0 );
		$this->echoLog( "it's over ~~" );
	}

}
