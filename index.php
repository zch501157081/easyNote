<?php 
	
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

	// 检测PHP环境

	if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
	//设定编辑模式
	header("content-type:text/html;charset=utf-8");
	define('APP_DEBUG',true);
	//define('APP_DEBUG',false);
	
	// 定义应用目录
	define('APP_PATH','./Application/');

	

	include('./ThinkPHP/ThinkPHP.php');

 ?>