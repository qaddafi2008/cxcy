<?php
return array(
	//'配置项'=>'配置值'
	'APP_GROUP_LIST'=>'Home,Admin',
	'DEFAULT_GROUP'	=>'Home',
	'URL_CASE_INSENSITIVE' => true,//不区分大小写
	'DB_TYPE'		=>	'mysql',		
	'DB_HOST'		=>	'localhost',
	'DB_NAME'		=>	'pkucxcy',
	'DB_USER'		=>	'pkuss',
	'DB_PWD'		=>	'pkuss',
	'DB_PREFIX'		=>	'',	
	'DB_CHARSET'	=>	'utf8',
	'ROUTER_ON'		=>	true,
	'APP_DEBUG'     =>  true,
	'SHOW_PAGE_TRACE' => false, // 显示页面Trace 信息
	'TOKEN_ON'      =>  false,
	'USER_AUTH_KEY' =>  'aid'
		//'USER_AUTH_GATEWAY'	=>'/Public/Login',
    	//'DEFAULT_MODULE' => 'Public',
		//'DEFAULT_ACTION' => 'Login'
	//TMPL_PARSE_STRING =>array( )
);
?>