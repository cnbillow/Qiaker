<?php
define('MICROTIME_START', microtime(true));
define('PHPCMS_ROOT','D:/wwwroot/');
date_default_timezone_set('Asia/shanghai');
error_reporting(E_ALL ^ E_NOTICE);
require(PHPCMS_ROOT.'vote/util/config.php');
require(PHPCMS_ROOT.'vote/util/core/db.class.php');
require(PHPCMS_ROOT.'vote/util/core/functions.inc.php');
define('TU',PHPCMS_ROOT.'vote/static/temp/');
if (isset($_POST["PHPSESSID"])) {
    session_id($_POST["PHPSESSID"]);
}
session_start();
$_userid=isset($_SESSION['userid'])?$_SESSION['userid']:0;
if(!$_userid){
    echo 'ERROR:登陆超时，请重新登陆';
    exit(0);
}

header('Content-type: text/html; charset='.CHARSET);
ini_set("html_errors", "0");

if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
	//没有文件上传
    echo "ERROR:上传失败";
    exit(0);
}
$oname = $_FILES["Filedata"]["name"];
$ext = strtolower(pathinfo($oname, PATHINFO_EXTENSION));
//$ext = strtolower(array_pop(explode('.', $oname)));
if(!in_array($ext,array('jpg','jpeg'))){
	//非jpg和jpeg的不能上传
	echo 'ERROR:文件类型不正确';
	exit(0);
}
$tmpname = TU.date('Ymd_His').mt_rand(100,999).'_real.'.$ext;

if(!move_uploaded_file($_FILES["Filedata"]["tmp_name"], $tmpname)){
	//文件移动出错
	echo 'ERROR:由于网络问题，传输过程中断，请稍后重试';
	exit(0);
}
list($w, $h, $type, $attr) = getimagesize($tmpname);
$w = intval($w);
$h = intval($h);
if(!($w && $h)){
    unlink($tmpname);
    echo 'ERROR:图片尺寸错误';
    exit(0);
}
if($w>2000 || $h>2000){
    unlink($tmpname);
    echo 'ERROR:图片尺寸太大了';
    exit(0);
}
$next =	image_type_to_extension($type,false);
if($next!='jpg'&&$next!='jpeg'){
    echo 'ERROR:文件损坏或者格式错误'.$next;
	exit(0);
}
/*
resize the real_img
*/
$width=1000;
if($w >$width){
	$height = ceil($width*$h/$w);
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($tmpname);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $w, $h);
	imagejpeg($image_p, $tmpname, 90);
	imagedestroy($image_p);
}

$w=360;
$h=$w1=$h1=200;
$file_a=str_replace('_real','_'.$w.'_'.$h,$tmpname);
getThumb($tmpname,$w,$h,$file_a);
$file_b=str_replace('_real','_'.$w1.'_'.$h1,$tmpname);
getThumb($tmpname,$w1,$h1,$file_b);

$db = MySQL::getdb();

ob_start();
$imagevariable = ob_get_contents();
ob_end_clean();

$file_id = md5($_FILES["Filedata"]["tmp_name"] + rand()*100000);

$_SESSION["file_info"][$file_id] = $imagevariable;
$new_file =str_replace(TU,'/static/temp/',$tmpname);
$sql = "INSERT INTO `web_zero_extra` (`userid`,`dataid`,`thumb`,`addtime`) VALUES ({$_userid},0,'{$new_file}',".time().")";
$db->query($sql);//保存信息
$picid=$db->insert_id();
echo "FILEID:" . $file_id . '|' .$new_file.'|'.$picid;	// Return the file id to the script