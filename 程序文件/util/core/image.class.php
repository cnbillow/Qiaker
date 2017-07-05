<?php
class Thumb{
    /**
	 *	@access	private
	 *	@var array
	 */
	private	$image;

	/**
	 *	@access	private
	 *	@var integer
	 */
	private $tWidth;

	/**
	 *	@access	private
	 *	@var integer
	 */
	private $tHeight;

	/**
	 *	@access	private
	 *	@var string
	 */
	private $folder;

	/**
	 *	@access	private
	 *	@var string
	 */
    private $cutpos;

	/**
	 *	Constructor
	 */
	public function __construct(){
		$this->image = array();
        $this->cutpos = 2;
	}

	public function Thumb(){
		$this->__construct();
	}

	/**
	 *	Input the path of the image
	 *
	 *	@param	string	$image
	 *	@return self
	 */
	public function setImage($image){
		if( empty($image) ){
            return 'Fatal Error:No image input!';
		}
		if( file_exists($image) ){
			$infos = pathinfo($image);
			if(in_array($infos['extension'], array('jpg', 'gif', 'png','jpeg'))){
				$this->image = array(
					'path' => $image,
					'name' => $infos['filename'],
					'ext' => strtolower($infos['extension'])
				);
                @file_put_contents('D:/wwwroot/static/upload/log/t.log',var_export($this->image,true),FILE_APPEND);
                $this->folder = $infos['dirname'].'/';
			} else {
                return 'Fatal Error:Image type must be JPG or GIF or PNG!';
			}
		} else {
            return '<script>alert("'.$image.'");</script>'.$image.'Fatal Error:Image does not exists!';
		}
        return false;
	}

	/**
	 *	Input the Thumb's height and width
	 *
	 *	@param	integer	$tWidth
	 *	@param	integer	$tHeight
	 *	@return self
	 */
	public function setSize($tWidth, $tHeight){
		if( is_int($tWidth) && is_int($tHeight)){
			$this->tWidth = $tWidth;
			$this->tHeight = $tHeight;
		}
	}
    /**
     *  Set Cut Mode
     *
     *  @param  integer $pos
     *  Position:		1  
     *					1	2	3
     *						3  
     */
    public function setCutPosition($pos){
        $this->cutpos = intval($pos);
    }
	/**
	 *	Where thumb is
	 *
	 *	@param	string	$folder
	 *	@return self
	 */
	public function setFolder($folder){
		if( is_dir($folder) && is_writeable($folder) ){
			$this->folder = rtrim($folder,'/').'/';
            return true;
		}else{
            return false;
        }
	}

	private function fixsmall($old_file,$s=''){
		if(!file_exists($old_file)){
            die('input file not exists');
		}
		$extinfo=pathinfo($old_file);
        $ext = strtolower($extinfo['extension']);
		$thumb_file = str_replace('.', $s.'_thumb.', $old_file);

        $createFunc = 'imagecreatefrom'.str_replace('jpg','jpeg',$ext);
        $outputFunc = 'image'.str_replace('jpg','jpeg',$ext);

		list($x, $y) = getimagesize($old_file);
		$thumb=array($this->tWidth,$this->tHeight);
		if($x > $thumb[0]||$y>$thumb[1]){
			$img_ratio = $x / $y;
			$org_ratio = $thumb[0]/$thumb[1];
			if ($org_ratio> $img_ratio) {
				$height =$thumb[1];
				$width = $img_ratio * $thumb[1];
			} else {
				$width = $thumb[0];
				$height = $thumb[0]/ $img_ratio;
			}
		}else{
			$width=$x;
			$height=$y;
		}
		$image = $createFunc($old_file);//初始化原始图像文件
		$image_p = imagecreatetruecolor($thumb[0],$thumb[1]);//创建缩略图的文件副本
		$white = imagecolorallocate($image_p, 255, 255, 255);//缩略图底色
		@imagefilledrectangle($image_p, 0, 0, $thumb[0], $thumb[1], $white);//缩略图
		imagecopyresampled($image_p, $image,($thumb[0]-$width)/2,($thumb[1]-$height)/2, 0, 0, $width, $height, $x, $y);//生成缩略图
		imagedestroy($image);//释放资源
        if($outputFunc=='imagejpeg'){
		    @imagejpeg($image_p, $thumb_file, 90);//保存缩略图
        }else{
            $outputFunc($image_p, $thumb_file);
        }
		imagedestroy($image_p);//释放资源
		return $thumb_file;//返回缩略图地址
	}

