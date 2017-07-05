<?php
$app_id = "****"; 
$app_secret = "****"; 
$my_url = "http://qiaker.cn/callback.html"; 

session_start();
$code = $_REQUEST["code"];
if (empty($code)) {
    $_SESSION['state'] = md5(uniqid(rand(), TRUE));
    $dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&state=".$_SESSION['state'];
	header('location:'.$dialog_url);
}

