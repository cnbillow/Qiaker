<?php
$acts=array('index'=>true,'login'=>true);
$c=isset($_REQUEST['c'])?trim($_REQUEST['c']):'index';
if(!isset($acts[$c])){
	$c='index';
}
$title='登陆 - 恰客';
$dsp="";
$keywords="智能头条,人工智能,智能硬件,智能机器人,人工智能学习,无人驾驶,无人机,物联网,云计算";
switch($c) {
	case 'index':
		include T('show','login');
		break;
	case 'login':
		$user = $_POST["username"]; 
        $psw = md5($_POST["password"]);
		$vercode = $_POST["vercode"];
        if($user == "" || $psw == "") {  
            exit('请输入用户名或密码！');  
        }
		if($vercode != "b") {  
            exit('验证码不正确');  
        }
		
		$userinfo=$db->get_One("select * from ucenter where username = '$user'");
		if(!empty($userinfo)){ 
			if($userinfo['password']!=$psw){
				exit('密码不正确');
			}
			$_SESSION['userid']=$userinfo['userid'];
			$_SESSION['username'] = $userinfo['username'];
			$auth = Auth::encode($_SESSION['userid']."\t".$userinfo['password']);
			Cookie::set('Uin', $_SESSION['userid']);
			Cookie::set('Uas', $auth);
			exit('ok');  
		}else{  
			exit('用户名不存在！'); 
		}  
         
		break;
}