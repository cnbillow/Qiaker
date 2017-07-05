<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>消息提醒</title>
	<meta name="Author" content="Zero">
</head>
<body>
<script type="text/javascript">
<?php if(!empty($msg)){?>
	window.parent.art.dialog.alert("<?=$msg?>");
<?php }?>
   window.location.href="<?=$url?>";
</script>
</body>
</html>