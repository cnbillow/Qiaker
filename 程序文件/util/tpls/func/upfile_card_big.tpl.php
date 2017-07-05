<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>文件上传</title>
	<style type="text/css">
	/* CSS Document */
	body{margin:0;padding:0;font:12px Arial,Times New Roman,"\5B8B\4F53",san-serif;width:170px;height:38px;overflow:hidden;background:url('/static/img/card_bg/bg_file_hh.jpg') no-repeat;}
	div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,hr,pre,form,fieldset,input,textarea,blockquote,p,object{padding:0;margin:0}
	#select-area{width:100%;height:100%;overflow:hidden;position:relative;z-index:1}
	#select-area label{display:block;width:100%;height:100%;overflow:hidden;text-align:center}
	#path {border:1px solid #cacaca;width:174px;height:28px;line-height:28px;position:relative;z-index:-1}
	input{float:left;}
	#filter{width:100%;height:38px;background:url('/static/img/func/file_loading.gif') no-repeat center -30px #F1F1F1;position:absolute;top:0px;left:0;display:none;z-index:99}
	#file_bg_hh{position:relative;width:170px;height:38px;}
	</style>
	<script type="text/javascript">
	var $ = function(e){return document.getElementById(e);};
	var $P = function(e){return window.parent.document.getElementById(e);};
	function doCheck(){
		if($('path').value == '') {
			window.top.art.dialog.tips('请选择文件!');
			return false;
		}else{
			document.getElementById('filter').style.display="block";
			document.getElementById('aa').submit();
		}
	}
	</script>
</head>
<body>
	<div id="file_bg_hh">
		<div id="select-area">
			<label for="path">&nbsp;</label>
			<div class="preview"></div>
		</div>
		<form id="aa" method="post" enctype="multipart/form-data" style="width:0;height:0;overflow:hidden;position:absolute;z-index:-1">
			<input name="file" id="path" type="file" accept="image/jpeg" size="15" onchange="doCheck()" style="filter:alpha(opacity=0);-moz-opacity:0;opacity:0;" />
			<input type="hidden" name="cp" id="cp" value="2" />
			<input type="hidden" name="w" value="<?=$w?>" />
			<input type="hidden" name="h" value="<?=$h?>" />
			<input type="hidden" name="d" value="save" />
			<input type="hidden" name="dosubmit" value="test_ad_upload" />
		</form>
	</div>
	<div id="filter"></div>
</body>
</html>