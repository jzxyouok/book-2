<?php
namespace app\common\services;


class ConstantService {
	public static $client_type_mapping = [
		0 => '',
		1 => 'weixin',
		2 => 'qq',
		3 => 'weibo'
	];

	public static $client_type_wechat = 1;

	public static $default_avatar = 'default_avatar';
	public static $default_password = '******';
	public static $default_time_stamps = '0000-00-00 00:00:00';
	public static $default_syserror = '系统繁忙，请稍后再试~~';

	public static $low_password = [
		"000000","111111","11111111","112233","123123","123321","123456","12345678","654321","666666","888888","abcdef","abcabc","abc123","a1b2c3","aaa111","123qwe","qwerty","qweasd","admin","password","p@ssword","passwd","iloveyou","5201314"
	];


	public static $status_default = -1;
	public static $status_mapping = [
		1 => '正常',
		0 => '已删除'
	];

}