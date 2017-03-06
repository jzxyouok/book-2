<?php

namespace app\modules\web\controllers;

use app\common\services\ConstantService;
use app\common\services\DataHelper;
use app\common\services\UrlService;
use app\common\services\UtilService;
use app\models\book\Book;
use app\models\book\BookCat;
use app\models\Images;
use app\models\pay\PayOrder;
use app\models\pay\PayOrderItem;
use app\modules\web\controllers\common\BaseController;

class FinanceController extends BaseController{

    public function actionIndex(){

		$status = intval( $this->get("status",ConstantService::$status_default ) );
		$p = intval( $this->get("p",1) );
		$p = ( $p > 0 )?$p:1;

		$pay_status_mapping = ConstantService::$pay_status_mapping;

		$query = PayOrder::find();

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
			->asArray()
			->all( );

		$data = [];

		if( $list ){
			$order_item_list = PayOrderItem::find()->where([ 'pay_order_id' =>  array_column( $list,"id" ) ])->asArray()->all();
			$book_mapping = Book::find()->select([ "id",'name' ])->where([ 'id' => array_column( $order_item_list,"target_id" ) ])->indexBy("id")->all();
			$pay_order_mapping = [];
			foreach( $order_item_list as $_order_item_info ){
				$tmp_book_info = $book_mapping[ $_order_item_info['target_id'] ];
				if( isset( $pay_order_mapping[ $_order_item_info['pay_order_id'] ] ) ){
					$pay_order_mapping[ $_order_item_info['pay_order_id'] ] = [];
				}

				$pay_order_mapping[ $_order_item_info['pay_order_id'] ][] = [
					'name' => $tmp_book_info['name'],
					'quantity' => $_order_item_info['quantity']
				];
			}

			foreach( $list as $_item ){
				$data[] = [
					'id' => $_item['id'],
					'sn' => date("YmdHi",strtotime( $_item['created_time'] ) ).$_item['id'],
					'pay_price' => $_item['pay_price'],
					'status_desc' => $pay_status_mapping[ $_item['status'] ],
					'status' => $_item['status'],
					'pay_time' => date("Y-m-d H:i",strtotime( $_item['pay_time'] ) ),
					'created_time' => date("Y-m-d H:i",strtotime( $_item['created_time'] ) ),
					'items' => isset( $pay_order_mapping[ $_item['id'] ] )?$pay_order_mapping[ $_item['id'] ]:[]
				];
			}
		}

        return $this->render('index',[
			"pages" => $pages,
			'list' => $data,
			'search_conditions' => [
				'p' => $p,
				'status' => $status
			],
			'status_mapping' => $pay_status_mapping
		]);
    }

	public function actionAccount(){

		$p = intval( $this->get("p",1) );
		$p = ( $p > 0 )?$p:1;

		$query = PayOrder::find()->where([ 'status' => 1 ]);

		$offset = ($p - 1) * $this->page_size;
		$total_res_count = $query->count();
		$total_pay_money = $query->sum( "pay_price" );

		$pages = UtilService::ipagination([
			'total_count' => $total_res_count,
			'page_size' => $this->page_size,
			'page' => $p,
			'display' => 10
		]);


		$list = $query->orderBy([ 'pay_time' => SORT_DESC ])
			->offset($offset)
			->limit($this->page_size)
			->asArray()
			->all( );

		$data = [];

		if( $list ){

			foreach( $list as $_item ){
				$data[] = [
					'id' => $_item['id'],
					'sn' => date("YmdHi",strtotime( $_item['created_time'] ) ).$_item['id'],
					'pay_price' => $_item['pay_price'],
					'pay_time' => date("Y-m-d H:i",strtotime( $_item['pay_time'] ) )
				];
			}
		}

		$total_pay_money = $total_pay_money?$total_pay_money:0;

		return $this->render('account',[
			"pages" => $pages,
			'list' => $data,
			'search_conditions' => [
				'p' => $p,
			],
			'total_pay_money' => sprintf("%.2f",$total_pay_money)
		]);
	}

}
