<?php
//上传文件类
class FileUploadTool {
	private $error;			//错误代码
	private $maxsize;		//表单最大值
	private $type;				//类型
	private $typeArr = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');		//类型合集
	private $path;				//目录路径   （类似 /wamp/www/boolshili/uploads/original_images/）
	private $today;			//今天目录        （类似 /wamp/www/boolshili/uploads/original_images/20141023/）
	private $name;			//文件名
	private $tmp;				//临时文件    (表单上传后的临时文件目录，可在php.ini中设置)
	private $linkpath;		//链接路径    (类似uploads/original_images/20141023/20141023095002999.jpg)
	private $linktoday;		//今天目录（相对）(20141023/)
	private $newname;     //上传后的文件名    （例如 20141023095002999.jpg）
	private $filesize;          //上传的文件大小
	
	//构造方法，初始化
	public function __construct($_file) {
		$this->error = $_FILES[$_file]['error'];
		$this->type = $_FILES[$_file]['type'];
		$this->name = $_FILES[$_file]['name'];
		$this->tmp = $_FILES[$_file]['tmp_name'];
		$this->filesize=$_FILES[$_file]['size'];
		$this->maxsize = 409600;          //默认最大为400K
		$this->path = ROOT_PATH.UPDIR;
		$this->linktoday = date('Ymd').'/';
		$this->today = $this->path.$this->linktoday;
	
	}
	
	public function start(){
	
		$this->checkError();
		$this->checkLength();
		$this->checkType();
		$this->checkPath();
		$this->moveUpload();
		
	}
	
	
	//添加允许的类型,如txt,zip等等
	public function setType($type){
		$this->typeArr[]=$type;
	}
	
	//添加允许的大小
	public function setMaxSize($size){
		$this->maxsize=$size;
	}
	
	//返回路径
	public function getPath() {
		$_path = $_SERVER["SCRIPT_NAME"];
		$_dir = dirname(dirname($_path));
		if ($_dir == '\\') $_dir = '/';
		$this->linkpath = $_dir.$this->linkpath;
		return $this->linkpath;
	}
	
	
	//返回日期文件夹开始的路径
	public function todayPath() {
		return $this->linktoday.$this->newname;
		//eturn $this->linktoday.$this->name;
	}
	
	
	//移动文件
	private function moveUpload() {
		if (is_uploaded_file($this->tmp)) {
			if (!move_uploaded_file($this->tmp,$this->setNewName())) {//上传到了uploads下的日期文件夹下
				JsTool::alertBack('警告：上传失败！');
			}
		} else {
			JsTool::alertBack('警告：临时文件不存在！');
		}
	}
	
	//设置新文件名
	private function setNewName() {
		$_nameArr = explode('.',$this->name);
		//$_postfix = $_nameArr[count($_nameArr)-1];
		$_postfix = end($_nameArr);
		$this->newname = date('YmdHis').mt_rand(100,1000).'.'.$_postfix;//上传的图片名
		$this->linkpath = UPDIR.$this->linktoday.$this->newname;//getpath()调用
		return $this->today.$this->newname;
	}
	
	//验证目录
	private function checkPath() {
		if (!is_dir($this->path) || !is_writeable($this->path)) {
			if (!mkdir($this->path)) {
				JsTool::alertBack('警告：主目录创建失败！');
			}
		}
		if (!is_dir($this->today) || !is_writeable($this->today)) {
			if (!mkdir($this->today)) {
				JsTool::alertBack('警告：日期子目录创建失败！');
			}
		}
	}
	
	//验证类型
	private function checkType() {
		if (!in_array($this->type,$this->typeArr)) {
			JsTool::alertBack('警告：不合法的上传类型！');
		}
	}
	
	//验证长度
	private  function checkLength(){
		return $this->filesize>$this->maxsize?JsTool::alertBack('超过了最大允许值！'):true;
	}
	
	//验证错误
	private function checkError() {
		if (!empty($this->error)) {
			switch ($this->error) {
				case 1 :
					JsTool::alertBack('警告：上传值超过了约定最大值！');
					break;
				case 2 :
					JsTool::alertBack('警告：上传值超过了表单约定值！');
					break;
				case 3 :
					JsTool::alertBack('警告：只有部分文件被上传！');
					break;
				case 4 :
					JsTool::alertBack('警告：没有任何文件被上传！');
					break;
				case 6 :
					JsTool::alertBack('警告：找不到临时文件夹！');
					break;
				case 7 :
					JsTool::alertBack('警告：文件写入失败！');
					break;
				default:
					JsTool::alertBack('警告：未知错误！');
			}
		}
	}
}


//phpinfo();
?>