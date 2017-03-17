<?php
$params = yii\helpers\ArrayHelper::merge(
	require(__DIR__ . '/params.php') ,
	require(__DIR__ . '/params-local.php')
);

$db_config = yii\helpers\ArrayHelper::merge(
	require(__DIR__ . '/db.php') ,
	require(__DIR__ . '/db-local.php')
);

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
	"timezone"  =>  "Asia/Shanghai",
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
			'cachePath' => '@runtime/cache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db_config,
		"urlManager" => [
			'scriptUrl' => '',
			'baseUrl' => '',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => false,
			'rules' => [
				'/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
				'/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			]
		],
		'errorHandler' => [
			'class' => 'app\commands\ErrorController'
		],
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
