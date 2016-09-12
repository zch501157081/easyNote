<?php
return array(
	//'配置项'=>'配置值'
	"URL_CASE_INSENSITIVE" =>true,//url不区分大小写
	"LOAD_EXT_CONFIG" => 'db',   //额外加载配置文件
	"MD5_PRE" => 'easyNote',  //对md5进行盐值加密值
	'DEFAULT_GROUP' => array('生活杂记','心情随笔','工作笔记'),
	'URL_ROUTER_ON' => true,
	'URL_ROUTE_RULES' => array(
		'login'        => 'Admin/Admin/login',
		'register'		=>'Admin/Admin/register',
		'editAdmin'		=>'Admin/Admin/editAdmin',
		'getAdmin'		=>'Admin/Admin/getAdmin',
		'getGroups'        => 'Admin/Group/getGroups',
		'addGroups'     => 'Admin/Group/addGroups',
		'dropGroup'     => 'Admin/Group/dropGroup',
		'getGroupsCount' =>'Note/Note/getGroupsCount',
		'getNote' =>'Note/Note/getNote',
		'addNote' =>'Note/Note/addNote',
		'dropNote' =>'Note/Note/dropNote',
		'getOpenNote'=>'Note/Note/getOpenNote',
		'upload'  => 'Note/Download/upload',
		
	),

);