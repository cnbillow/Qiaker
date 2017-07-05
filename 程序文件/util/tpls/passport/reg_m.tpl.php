<?php include T('wap','header');?>
<script type="text/javascript">
function checkUsername(e){
	if (e.length<1){
		$('#forusername').html('<font color="red">(请填写用户名)</font>');
		return;
	}
	$.ajax({type : 'post', url : '/wap/ajax.html?do=cu', data : {'u':e},
		success : function(r){
			r = parseInt(r, 10);
			if(r==0){
				$('#forusername').html('<font color="red">(已被注册)</font>');
			}else if(r==1){
				$('#forusername').html('<font color="green">(可以注册)</font>');
			}else if(r==-1){
				$('#forusername').html('<font color="red">(请填写用户名)</font>');
			}else{
				$('#forusername').html('<font color="red">(格式不正确 )</font>');
			}
		}
	});
}
function checkEmail(e){
	if (e.length<1){
		$('#foremail').html('<font color="red">(请填写邮箱)</font>');
		return;
	}
	$.ajax({type : 'post',url : '/wap/ajax.html?do=ce',data : {'e':e},
		success : function(r){
			r = parseInt(r, 10);
			if(r==0){
				$('#foremail').html('<font color="red">(已被注册)</font>');
			}else if(r==1){
				$('#foremail').html('<font color="green">(可以注册)</font>');
			}else{
				$('#foremail').html('<font color="red">(格式不正确)</font>');
			}
		}
	})
}
function checkPWD(e){
    if(!e || e==''){
        $('#forpwd').html('<font color="red">(请填写密码)</font>');
    }else{
        $('#forpwd').html('<font color="green">(正确)</font>');
    }
}
function checkRPWD(e){
    if(!e || e==''){
        $('#forrpwd').html('<font color="red">(请再次输入密码)</font>');
        return;
    }
    var p = $('#pwd').val();
    if(p==''){
        $('#forpwd').html('<font color="red">(请填写密码)</font>');
    }
    if(e!=p){
        $('#forrpwd').html('<font color="red">(两次密码不一致)</font>');
        document.getElementById('rpwd').value='';
    }else{
        $('#forrpwd').html('<font color="green">(正确)</font>');
    }
}
function checkCode(c){
    if(!c || c==''){
        $('#forcode').html('<font color="red">(请输入验证码)</font>');
        return;
    }
	$.ajax({type : 'post',data:{'c':c},url : '/wap/ajax.html?do=cc',
		success : function(r){
			r = parseInt(r, 10);
			if(r==0){
				$('#forcode').html('<font color="red">(验证码错误)</font>');
				return false;
			}else{
				$('#forcode').html('<font color="green">(正确)</font>');
			}
		}
	});
}
function checkForm(){
	var rr = false; 
	var lan = {
		'username_empty':'请填写用户名',
		'username_format':'格式不正确',
		'username_exists':'已被注册',
		'email_empty':'填写电子邮箱',
		'email_format':'格式不正确',
		'email_exists':'已被注册',
		'code_empty':'填写验证码',
		'code_wrong':'验证码错误'
	};
	var u = $('#username').val(),
		p = $('#pwd').val(),
		rp = $('#rpwd').val(),
		e = $('#email').val(),
		c = $('#code').val();
	if(u==''){
		$('#forusername').html('<font color="red">(填写用户名)</font>');
		return false;
	}
	if(e==''){
		$('#foremail').html('<font color="red">(填写电子邮箱)</font>');
		return false;
	}
	if(c==''){
		$('#forcode').html('<font color="red">(填写验证码)</font>');
		return false;
	}
	if(p==''){
        $('#forpwd').html('<font color="red">(请填写密码)</font>');
		return false;
    }else{
		if (p!=rp){
			$('#forrpwd').html('<font color="red">(两次密码不一致)</font>');
			return false;
		}
	}
	$('#reg_page tr td span').html('<font color="green">(正确)</font>');
	$.ajax({
		type : 'post',
		url : '/wap/ajax.html?do=regcheck',
		data : {'u':u,'e':e,'c':c},
		async : false,
		success : function(r){
			if(r=='ok'){
				rr = true;
			}else{
				var s = r.split('|');
				$('#'+s[0]).html('<font color="red">('+(lan[s[1]] ? lan[s[1]] : s[1])+')</font>');
			}
		}
	});

	return rr ? true : false;
}
</script>
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
    <form action="http://m.7192.com/passport/cnsave" method="post" name="registerform" id="use_form" accept-charset="GB2312" onsubmit="return checkForm();">
        <input type="hidden" name="domain" value="<?=$domain?>" />
        <input type="hidden" name="forward" value="<?php echo $forward;?>" />
		<table id="reg_page">
			<tr>
				<td>用户名：<span id="forusername">(汉字\字母\数字)</span></td>
			</tr>
			<tr>
				<td><input type="text" name="memberinfo[username]" id="username" maxlength="20" class="use_inp" onblur="checkUsername(this.value)" /></td>
			</tr>
			<tr>
				<td>邮箱：<span id="foremail">(如:123456@qq.com)</span></td>
			</tr>
			<tr>
				<td><input type="email" name="memberinfo[email]" id="email" class="use_inp" onblur="checkEmail(this.value)"></td>
			</tr>
			<tr>
				<td>密码：<span id="forpwd">(字母\数字)</span></td>
			</tr>
			<tr>
				<td><input type="password" name="memberinfo[password]" id="pwd" maxlength="30" class="use_inp" onblur="checkPWD(this.value)" /></td>
			</tr>
			<tr>
				<td>确认密码：<span id="forrpwd"></span></td>
			</tr>
			<tr>
				<td><input type="password" name="memberinfo[pwdconfirm]" id="rpwd" maxlength="30" class="use_inp" onblur="checkRPWD(this.value)" /></td>
			</tr>
			<tr>
				<td>验证码：<span id="forcode">(不区分大小写)</span></td>
			</tr>
			<tr>
				<td><input name="checkcodestr" id="code" class="use_inp wid" type="text" style="ime-mode:disabled" size="6" onblur="checkCode(this.value)" /> 
				<img id="seccode" class="color_1" title="验证码,看不清楚?请点击刷新验证码" alt="验证码,看不清楚?请点击刷新验证码" style="cursor:pointer;" onclick="this.src='/wap/checkcode.html?_='+Math.random()*5;" src="/wap/checkcode.html">
				<a href="javascript:document.getElementById('seccode').setAttribute('src','/wap/checkcode.html?_='+Math.random()*5);">刷新</a>
				</td>
			</tr>
		</table>
		<table id="reg_btn_area">
			<tr>
				<th><input type="submit" name="dosubmit" class="k_zc" value="提交注册"></th>
			</tr>
            <tr>
                <td align="center"><div class="smlink">已有账号？&nbsp;&nbsp;&nbsp;&nbsp;<a href="/wap/login.html">立即登陆</a></div><td>
            </tr>
		</table>
	</form>
</div>
</div>
<?php include T('wap','footer');?>