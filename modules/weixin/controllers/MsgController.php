<?php
namespace app\modules\weixin\controllers;

use app\common\services\weixin\MsgCryptService;

class MsgController extends BaseController{

    public function actionIndex( ){
		if( !$this->checkSignature() ){
			return 'error signature ~~';
		}

		if( array_key_exists('echostr',$_GET) && $_GET['echostr']){//用于微信第一次认证的
			return $_GET['echostr'];
		}

		//因为很多都设置了register_globals禁止,不能用$GLOBALS["HTTP_RAW_POST_DATA"];
		$xml_data = file_get_contents("php://input");
		$this->record_log( "[xml_data]:". $xml_data );
		if( !$xml_data ){
			return 'error xml ~~';
		}

		$msg_signature = trim( $this->get("msg_signature","") );
		$timestamp = trim( $this->get("timestamp","") );
		$nonce = trim( $this->get("nonce","") );

		$config = \Yii::$app->params['weixin'];
		$target = new MsgCryptService( $config['token'], $config['aeskey'], $config['appid']);
		$err_code = $target->decryptMsg($msg_signature, $timestamp, $nonce, $xml_data, $decode_xml);
		if ( $err_code != 0) {
			return 'error decode ~~';
		}

		$this->record_log( '[decode_xml]:'.$decode_xml );

		$xml_obj = simplexml_load_string($decode_xml, 'SimpleXMLElement', LIBXML_NOCDATA);
		$from_username = $xml_obj->FromUserName;
		$to_username = $xml_obj->ToUserName;
		$msg_type = $xml_obj->MsgType;
		$content = $xml_obj->Content;
		$reply_time = time();

		$plain_data = $this->textTpl($from_username,$to_username,"接口正在开发中",$reply_time );
		$encrypt_msg = '';
		$err_code = $target->encryptMsg($plain_data, $reply_time, $nonce,$encrypt_msg);
		if ( $err_code != 0) {
			return 'error encode ~~';
		}
		return $encrypt_msg;
    }


    private function textTpl( $from_username,$to_username,$content,$time ){
		$textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[%s]]></MsgType>
        <Content><![CDATA[%s]]></Content>
        <FuncFlag>0</FuncFlag>
        </xml>";
		return sprintf($textTpl, $from_username, $to_username, $time, "text", $content );
	}

}
