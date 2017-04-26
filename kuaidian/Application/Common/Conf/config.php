<?php
return array(
	//'配置项'=>'配置值'
	/* 数据库设置 */
	'DB_TYPE'               =>  'mysql',     // 数据库类型
	'DB_HOST'               =>  'localhost', // 服务器地址
	'DB_NAME'               =>  'kuaidian',          // 数据库名
	'DB_USER'               =>  'root',      // 用户名
	'DB_PWD'                =>  'abc123',          // 密码
	'DB_PORT'               =>  '3306',        // 端口
	'DB_PREFIX'             =>  'kuaidian_',    // 数据库表前缀
	'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
	
	/****************MD5用来复杂化的*******************/
	'MD5_KEY'   => 'afda#@90#_1465$gfhgnv!123',
		
	/************图片相关配置****************/
	'IMG_maxSize'    =>     '3M',  // 保存根路径
	'IMG_exts'          =>     array('jpg', 'gif', 'png', 'jpeg','bmp'),  // 设置附件上传类型
	'IMG_URL'          => '/Public/Uploads/',
	'IMG_rootPath'   =>     './Public/Uploads/',  // 设置附件上传根目录
		
);