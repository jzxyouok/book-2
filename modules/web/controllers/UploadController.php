<?php

namespace app\modules\web\controllers;

use app\common\services\UrlService;
use app\common\services\UtilService;
use app\modules\web\controllers\common\BaseController;
use app\common\services\UploadService;

class UploadController extends BaseController{

    public function actionUeditor(){
		$action = $this->get("action");
		$config_path = UtilService::getRootPath()."/web/plugins/ueditor/upload_config.json";
		$config = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents($config_path) ), true);
		switch( $action ){
			case 'config':
				echo  json_encode($config);
				break;
				/* 上传图片 */
			case 'uploadimage':
				/* 上传涂鸦 */
			case 'uploadscrawl':
				/* 上传视频 */
			case 'uploadvideo':
				/* 上传文件 */
			case 'uploadfile':
				$this->uploadUeditorImage();
				break;
			case 'listimage':
				$this->listUeditorImage();
				break;
		}
    }

	private function uploadUeditorImage(){
		$up_target = $_FILES["upfile"];
		if ( $up_target["error"] > 0 ){
			return $this->retUeditor( "上传失败!error:". $up_target["error"] );
		}

		if( !is_uploaded_file($up_target['tmp_name']) ){
			return $this->retUeditor( "非法上传文件~~" );
		}

		$type = $up_target["type"];
		$filename = $up_target["name"];


		$ret = UploadService::uploadByFile($filename,$up_target['tmp_name']);

		if( !$ret ){
			return $this->retUeditor( UploadService::getLastErrorMsg() );
		}

		if( isset($ret['code']) && $ret['code'] == 205 ){
			return $this->retUeditor( "此图片已经上传过了~~" );
		}

		return $this->retUeditor( "SUCCESS",UrlService::buildWwwUrl( "/uploads/".$ret['path'] ),"ewww");
	}

	private function listUeditorImage(){
		$start = intval( $this->get("start",0) );
		$page_size = intval( $this->get("size",20) );
		$query = Images::find()->where(['bucket' => "pic1"]);
		if( $start ){
			$query->andWhere(['<',"id",$start]);
		}
		$list = $query->orderBy("id desc")->limit($page_size)->all();
		$images = [];
		$last_id = 0;
		if( $list ){
			foreach( $list as $_item){
				$images[] = [
					'url' => GlobalUrlService::buildPic1Static($_item['filepath'],['w' => 600]),
					'mtime' => strtotime( $_item['created_time'] ),
					'width' => 300
				];
				$last_id = $_item['id'];
			}
		}

		header('Content-type: application/json');
		$data = [
			"state" => (count($images)> 0 )?'SUCCESS':'no match file',
			"list" => $images,
			"start" => $last_id,
			"total" => count($images)
		];
		echo  json_encode( $data );
		exit();
	}

	private function retUeditor( $state, $url = '',$title = '',$original = '',$type = '',$size = 0){

		header('Content-type: application/json');
		$data = [
			"state" => $state,
			"url" => $url,
			"title" => $title,
			"original" => $original,
			"type" => $type,
			"size" => $size,
			"width" => 200
		];
		echo  json_encode( $data );
		exit();
	}
}
