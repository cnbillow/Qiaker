<?php
$acts=array('index'=>true,'cancel'=>true,'tj'=>true,'unfav'=>true);
$c=isset($_REQUEST['c'])?trim($_REQUEST['c']):'index';
if(!isset($acts[$c])){
	$c='index';
}
$title='我的推荐 - 恰客';
switch($c) {
	case 'index':
		$page=isset($_GET['page'])?intval($_GET['page']):1;
		$page=max(1,$page);
		$offset=10;
		$start=($page-1)*$offset;
		$nums=$db->get_one('select count(*) as num from `main_info` where userid='.$_userid);
		$list=$db->getAll('select * from `main_info` where userid='.$_userid.' order by time desc');
		$fav_list=$db->getAll('select * from `fav_log` where userid='.$_userid.' order by time desc');
		$fav_num=$db->get_one('select count(*) as num from `fav_log` where userid='.$_userid);
		$pagestr=pages_z($nums['num'], $page, $offset);
		include T('admin','news_list');
		break;
	case 'cancel':
		$id=intval($_REQUEST['id']);
		$db->query('update `main_info` set status=0 where id='.$id);
		exit('ok');
		break;
	case 'unfav':
		$id=intval($_REQUEST['id']);
		$db->query('update `fav_log` set userid=-'.$_userid.' where id='.$id);
		exit('ok');
		break;
	case 'tj':
		$id=intval($_REQUEST['id']);
		$db->query('update `main_info` set status=1 where id='.$id);
		exit('ok');
		break;
}