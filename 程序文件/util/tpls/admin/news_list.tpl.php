<?php include T('show','header');?>
<div class="main fly-user-main layui-clear">
	<?php include T('admin','left');?>
	<div class="site-tree-mobile layui-hide">
		<i class="layui-icon">&#xe602;</i></div>
	<div class="site-mobile-shade"></div>
	<div class="fly-panel fly-panel-user" pad20>
		<div class="layui-tab layui-tab-brief" lay-filter="user" id="LAY_uc">
			<ul class="layui-tab-title" id="LAY_mine">
				<li data-type="mine-jie" lay-id="index" class="layui-this">我推荐的（<span><?=$nums['num']?></span>）
				</li>
				<li data-type="collection" data-url="/collection/find/" lay-id="collection">我收藏的（<span><?=$fav_num['num']?></span>）
				</li>
			</ul>
			<div class="layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
				<div class="layui-tab-item layui-show">
					<ul class="mine-view jie-row">
					<?php foreach($list as $k=>$v) {?>
						<li>    
							<a class="jie-title" href="/product/<?=$v['id']?>.html" target="_blank"><?=$v['title']?></a> 
							<i><?=date('Y-m-d H:i',$v['time'])?></i>
							<?php if($v['status']==1){?>
							<a class="mine-edit" onclick="cancel(<?=$v['id']?>)">取消推荐</a>
							<?php }else{?>
							<a class="mine-edit" onclick="tj(<?=$v['id']?>)"><i class="layui-icon">&#xe609;</i> 重新推荐</a>
							<?php }?>
							<em><?=$v['view']?>阅/<?=$v['zan']?>赞</em>  
						</li>
					<?php }?>
					</ul>
					<div id="LAY_page"></div>
				</div>
				<div class="layui-tab-item">
					<ul class="mine-view jie-row">
					<?php foreach($fav_list as $k=>$v) {
					$pd=$db->get_One('select * from `main_info` where id='.$v['infoid']);
					?>
						<li>    
							<a class="jie-title" href="/product/<?=$v['infoid']?>.html" target="_blank"><?=$pd['title']?></a> 
							<i><?=date('Y-m-d H:i',$v['time'])?></i>
							<a class="mine-edit" onclick="unfav(<?=$v['id']?>)">取消收藏</a>
							<em><?=$pd['view']?>阅/<?=$pd['zan']?>赞</em>  
						</li>
					<?php }?>
					</ul>
					<div id="LAY_page1"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function cancel(id){
	$.ajax({
		type:'post',
		url:'/?m=admin&a=news&c=cancel',
		data:{'id':id},
		success:function(r){
			if(r=='ok'){
				layer.msg('取消推荐成功！');
			}else{
				layer.msg(r);
			}
			setTimeout(function(){window.location.reload(true);},1200);
		}
	});
}
function unfav(id){
	$.ajax({
		type:'post',
		url:'/?m=admin&a=news&c=unfav',
		data:{'id':id},
		success:function(r){
			if(r=='ok'){
				layer.msg('取消收藏成功！');
			}else{
				layer.msg(r);
			}
			setTimeout(function(){window.location.reload(true);},1200);
		}
	});
}
function tj(id){
	$.ajax({
		type:'post',
		url:'/?m=admin&a=news&c=tj',
		data:{'id':id},
		success:function(r){
			if(r=='ok'){
				layer.msg('推荐成功！');
			}else{
				layer.msg(r);
			}
			setTimeout(function(){window.location.reload(true);},1200);
		}
	});
}
</script>

<?php include T('show','footer');?>