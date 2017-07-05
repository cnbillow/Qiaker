<?php 
define('MICROTIME_START', microtime(true));
define ( 'Q_DIR', dirname(__FILE__));
define('PHPCMS_ROOT', str_replace("\\", '/', substr(Q_DIR, 0, -5)).'/');

date_default_timezone_set('Asia/shanghai');
error_reporting(E_ALL ^ E_NOTICE);

ini_set('error_log',PHPCMS_ROOT.'log/phperror.log');
require(PHPCMS_ROOT.'util/config.php');
require(PHPCMS_ROOT.'util/core/db.class.php');
require(PHPCMS_ROOT.'util/core/functions.inc.php');

define('IN_PHPCMS', TRUE);
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
define('TODAY',strtotime('today'));
define('YEAR',date('Y'));
define('TIME', time());
define('RATE', 0.036);
define('SCRIPT_NAME', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : preg_replace("/(.*)\.php(.*)/i", "\\1.php", $_SERVER['PHP_SELF']));
define('QUERY_STRING', $_SERVER['QUERY_STRING']);
define('PATH_INFO', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '');
define('RELATE_URL', str_replace(array('(', '$', ')', '{', '}', '<', '>'), '', isset($_SERVER['REQUEST_URI']) ? (MAGIC_QUOTES_GPC ? new_stripslashes($_SERVER['REQUEST_URI']) : new_addslashes($_SERVER['REQUEST_URI'])) : SCRIPT_NAME.(QUERY_STRING ? '?'.QUERY_STRING : PATH_INFO)));

session_set_cookie_params(0, COOKIE_PATH, COOKIE_DOMAIN);

$sess = session_id();
if(empty($sess)) session_start();

if(PHP_VERSION < '5.3.0') {
	set_magic_quotes_runtime(0);
}

define('IP', ip());
define('HTTP_REFERER', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
define('DOMAIN', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : preg_replace("/([^:]*)[:0-9]*/i", "\\1", $_SERVER['HTTP_HOST']));
define('SCHEME', $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://');
define('SITE_URL', SCHEME.$_SERVER['HTTP_HOST'].'/');
define('RELATE_URL', str_replace(array('(', '$', ')', '{', '}', '<', '>'), '', isset($_SERVER['REQUEST_URI']) ? (MAGIC_QUOTES_GPC ? new_stripslashes($_SERVER['REQUEST_URI']) : new_addslashes($_SERVER['REQUEST_URI'])) : SCRIPT_NAME.(QUERY_STRING ? '?'.QUERY_STRING : PATH_INFO)));
define('URL', SCHEME.$_SERVER['HTTP_HOST'].RELATE_URL);
define('RELATE_REFERER', urlencode(RELATE_URL));

header('Content-type: text/html; charset='.CHARSET);

if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE') === false){
	//Gzip
	if(GZIP && extension_loaded('zlib')){
		ini_set('zlib.output_compression', 'On');
		ini_set('zlib.output_compression_level', '1');
	}
	//Gzip
	ob_start();
}else{
	//include T('func','goodbye');
	//exit();
}

unset($LANG, $HTTP_ENV_VARS, $HTTP_POST_VARS, $HTTP_GET_VARS, $HTTP_POST_FILES, $HTTP_COOKIE_VARS);
$db = MySQL::getdb();
/*判断访问环境*/
$chk_mobile=checkmobile();

/*用户登录状态start*/
if($_SESSION['userid']){
	//如果有session
    $_userid = intval($_SESSION['userid']);
	$username = $db->findOne("SELECT `username` FROM `ucenter` WHERE `userid`={$_userid}");
	$uc=$db->get_One('select * from `ucenter` where userid='.$_userid);
	if(!empty($username)){
		$_SESSION['userid'] = $_userid;
		$username = str_replace(array('"',"'"),'',htmlspecialchars(trim($username)));
        $_SESSION['username'] =$username;
		$_username = $username;
	}else{
		Cookie::delete('Uas');
		Cookie::delete('Uin');
	}
}else{
	$_userid=0;
	$_username='游客';
    $auth = Cookie::get('Uas');
    $info = Auth::decode($auth);
    if(!empty($info)){
        list($uid, $pass) = explode("\t",$info);
        $uid = intval($uid);
        $pass = preg_replace('/[^0-9a-z]/i','', $pass);
        if($uid && !empty($pass)){
            $username = $db->findOne("SELECT `username` FROM `ucenter` WHERE `userid`={$uid}  AND `password`='{$pass}'");
            if(!empty($username)){
                $_SESSION['userid'] = $_userid = $uid;
                $username = str_replace(array('"',"'"),'',htmlspecialchars(trim($username)));
                $_SESSION['username'] =$username;
				$_username = $username;
            }else{
                Cookie::delete('Uas');
                Cookie::delete('Uin');
            }
        }else{
            Cookie::delete('Uas');
            Cookie::delete('Uin');
        }
    }else{
        Cookie::delete('Uas');
        Cookie::delete('Uin');
    }
	//如果没有session就请求cookie
}
/*用户登录状态end*/

/*用户登录状态end*/
if($_REQUEST){
	//当有请求时自动处理各变量
	if(MAGIC_QUOTES_GPC){
		$_REQUEST = new_stripslashes($_REQUEST);
		if($_COOKIE) $_COOKIE = new_stripslashes($_COOKIE);
	}else{
		$_POST = new_addslashes($_POST);
		$_GET = new_addslashes($_GET);
		$_COOKIE = new_addslashes($_COOKIE);
		@extract($_POST);
		@extract($_GET);
		@extract($_COOKIE);
	}
	$_REQUEST = filter_xss($_REQUEST, ALLOWED_HTMLTAGS);
	extract($db->escape($_REQUEST), EXTR_SKIP);//如果有冲突，不覆盖已有的变量
	if($_COOKIE) $db->escape($_COOKIE);
}
$m=isset($_REQUEST['m'])?trim($_REQUEST['m']):'wxsite';
$m_arr=array('wap'=>true,'admin'=>true,'wxsite'=>true,'mall'=>true);//,'wechat'=>true,'meic'=>true,'zero'=>true
if(!isset($m_arr[$m])){
	$m='wxsite';
}
if(defined('WXSITE')){
	include (PHPCMS_ROOT.'util/mod/'.$m.'.am.php');
}

