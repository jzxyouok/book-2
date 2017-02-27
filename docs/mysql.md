数据库变更
=============================

## schema

    CREATE TABLE `user` (
      `uid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '登录用户名',
      `mobile` varchar(20) NOT NULL COMMENT '手机号码',
      `email` varchar(100) NOT NULL COMMENT '邮箱',
      `sex` tinyint(4) NOT NULL DEFAULT '0' COMMENT '性别 1 男 2 女',
      `avatar` varchar(64) NOT NULL COMMENT '头像key',
      `login_name` varchar(20) NOT NULL DEFAULT '' COMMENT '登录用户名',
      `login_pwd` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
      `login_salt` varchar(32) NOT NULL DEFAULT '' COMMENT '加密随机秘钥',
      `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 有效 0 无效 ',
      `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次更新时间',
      `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间',
      PRIMARY KEY (`uid`),
      UNIQUE KEY `idx_login_name` (`login_name`)
    ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='用户表';