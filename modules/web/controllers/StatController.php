<?php

namespace app\modules\web\controllers;

use app\common\services\UrlService;
use app\common\services\UtilService;
use app\models\stat\StatDailySite;
use app\modules\web\controllers\common\BaseController;

class StatController extends BaseController{

    public function actionIndex(){
		$date_from = $this->get("date_from",date("Y-m-d",strtotime("-30 days") ) );
		$date_to = $this->get("date_to",date("Y-m-d" ) );
		$p = intval( $this->get("p",1) );
		$p = ( $p > 0 )?$p:1;


		$query = StatDailySite::find();
		$query->where([ '>=','date',$date_from ]);
		$query->andWhere([ '<=','date',$date_to ]);

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

        return $this->render("index",[
			"pages" => $pages,
			'list' => $list,
			'search_conditions' => [
				'date_from' => $date_from,
				'date_to' => $date_to,
				'p' => $p,
			],
		]);
    }

}
