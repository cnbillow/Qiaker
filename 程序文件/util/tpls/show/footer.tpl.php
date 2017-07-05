<div class="footer">
    <p><a href="http://qiaker.cn/">恰客</a>2017 &copy;<a href="http://qiaker.cn/">qiaker.cn</a> <a>鲁ICP备16031483号</a></p>
	<p>
		<a>本站部分资源来源于网络或会员分享，如有侵权请联系管理员进行删除。QQ：290805404</a>
    </p>
</div>
<!-- go top -->
<script type="text/javascript">
jQuery(document).ready(function($) {
	var offset = 300,
		offset_opacity = 1200,
		scroll_top_duration = 700,
		$back_to_top = $('.go-top');

	$(window).scroll(function() {
		($(this).scrollTop() > offset) ? $back_to_top.addClass('go-is-visible'): $back_to_top.removeClass('go-is-visible go-fade-out');
		if ($(this).scrollTop() > offset_opacity) {
			$back_to_top.addClass('go-fade-out');
		}
	});

	$back_to_top.on('click', function(event) {
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0,
		}, scroll_top_duration);
	});

});
</script>
<a href="#0" class="go-top">Top</a>
<script type="text/javascript">
layui.use(['layer', 'jquery'],function() {
	var layer = layui.layer,
	jq = layui.jquery;
})
layui.use('element',function() {
	var element = layui.element();
});
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?f9ff0e9456febfac352e5c530446a554";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>