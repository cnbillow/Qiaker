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
<link rel="stylesheet" href="//at.alicdn.com/t/font_2tr0slv8oqdxi529.css">
</head>
<body class="fly-full">

<div class="main layui-clear">
	<div class="fly-panel" pad20 style="padding-top: 5px;">
		<div class="layui-form">
			<div class="layui-tab layui-tab-brief" lay-filter="user">
				<ul class="layui-tab-title">
					<li class="layui-this">手机号码找回</li>
					<li>邮箱找回</li>
				</ul>
				<div class="layui-form layui-tab-content" style="padding: 20px 0;">
					<div class="layui-tab-item layui-show">
						<form method="post">
							<input type="hidden" name="c" value="save"/>
							<div class="layui-form-item">
								<label for="L_title" class="layui-form-label">手机号</label>
								<div class="layui-input-inline">
									<input type="text" id="phone" required lay-verify="required" autocomplete="off" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<label for="L_vercode" class="layui-form-label">人类验证</label>
								<div class="layui-input-inline">
									<input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
								</div>
								<div class="layui-form-mid">
									<span style="color: #c00;">a和c之间的字母是？</span>
								</div>
							</div>
							<div class="layui-form-item">
								<label for="L_title" class="layui-form-label">填写验证码</label>
								<div class="layui-input-inline">
									<input type="text" name="title" required lay-verify="required" autocomplete="off" class="layui-input">
								</div>
								<div class="layui-input-inline">
									<input type="button" class="layui-btn" onclick="get_tel()" value="获取验证码">
								</div>
							</div>
							<div class="layui-form-item">
								<div class="layui-input-block">
									<a class="layui-btn" lay-submit lay-filter="fromtel">立即提交</a>
								</div>
							</div>
						</form>
					</div>
					<div class="layui-tab-item">
						<form method="post">
							<input type="hidden" name="c" value="save"/>
							<div class="layui-form-item">
								<label for="L_title" class="layui-form-label">电子邮箱</label>
								<div class="layui-input-inline">
									<input type="text" name="title" required lay-verify="required" autocomplete="off" class="layui-input">
								</div>
								<div class="layui-input-inline">
									<a class="layui-btn">获取验证码</a>
								</div>
							</div>
							<div class="layui-form-item">
								<label for="L_title" class="layui-form-label">填写验证码</label>
								<div class="layui-input-inline">
									<input type="text" name="title" required lay-verify="required" autocomplete="off" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item">
								<div class="layui-input-block">
									<a class="layui-btn" lay-submit lay-filter="fromemail">立即提交</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

var wait=60;
function time(o) {
	if (wait == 0) {
		o.removeAttribute("disabled");
		o.value="获取动态码";
		wait = 60;
	} else {
		o.setAttribute("disabled", true);
		o.value="重新发送(" + wait + ")";
		wait--;
		setTimeout(function() {
			time(o)
		}, 1000)
	}
}

function get_tel(){
	var phone = $('#phone').val();
	$.ajax({
		type: 'post',
		url: "/getpwd.html?c=save",
		data: {'phone': phone},
		success: function (result) {
			
			alert(result);
		}
	});
}

layui.use(['form','layedit','upload'], function(){
	var form = layui.form();
	layedit = layui.layedit;
	layedit.set({
		uploadImage: {
			url: '/?m=admin&a=up' //接口url
			,type: 'post' //默认post
		}
	});
	var txt = layedit.build('chk_content',{
		height: 280,
		//tool: ['strong', 'italic', 'underline','del', '|','left', 'center', 'right']
	});
	
	form.on('submit(send)', function(data){
		layedit.sync(txt);
		$.post('/send.html',data.field,function(res){
			if(res=='ok'){
				layer.msg('发布成功,审核成功！');
				setTimeout(function(){
					window.location.href="/";
				},1000)
			}else{
				layer.msg(res);
			}
		});
		return false;
	});
});
</script>


<script type="text/javascript">
layui.use(['layer', 'jquery'],function() {
	var layer = layui.layer,
	jq = layui.jquery;
})
layui.use('element',function() {
	var element = layui.element();
});
</script>
</body>
</html>