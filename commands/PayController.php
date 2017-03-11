<?php

namespace app\commands;

use app\common\services\book\BookService;
use app\models\book\Book;
use app\models\pay\PayOrder;
use app\models\pay\PayOrderItem;
use Yii;


/*关于金额的处理*/
class PayController extends BaseController {

    /*
     * 库存处理
     * 释放30分钟前的订单
     * php yii pay/product_stock
     * */
    public function actionProduct_stock(){
        $before_half_date = date("Y-m-d H:i:s",time() - 30 * 60 );
        $before_half_order_list = PayOrder::find()
            ->where( ['target_type' => 1 ,'status' => -8 ] )
            ->andWhere( ['<=',"created_time",$before_half_date] )
            ->all();

        if( !$before_half_date ){
            return $this->echoLog("no data");
        }

        $date_now = date("Y-m-d H:i:s");
        foreach( $before_half_order_list as $_order_info ){
            $tmp_pay_order_items = PayOrderItem::findAll( [ 'pay_order_id' => $_order_info["id"] ] );
            $this->echoLog("order_id:{$_order_info["id"]}");

            if( $tmp_pay_order_items ){
                foreach( $tmp_pay_order_items as $_order_item_info ){

                	$tmp_book_info = Book::find()->where([ 'id' => $_order_item_info['target_id'] ])->one();
                	if( $tmp_book_info ){
						$tmp_book_info->stock += $_order_item_info['quantity'];
						$tmp_book_info->updated_time = $date_now;
						$tmp_book_info->update( 0 );
						BookService::setStockChangeLog( $_order_item_info['target_id'],$_order_item_info['quantity'],"订单过期释放库存" );
					}

                }
            }

            $_order_info->status = 0;
            $_order_info->updated_time = date("Y-m-d H:i:s");
            $_order_info->update(0);
        }

        return $this->echoLog("it's over ~~");
    }

}
