<?php
return array(

	'COOKIE_EXPIRE'         =>  0,   	 // Cookie有效期
	'COOKIE_DOMAIN'         =>  '',      // Cookie有效域名
	'COOKIE_PATH'           =>  '/',     // Cookie路径
	'COOKIE_PREFIX'         =>  'MD_',      // Cookie前缀 避免冲突


	'LOG_RECORD'            =>  true,   // 默认不记录日志
	'LOG_TYPE'              =>  'File', // 日志记录类型 默认为文件方式
	'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
	'LOG_EXCEPTION_RECORD'  =>  true,    // 是否记录异常信息日志

	//'配置项'=>'配置值'
	'DEFAULT_AJAX_RETURN'   =>  'JSON',

	'URL_CASE_INSENSITIVE'  =>  false,

	// 'TMPL_EXCEPTION_FILE'	=>	'./Public/404.tpl',
	'ERROR_PAGE'     		=>	'./Public/404.tpl',


	'URL_ROUTER_ON'   		=>  true,
	'URL_HTML_SUFFIX'       =>  'Power_by_deelian',  // URL伪静态后缀设置
	'URL_MODEL'             =>  2, 


	'LOAD_EXT_CONFIG' 		=> 'SYS,DB'  
);