<?php
$acts=array('index'=>true,'save'=>true);
$c=isset($_REQUEST['c'])?trim($_REQUEST['c']):'index';
if(!isset($acts[$c])){
	$c='index';
}
$title='我的主页 - 恰客';
switch($c) {
	case 'index':
		$log=$db->getAll('select * from	`main_info` where userid='.$_userid.' order by time desc');
		include T('admin','index');
		break;
}