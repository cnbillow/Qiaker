<?php include T('show','header');?>
<div class="main layui-clear">
    <div class="wrap">
		<div class="bdsharebuttonbox">
		<a href="#" class="bds_tsina1 bds_ico" data-cmd="tsina" title="分享到新浪微博"></a>
		<a href="#" class="bds_weixin1 bds_ico" data-cmd="weixin" title="分享到微信"></a>
		<a href="#" class="bds_qzone1 bds_ico" style="border-bottom: 0px" data-cmd="qzone" title="分享到QQ空间"></a>
		<a href="#cmt" class="bds_pin bds_ico2" style="margin-top: 30px;border-bottom: 0px">评论</a>
		</div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
        <div class="content detail">
            <div class="fly-panel detail-box">
                <h1><?=$info['title']?></h1>
                <div class="fly-tip fly-detail-hint">
                    <div class="fly-list-hint">
                        <a href="#comment"><i class="iconfont icon-icon3zanpinglunzhuanfaliulan01"></i> <?=$info['zan']?></a>
                        <i class="iconfont icon-liulan"></i> <?=$info['view']?>
						<?php if($_userid==$info['userid']){?>
						<a href="/send.html?c=edit&id=<?=$id?>"><i class="layui-icon">&#xe642;</i>  编辑</a>
						<?php }?>
					</div>
				</div>
				<div style="clear:both"></div>
				<div class="detail-about">
                    <a class="jie-user" href="/user/<?=$info['userid']?>.html">
                        <img src="<?=$user['face']?$user['face']:'/static/images/avater.png';?>" alt="">
                        <cite><?=$user['username']?><em><?=date('Y年m月d日',$info['time'])?></em></cite>
                    </a>
                    <div class="detail-hits" data-id="{{rows.id}}">
                        <span>共推荐过 <i style="color:#FF7200"><?=$tj?></i> 次产品</span>
                    </div>
					
                </div>
                <div class="detail-body">
                    <p><?=$info['dsp']?></p>
                </div>
				<div class="detail-body" >
                    <?=$info['content']?>
                </div>
				<div class="p-content" >
					<?php if(empty($old_zan)){?>
					<a onclick="zan(<?=$id?>)" class="layui-btn layui-btn-normal"><i class="iconfont icon-icon3zanpinglunzhuanfaliulan01"></i></a>
					<?php }else{?>
					<a class="layui-btn layui-btn-normal" disabled><i class="iconfont icon-icon3zanpinglunzhuanfaliulan01"></i>  已赞</a>
					<?php }?>
					<?php if(empty($old_fav)){?>
					<a onclick="fav(<?=$id?>)" class="layui-btn layui-btn-warm"><i class="layui-icon">&#xe600;</i> 收藏</a>
					<?php }else{?>
					<a class="layui-btn layui-btn-warm"><i class="layui-icon">&#xe60c;</i> 已收藏</a>
					<?php }?>
					<?php if(!empty($info['url'])){?>
					<a href="/url.html?id=<?=$id?>" target="_blank" class="layui-btn"><i class="layui-icon">&#xe64c;</i>  链接</a><?php }?><br/><br/>
				</div>
				<fieldset class="layui-elem-field layui-field-title site-title">
					<legend><a name="get"><?=$zan_num?$zan_num:0;?>人觉得很赞</a></legend>
				</fieldset>
				<div class="zan_user">
<?php foreach($all_zan as $k=>$v) {
$this_user=$db->get_One('select * from `ucenter` where userid ='.$v['userid']);
?>
					<a href="/user/<?=$v['userid']?>.html" title="<?=$this_user['username']?>">
						<div class="zan_avater">
							<img src="<?=$this_user['face']?$this_user['face']:'/static/images/avater.png';?>" alt="<?=$this_user['username']?>" />
						</div>
						<span><?=$this_user['username']?></span>
					</a>
<?php }?>
				</div>
			</div>
			<a id="cmt"></a>
            <div class="fly-panel">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- 自适应仅图片 -->
				<ins class="adsbygoogle"
					 style="display:block"
					 data-ad-client="ca-pub-3138559351412474"
					 data-ad-slot="7857671329"
					 data-ad-format="auto"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
            </div>
            <div class="fly-panel">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- 自适应仅图片 -->
				<ins class="adsbygoogle"
					 style="display:block"
					 data-ad-client="ca-pub-3138559351412474"
					 data-ad-slot="7857671329"
					 data-ad-format="auto"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
            </div>
			<div class="fly-panel detail-box" style="padding-top: 10px;">
				<ul class="jieda photos" id="jieda">
<?php if(!empty($comment)){foreach($comment as $k=>$v) {
$who=$db->get_One('select * from `ucenter` where userid='.$v['userid']);
?>
					<li>
						<div class="detail-about detail-about-reply">
							<a class="jie-user" href="">
								<img src="<?=$who['face']?$who['face']:'/static/images/avater.png';?>" alt="<?=$who['username']?>" layer-index="0">
								<cite><i><?=$who['username']?></i></cite>
							</a>
							<div class="detail-hits"><span><?=date('Y-m-d H:i',$v['time'])?></span></div>
						</div>
						<div class="detail-body jieda-body">
							<?=$v['content']?>
						</div>
					</li>
<?php }}else{?>
					<li class="fly-none">没有任何回复</li>
<?php }?>
				</ul>
				<div class="layui-form layui-form-pane">
					<form method="post">
						<input type="hidden" name="c" value="comment"/>
						<input type="hidden" name="infoid" value="<?=$id?>">
						<div class="layui-form-item layui-form-text">
							<div class="layui-input-block">
								<textarea id="L_content" name="content"></textarea>
							</div>
						</div>
						<div class="layui-form-item">
							<a class="layui-btn" id="sendbtn" lay-filter="cmt" lay-submit>发布评论</a>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>
    <div class="edge">
		<div class="fly-panel leifeng-rank">      
			<h3 class="fly-panel-title">推荐榜 - TOP 12</h3>      
			<dl> 
<?php foreach($tj_user as $k=>$v) {
$this_user=$db->get_One('select * from `ucenter` where userid ='.$v['userid']);
?>
				<dd>          
					<a href="/user/<?=$v['userid']?>.html">            
						<img src="<?=$this_user['face']?$this_user['face']:'/static/images/avater.png';?>">            
						<cite><?=$this_user['username']?></cite>            
						<i><?=$v['num']?>次推荐</i>          
					</a>       
				</dd> 
<?php }?>
			</dl>    
		</div>
        <div class="fly-panel">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- 336 -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:336px;height:280px"
				 data-ad-client="ca-pub-3138559351412474"
				 data-ad-slot="3025517326"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
        </div>
        <div class="fly-panel">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- 336 -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:336px;height:280px"
				 data-ad-client="ca-pub-3138559351412474"
				 data-ad-slot="3025517326"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
        </div>
		<!--<div class="fly-panel fly-hezuo">      
			<div style="height: 90px; line-height: 90px; text-align: center; background-color: #fff; color: #ccc; font-size: 16px; font-weight: 300; white-space: nowrap;">边栏广告位，联系QQ：290805404</div>    
		</div>-->
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
	var txt = layedit.build('L_content',{
		height: 150,
		//tool: [ 'strong', 'italic', 'underline','del', '|','face','link', '|','left', 'center', 'right']
	});
	$('#sendbtn').click(function(){
		layedit.sync(txt);	
		form.on('submit(cmt)', function(data){
			$.post('/show.html',data.field,function(res){
				if(res=='ok'){
					layer.msg('发布评论成功！');
					setTimeout(function(){
						window.location.reload();
					},1000)
				}else{
					layer.msg(res);
				}
			});
			return false;
		});
	});
});
function zan(id){
	<?php if(!$_userid){?>
	layer.msg('您还没有登陆哦！');
	return;
	<?php }?>
	$.ajax({
		type:'post',
		url:'/product/<?=$id?>.html?c=zan',
		data:{'infoid':id},
		success:function(r){
			if(r=='ok'){
				layer.msg('感谢支持！');
			}else{
				layer.msg(r);
			}
			setTimeout(function(){window.location.reload(true);},1200);
		}
	});
}

function fav(id){
	<?php if(!$_userid){?>
	layer.msg('您还没有登陆哦！');
	return;
	<?php }?>
	$.ajax({
		type:'post',
		url:'/product/<?=$id?>.html?c=fav',
		data:{'infoid':id},
		success:function(r){
			if(r=='ok'){
				layer.msg('收藏成功！');
			}else{
				layer.msg(r);
			}
			setTimeout(function(){window.location.reload(true);},1200);
		}
	});
}
</script>
<?php include T('show','footer');?>