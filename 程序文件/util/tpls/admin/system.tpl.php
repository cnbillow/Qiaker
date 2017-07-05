<?php include T('show','header');?>
<div class="main fly-user-main layui-clear">
	<?php include T('admin','left');?>
	<div class="site-tree-mobile layui-hide">
		<i class="layui-icon">&#xe602;</i>
	</div>
	<div class="site-mobile-shade"></div>
	<div class="fly-panel fly-panel-user" pad20>
		<div class="layui-tab layui-tab-brief" lay-filter="user">
			<ul class="layui-tab-title" id="LAY_mine">
				<li class="layui-this" lay-id="info">我的资料</li>
				<li lay-id="avatar">头像</li>
				<li lay-id="pass">密码</li>
			</ul>
			<div class="layui-tab-content" style="padding: 20px 0;">
				<div class="layui-form layui-form-pane layui-tab-item layui-show">
					<form method="post">
						<input type="hidden" name="c" value="save"/>
						<div class="layui-form-item">
							<label for="L_email" class="layui-form-label">邮箱</label>
							<div class="layui-input-inline">
								<input type="text" id="L_email" name="email" required lay-verify="email" autocomplete="off" value="<?=$uc['email']?>" class="layui-input">
							</div>
							<!--<div class="layui-form-mid layui-word-aux">如果您在邮箱已激活的情况下，变更了邮箱，需<a href="" style="font-size: 12px; color: #4f99cf;">重新验证邮箱</a>。</div>-->
						</div>
						<div class="layui-form-item">
							<label for="sex" class="layui-form-label">性别</label>
							<div class="layui-input-block">
								<input type="radio" name="sex" value="男" title="男" <?=$uc['sex']=='男'?'checked':'';?>>
								<input type="radio" name="sex" value="女" title="女" <?=$uc['sex']=='女'?'checked':'';?>>
							</div>
						</div>
						<div class="layui-form-item layui-form-text">
							<label for="L_sign" class="layui-form-label">签名</label>
							<div class="layui-input-block">
								<textarea placeholder="随便写些什么刷下存在感" id="L_sign" name="signature" autocomplete="off" class="layui-textarea" style="height: 80px;"><?=$uc['signature']?></textarea>
							</div>
						</div>
						<div class="layui-form-item">
							<a class="layui-btn" key="set-mine" lay-filter="info" lay-submit>确认修改</a>
						</div>
					</form>
				</div>
				<div class="layui-form layui-form-pane layui-tab-item">
					<div class="layui-form-item">
						<div class="avatar-add">
							<p>建议尺寸200*200，支持jpg、png、gif</p>
							<div class="upload-img">
								<input type="file" name="file" id="face" lay-title="上传头像">
							</div>
							<div id="img_sitethumb" style="margin-top:10px">
<?php if(isset($uc['face'])){?>	
								<img src="<?=$uc['face']?>" alt="图片预览" width="150px" />
<?php }?>
							</div>
							<span class="loading"></span>
						</div>
					</div>
				</div>
				<div class="layui-form layui-form-pane layui-tab-item">
					<form method="post">
						<input type="hidden" name="c" value="savepass"/>
						<div class="layui-form-item">
							<label for="L_pass" class="layui-form-label">新密码</label>
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
							<a class="layui-btn" key="set-mine" lay-filter="savepass" lay-submit>确认修改</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
layui.use('form', function(){
	var form = layui.form();
	form.on('submit(info)', function(data){
		$.post('/?m=admin&a=system',data.field,function(res){
			if(res=='ok'){
				layer.msg('基本资料保存成功！');
				setTimeout(function(){
					window.location.href="/?m=admin&a=system";
				},1000)
			}else{
				layer.msg(res);
			}
		});
		return false;
	});
	form.on('submit(savepass)', function(data){
		$.post('/?m=admin&a=system',data.field,function(res){
			if(res=='ok'){
				layer.msg('密码修改成功！');
				setTimeout(function(){
					window.location.href="/?m=admin&a=system";
				},1000)
			}else{
				layer.msg(res);
			}
		});
		return false;
	});
});

layui.use('upload', function(){
	layui.upload({
		url: '/?m=admin&a=upface'
		,elem: '#face' 
		,success: function(res){
			layer.alert(res.msg);
			setTimeout(function(){
				window.location.reload();
			},1000)
		}
	}); 
});
</script>
      
<?php include T('show','footer');?>