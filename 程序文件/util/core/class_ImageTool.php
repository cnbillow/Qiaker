<?php
//图像处理类
class ImageTool{
	private $oldfile;			//原始图片存储地址（有图片名）
	private $newfile;			//新图片存储地址（有图片名）
	private $oldwidth;			//原始图片长度
	private $oldheight;			//原始图片长度
	private $type;				//原始图片类型
	private $src_im;				//原始图的资源句柄
	private $des_im;				//新图的资源句柄
	private $dir;                    //硬盘目录
	
	//构造方法，初始化
	public function __construct() {
		
		$this->dir=$_SERVER['DOCUMENT_ROOT'];
		
	
	}

	
	//生成缩略图
	public function createThumb($oldfile,$_width,$_height,$newfile,$type=4){
		//组合图片地址
		$this->oldfile =$this->dir.$oldfile;
		//将图片长、宽、类型获取
		$this->getImgInfo();
		//根据图片类型获取该类型的资源句柄
		$this->src_im = $this->getImgSource($this->oldfile, $this->type);
		//新图片存储地址（有图片名）
		$this->newfile=$this->dir.$newfile;
		//目标句柄，创建真彩色画布
		$this->des_im=imagecreatetruecolor($_width,$_height);
		//缩略图背景白色填充
		$color=imagecolorallocate($this->des_im,255,255,255);
		imagefill($this->des_im, 0, 0, $color);
		//
		$srcRate=$this->oldwidth/$this->oldheight;
    	$thumbRate=$_width/$_height;
		if ( $srcRate > $thumbRate ) {
        	$a=$this->oldheight*$thumbRate;
        	$b=$this->oldheight;
    	} else {
        	$a=$this->oldwidth;
        	$b=$this->oldwidth/$thumbRate;
    	}
		//缩略图剪切类型	
		switch($type){
			case '1':
			//原图长宽等比例缩小到目标句柄，不够的部分留空
			$w=$_width/$this->oldwidth;//50 200
			$h=$_height/$this->oldheight;
			if($w<$h){
				imagecopyresampled($this->des_im, $this->src_im, 0, ($_height- $this->oldheight*$w)/2, 0, 0,  $this->oldwidth*$w, $this->oldheight*$w, $this->oldwidth, $this->oldheight);
			}else{
				imagecopyresampled($this->des_im, $this->src_im,($_width- $this->oldwidth*$h)/2, 0, 0, 0,  $this->oldwidth*$h, $this->oldheight*$h, $this->oldwidth, $this->oldheight);		
			};
			break;
			case '2'://不等比缩小，左侧截取
			$srcX			=	$srcY	=	0;
			$srcWidth		=	round($a);
    		$srcHeight		=	round($b);
			imagecopyresampled ( $this->des_im, $this->src_im, 0, 0, $srcX, $srcY, $_width, $_height, $a , $b);
			break;
			case '3'://不等比缩小，中间截取
			$srcX			=	round(($this->oldwidth-$a)/2);
       	 	$srcY			=	round(($this->oldheight-$b)/2);
			$srcWidth		=	round($a);
    		$srcHeight		=	round($b);
			imagecopyresampled ( $this->des_im, $this->src_im, 0, 0, $srcX, $srcY, $_width, $_height, $a , $b);
			break;
			case '4'://不等比缩小，右侧截取
			$srcX			=	round($this->oldwidth-$a);
        	$srcY			=	round($this->oldheight-$b);
			$srcWidth		=	round($a);
    		$srcHeight		=	round($b);
			imagecopyresampled ( $this->des_im, $this->src_im, 0, 0, $srcX, $srcY, $_width, $_height, $a , $b);
			break;
			
		}
		
		
		//创建图片输出所在目录
		$this->createdir(dirname($this->newfile));
		//输出处理后的图片
		imagepng($this->des_im,$this->newfile);

	}
	
	
	//给图片生成水印
	public function createWater($waterfile,$oldfile,$alpha=50,$savefile=null,$pos_x=0,$pos_y=0){

		$this->oldfile=$this->dir.$oldfile;           //原图地址
		//将原图片长、宽、类型获取（函数内已判断路径是否存在）
		$this->getImgInfo();
		//获取水印图片的信息
		list($width, $height,$type)=getimagesize($waterfile);
		//水印不能比原图大
		if($width>$this->oldwidth||$height>$this->oldheight){
			JsTool::alertBack('水印图片比原图大，不能添加水印');
		}
		//生成作为水印的图片的句柄
		$this->src_im=$this->getImgSource($waterfile, $type);
		//根据图片类型生成被添加水印的图片的句柄
		$this->des_im = $this->getImgSource($this->oldfile, $this->type);  
		//将水印图片复制到目标图片
		imagecopymerge($this->des_im,$this->src_im,$pos_x,$pos_y,0,0,$width,$height,$alpha);
		//输出处理后的图片,如果$savefile=null则覆盖原图片,不是则检查新目录是否存在，不存在则新建
		if($savefile==null){
			$this->outPut($this->type,$this->oldfile);
		}else{
			$this->createdir(dirname($this->dir.$savefile))?$this->outPut($this->type,$this->dir.$savefile):JsTool::alertBack('存放目录创建失败');
		}
		
	}
	
	
	
	//根据类型和路径输出一张图片
	private function outPut($type,$path){
		
		switch ($type) {
			case 1 :
				imagegif($this->des_im,$path);
				break;
			case 2 :
				imagejpeg($this->des_im,$path);
				break;
			case 3 :
				imagepng($this->des_im,$path);
				break;
			default:
				JsTool::alertBack('警告：此图片类型本系统不支持！');
		}
		
	}
	
	
	
	//创建图片输出所在目录
	private function createdir($dir){
		
		if(!is_dir($dir)){
			return mkdir($dir)?true:JsTool::alertBack('处理后图片存储目录创建失败');
		}else {
			return true;
		}
		
	}
	
	
     //获取图片信息并赋值
	private function getImgInfo(){
		
		if(file_exists($this->oldfile)){
		list($this->oldwidth, $this->oldheight, $this->type) = getimagesize($this->oldfile);
		}else {
		  JsTool::alertBack('原始图片地址不存在');
		}
		
	}
	
	
	//加载图片，判断图片的类型，返回此类型的资源句柄
	private function getImgSource($_file, $_type) {
		switch ($_type) {
			case 1 :
				$img = imagecreatefromgif($_file);
				break;
			case 2 :
				$img = imagecreatefromjpeg($_file);
				break;
			case 3 : 
				$img = imagecreatefrompng($_file);
				break;
			default:
				JsTool::alertBack('警告：此图片类型本系统不支持！');
		}
		return $img;
	}
	
	
	//句柄销毁
	public function destroy() {
		imagedestroy($this->src_im);
		imagedestroy($this->des_im);
	}
	
	
	
}

?>