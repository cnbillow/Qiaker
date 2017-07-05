<ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
	<li class="layui-nav-item">
		<a href="/?m=admin"><i class="layui-icon">&#xe609;</i>我的主页</a>
	</li>
	<li class="layui-nav-item <?=$a=='news'?'layui-this':'';?>">
		<a href="/?m=admin&a=news"><i class="layui-icon">&#xe612;</i>我的推荐</a>
	</li>
	<li class="layui-nav-item <?=$a=='system'?'layui-this':'';?>">
		<a href="/?m=admin&a=system"><i class="layui-icon">&#xe620;</i>基本设置</a>
	</li>
</ul>