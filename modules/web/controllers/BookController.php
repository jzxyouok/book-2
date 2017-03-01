<?php

namespace app\modules\web\controllers;

use app\common\services\ConstantService;
use app\models\book\BookCat;
use app\modules\web\controllers\common\BaseController;

class BookController extends BaseController{

    public function actionIndex(){
        return $this->render('index');
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


	public function actionSet(){
		return $this->render('set');
	}
}
