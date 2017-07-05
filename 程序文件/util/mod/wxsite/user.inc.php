<?php
$acts=array('index'=>true,'save'=>true);
$c=isset($_REQUEST['c'])?trim($_REQUEST['c']):'index';
if(!isset($acts[$c])){
	$c='index';
}
$uid=intval($_REQUEST['uid']);
$user=$db->get_One('select * from `ucenter` where userid='.$uid);
$title=$user['username'].'的主页 - 恰客';
switch($c) {
	case 'index':
		$log=$db->getAll('select * from	`main_info` where userid='.$uid.' order by time desc');
		include T('show','user');
		break;
}