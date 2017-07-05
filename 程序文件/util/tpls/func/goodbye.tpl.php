<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="cache-control" content="no-cache">
	<title>Say Goodbye To IE</title>
	<meta name="Author" content="Zero">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=2.0,user-scalable=yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta content="telephone=no" name="format-detection" />
	<meta name="generator" content="bd-mobcard">
	<script type="text/javascript" src="/static/js/j.js"></script>
	<style type="text/css">
		body,ul,ol,li,form{margin:0;padding:0;-webkit-text-size-adjust:none}
		ul,ol{list-style:none}
		img{border:0}
		body{font-family:'Microsoft Yahei','Simsun',Arial;height:100%;font-size:14px;line-height:1.5;color:#252525;position:relative;}
		div,p,a,table,td,textarea,form,input,img,ul,li,dl,dt,dd,h1,h2,h3,h4{margin:0;padding:0;font-size:100%;font-weight:normal;-webkit-tap-highlight-color:transparent}
		a{color:#252525;cursor:pointer;text-decoration:none;-webkit-tap-highlight-color:rgba(0,0,0,0)}
		h3{width:600px;height:50px;font:bolder 30px/50px '微软雅黑';color:#222;margin:0 auto;margin-top:100px;text-align:center}
		#mask{position:absolute;z-index:1000;top:0;left:0;display:none;background:#666}
		#note_tips{width:620px;height:420px;overflow:hiddem;background:#fff;position:absolute;top:130px;left:50%;margin-left:-300px;border:10px solid #CCC;color:#000;z-index:1001;display:none}
		#note_tips table{width:100%;height:50px;overflow:hidden;background-color:#4380DD;}
		#note_tips table tr td h1{font-size:20px;color:#fff;}
		#note_tips table tr th span{color:#fff;cursor:pointer;background-color:#BD1314;display:inline-block;width:24px;height:24px;text-align:center;line-height:24px;}
		#infomations{padding:25px 0 25px 70px;}
		#note_tips h2{height:32px;font:bolder 20px/30px '微软雅黑','Arial'}
		#note_tips p{padding:10px 0;font-size:14px;line-height:24px;}
		#note_tips p a{color:#000;display:inline-block;width:100px;height:40px;padding:5px 0 5px 46px;overflow:hidden;margin-right:10px;border:1px solid #ccc;font-size:12px;line-height:20px;background:url('/static/img/admin/ie_icon.jpg') no-repeat}
		#note_tips p strong{color:#36f}
		#note_tips p a.ie_01{background-position:5px -115px;}
		#note_tips p a.ie_02{background-position:5px -55px;}
		#note_tips p a.ie_03{background-position:5px 5px;}
		#note_tips p a span{color:#1879A3;}
		#close_btn{width:120px;height:30px;overflow:hidden;background:#4989E3;border:1px solid #3F78C9;color:#fff;font-size:14px;font-weight:bolder;cursor:pointer}
	</style>
</head>
<body>
<div id="mask"></div>
<div id="note_tips">
	<table cellspacing="10px">
		<tr>
			<td><h1>提示</h1></td>
			<th align="right"><span onclick="close_warn()">X</span></th>
		</tr>
	</table>
	<div id="infomations">
		<h2>抱歉，请不要使用您现在的浏览器来管理。</h2>
		<p>微网站是在手机上展示的，如果您希望获得跟手机一样的浏览效果，<br /> 
		我们建议<strong>升级</strong>您的浏览器或者切换您的浏览器到<strong>极速</strong>核心</p>
		<p>在下侧查找我们支持的浏览器的最新版本.</p>
		<button id="close_btn" onclick="close_warn()">不，继续浏览</button>
		<p><b>获得最新的受支持浏览器</b><br /><br />
		<a href="http://chrome.360.cn/" title="360极速浏览器下载页面" class="ie_01"><span>360极速浏览器</span><br />所有者:360</a>
		<a href="http://firefox.com.cn/" title="Firefox下载页面" class="ie_02"><span>Firefox</span><br />所有者:Mozilla</a>
		<a href="https://www.google.com/intl/zh-CN/chrome/browser/" title="Chrome下载页面" class="ie_03"><span>Chrome</span><br />所有者:Google</a>
		</p>
	</div>
</div>
<script type="text/javascript">
	//if (typeof(Worker) == "undefined") {
		$('#mask').css('opacity','0.5').css('height',$(document.body).height()+'px').css('width',$(document.body).width()+'px').show();
		$('#note_tips').show();
	//}
	function close_warn(){
		$('#note_tips,#mask').hide();
	}
</script>
</body>
</html>