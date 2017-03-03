<?php

namespace app\modules\m\controllers;
use app\common\services\UrlService;
use app\common\services\UtilService;
use app\models\book\Book;
use app\modules\m\controllers\common\BaseController;

class ProductController extends BaseController {
	public function actionIndex(){
		$query = Book::find()->where([ 'status' => 1 ]);
		$list = $query->orderBy([ 'id' => SORT_DESC ])->all();
		$data = [];
		if( $list ){
			foreach( $list as $_item ){
				$data[] = [
					'id' => $_item['id'],
					'name' => UtilService::encode( $_item['name'] ),
					'price' => UtilService::encode( $_item['price'] ),
					'main_image_url' => UrlService::buildPicUrl("book",$_item['main_image'] ),
				];
			}
		}
		return $this->render("index",[
			'list' => $data
		]);
	}

	public function actionInfo(){
		return $this->render("info");
	}

	public function actionCart(){
		return $this->render("cart");
	}
}