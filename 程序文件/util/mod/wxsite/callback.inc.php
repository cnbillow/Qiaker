<?php 
$app_id = "101406653"; 
$app_secret = "62482470b0e1f21381c79b39970c539d"; 
$my_url = "http://qiaker.cn/callback.html"; 

$code = $_REQUEST["code"];
if ($_REQUEST['state']==$_SESSION['state']) {
    $token_url="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"."client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&client_secret=".$app_secret."&code=".$code;
    $response = file_get_contents($token_url);
    if (strpos($response, "callback") !== false){
        $lpos = strpos($response, "(");
        $rpos = strrpos($response, ")");
        $response = substr($response, $lpos + 1, $rpos - $lpos - 1);
        $msg = json_decode($response);
        if (isset($msg->error)) {
            echo "<h3>error:</h3>".$msg->error;
            echo "<h3>msg :</h3>".$msg->error_description;
            exit;
        }
    }

    $params = array();
    parse_str($response, $params); //把传回来的数据参数变量化 
    $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=".$params['access_token'];
    $str = file_get_contents($graph_url);
    if (strpos($str, "callback") !== false) {
        $lpos = strpos($str, "(");
        $rpos = strrpos($str, ")");
        $str = substr($str, $lpos + 1, $rpos - $lpos - 1);
    }
    $user = json_decode($str); //存放返回的数据 client_id ，openid 
    if (isset($user->error)) {
        echo "<h3>error:</h3>".$user->error;
        echo "<h3>msg :</h3>".$user->error_description;
        exit;
    }
    $user_data_url="https://graph.qq.com/user/get_user_info?access_token={$params['access_token']}&oauth_consumer_key={$app_id}&openid={$user->openid}&format=json";
    $user_data = json_decode(file_get_contents($user_data_url));
	$nickname=$user_data->nickname;
	$face=$user_data->figureurl_qq_2;
	$sex=$user_data->gender;
	$openid=$user->openid;
	$olduser=$db->get_One("select * from ucenter where openid = '$openid'"); 
	if(empty($olduser)){ 
		$regtime=TIME;
		$db->query("INSERT INTO ucenter(username,regtime,face,sex,openid)VALUES('$nickname','$regtime','$face','$sex','$openid')");
		$uid=$db->insert_id();
		$_SESSION['userid']=$uid;
		$_SESSION['username'] = $nickname;
	}else{  
		$_SESSION['userid']=$olduser['userid'];
		$_SESSION['username'] = $olduser['username'];
		$auth = Auth::encode($_SESSION['userid']."\t".$olduser['password']);
		Cookie::set('Uin', $_SESSION['userid']);
		Cookie::set('Uas', $auth);
	}
	header('location:/');
} else {
    echo("The state does not match. You may be a victim of CSRF.");
}