    public function scaleThumb($height=100,$prefix='_small',$newfile=''){
        $file = $this->image['path'];
        if(!file_exists($file)){ die('FileNotExists');}
        $info = pathinfo($file);
        $ext = str_replace('jpg','jpeg', strtolower($info["extension"]));
        if(!$this->is__writable($info['dirname'])){
            die('UploadDirCanNotWrite');
        }
        if(empty($ext)){ die('FilenameError');}
        $cFun = 'imagecreatefrom'.$ext;
        $oFun = 'image'.$ext;
        list($width_orig, $height_orig) = getimagesize($file);
        if($height_orig>=$height){
            $width = ceil(($width_orig*$height)/$height_orig);
        }else{
            $width=$width_orig;
            $height=$height_orig;
        }
        $image_p = imagecreatetruecolor($width,$height);
        $white = imagecolorallocate($image_p, 255, 255, 255);
        @imagefilledrectangle($image_p, 0, 0, 200, 160, $white);
        $image = $cFun($file);
        imagecopyresampled($image_p, $image,0,0, 0, 0, $width, $height, $width_orig, $height_orig);
        if(empty($newfile)){
            $newfile = str_replace('.', $prefix.'.', $file);
        }
        if($ext=='jpeg'){
            imagejpeg($image_p, $newfile, 90);
        }else{
            $oFun($image_p, $newfile);
        }
        imagedestroy($image_p);
        return $newfile;
    }
/*zz*/
 public function zzscaleThumb($height=100,$prefix='_small',$newfile=''){
        $file = $this->image['path'];
        if(!file_exists($file)){ die('FileNotExists');}
        $info = pathinfo($file);
        $ext = str_replace('jpg','jpeg', strtolower($info["extension"]));
        if(!$this->is__writable($info['dirname'])){
            die('UploadDirCanNotWrite');
        }
        if(empty($ext)){ die('FilenameError');}
        $cFun = 'imagecreatefrom'.$ext;
        $oFun = 'image'.$ext;
        list($width_orig, $height_orig) = getimagesize($file);
        if($height_orig>=$height){
            $width = ceil(($width_orig*$height)/$height_orig);
        }else{
            $width=$width_orig;
            $height=$height_orig;
        }
        $image_p = imagecreatetruecolor($width,$height);
        $white = imagecolorallocate($image_p, 255, 255, 255);
        @imagefilledrectangle($image_p, 0, 0, 285, 170, $white);
        $image = $cFun($file);
        imagecopyresampled($image_p, $image,0,0, 0, 0, $width, $height, $width_orig, $height_orig);
        if(empty($newfile)){
            $newfile = str_replace('.', $prefix.'.', $file);
        }
        if($ext=='jpeg'){
            imagejpeg($image_p, $newfile, 90);
        }else{
            $oFun($image_p, $newfile);
        }
        imagedestroy($image_p);
        return $newfile;
    }
/*end*/
    private function is__writable($path) {
        if ($path{strlen($path)-1}=='/')
            return $this->is__writable($path.uniqid(mt_rand()).'.tmp');
        else if (is_dir($path))
            return $this->is__writable($path.'/'.uniqid(mt_rand()).'.tmp');
        $rm = file_exists($path);
        $f = @fopen($path, 'a');
        if ($f===false) return false;
        fclose($f);
        if (!$rm) unlink($path);
        return true;
    }

	/**
	 *	Execute actions to save thumb
	 *	@return string|boolean
	 */
	public function save($s=''){
		//Check if canbe run
		empty($this->image) && die('No image given!');
		empty($this->folder) && die('Folder dose not exists or can not write!');
		($this->tWidth && $this->tHeight) or die('Size error!');
		
		//Define the image types
		$types = array('gif'=>'gif', 'jpg'=>'jpeg', 'png'=>'png','jpeg'=>'jpeg');

		//Check required functions
		if(function_exists("imagecopyresampled") && function_exists("imagecreatetruecolor")) {

			$funcCreate = "imagecreatetruecolor";
			$funcResize = "imagecopyresampled";

        } elseif (function_exists("imagecreate") && function_exists("imagecopyresized")) {

            $funcCreate = "imagecreate";
            $funcResize = "imagecopyresized";

        } else {
            die('Fatal Error:Importent function disabled!');
        }

		//Start to calculate
		list($width, $height) = getimagesize($this->image['path']);
		if( $width < $this->tWidth || $height < $this->tHeight){
			return $this->fixsmall($this->image['path'],$s);
		}
		$cf = 'imagecreatefrom' . $types[$this->image['ext']];
		$oImg = $cf($this->image['path']);
		$oRate = $width/$height;

        //Cute Start Position
		$_x = 0;
        $_y = 0;

        $tRate = $this->tWidth/$this->tHeight;
		if ($tRate > $oRate) {
		   $nHeight = round($this->tWidth/$oRate);
		   $nWidth = $this->tWidth;
		} else {
		   $nWidth = round($this->tHeight*$oRate);
		   $nHeight = $this->tHeight;
		}
		
        switch($this->cutpos){
            case 1:
                break;
            case 2:
                $_x = round(($nWidth-$this->tWidth)/2);
                $_y = round(($nHeight-$this->tHeight)/2);
                break;
            case 3:
                if( $tRate > $oRate ){
                    $_y = $nHeight-$this->tHeight;
                }else{
                    $_x = $nWidth-$this->tWidth;
                }
                break;
            default:
                break;
        }
		
		$process = $funcCreate($nWidth, $nHeight); 
		
		$funcResize($process, $oImg, 0, 0, 0, 0, 
					$nWidth, $nHeight, 
					$width, $height);

		$thumb = $funcCreate($this->tWidth, $this->tHeight); 

		$funcResize($thumb, $process, 0, 0, $_x, $_y, 
					$this->tWidth, $this->tHeight, 
					$this->tWidth, $this->tHeight);

		//Free the resource
		imagedestroy($process);
		imagedestroy($oImg);
		
		//Output Image file
		$outputfile = $this->image['name'] .$s. '_thumb.'. $this->image['ext'];
		$op = 'image' . $types[$this->image['ext']];
        if($op=='imagejpeg'){
            $statu = $op($thumb, $this->folder . $outputfile,90);
        }else{
		    $statu = $op($thumb, $this->folder . $outputfile);
        }
		return $this->folder . $outputfile;
	}
}