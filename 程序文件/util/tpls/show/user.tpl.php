<?php include T('show','header');?>
<div class="fly-home" style="background-image: url();">
	<img src="<?=$user['face']?$user['face']:'/static/images/avater.png';?>" alt="<?=$user['username']?>">
	<h1><?=$user['username']?> <i class="iconfont icon-<?=$user['sex']=='男'?'nan':'nv';?>"></i></h1>
	<p class="fly-home-info">
		<i class="iconfont icon-shijian"></i>
		<span><?=date('Y-m-d',$user['regtime'])?> 加入</span></p>
	<p class="fly-home-sign">（<?=$user['signature']?$user['signature']:'这个人很懒~~';?>）</p></div>
<div class="main fly-home-main">
	<div class="layui-inline fly-home-jie">
		<div class="fly-panel">
			<h3 class="fly-panel-title"><?=$user['username']?> 最近的推荐</h3>
			<ul class="jie-row">
<?php foreach($log as $k=>$v) {?>
				<li>
					<a href="/product/<?=$v['id']?>.html" class="jie-title"><?=$v['title']?></a>
					<i><?=date('Y-m-d',$v['time'])?></i><br>
					<span><?=$v['dsp']?></span>
					<em><?=$v['view']?>阅/<?=$v['zan']?>赞</em>
				</li>
<?php }?>
			</ul>
		</div>
	</div>
</div>
<?php include T('show','footer');?>