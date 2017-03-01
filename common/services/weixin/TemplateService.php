<?php

namespace common\service\weixin;

use app\common\services\UrlService;
use app\common\services\weixin\RequestService;
use app\models\oauth\OauthMemberBind;
use \app\models\pay\PayOrder;
use Yii;


class TemplateService
{
    /**
     * 支付提醒
     */
    public static function payNotice( $pay_order_id ){

        $pay_order_info =PayOrder::findOne( $pay_order_id );

        if( !$pay_order_info ){
            return false;
        }

		$config = \Yii::$app->params['weixin'];
		RequestService::setConfig( $config['appid'],$config['token'],$config['sk'] );

        $open_id = self::getOpenId( $pay_order_info['member_id'] );
        if(!$open_id){
            return false;
        }

		$template_id = "1671PUYF8cEzG30EvyhGZZzpYcyp97cf0BFMWdwmKzY";
        $pay_money = $pay_order_info["pay_price"];

        $data = [
            "first" => [
                "value" => "您已成功支付{$pay_money}元",
                "color" => "#173177"
            ],
			"keyword1" =>[
				"value" => substr( $pay_order_info['order_sn'],0,8),
				"color" => "#173177"
			],
            "keyword2" =>[
                "value" => $pay_order_info['note'],
                "color" => "#173177"
            ],
            "keyword3" =>[
                "value" => date("Y-m-d H:i",strtotime( $pay_order_info['pay_time'] ) ),
                "color" => "#173177"
            ],
            "remark" => [
                "value" => "感谢您的支持",
                "color" => "#173177"
            ]
        ];

        return self::send($open_id,$template_id,UrlService::buildMUrl("/"),$data);
    }



    /**
     * 获取微信公众平台的微信公众号id
     */
    protected static function getOpenId( $member_id ){
        $open_infos = OauthMemberBind::findAll([ 'member_id' => $member_id,'type' => 3 ]);

        if( !$open_infos ){
            return false;
        }

        foreach($open_infos as $open_info){
            if( self::getPublicByOpenId($open_info['openid']) ) {
                return $open_info['openid'];
            }
        }
        return false;
    }

    public  static function send($openid,$template_id,$url,$data){
        $msg = [
            "touser" => $openid,
            "template_id" => $template_id,
            "url" => $url,
            "data" => $data
        ];

        $token = RequestService::getAccessToken();
        return RequestService::send("message/template/send?access_token=".$token,json_encode( $msg ),'POST');
    }

    private static $maxredirs = 0;

    protected static function getPublicByOpenId($openid){
        $token = RequestService::getAccessToken();
        $ret = RequestService::send("user/info?access_token={$token}&openid={$openid}&lang=zh_CN","GET");
        if( !$ret ){
            self::$maxredirs++;
            if(self::$maxredirs <= 3){
                return self::getPublicByOpenId($openid);
            }
        }

		$info = $ret;

        if(!$info || isset($info['errcode']) ){
            return false;
        }

        if($info['subscribe']){
            return true;
        }
        return false;
    }
}

