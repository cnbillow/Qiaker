<?php
$app_id = "101406653"; 
$app_secret = "62482470b0e1f21381c79b39970c539d"; 
$my_url = "http://qiaker.cn/callback.html"; 

session_start();
$code = $_REQUEST["code"];
if (empty($code)) {
    $_SESSION['state'] = md5(uniqid(rand(), TRUE));
    $dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&state=".$_SESSION['state'];
	header('location:'.$dialog_url);
}

