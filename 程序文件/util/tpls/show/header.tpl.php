<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
<meta name="renderer" content="webkit">
<title><?=$title?></title>
<meta name="keywords" content="<?=$keywords?>">
<meta name="description" content="<?=$dsp?>">
<link rel="stylesheet" href="/layui/css/layui.css">
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="/layui/layui.js" type="text/javascript"></script>
<link rel="stylesheet" href="/static/css/global.css?t=<?=TIME?>">
<link rel="stylesheet" href="//at.alicdn.com/t/font_lzvmmwrz77gb9.css">
<style>
.header{border-bottom: 1px solid #404553; border-right: 1px solid #404553;}
</style>
<link href='http://cdn.webfont.youziku.com/webfonts/nomal/26113/46870/5949ed34f629da05445d3daf.css' rel='stylesheet' type='text/css' />
<body class="fly-full">
<div class="header">
	<div class="main">
		<a class="logo cssb6defdeb66601" href="/" title="恰客">恰客 <span class="site_des">发现Today的好产品！</span></a>
<?php if(empty($_userid)){?>
		<div class="nav-user">
			<a class="unlogin" href="/login.html"><i class="iconfont icon-touxiang" style="font-size: 22px;"></i></a>
			<span><a href="/login.html">登陆</a><a href="/reg.html">注册</a></span>
			<p class="out-login">        
				<a href="/qqlogin.html" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-qq" title="QQ登入"></a>      
			</p>
		</div>
<?php }else{?>
		<div class="nav-user">            
			<a class="avatar" href="/?m=admin">                
				<img src="<?=$uc['face']?$uc['face']:'/static/images/avater.png';?>">
				<cite><?=$_username?></cite>              
			</a>      
			<div class="nav">        
				<a href="/?m=admin&a=system"><i class="iconfont icon-shezhi" style="font-size: 22px;"></i>设置</a>        
				<a href="/logout.html"><i class="iconfont icon-logout" style="font-size: 22px;"></i>退出</a>      
			</div>          
		</div>
<?php }?>
	</div>
</div>
  