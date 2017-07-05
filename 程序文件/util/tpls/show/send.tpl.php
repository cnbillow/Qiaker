<?php include T('show','header');?>  
<div class="main layui-clear">
	<div class="fly-panel" pad20 style="margin-top: 20px;">
		<div class="layui-form">
			<div class="layui-tab layui-tab-brief" lay-filter="user">
				<ul class="layui-tab-title">
					<li class="layui-this">推荐产品</li>
				</ul>
				<div class="layui-form layui-tab-content" style="padding: 20px 0;">
					<div class="layui-tab-item layui-show">
						<form method="post">
							<input type="hidden" name="c" value="save"/>
							<input type="hidden" name="id" value="<?=$id?>"/>
							<div class="layui-form-item">
								<label for="L_title" class="layui-form-label">标题</label>
								<div class="layui-input-block">
									<input type="text" name="title" required lay-verify="required"  placeholder="请填写标题" autocomplete="off" class="layui-input" value="<?=$info['title']?>">
								</div>
							</div>
							<div class="layui-form-item layui-form-text">
								<label class="layui-form-label">描述</label>
								<div class="layui-input-block">
									<textarea name="dsp" required lay-verify="required" placeholder="请简要描述下此产品" class="layui-textarea fly-editor" style="height: 50px;"><?=$info['dsp']?></textarea>
								</div>
							</div>
							<div class="layui-form-item">
								<label for="L_title" class="layui-form-label">链接</label>
								<div class="layui-input-block">
									<input type="text" name="url" required lay-verify="required" placeholder="请填写链接"  autocomplete="off" class="layui-input" value="<?=$info['url']?>">
								</div>
							</div>
							<div class="layui-form-item layui-form-text">
								<label class="layui-form-label">详情</label>
								<div class="layui-input-block">
									<textarea name="content" id="chk_content"><?=$info['content']?></textarea>
								</div>
							</div>
							<div class="layui-form-item">
								<div class="layui-input-block">
									<a class="layui-btn" id="sendbtn" lay-submit lay-filter="send">立即提交</a>
									<button type="reset" class="layui-btn layui-btn-primary">重置</button>
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
$('#sendbtn').click(function(){
	layedit.sync(txt);
	form.on('submit(send)', function(data){	
		$.post('/send.html',data.field,function(res){
			console.log(data.field);
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
})	
	
});
</script>
<?php include T('show','footer');?>