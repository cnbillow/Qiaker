<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>文件上传</title>
	<style type="text/css">
	/* CSS Document */
	body{margin:0;padding:0;font:12px Arial,Times New Roman,"\5B8B\4F53",san-serif;width:96px;height:96px;overflow:hidden;background:#ddd;}
	div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,hr,pre,form,fieldset,input,textarea,blockquote,p,object{padding:0;margin:0}
	#select-area{width:96px;height:96px;overflow:hidden;position:relative;z-index:1}
	#select-area label{display:block;width:60px;height:60px;padding:18px;overflow:hidden;text-align:center;color:#fff;font-size:18px;line-height:30px;letter-spacing:5px;font-weight:bold;font-family:'微软雅黑';}
	#path {border:1px solid #cacaca;width:174px;height:28px;line-height:28px;position:relative;z-index:-1}
	input{float:left;}
	#filter{width:100%;height:36px;background:url('/static/img/func/file_loading.gif') no-repeat center -27px #F1F1F1;position:absolute;top:50%;margin-top:-20px;left:0;display:none;z-index:99}
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
	<div style="position:relative">
		<div id="select-area">
			<label for="path">上传<br/>图片</label>
			<div class="preview"></div>
		</div>
		<form id="aa" method="post" enctype="multipart/form-data" style="width:0;height:0;overflow:hidden;position:absolute;z-index:-1">
			<input name="file" id="path" type="file" accept="image/jpeg" size="15" onchange="doCheck()" style="filter:alpha(opacity=0);-moz-opacity:0;opacity:0;" />
			<input type="hidden" name="w" value="<?=$w?>" />
			<input type="hidden" name="h" value="<?=$h?>" />
            <input type="hidden" name="wid" value="<?=$_SESSION['wid']?>" />
			<input type="hidden" name="d" value="save" />
			<input type="hidden" name="dosubmit" value="test_ad_upload" />
		</form>
	</div>
	<div id="filter"></div>
</body>
</html>