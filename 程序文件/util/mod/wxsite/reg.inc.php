<?php
$acts=array('index'=>true,'reg'=>true);
$c=isset($_REQUEST['c'])?trim($_REQUEST['c']):'index';
if(!isset($acts[$c])){
	$c='index';
}
$title='注册 - 恰客';
$dsp="";
$keywords="智能头条,人工智能,智能硬件,智能机器人,人工智能学习,无人驾驶,无人机,物联网,云计算";
switch($c) {
	case 'index':
		include T('show','reg');
		break;
	case 'reg':
		$user = $_POST["username"];
		$email = $_POST["email"]; 
        $pass = trim($_POST["pass"]);   
        $repass = trim($_POST["repass"]);
		if($user == "" || $pass == ""|| $repass == "") {  
            exit('请输入用户名或密码！');  
        }
		if($email == "") {  
            exit('请输入电子邮箱！');  
        }
		if($repass!=$pass){
			exit('两次输入的密码不一致！');  
		}
        $psw = md5($pass);  
        $regtime=time(); 
		$user=$db->get_One("select * from ucenter where username = '$user'"); 
		if(empty($user)){ 
			$db->query("INSERT INTO ucenter(username,password,email,regtime)VALUES('$username','$psw','$email','$regtime')");
			exit('ok');  
		}else{  
			exit('用户名已被使用！'); 
		}  
         
		break;
}