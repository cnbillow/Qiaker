<!DOCTYPE HTML>
<html  xml:lang="zh-CN">
<head>
    <meta charset="UTF-8" />
    <title>登陆账号</title>
    <style type="text/css">
    body { font-size:14px;font-family:'微软雅黑';background-color:#EAEFF2;}
    .bd { border:1px solid #ddd;border-radius:5px;}
    .txt { display: inline-block;height: 20px;padding: 8px;background: #fff;font-size: 14px;border: 1px solid #e3e3e3;border-top: 1px solid #ccc;box-shadow: 0 1px 1px #fff;border-radius:3px;}
    .btn {background: url('/static/img/passport/s_bgs.png') 0 -40px repeat-x;height: 36px;display: inline-block;zoom: 1;border: 1px solid #dadada;font-size: 14px;width: 132px;cursor: pointer;border-radius:3px;}
    </style>
</head>
<body>
<table width="500" align="center" cellpadding="10" cellspacing="0" bgcolor="#f7f7f7" border="0" style="margin-top:200px;box-shadow:0 0 1000px #aaa;border-radius:5px;"><tr><td>
<div class="bd"><form action="/passport/login.html" method="post">
<input type="hidden" name="formhash" value="" />
<table width="100%" cellpadding="10" bgcolor="white" cellspacing="0" border="0">
    <tr>
        <td colspan="2" bgcolor="#eeeeee"><b>登陆账号</b></td>
    </tr>
    <?php if($msg){?>
    <tr>
        <td colspan="2"><font color="red"><?php echo $msg;?></font></td>
    </tr>
    <?php }?>
    <tr>
        <td width="60" align="right">账号</td>
        <td><input type="text" name="username" class="txt" style="width:260px;" /></td>
    </tr>
    <tr>
        <td width="60" align="right">密码</td>
        <td><input type="password" name="password" class="txt" style="width:260px;" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="submit" class="btn" value=" 登 陆 " /></td>
    </tr>
</table>
</form></div>
</td></tr></table>
</body>
</html>