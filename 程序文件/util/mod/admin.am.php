<?php

$white_mod = array(
    'index'=>1,
	'cate'=>1,
	'news'=>1,
	'system'=>1,
	'work'=>1,
	'friend'=>1,
	'ads'=>1,
	'upfile'=>1,
	'banner'=>1,
	'up'=>1,
	'upface'=>1
);

$uc=$db->get_One('select * from `ucenter` where userid='.$_userid);
$a=isset($_REQUEST['a']) ? trim($_REQUEST['a']) : 'index';
if(!$_userid&&$a!='up'){
	header('location:/login.html');
}
if(isset($white_mod[$a])){
	include M($m, $a);
}