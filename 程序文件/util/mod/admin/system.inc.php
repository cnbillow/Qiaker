<?php
$acts=array('index'=>true,'save'=>true,'savepass'=>true);
$c=isset($_REQUEST['c'])?trim($_REQUEST['c']):'index';
if(!isset($acts[$c])){
	$c='index';
}
$title='基本设置 - 恰客';
switch($c) {
	case 'index':
		include T('admin','system');
		break;
	case 'save':
		$infos=array();
		$infos['email'] = $_POST['email'];
		$infos['sex'] = $_POST['sex'];
		$infos['signature'] = $_POST['signature'];
		$db->update('`ucenter`',$infos,'userid='.$_userid);
		exit('ok');
		break;
	case 'savepass':
		$pass=$_POST['pass'];
		$repass=$_POST['repass'];
		if(empty($pass)||empty($repass)){
			exit('密码不能为空！');
		}
		if($pass!=$repass){
			exit('两次密码输入不一致！');
		}
		$newpass=MD5($pass);
        $db->query("update `ucenter` set password='$newpass' where userid='$_userid'");
		exit('ok');
		break;
}