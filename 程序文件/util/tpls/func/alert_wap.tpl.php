<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>消息提醒</title>
	<meta name="Author" content="Zero">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta content="telephone=no" name="format-detection" />
	<meta name="generator" content="bd-mobcard">
	<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<link href="/touch-icon.png" rel="apple-touch-icon-precomposed" />
	<link rel="apple-touch-startup-image" href="/touch-icon.png" />
	<link rel="apple-touch-icon" href="/touch-icon.png"/>
	<meta http-equiv="refresh" content="0; url=<?=$url?>" />
</head>
<body>
<script type="text/javascript" src="/static/js/jquery.artDialog.js?skin=aero"></script>
<script type="text/javascript">
<?php if(!empty($msg)){?>
	window.parent.art.dialog.tips("<?=$msg?>");
<?php }?>
</script>
</body>
</html>