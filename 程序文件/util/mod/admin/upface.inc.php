<?php
	//包含一个文件上传类《细说PHP》中的上传类
	include (dirname(__FILE__).'/../../core/fileupload.class.php');
	$up = new fileupload;
	//设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)
	$d =PHPCMS_ROOT.'/static/uploadfile/'.date('Y/md/');
	if(createDir($d)){
		$up -> set("path", $d);
		$up -> set("maxsize", 1000000);
		$up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
		$up -> set("israndname", true);
	}
	$f = $_FILES['file'];
	//使用对象中的upload方法， 就可以上传文件， 方法需要传一个上传表单的名子 pic, 如果成功返回true, 失败返回false
	if($up -> upload("file")) {
		$info=$up->getFileName();
		$src='http://qiaker.cn/static/uploadfile/'.date('Y/md/').$info;
		$res=array(
			'code' => 0,
			'msg' => '上传成功！',
			'data' => array(
				'src'=>$src,
				'title'=>$info
			)
		);
		$db->query('update `ucenter` set face="'.$src.'" where userid='.$_userid);
		echo json_encode($res);
		exit;
	} else {
		//获取上传失败以后的错误提示
		$info=$up->getErrorMsg();
		$res=array(
			'code' => 1,
			'msg' => $info,
			'data' => array(
				'src'=>'',
				'title'=>$info
			)
		);
		echo json_encode($res);
	}
