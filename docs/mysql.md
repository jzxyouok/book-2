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
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表';
    
    CREATE TABLE `brand_setting` (
      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
      `name` varchar(100) NOT NULL DEFAULT '' COMMENT '品牌名称',
      `description` varchar(2000) NOT NULL DEFAULT '' COMMENT '品牌描述',
      `address` varchar(200) NOT NULL DEFAULT '' COMMENT '公司地址',
      `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '联系电话',
      `logo` varchar(200) NOT NULL DEFAULT '' COMMENT 'logo图片',
      `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
      `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间',
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品牌设置表';
    
    CREATE TABLE `brand_images` (
      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
      `image_key` varchar(200) NOT NULL DEFAULT '' COMMENT '图片地址',
      `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间',
      PRIMARY KEY (`id`),
      UNIQUE KEY `idx_image_key` (`image_key`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品牌图片';
    
    CREATE TABLE `member` (
      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
      `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '会员名',
      `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '会员手机号码',
      `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别 1：男 2：女',
      `avatar` varchar(200) NOT NULL DEFAULT '' COMMENT '会员头像',
      `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：有效 0：无效',
      `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
      `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间',
      PRIMARY KEY (`id`),
      UNIQUE KEY `idx_mobile` (`mobile`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表';