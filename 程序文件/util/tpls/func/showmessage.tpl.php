<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="cache-control" content="no-cache">
<title>提示信息</title>
	<script type="text/javascript">
	function url_go(){
<?php if($url_forward=='goback'){?>
		window.history.go(-1);
<?php }else{?>
		window.location.href='<?=$url_forward?>';
<?php }?>
	}
	document.onkeydown = function(e){
		e = e ? e : window.event;
		var keyCode = e.which ? e.which : e.keyCode;
		if(keyCode == 13){
			url_go();
		}
	}
	</script>
	<style type="text/css">
		body,ul,ol,li,form{margin:0;padding:0;-webkit-text-size-adjust:none}
		ul,ol{list-style:none}
		img{border:0}
		body{font-family:'Microsoft Yahei','Simsun',Arial;height:100%;font-size:14px;line-height:1.5;color:#252525;position:relative;}
		div,p,a,table,td,textarea,form,input,img,ul,li,dl,dt,dd,h1,h2,h3,h4{margin:0;padding:0;font-size:100%;font-weight:normal;-webkit-tap-highlight-color:transparent}
		a{color:#252525;cursor:pointer;text-decoration:none;-webkit-tap-highlight-color:rgba(0,0,0,0)}
		#msg_o{width:80%;max-width:400px;min-height:0;overflow:hidden;padding:6px;margin:0 auto;margin-top:20%;border: 1px solid #eee;background-color:#eee;border-radius: 7px;-webkit-border-radius: 7px;}
		#msg_o table{width:100%;min-height:0;overflow:hidden;background-color:#E9F3FC;border: 1px solid #A6C8E4;}
		#msg_o table p{font-size:14px;height:26px;line-height:26px;color:#666}
		#msg_o table tr td{background-color:#fff}
		#msg_box{min-height:0;overflow:hidden;padding:10px;font-size:14px;font-weight:bolder;line-height:25px;color:#fe4701;border:1px solid #c4c4c4}
		#msg_sure{width:80px;height:24px;font-weight:bolder;color:#fff;overflow:hidden;background-color: #0A8CEE;border: 1px solid #0162A7;border-radius:2px;-webkit-border-radius:2px;}
	</style>
</head>
<body>
<div id="msg_o">
	<table cellpadding="0" cellspacing="4">
		<tr>
			<th align="left"><p>温馨提示:</p></th><th align="right"><p>7192.com</p></th>
		</tr>
		<tr>
			<td colspan="2"><div id="msg_box"><?=$msg?></div></td>
		</tr>
		<tr>
			<th colspan="2">
			<input id="msg_sure" type="button" value="确定" onclick="url_go()" />
			<script type="text/javascript" language="javascript">setTimeout(function(){url_go();},3500);</script> 
			</th>
		</tr>
	</table>
</div>
</body>
</html>