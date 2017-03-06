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

    public function actionInfo(){
		$id = intval( $this->get("id", 0) );
		$reback_url = UrlService::buildWebUrl("/book/index");
		if( !$id ){
			return $this->redirect( $reback_url );
		}

		$info = Book::find()->where([ 'id' => $id ])->one();
		if( !$info ){
			return $this->redirect( $reback_url );
		}

		return $this->render("info",[
			"info" => $info
		]);
	}

	public function actionSet(){
		if( \Yii::$app->request->isGet ) {
			$id = intval( $this->get("id", 0) );
			$info = [];
			if( $id ){
				$info = Book::find()->where([ 'id' => $id ])->one();
			}

			$cat_list = BookCat::find()->orderBy([ 'id' => SORT_DESC ])->all();
			return $this->render('set',[
				'cat_list' => $cat_list,
				'info' => $info
			]);
		}

		$id = intval( $this->post("id",0) );
		$cat_id = intval( $this->post("cat_id",0) );
		$name = trim( $this->post("name","") );
		$price = floatval( $this->post("price",0) );
		$main_image = trim( $this->post("main_image","") );
		$summary = trim( $this->post("summary","") );
		$unit = intval( $this->post("unit",0) );
		$tags = trim( $this->post("tags","") );
		$date_now = date("Y-m-d H:i:s");

		if( !$cat_id ){
			return $this->renderJSON([],"请输入图书分类~~",-1);
		}

		if( mb_strlen( $name,"utf-8" ) < 1 ){
			return $this->renderJSON([],"请输入符合规范的图书名称~~",-1);
		}

		if( $price <= 0  ){
			return $this->renderJSON([],"请输入符合规范的图书售卖价格~~",-1);
		}

		if( mb_strlen( $main_image ,"utf-8") < 3 ){
			return $this->renderJSON([],"请上传封面图~~",-1);
		}

		if( mb_strlen( $summary,"utf-8" ) < 10 ){
			return $this->renderJSON([],"请输入图书描述，并不能少于10个字符~~",-1);
		}

		if( $unit < 1 ){
			return $this->renderJSON([],"请输入符合规范的库存量~~",-1);
		}

		if( mb_strlen( $tags,"utf-8" ) < 1 ){
			return $this->renderJSON([],"请输入图书标签，便于搜索~~",-1);
		}


		$info = [];
		if( $id ){
			$info = Book::findOne(['id' => $id]);
		}
		if( $info ){
			$model_book = $info;
		}else{
			$model_book = new Book();
			$model_book->status = 1;
			$model_book->created_time = $date_now;
		}

		$model_book->cat_id = $cat_id;
		$model_book->name = $name;
		$model_book->price = $price;
		$model_book->main_image = $main_image;
		$model_book->summary = $summary;
		$model_book->unit = $unit;
		$model_book->tags = $tags;
		$model_book->updated_time = $date_now;
		$model_book->save( 0 );
		return $this->renderJSON([],"操作成功~~");
	}

	public function actionOps(){
		if( !\Yii::$app->request->isPost ){
			return $this->renderJSON( [],ConstantService::$default_syserror,-1 );
		}

		$id = $this->post('id',[]);
		$act = trim($this->post('act',''));
		if( !$id ){
			return $this->renderJSON([],"请选择要操作的账号~~",-1);
		}

		if( !in_array( $act,['remove','recover' ])){
			return $this->renderJSON([],"操作有误，请重试~~",-1);
		}

		$info = Book::find()->where([ 'id' => $id ])->one();
		if( !$info ){
			return $this->renderJSON([],"指定书籍不存在~~",-1);
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

	public function actionCat(){
		$status = intval( $this->get("status",ConstantService::$status_default ) );
		$query = BookCat::find();

		if( $status > ConstantService::$status_default ){
			$query->where([ 'status' => $status ]);
		}

		$list = $query->orderBy([ 'weight' => SORT_DESC ,'id' => SORT_DESC ])->all( );

		return $this->render('cat',[
			'list' => $list,
			'status_mapping' => ConstantService::$status_mapping,
			'search_conditions' => [
				'status' => $status
			]
		]);
	}

	public function actionCat_set(){
		if( \Yii::$app->request->isGet ){
			$id = intval( $this->get("id",0) );
			$info = [];
			if( $id ){
				$info = BookCat::find()->where([ 'id' => $id ])->one();
			}

			return $this->render("cat_set",[
				'info' => $info
			]);
		}

		$id = intval( $this->post("id",0) );
		$weight = intval( $this->post("weight",1) );
		$name = trim( $this->post("name","") );
		$date_now = date("Y-m-d H:i:s");

		if( mb_strlen( $name,"utf-8" ) < 1 ){
			return $this->renderJSON( [] , "请输入符合规范的分类名称~~" ,-1);
		}

		$has_in = BookCat::find()->where([ 'name' => $name ])->andWhere([ '!=','id',$id ])->count();
		if( $has_in ){
			return $this->renderJSON( [] , "该分类名称已存在，请换一个试试~~" ,-1);
		}

		$cat_info = BookCat::find()->where([ 'id' => $id ])->one();
		if( $cat_info ){
			$model_book_cat = $cat_info;
		}else{
			$model_book_cat = new BookCat();
			$model_book_cat->created_time = $date_now;
		}

		$model_book_cat->name = $name;
		$model_book_cat->weight = $weight;
		$model_book_cat->updated_time = $date_now;
		$model_book_cat->save( 0 );

		return $this->renderJSON( [],"操作成功~~" );
	}

	public function actionCat_ops(){
		if( !\Yii::$app->request->isPost ){
			return $this->renderJSON( [],ConstantService::$default_syserror,-1 );
		}

		$id = $this->post('id',[]);
		$act = trim($this->post('act',''));
		if( !$id ){
			return $this->renderJSON([],"请选择要操作的账号~~",-1);
		}

		if( !in_array( $act,['remove','recover' ])){
			return $this->renderJSON([],"操作有误，请重试~~",-1);
		}

		$info = BookCat::find()->where([ 'id' => $id ])->one();
		if( !$info ){
			return $this->renderJSON([],"指定分类不存在~~",-1);
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

	public function actionImages(){
		$p = intval( $this->get("p",1) );
		$p = ( $p > 0 )?$p:1;

		$bucket = "book";
		$query = Images::find()->where([ 'bucket' => $bucket ]);

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
			foreach ( $list as $_item ){
				$data[] = [
					'url' => UrlService::buildPicUrl( $bucket,$_item['file_key'] )
				];
			}
		}
		return $this->render("images",[
			'list' => $data,
			'pages' => $pages
		]);
	}

}