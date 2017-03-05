<?php

namespace app\modules\m\controllers;
use app\common\services\ConstantService;
use app\common\services\DataHelper;
use app\common\services\PayOrderService;
use app\common\services\UrlService;
use app\common\services\UtilService;
use app\models\book\Book;
use app\models\member\Fav;
use app\models\member\MemberCart;
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
		$id = intval( $this->get("id",0) );
		$reback_url = UrlService::buildMUrl("/product/index");
		if( !$id ){
			return $this->redirect( $reback_url );
		}

		$info = Book::findOne([ 'id' => $id ]);
		if( !$info ){
			return $this->redirect( $reback_url );
		}

		$has_faved = false;
		if(  $this->current_user ){
			$has_faved = Fav::find()->where([ 'member_id' => $this->current_user['id'],'book_id' => $id ])->count();
		}


		return $this->render("info",[
			'info' => $info,
			'has_faved' => $has_faved
		]);
	}

	public function actionCart(){
		if( \Yii::$app->request->isGet ){
			$list = MemberCart::find()->where([ 'member_id' => $this->current_user['id'] ])->orderBy([ 'id' => SORT_DESC ])->all();
			$data = [];
			if( $list ){
				$book_mapping = DataHelper::getDicByRelateID( $list ,Book::className(),"book_id","id",[ 'name','price','main_image','unit' ] );
				foreach( $list as $_item ){
					$tmp_book_info = $book_mapping[ $_item['book_id'] ];
					$data[] = [
						'id' => $_item['id'],
						'quantity' => $_item['quantity'],
						'book_id' => $_item['book_id'],
						'book_price' => $tmp_book_info['price'],
						'book_unit' => $tmp_book_info['unit'],
						'book_name' => UtilService::encode( $tmp_book_info['name'] ),
						'book_main_image' => UrlService::buildPicUrl( "book",$tmp_book_info['main_image'] )
					];
				}
			}
			return $this->render("cart",[
				'list' => $data
			]);
		}

		$act = trim( $this->post("act","") );
		$id = intval( $this->post("id",0) );
		$book_id = intval( $this->post("book_id",0) );
		$quantity = intval( $this->post("quantity",0) );
		$date_now = date("Y-m-d H:i:s");

		if( !in_array( $act,[ "del","set" ] ) ){
			return $this->renderJSON( [],ConstantService::$default_syserror,-1 );
		}

		if( $act == "del" ){
			$cart_info = MemberCart::find()->where([ 'member_id' => $this->current_user['id'],'id' => $id ])->one();
			if( $cart_info ){
				$cart_info->delete();
			}
			return $this->renderJSON( [],"操作成功~~" );
		}


		if( !$book_id || !$quantity ){
			return $this->renderJSON( [],ConstantService::$default_syserror,-1 );
		}

		$book_info = Book::findOne([ 'id' => $book_id ]);
		if( !$book_info ){
			return $this->renderJSON( [],ConstantService::$default_syserror,-1 );
		}

		$cart_info = MemberCart::find()->where([ 'member_id' => $this->current_user['id'],'book_id' => $book_id ])->one();
		if( $cart_info  ){
			$model_cart = $cart_info;
		}else{
			$model_cart = new MemberCart();
			$model_cart->member_id = $this->current_user['id'];
			$model_cart->created_time = $date_now;
		}

		$model_cart->book_id = $book_id;
		$model_cart->quantity = $quantity;
		$model_cart->updated_time = $date_now;
		$model_cart->save ( 0 );

		return $this->renderJSON( [],"操作成功~~" );
	}

	public function actionFav(){
		$book_id = intval( $this->post("book_id",0) );
		if( !$book_id ){
			return $this->renderJSON( [],ConstantService::$default_syserror,-1 );
		}

		$has_faved = Fav::find()->where([ 'member_id' => $this->current_user['id'],'book_id' => $book_id ])->count();
		if( $has_faved ){
			return $this->renderJSON( [],"已收藏~~",-1 );
		}

		$model_fav = new Fav();
		$model_fav->member_id = $this->current_user['id'];
		$model_fav->book_id = $book_id;
		$model_fav->created_time = date("Y-m-d H:i:s");
		$model_fav->save( 0 );
		return $this->renderJSON( [],"操作成功~~" );
	}

	public function actionOrder(){
		if( \Yii::$app->request->isGet ){
			$book_id = intval( $this->get("id",0) );
			$quantity = intval( $this->get("quantity",1) );
			$pay_order_id = intval( $this->get("pay_order_id",0) );
			$product_list = [];
			$total_pay_money = 0;
			if( $book_id ){
				$book_info = Book::find()->where([ 'id' => $book_id ])->one();
				if( $book_info ){
					$product_list[] = [
						'id' => $book_info['id'],
						'name' => UtilService::encode( $book_info['name'] ),
						'quantity' => $quantity,
						'price' => $book_info['price'],
						'main_image' =>  UrlService::buildPicUrl( "book",$book_info['main_image'])
					];
					$total_pay_money += $book_info['price'];
				}
			}else{//从购物车中获取商品信息
				$cart_list = MemberCart::find()->where([ 'member_id' => $this->current_user['id'] ])->all();
				if( $cart_list ){
					$book_mapping = DataHelper::getDicByRelateID( $cart_list ,Book::className(),"book_id","id",[ 'name','price','main_image','unit' ] );
					foreach( $cart_list as $_item ){
						$tmp_book_info = $book_mapping[ $_item['book_id'] ];
						$product_list[] = [
							'id' => $tmp_book_info['id'],
							'name' => UtilService::encode( $tmp_book_info['name'] ),
							'quantity' => $_item['quantity'],
							'price' => $tmp_book_info['price'],
							'main_image' => UrlService::buildPicUrl( "book",$tmp_book_info['main_image'] )
						];
						$total_pay_money += $tmp_book_info['price'];
					}
				}
			}

			return $this->render("order",[
				'product_list' => $product_list,
				'total_pay_money' => sprintf("%.2f",$total_pay_money)
			]);
		}

		$product_items = $this->post("product_items",[]);
		if( !$product_items ){
			return $this->renderJSON([],"请选择商品之后在提交~~",-1);
		}

		$book_ids = [];
		foreach( $product_items as $_item ) {
			$tmp_item_info = explode("#", $_item);
			$book_ids = $tmp_item_info[ 0 ];
		}

		$book_mapping = Book::find()->where([ 'id' => $book_ids ])->indexBy("id")->all();
		if( !$book_mapping ){
			return $this->renderJSON([],"请选择商品之后在提交~~",-1);
		}



		$target_type = 1;
		$items = [];
		foreach( $product_items as $_item ){
			$tmp_item_info = explode("#",$_item);
			$tmp_book_info = $book_mapping[ $tmp_item_info[0] ];
			$items[] = [
				'price' => $tmp_book_info['price'] * $tmp_item_info[1],
				'quantity' => $tmp_item_info[1],
				'target_type' => $target_type,
				'target_id' => $tmp_item_info[0]
			];
		}


		$params = [
			'pay_type' => 1,
			'pay_source' => 2,
			'target_type' => $target_type,
			'note' => '购买商品',
			'status' => -8
		];


		$ret = PayOrderService::createPayOrder( $this->current_user['id'],$items,$params );

		if( !$ret ){
			return $this->renderJSON([],"提交失败，请重新提交".PayOrderService::getLastErrorMsg(),-1 );
		}

		return $this->renderJSON([ 'url' => UrlService::buildMUrl("/pay/buy",[ 'pay_order_id' => $ret['id'] ]) ],'下单成功,前去支付~~' );
	}
}