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
$tmpname = TU.date('YmdHis').mt_rand(100,999).'_real.'.$ext;
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

$db = MySQL::getdb();

/*
$site_infos=$db->get_one("select `mark_info` from `web_site_company` where `userid`={$_userid}");
$water_info=empty($site_infos['mark_info'])?array('open'=>1,'w'=>65,'h'=>23,'p'=>9,'org'=>1):unserialize($site_infos['mark_info']);
if(isset($water_info['open'])&&$water_info['open']==1){//开启状态
	$water_file=APPROOT.'diy/'.uidstr($_userid).'/water.png';
	if(file_exists($water_file)&&$water_info['org']!=1){
		$water_info['water_file']=$water_file;
	}else{
		$water_info['water_file']=APPROOT.'img/water_7192_z.png';
	}
	create_new_file($tmpname,$tmpname,$water_info);
}
*/
ob_start();
$imagevariable = ob_get_contents();
ob_end_clean();

$file_id = md5($_FILES["Filedata"]["tmp_name"] + rand()*100000);
$ty=$_POST['type'];
if($ty=='pic'){
    $spuer_w =500;
	$spuer_h =800;
	$w=150;
	$h=200;
	$w1=200;
	$h1=200;
    $file_a=str_replace('_real','_'.$w.'_'.$h,$tmpname);
    $file_b=str_replace('_real','_'.$w1.'_'.$h1,$tmpname);
    getThumb($tmpname,$w,$h,$file_a);
    getThumb($tmpname,$w1,$h1,$file_b);
    reStore($tmpname,$spuer_w,$spuer_h);
    $c='D:/wwwroot/vote/static/uploadfile/'.date('Y',time()).'/'.date('md',time());
    //if(!is_dir($c)){
    //    createDir($c);
    //}
    $ty=1;
    //$new_name=$c.array_pop(explode('temp',$tmpname));
    //$new_name2=$c.array_pop(explode('temp',$file_a));
    //$new_name3=$c.array_pop(explode('temp',$file_b));
    //rename($tmpname,$new_name);
    //rename($file_a,$new_name2);
    //rename($file_b,$new_name3);
    //$thumb=str_replace('D:/wwwroot/vote/static','/static',$new_name);
    $thumb=str_replace('D:/wwwroot/vote/static','/static',$tmpname);
    $db = MySQL::getdb();
    $sql = "INSERT INTO `web_vote`.`web_vote_item_plugin` (`userid`,`dataid`,`thumb`,`addtime`) VALUES ('$_userid',0,'$thumb',".time().")";
    $db->query($sql);
}

$picid=$db->insert_id();
echo "FILEID:" . $file_id . '|' .$thumb.'|'.$picid.'|'.$ty;	// Return the file id to the script

/*
*从上传的临时目录获得资源，加水印后保存到新目录
*/
function create_new_file($old_file,$newfile,$w_cfg=array()){
	global $_userid;
	$mark_pos=9;
	$www=$w_cfg['w'];
	$hhh=$w_cfg['h']-1;
	$w_img=$w_cfg['water_file'];
	$mark_pos=$w_cfg['p'];
	$water_img=imagecreatefrompng($w_img);
	list($x, $y) = getimagesize($old_file);
	$cfg_ab=array(
		1=>array('a'=>0,'b'=>0),
			array('a'=>($x-$www)/2,'b'=>0),
			array('a'=>$x-$www,'b'=>0),
			array('a'=>0,'b'=>($y-$hhh)/2),
			array('a'=>($x-$www)/2,'b'=>($y-$hhh)/2),
			array('a'=>$x-$www,'b'=>($y-$hhh)/2),
			array('a'=>0,'b'=>$y-$hhh),
			array('a'=>($x-$www)/2,'b'=>$y-$hhh),
			array('a'=>$x-$www,'b'=>$y-$hhh),
	);
	$mark_pos_info=isset($cfg_ab[$mark_pos])?$cfg_ab[$mark_pos]:$cfg_ab[9];
	$image = imagecreatefromjpeg($old_file);//临时目录的图像文件
	$image_new = imagecreatetruecolor($x, $y);//创建新的图像文件副本
	$black = imagecolorallocatealpha($image_new,255,255,255,0);//设置底色
	$white = imagecolorallocatealpha($image_new,32,32,32,0);//设定字体颜色
	$red=imagecolorallocatealpha($image_new,228,0,96,0);//设定字体颜色
	imagecopyresampled($image_new, $image, 0, 0, 0, 0, $x, $y, $x, $y);//将临时目录的图像资源copy到新的副本中
	imagedestroy($image);//释放资源
	imageCopy($image_new, $water_img, $mark_pos_info['a'], $mark_pos_info['b'], 0, 0,$www, $hhh);
	imagejpeg($image_new, $newfile, 90);//保存文件
	imagedestroy($image_new);//释放资源
	return true;
}
if(!function_exists('uidstr')){
    function uidstr($uid=0){
        $uid_str = abs(intval($uid));
        $file_str = sprintf("%09d", $uid_str);
        $dir1 = substr($file_str, 0, 3);
        $dir2 = substr($file_str, 3, 3);
        $dir3 = substr($file_str, 6, 3);
        return $dir1.'/'.$dir2.'/'.$dir3;
    }
}
?>