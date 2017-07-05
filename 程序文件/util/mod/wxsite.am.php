<?php
//微网展示入口
$mod_arr=array(
	'index'=>true,
	'show'=>true,
	'login'=>true,
	'reg'=>true,
	'send'=>true,
	'logout'=>true,
	'day'=>true,
	'user'=>true,
	'getpwd'=>true,
	'qqlogin'=>true,
	'callback'=>true,
	'url'=>true
);//模块白名单
$this_mod=isset($_REQUEST['mod'])?trim($_REQUEST['mod']):'index';
if(!isset($mod_arr[$this_mod])){
	$this_mod='index';
}

$keywords="智能头条,人工智能,智能硬件,智能机器人,人工智能学习,无人驾驶,无人机,物联网,云计算";
$dsp="恰客网，每天来分享你觉得很赞的产品";
include M($m,$this_mod);
