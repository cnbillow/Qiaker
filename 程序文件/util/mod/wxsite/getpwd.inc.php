<?php
$acts=array('index'=>true,'add'=>true,'edit'=>true,'del'=>true,'save'=>true);
$c=isset($_REQUEST['c'])?trim($_REQUEST['c']):'index';
if(!isset($acts[$c])){
	$c='index';
}

function sedsms($phone,$Content){
	$url = 'http://smshttp.k400.cc/SendSMS.aspx';//Wap push地址
	$data = array(
		'User' => 'mengxi',//企业用户名
		'Pass' => 'mengxi717032',//用户密码
		'Destinations' => $phone,//收短信的号码，最多不超过1000个，中间用英文“,”隔开
		'Content' => $Content,//短信内容
		'SendTime' => ''//定时发送时间，格式：年月日时分，201404150832，无需定时发送此参数设置为空
	);
	$postdata = json_encode( $data );
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $postdata );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
	$response = curl_exec( $ch );
	curl_close( $ch );
	$result = json_decode( $response, true );
	print_r($data);
	return $result;
}
switch($c) {
	case 'index':

		include T('show','getpwd');
		break;
	case 'save':
		$phone='18764635699';//trim($_POST['phone']);
		$Content=mt_rand(100000,999999);
		$res=sedsms($phone,$Content);
		print_r($res);
		break;
}