<?php
return [
	'domain' => [
		'www' => 'http://book.54php.cn',
		'm' => 'http://book.54php.cn/m',
		'web' => 'http://book.54php.cn/web',
		'blog' => "http://www.54php.cn"
	],
	'weixin' => [
		'appid' => 'xxxxx',
		'sk' => 'xxx',
		'token' => 'xxxx',
		'aeskey' => 'xxxx',
		'pay' => [
			'key' => 'xxxx',
			'mch_id' => 'xxxx',
			'notify_url' => [
				'm' => '/pay/callback',
				'web' => '/pay/callback'
			]
		]
	],
];