<?php
/*
新结构目录
/util/						php目录
	/util/core/			基础程序类库
	/util/mod/			基础模型
	/util/action/			ajax等模型外应用
	/util/tpls/			相关模板文件
/static/					静态目录
	/static/css/			静态css
	/static/img/			相关img
	/static/js/			相关js
	/static/plugin/		插件应用

/logs/						日志目录

/web.config				服务器配置文件
/favicon.ico				ico文件

*/

define('WXSITE',true);
//初始化当前的绝对路径
define('ROOT_PATH',str_replace('\\', '/', dirname(__FILE__)).'/');
include(ROOT_PATH.'/util/origin.inc.php');