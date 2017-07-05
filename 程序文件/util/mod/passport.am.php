<?php
//微网登录注册处理接口
exit;
$mod_arr=array('login'=>true,'reg'=>true,'logout');//模块白名单
$this_mod=isset($_REQUEST['mod'])?trim($_REQUEST['mod']):'login';
/*
if($_userid && $this_mod!='logout'){
    header('Locaition:/');
    exit;
}*/
if($this_mod=='login'){
    if(!empty($_POST)){
        $username = iconv('UTF-8', 'GBK', htmlspecialchars(trim($_POST['username'])));
        $password = iconv('UTF-8', 'GBK', $_POST['password']);
        $db->query('SET NAMES \'gbk\'');
        $r = $db->get_one('SELECT `uid`,`salt`,`password` FROM `ucenter`.`uc_members` WHERE `username`=\''.$username.'\'');
        $db->query('SET NAMES \'utf8\'');
        if(empty($r)){
            $msg = '账号错误';
        }else{
            $np = md5(md5($password).$r['salt']);
            if($np==$r['password']){
                $_SESSION['userid'] = intval($r['uid']);
                $_SESSION['username'] = iconv('GBK', 'UTF-8',$username);
                $auth = Auth::encode($_SESSION['userid']."\t".$r['password']);
                Cookie::set('Uin', $_SESSION['userid']);
                Cookie::set('Uas', $auth);
                location('/');
            }else{
                $msg = '密码错误';
            }
        }
        include T('passport','login');//T('passport','login');
        exit;
    }else{
		if($chk_mobile){
			header_302('/wap/login.html','');
		}else{
			include $chk_mobile?T('passport','login_m'):T('passport','login');//T('passport','login');
		}
        exit;
    }
}elseif($this_mod=='logout'){
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    Cookie::delete('Uin');
    Cookie::delete('Uas');
    location('http://wxdata.7192.com');
}