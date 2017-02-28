<?php

namespace common\service\applog;


use common\models\applog\AppLog;
use common\service\CommonService;
use Yii;

class ApplogService {

    public static function add($appname,$content){

        $error = Yii::$app->errorHandler->exception;

        $model_app_logs = new AppLog();
        $model_app_logs->app_name = $appname;
        $model_app_logs->content = $content;


        $model_app_logs->ip = CommonService::getIP();

        if(!empty($_SERVER['HTTP_USER_AGENT'])) {
            $model_app_logs ->ua = "[UA:{$_SERVER['HTTP_USER_AGENT']}]";
        }

        if ($error) {

            if(method_exists($error,'getName' )) {
                $model_app_logs->err_name = $error->getName();
            }

            if (isset($error->statusCode)) {
                $model_app_logs->http_code = $error->statusCode;
            }

            $model_app_logs->err_code = $error->getCode();
        }

        $model_app_logs->created_time = date("Y-m-d H:i:s");
        $model_app_logs->save(0);
    }
} 