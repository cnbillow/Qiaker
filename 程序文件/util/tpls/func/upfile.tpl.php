<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>文件上传</title>
	<style type="text/css">
	/* CSS Document */
	body{margin:0;padding:0;font:12px Arial,Times New Roman,"\5B8B\4F53",san-serif}
	div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,hr,pre,form,fieldset,input,textarea,blockquote,p,object{padding:0;margin:0}
	#path {border:1px solid #cacaca;width:174px;height:28px;line-height:28px;}
	input{float:left}
	.btn { border:1px solid #a8c3dd;height:30px;width:80px;cursor:pointer;margin-left:3px;font-weight:bold;font-size:12px;color:#2075c8;background-color:#e7f1ff;}
	#filter{width:100%;height:30px;background:url('/static/img/func/file_loading.gif') no-repeat center -30px #eee;position:absolute;top:0;left:0;display:none}
	</style>
	<script type="text/javascript">
	var $ = function(e){return document.getElementById(e);};
	var $P = function(e){return window.parent.document.getElementById(e);};
	function doCheck(){
		if($('path').value == '') {
			window.top.art.dialog.alert('请选择文件!');
			return false;
		}else{
			document.getElementById('filter').style.display="block";
			document.getElementById('aa').submit();
		}
	}
	</script>
</head>
<body>
	<div >
		<form id="aa" method="post" enctype="multipart/form-data">
			<input name="file" id="path" type="file" size="15" />
			<input type="hidden" name="cp" id="cp" value="2" />
			<input type="hidden" name="w" value="<?=$w?>" />
			<input type="hidden" name="h" value="<?=$h?>" />
			<input type="hidden" name="c" value="save" />
			<input type="hidden" name="dosubmit" value="test_ad_upload" />
			<input type="button" class="btn" value=" 开始上传 " onclick="doCheck()" />
		</form>
	</div>
	<div id="filter"></div>
</body>
</html>