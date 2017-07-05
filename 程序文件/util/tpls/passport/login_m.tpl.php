<?php include T('wap','header');?>
<style type="text/css">
#container{width:100%;max-width:480px;min-height:0;overflow:hidden;margin:0 auto;}
#reg_content{padding:8px;min-height:0;overflow:hidden;margin:8px}
#reg_page{width:100%;}
#reg_page tr td{height:30px}
#reg_page tr td input.use_inp{float:left;width:100%;height:28px;text-indent:3px;line-height:28px;border:1px solid #A6C8E4;border-radius:4px;-webkit-border-radius:4px;}
#reg_page tr td input#code{width:90px}
#reg_page tr td img{position:relative;float:left;margin:0 2px}
#reg_page tr td a{line-height:30px}
#reg_btn_area{width:72%;max-width:350px;margin:0 auto;margin-top:10px}
#reg_btn_area input{cursor:pointer;height:30px;width:50%;border:1px solid #0062A5;background:#0A8CEE;font-weight:bold;font-size:16px;color:#fff;border-radius:4px;-webkit-border-radius:4px}
.smlink { padding:10px;}
</style>
<div id="container">
<div id="reg_content">
<form action="/wap/loginm.html" method="post">
    <input type="hidden" name="forward" value="<?php echo $forward;?>" />
	<table id="reg_page">
		<tr>
			<td>用户名：<span id="no_un">(请输入用户名)</span></td>
		</tr>
<?php if($msg){?>
    <tr>
        <td><font color="red"><?php echo $msg;?></font></td>
    </tr>
<?php }?>
		<tr>
			<td><input id="un" class="use_inp" type="text" name="username" placeholder="请输入用户名"></td>
		</tr>
		<tr>
			<td>密码：<span id="no_pw">(请输入密码)</span></td>
		</tr>
		<tr>
			<td><input id="pwd" class="use_inp" type="password" name="password" placeholder="请输入密码"></td>
		</tr>
	</table>
	<table id="reg_btn_area">
		<tr>
			<th><input class="log_btn" type="submit" name="dosubmit" value="立 即 登 录"><input type="hidden" name="formhash" value="" /></th>
		</tr>
        <tr>
            <td align="center"><div class="smlink"><a href="#" title="找回密码">忘记密码？</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/wap/reg.html<?php if(!empty($forward)){?>?forward=<?=urlencode($forward)?><?php }?>">立即注册</a></div><td>
        </tr>
	</table>
</form></div>
</div>
<?php include T('wap','footer');?>