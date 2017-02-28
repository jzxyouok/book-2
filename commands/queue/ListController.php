<?php

namespace app\commands\queue;


use app\commands\BaseController;
use app\common\services\UploadService;
use app\models\member\Member;
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
			switch ( $_item['queue_name'] ){
				case "member_avatar":
					$this->handleMemberAvatar( $_item );
					break;

			}
		}

		return $this->echoLog("it's over ~~");
	}

	private function handleMemberAvatar( $item ){
		$data = @json_decode( $item['data'],true );
		$item->status = 1;
		$item->updated_time = date("Y-m-d H:i:s");
		$item->update( 0 );
		if( !isset( $data['member_id'] ) || !isset( $data['avatar_url']) ){
			return false;
		}


		if( !$data['member_id'] || !$data['avatar_url'] ){
			return false;
		}

		$user_info = Member::findOne([ 'uid' => $data['member_id'] ]);
		if( !$user_info ){
			return false;
		}

		$image_key = UploadService::uploadByUrl( $data['avatar_url'],"avatar" );
		if( $image_key ){
			$user_info->avatar = $image_key;
			$user_info->update( 0 );
		}
		return true;
	}
}