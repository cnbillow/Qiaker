<?php include T('show','header');?> 
<div class="main layui-clear">
	<div class="wrap">
		<div class="content">
			<div class="fly-tab fly-tab-index">        
				<span>
					<a><i class="layui-icon">&#xe637;</i> <?=$date?> <?=$week?></a>
					<a href="<?php if($_userid){?>/?m=admin&a=news<?php }else{?>/login.html<?php }?>"><i class="iconfont icon-wode"></i> 我的推荐</a>
				</span>      
				<a href="<?php if($_userid){?>/send.html<?php }else{?>/login.html<?php }?>" class="layui-btn jie-add"><i class="layui-icon">&#xe609;</i> 我要分享</a>      
			</div>
<?php if(!empty($today_post)&&$page==1){?>
			<ul class="fly-panel fly-list fly-list-top"> 
			<?php foreach($today_post as $k=>$v) {
$user=$db->get_One('select * from `ucenter` where userid='.$v['userid']);
?>
				<li class="fly-list-li">
					<a href="/user/<?=$v['userid']?>.html" class="fly-list-avatar"><img src="<?=$user['face']?$user['face']:'/static/images/avater.png';?>" alt="头像"></a>
					<h2 class="fly-tip">
						<a href="/product/<?=$v['id']?>.html"><?=$v['title']?></a>
						<a href="/url.html?id=<?=$v['id']?>" target="_blank" style="float:right"><i class="iconfont icon-qitayingyongdakai-copy"></i></a>
					</h2>
					<p>
						<span><a href="/user/<?=$v['userid']?>.html" target="_blank"><?=$user['username']?$user['username']:'匿名网友';?></a></span>
						<span><?=date('Y-m-d',$v['time'])?></span>
						<span class="fly-list-hint" style="float:right"><i class="iconfont icon-icon3zanpinglunzhuanfaliulan01"></i> <?=$v['zan']?> <i class="iconfont icon-liulan"></i> <?=$v['view']?></span>
					</p>
				</li>
<?php }?>
			</ul>
<?php }?>
			<ul class="fly-panel fly-list fly-list-top">
<?php foreach($list as $k=>$v) {
$user=$db->get_One('select * from `ucenter` where userid='.$v['userid']);
?>
				<li class="fly-list-li">
					<a href="/user/<?=$v['userid']?>.html" class="fly-list-avatar"><img src="<?=$user['face']?$user['face']:'/static/images/avater.png';?>" alt="头像"></a>
					<h2 class="fly-tip">
						<a href="/product/<?=$v['id']?>.html"><?=$v['title']?></a>
						<a href="/url.html?id=<?=$v['id']?>" target="_blank" style="float:right"><i class="iconfont icon-qitayingyongdakai-copy"></i></a>
					</h2>
					<p>
						<span><a href="/user/<?=$v['userid']?>.html" target="_blank"><?=$user['username']?$user['username']:'匿名网友';?></a></span>
						<span><?=date('Y-m-d',$v['time'])?></span>
						<span class="fly-list-hint" style="float:right"><i class="iconfont icon-icon3zanpinglunzhuanfaliulan01"></i> <?=$v['zan']?> <i class="iconfont icon-liulan"></i> <?=$v['view']?></span>
					</p>
				</li>
<?php }?>
			</ul>
			<!--<div class="bb_sense">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<ins class="adsbygoogle"
					 style="display:block"
					 data-ad-client="ca-pub-3138559351412474"
					 data-ad-slot="7857671329"
					 data-ad-format="auto"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>-->
			<div style="text-align: center;"> 
				<div class="laypage-main"><?=$pagestr?></div>
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
        <div class="fly-panel fly-link">      
			<h3 class="fly-panel-title">友情链接</h3>      
			<dl>
				<dd><a href="http://fly.layui.com/case/2017/" target="_blank">layui</a></dd>
				<dd><a href="http://blog.qiaker.cn/" target="_blank">千里草</a></dd>
				<dd><a href="http://app.qiaker.cn/" target="_blank">微信小程序</a></dd>
				<dd><a href="http://www.xiaoduotech.com/" target="_blank">晓多智能客服</a></dd>
			</dl>    
		</div>
    </div>
</div> 
<?php include T('show','footer');?>