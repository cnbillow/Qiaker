<?php
$acts=array('index'=>true,'comment'=>true,'zan'=>true,'fav'=>true);
$c=isset($_REQUEST['c'])?trim($_REQUEST['c']):'index';
if(!isset($acts[$c])){
	$c='index';
}

switch($c) {
	case 'index':
		$id=intval($_REQUEST['id']);
		$info=$db->get_One('select * from `main_info` where id='.$id);
		if(empty($info)){
			header('location:/');
		}
		if($_userid>0){
			$old_zan=$db->get_One('select * from `zan_log` where userid='.$_userid.' and infoid='.$id);
			$old_fav=$db->get_One('select * from `fav_log` where userid='.$_userid.' and infoid='.$id);
			$zan_num=$db->findOne('select count(*) from `zan_log` where infoid='.$id);
		}
		$all_zan=$db->getAll('select * from `zan_log` where infoid='.$id.' order by time desc');
		$db->query('update `main_info` set view=view+1 where id='.$id);
		$title=$info['title'].' - 恰客';
		$user=$db->get_One('select * from `ucenter` where userid='.$info['userid']);
		$tj=$db->findOne('select count(*) from `main_info` where userid='.$info['userid']);
		$comment=$db->getAll('select * from `main_comment` where infoid='.$id.' order by time asc');
		$tj_user=$db->getAll('select count(*) as num,userid from `main_info` group by userid order by num desc limit 12');
		include T('show','show');
		break;
	case 'comment':
		if(empty($_userid)){
			exit('请先登录！');
		}
		$infos=array();
		$infos['infoid']=intval($_POST['infoid']);
		$infos['content']=trim($_POST['content']);
		if(empty($infos['content'])){
			exit('请完善评论内容');
		}
		$infos['userid']=intval($_userid);
		$infos['time']=TIME;
        $db->insert('main_comment',$infos);
		exit('ok');
		break;
	case 'zan':
		if(empty($_userid)){
			exit('请先登录！');
		}
		$infos=array();
		$infos['infoid']=intval($_POST['infoid']);
		$infos['userid']=$_userid;
		$infos['time']=TIME;
		$db->insert('`zan_log`',$infos);
		$db->query('update `main_info` set zan=zan+1 where id='.$infos['infoid']);
		exit('ok');
		break;
	case 'fav':
		if(empty($_userid)){
			exit('请先登录！');
		}
		$infos=array();
		$infos['infoid']=intval($_POST['infoid']);
		$infos['userid']=$_userid;
		$infos['time']=TIME;
		$db->insert('`fav_log`',$infos);
		exit('ok');
		break;
}