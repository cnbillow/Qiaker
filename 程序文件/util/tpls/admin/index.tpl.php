<?php include T('show','header');?>
<div class="fly-home" style="background-image: url();">
	<img src="<?=$uc['face']?$uc['face']:'/static/images/avater.png';?>" alt="<?=$_username?>">
	<h1><?=$_username?> <i class="iconfont icon-<?=$uc['sex']=='男'?'nan':'nv';?>"></i></h1>
	<p class="fly-home-info">
		<i class="iconfont icon-shijian"></i>
		<span><?=date('Y-m-d',$uc['regtime'])?> 加入</span></p>
	<p class="fly-home-sign">（<?=$uc['signature']?$uc['signature']:'这个人很懒~~';?>）</p></div>
<div class="main fly-home-main">
	<div class="layui-inline fly-home-jie">
		<div class="fly-panel">
			<h3 class="fly-panel-title"><?=$_username?> 最近的推荐</h3>
<?php if(empty($log)){?>
			<p style="text-align:center;line-height:50px">您还没有推荐过内容哦</p>
<?php }else{?>
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
<?php }?>
		</div>
	</div>
</div>
<?php include T('show','footer');?>