<?php

namespace app\commands\queue;


use app\commands\BaseController;
use app\common\services\UploadService;
use app\models\market\MarketQrcode;
use app\models\market\QrcodeScanHistory;
use app\models\member\Member;
use app\models\oauth\OauthMemberBind;
use app\models\QueueList;


class ListController extends  BaseController {
	/**
	 * 如果跑多个会重复跑如何解决，这个就要求模计算了
	 * php yii queue/list/run
	 */
	public function actionRun( ){
		$list = QueueList::find()->where([ 'status' => -1  ])->orderBy([ 'id' =>SORT_ASC ])->limit( 10 )->all();
		if( !$list ){
			return $this->echoLog( 'no data to handle ~~' );
		}

		foreach( $list as $_item ){
			$this->echoLog("queue_id:{$_item['id']}");
			$_item->status = 1;
			$_item->updated_time = date("Y-m-d H:i:s");
			$_item->update( 0 );
			switch ( $_item['queue_name'] ){
				case "member_avatar":
					$this->handleMemberAvatar( $_item );
					break;
				case  "bind":
					$this->handleBind( $_item );
					break;

			}
		}

		return $this->echoLog("it's over ~~");
	}

	private function handleMemberAvatar( $item ){
		$data = @json_decode( $item['data'],true );

		if( !isset( $data['member_id'] ) || !isset( $data['avatar_url']) ){
			return false;
		}


		if( !$data['member_id'] || !$data['avatar_url'] ){
			return false;
		}

		$member_info = Member::findOne([ 'id' => $data['member_id'] ]);
		if( !$member_info ){
			return false;
		}

		$ret = UploadService::uploadByUrl( $data['avatar_url'],"avatar" );
		if( $ret ){
			$member_info->avatar = $ret['path'];
			$member_info->update( 0 );
		}
		return true;
	}

	private function handleBind( $item ){
		$data = @json_decode( $item['data'],true );

		if( !isset( $data['member_id'] ) || !isset( $data['openid']) ){
			return false;
		}


		if( !$data['member_id'] || !$data['openid'] ){
			return false;
		}


		$member_info = Member::findOne([ 'id' => $data['member_id'] ]);
		if( !$member_info ){
			return false;
		}

		$scan_info = QrcodeScanHistory::find()->where([ 'openid' => $data['openid'] ])->one();
		if( !$scan_info ){
			return false;
		}

		$qrcode_info = MarketQrcode::find()->where([ 'id' => $scan_info['qrcode_id'] ])->one();
		if( !$qrcode_info ){
			return false;
		}

		$qrcode_info->total_reg_count += 1;
		$qrcode_info->update( 0 );
		return true;
	}
}