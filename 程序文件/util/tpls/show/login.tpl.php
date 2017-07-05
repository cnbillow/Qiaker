<?php include T('show','header');?>  
<div class="main layui-clear">
	<div class="fly-panel fly-panel-user" pad20>
		<div class="layui-tab layui-tab-brief" lay-filter="user">
			<ul class="layui-tab-title">
				<li class="layui-this">登入</li>
				<li><a href="/reg.html">注册</a></li>
			</ul>
			<div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
				<div class="layui-tab-item layui-show">
					<div class="layui-form layui-form-pane">
					<form method="post">
						<input type="hidden" name="c" value="login"/>
						<div class="layui-form-item">
							<label for="L_username" class="layui-form-label">用户名</label>
							<div class="layui-input-inline">
								<input type="text" id="L_username" name="username" required lay-verify="username" autocomplete="off" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label for="L_pass" class="layui-form-label">密码</label>
							<div class="layui-input-inline">
								<input type="password" id="L_pass" name="password" required lay-verify="password" autocomplete="off" class="layui-input">
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
							<a class="layui-btn" lay-filter="login" lay-submit>立即登录</a>
							<!--<span style="padding-left:20px;"><a href="/user/forget">忘记密码？</a></span>-->
						</div>
						<div class="layui-form-item fly-form-app">                
							<span>或者使用社交账号登入</span>                
							<a href="/qqlogin.html" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-qq" title="QQ登入"></a>            
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
layui.use('form', function(){
	var form = layui.form();
	form.on('submit(login)', function(data){
	$.post('/login.html',data.field,function(res){
		if(res=='ok'){
			layer.msg('登录成功,进入会员中心！');
			setTimeout(function(){
				window.location.href="/?m=admin";
			},1000)
		}else{
			layer.msg(res);
		}
	});
	return false;
});
form.verify({
  username: function(value, item){ //value：表单的值、item：表单的DOM对象
    if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
      return '用户名不能有特殊字符';
    }
    if(/(^\_)|(\__)|(\_+$)/.test(value)){
      return '用户名首尾不能出现下划线\'_\'';
    }
    if(/^\d+\d+\d$/.test(value)){
      return '用户名不能全为数字';
    }
  }
  
  //我们既支持上述函数式的方式，也支持下述数组的形式
  //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
  ,pass: [
    /^[\S]{6,12}$/
    ,'密码必须6到12位，且不能出现空格'
  ] 
}); 
});  
</script>
<?php include T('show','footer');?>