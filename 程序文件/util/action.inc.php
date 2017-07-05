<?php
$m=isset($_REQUEST['m'])?trim($_REQUEST['m']):'wap';
$m_arr=array('wap'=>true,'admin'=>true);
if(!isset($m_arr[$m])){
	$m='wap';
}
$a=isset($_REQUEST['a'])?trim($_REQUEST['a']):'';
switch($m) {
	case 'wap':
		
		break;
	case 'admin':
		$w_l=array('photo'=>true,'area'=>true,'tx'=>true);
		if(isset($w_l[$a])){
			include('/util/action/admin/'.$a.'.inc.php');
		}else{
			sta_404(0);
		}
		break;
}
