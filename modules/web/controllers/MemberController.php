<?php

namespace app\modules\web\controllers;

use app\common\services\ConstantService;
use app\common\services\DataHelper;
use app\common\services\UrlService;
use app\common\services\UtilService;
use app\models\book\Book;
use app\models\book\BookCat;
use app\models\Images;
use app\models\member\Member;
use app\models\pay\PayOrder;
use app\modules\web\controllers\common\BaseController;

class MemberController extends BaseController{

    public function actionIndex(){
		$mix_kw = trim( $this->get("mix_kw","" ) );
		$status = intval( $this->get("status",ConstantService::$status_default ) );
		$p = intval( $this->get("p",1) );
		$p = ( $p > 0 )?$p:1;

		$query = Member::find();

		if( $mix_kw ){
			$where_nickname = [ 'LIKE','nickname','%'.strtr($mix_kw,['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']).'%', false ];
			$where_mobile = [ 'LIKE','mobile','%'.strtr($mix_kw,['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']).'%', false ];
			$query->andWhere([ 'OR',$where_nickname,$where_mobile ]);
		}

		if( $status > ConstantService::$status_default ){
			$query->andWhere([ 'status' => $status ]);
		}


		$offset = ($p - 1) * $this->page_size;
		$total_res_count = $query->count();

		$pages = UtilService::ipagination([
			'total_count' => $total_res_count,
			'page_size' => $this->page_size,
			'page' => $p,
			'display' => 10
		]);


		$list = $query->orderBy([ 'id' => SORT_DESC ])
			->offset($offset)
			->limit($this->page_size)
			->all( );

		$data = [];

		if( $list ){
			foreach( $list as $_item ){
				$data[] = [
					'id' => $_item['id'],
					'nickname' => UtilService::encode( $_item['nickname'] ),
					'mobile' => UtilService::encode( $_item['mobile'] ),
					'sex_desc' => ConstantService::$sex_mapping[ $_item['sex'] ],
					'avatar' => UrlService::buildPicUrl( "avatar",$_item['avatar'] ),
					'status_desc' => ConstantService::$status_mapping[ $_item['status'] ],
					'status' => $_item['status'],
				];
			}
		}

        return $this->render('index',[
			"pages" => $pages,
			'list' => $data,
			'search_conditions' => [
				'mix_kw' => $mix_kw,
				'p' => $p,
				'status' => $status
			],
			'status_mapping' => ConstantService::$status_mapping
		]);
    }

    public function actionInfo(){
		$id = intval( $this->get("id", 0) );
		$reback_url = UrlService::buildWebUrl("/member/index");
		if( !$id ){
			return $this->redirect( $reback_url );
		}

		$info = Member::find()->where([ 'id' => $id ])->one();
		if( !$info ){
			return $this->redirect( $reback_url );
		}

		$pay_order_list = PayOrder::find()->where([ 'member_id' => $id,'status' => [ -8,1 ] ])->orderBy([ 'id' => SORT_DESC ])->all();


		return $this->render("info",[
			"info" => $info,
			"pay_order_list" => $pay_order_list
		]);
	}

	public function actionSet(){
		if( \Yii::$app->request->isGet ) {
			$id = intval( $this->get("id", 0) );
			$info = [];
			if( $id ){
				$info = Member::find()->where([ 'id' => $id ])->one();
			}

			return $this->render('set',[
				'info' => $info
			]);
		}

		$id = intval( $this->post("id",0) );
		$nickname = trim( $this->post("nickname","") );
		$mobile = floatval( $this->post("mobile",0) );
		$date_now = date("Y-m-d H:i:s");

		if( mb_strlen( $nickname,"utf-8" ) < 1 ){
			return $this->renderJSON([],"请输入符合规范的姓名~~",-1);
		}

		if( mb_strlen( $mobile,"utf-8" ) < 1   ){
			return $this->renderJSON([],"请输入符合规范的手机号码~~",-1);
		}



		$info = [];
		if( $id ){
			$info = Member::findOne(['id' => $id]);
		}
		if( $info ){
			$model_member = $info;
		}else{
			$model_member = new Member();
			$model_member->status = 1;
			$model_member->avatar = ConstantService::$default_avatar;
			$model_member->created_time = $date_now;
		}

		$model_member->nickname = $nickname;
		$model_member->mobile = $mobile;
		$model_member->updated_time = $date_now;
		$model_member->save( 0 );
		return $this->renderJSON([],"操作成功~~");
	}

	public function actionOps(){
		if( !\Yii::$app->request->isPost ){
			return $this->renderJSON( [],ConstantService::$default_syserror,-1 );
		}

		$id = $this->post('id',[]);
		$act = trim($this->post('act',''));
		if( !$id ){
			return $this->renderJSON([],"请选择要操作的会员账号号~~",-1);
		}

		if( !in_array( $act,['remove','recover' ])){
			return $this->renderJSON([],"操作有误，请重试~~",-1);
		}

		$info = Member::find()->where([ 'id' => $id ])->one();
		if( !$info ){
			return $this->renderJSON([],"指定会员账号不存在~~",-1);
		}

		switch ( $act ){
			case "remove":
				$info->status = 0;
				break;
			case "recover":
				$info->status = 1;
				break;
		}
		$info->updated_time = date("Y-m-d H:i:s");
		$info->update( 0 );
		return $this->renderJSON( [],"操作成功~~" );
	}

}
