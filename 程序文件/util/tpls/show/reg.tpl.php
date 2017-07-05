<?php include T('show','header');?>  
<div class="main layui-clear">
	<div class="fly-panel fly-panel-user" pad20>
		<div class="layui-tab layui-tab-brief" lay-filter="user">
			<ul class="layui-tab-title">
				<li><a href="/login.html">登入</a></li>
				<li class="layui-this">注册</li>
			</ul>
			<div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
				<div class="layui-tab-item layui-show">
					<div class="layui-form layui-form-pane">
					<form method="post">
						<input type="hidden" name="c" value="reg"/>
						<div class="layui-form-item">
							<label for="L_username" class="layui-form-label">用户名</label>
							<div class="layui-input-inline">
								<input type="text" id="L_username" name="username" required lay-verify="required" autocomplete="off" class="layui-input">
							</div>
							<div class="layui-form-mid layui-word-aux">将会成为您唯一的登入名</div>
						</div>
						<div class="layui-form-item">
							<label for="L_email" class="layui-form-label">邮箱</label>
							<div class="layui-input-inline">
								<input type="text" id="L_email" name="email" required lay-verify="email" autocomplete="off" class="layui-input">
							</div>
							<div class="layui-form-mid layui-word-aux">用于找回密码</div>
						</div>
						<div class="layui-form-item">
							<label for="L_pass" class="layui-form-label">密码</label>
							<div class="layui-input-inline">
								<input type="password" id="L_pass" name="pass" required lay-verify="required" autocomplete="off" class="layui-input">
							</div>
							<div class="layui-form-mid layui-word-aux">6到16个字符</div>
						</div>
						<div class="layui-form-item">
							<label for="L_repass" class="layui-form-label">确认密码</label>
							<div class="layui-input-inline">
								<input type="password" id="L_repass" name="repass" required lay-verify="required" autocomplete="off" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<a class="layui-btn" lay-filter="reg" lay-submit>立即注册</a>
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
	form.on('submit(reg)', function(data){
	$.post('/reg.html',data.field,function(res){
		if(res=='ok'){
			layer.msg('注册成功，马上登录吧！');
			setTimeout(function(){
				window.location.href="/login.html";
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