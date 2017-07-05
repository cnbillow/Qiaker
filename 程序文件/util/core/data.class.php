<?php
class Fields{
	static public function getHtml($type,$v,$admin=true){
		$type=$admin?$type:'show'.$type;
		return self::$type($v);
	}
	static public function TextField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="text" name="c_'.$data['id'].'" value="'.$extra['df'].'" disabled="disabled" /></label></div>';
		return $html;
	}
	static public function TextArea($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_text"><textarea name="c_'.$data['id'].'"  disabled="disabled">'.$extra['df'].'</textarea></label></div>';
		return $html;		
	}
	static public function RadioButton($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		if(empty($extra)){
			$extra=array(
				'options'=>array('选项一','选项二','选项三'),
				'df'=>''
			);
		}
		$html.='<div class="choices_area" rel="'.$extra['df'].'">';
		foreach($extra['options'] as $kk=>$kv) {
			$chked=isset($extra['df'][$kk])?' checked ':'';
			$html.='<label class="lab_radio"><input name="c_'.$data['id'].'" '.$chked.' type="radio" disabled="disabled" rel="'.$kk.'" /><span>'.$kv.'</span>';
			if($kk==='other'){
				$html.='<input name="c_'.$data['id'].'[other]" '.$chked.' type="text" disabled="disabled" /></label>';
			}else{
				$html.='</label>';
			}
		}
		$html.='</div>';
		return $html;		
	}
	static public function CheckBox($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		if(empty($extra)){
			$extra=array(
				'options'=>array('选项一','选项二','选项三'),
				'df'=>''
			);
		}
		$html.='<div class="choices_area" rel="'.$extra['df'].'">';
		foreach($extra['options'] as $kk=>$kv) {
			$chked=isset($extra['df'][$kk])?' checked ':'';
			$html.='<label class="lab_radio"><input name="c_'.$data['id'].'" '.$chked.' type="checkbox" disabled="disabled" rel="'.$kk.'" /><span>'.$kv.'</span>';
			if($kk==='other'){
				$html.='<input name="c_'.$data['id'].'[other]" '.$chked.' type="text" disabled="disabled" /></label>';
			}else{
				$html.='</label>';
			}
		}
		$html.='</div>';
		return $html;		
	}
	static public function NumberField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="text" name="c_'.$data['id'].'" value="'.$extra['df'].'" disabled="disabled" /></label></div>';
		return $html;
	}
	static public function EmailField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="text" name="c_'.$data['id'].'" value="'.$extra['df'].'" disabled="disabled" /></label></div>';
		return $html;
	}
	static public function LinkField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="text" name="c_'.$data['id'].'" value="'.$extra['df'].'" disabled="disabled" /></label></div>';
		return $html;
	}
	/*static public function AddressField($data=array()){
		
	}*/
	static public function TelephoneField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="text" name="c_'.$data['id'].'" value="'.$extra['df'].'" disabled="disabled" /></label></div>';
		return $html;
	}
	static public function MobileField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="text" name="c_'.$data['id'].'" value="'.$extra['df'].'" disabled="disabled" /></label></div>';
		return $html;
	}
	static public function DateField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$df_arr=array('define'=>0,'today'=>1,'yesterday'=>2,'tomorrow'=>3);
		$data_type=isset($df_arr[$extra['df']])?$extra['df']:'define';
		$extra['df']=$data_type=='define'?$extra['df']:date('Y-m-d',strtotime($extra['df']));
		$html.='<div class="choices_area" rel="'.$extra['df'].'" tp="'.$data_type.'"><label class="lab_txt"><input type="text" name="c_'.$data['id'].'" value="'.$extra['df'].'" disabled="disabled" /></label></div>';
		return $html;
	}
	static public function TimeField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='';
		return $html;		
	}
	static public function DropDown($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		if(empty($extra)){
			$extra=array(
				'options'=>array('选项一','选项二','选项三'),
				'df'=>''
			);
		}
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_sel"><select name="c_'.$data['id'].'" disabled="disabled"><option value="">请选择</option>';
		foreach($extra['options'] as $kk=>$kv) {
			//$chked=isset($extra['df'][$kk])?' selected ':'';
			$html.='<option value="'.$kk.'" '.$chked.'>'.$kv.'</option>';
		}
		$html.='</select></label></div>';
		return $html;		
	}
	static public function CascadeDropDown($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		if(empty($extra)){
			$extra=array (
				'df' => '选项1
-二级选项1
-二级选项2
选项2
-二级选项',
				'options' => array (
					array (
					  'main' => '选项1',
					  'son' => array (0 => '二级选项1',1 => '二级选项2',),
					),
					array (
					  'main' => '选项2',
					  'son' => array (0 => '二级选项',),
					),
				),
			);
		}
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_sel"><select name="c_'.$data['id'].'" disabled="disabled"><option value="">请选择</option>';
		foreach($extra['options'] as $kk=>$kv) {
			$html.='<option value="'.$kv['main'].'" '.$chked.' rel=\'["'.implode('","',$kv['son']).'"]\'>'.$kv['main'].'</option>';
		}
		$html.='</select></label>
		<label class="lab_sel"><select name="c_0" disabled="disabled"><option value="0" selected>请选择</option></select></label>
		<textarea style="display:none">'.$extra['df'].'</textarea>
		</div>';
		return $html;		
	}
	static public function RatingField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_rate">';
		$extra_size=$extra['size']==5?5:3;
		$extra_type=$extra['type']=='heart'?'heart':'star';
		for($i=0; $i<$extra_size; $i++) {
			$html.='<i class="icon-'.$extra_type.'-empty"></i>';
		}
		$html.='</label></div>';
		return $html;		
	}
	
	static public function showTextField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="text" name="c_'.$data['id'].'" value="'.$extra['df'].'" /></label></div>';
		return $html;
	}
	static public function showTextArea($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_text"><textarea name="c_'.$data['id'].'">'.$extra['df'].'</textarea></label></div>';
		return $html;		
	}
	static public function showRadioButton($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		if(empty($extra)){
			$extra=array(
				'options'=>array('选项一','选项二','选项三'),
				'df'=>''
			);
		}
		$html.='<div class="choices_area" rel="'.$extra['df'].'">';
		foreach($extra['options'] as $kk=>$kv) {
			$chked=isset($extra['df'][$kk])?' checked ':'';
			$html.='<label class="lab_radio"><input name="c_'.$data['id'].'" '.$chked.' type="radio" value="'.$kk.'" /><span>'.$kv.'</span>';
			if($kk==='other'){
				$html.='<input name="c_'.$data['id'].'_other" '.$chked.' type="text" /></label>';
			}else{
				$html.='</label>';
			}
		}
		$html.='</div>';
		return $html;		
	}
	static public function showCheckBox($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		if(empty($extra)){
			$extra=array(
				'options'=>array('选项一','选项二','选项三'),
				'df'=>''
			);
		}
		$html.='<div class="choices_area" rel="'.$extra['df'].'">';
		foreach($extra['options'] as $kk=>$kv) {
			$chked=isset($extra['df'][$kk])?' checked ':'';
			$html.='<label class="lab_radio"><input name="c_'.$data['id'].'[]" '.$chked.' type="checkbox" value="'.$kk.'" /><span>'.$kv.'</span></label>';
			if($kk==='other'){
				$html.='<input name="c_'.$data['id'].'_other" '.$chked.' type="text" /></label>';
			}else{
				$html.='</label>';
			}
		}
		$html.='</div>';
		return $html;		
	}
	static public function showNumberField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="number" name="c_'.$data['id'].'" value="'.$extra['df'].'" /></label></div>';
		return $html;
	}
	static public function showEmailField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="email" name="c_'.$data['id'].'" value="'.$extra['df'].'" /></label></div>';
		return $html;
	}
	static public function showLinkField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="text" name="c_'.$data['id'].'" value="'.$extra['df'].'" /></label></div>';
		return $html;
	}
	/*static public function showAddressField($data=array()){
		
	}*/
	static public function showTelephoneField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="number" name="c_'.$data['id'].'" value="'.$extra['df'].'" /></label></div>';
		return $html;
	}
	static public function showMobileField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="number" name="c_'.$data['id'].'" value="'.$extra['df'].'" /></label></div>';
		return $html;
	}
	static public function showDateField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$df_arr=array('define'=>0,'today'=>1,'yesterday'=>2,'tomorrow'=>3);
		$data_type=isset($df_arr[$extra['df']])?$extra['df']:'define';
		$extra['df']=$data_type=='define'?$extra['df']:date('Y-m-d',strtotime($extra['df']));
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_txt"><input type="date" name="c_'.$data['id'].'" value="'.$extra['df'].'" /></label></div>';
		return $html;
	}
	static public function showTimeField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='';
		return $html;		
	}
	static public function showDropDown($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		if(empty($extra)){
			$extra=array(
				'options'=>array('选项一','选项二','选项三'),
				'df'=>''
			);
		}
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_sel"><select name="c_'.$data['id'].'"><option value="">请选择</option>';
		foreach($extra['options'] as $kk=>$kv) {
			$html.='<option value="'.$kk.'" '.$chked.'>'.$kv.'</option>';
		}
		$html.='</select></label></div>';
		return $html;		
	}
	static public function showCascadeDropDown($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		return $html;		
	}
	static public function showRatingField($data=array()){
		$extra=unserialize($data['extra']);
		$html='';
		$html.='<div class="choices_area" rel="'.$extra['df'].'"><label class="lab_rate">';
		$extra_size=$extra['size']==5?5:3;
		$extra_type=$extra['type']=='heart'?'heart':'star';
		for($i=0; $i<$extra_size; $i++) {
			$rel=$i+1;
			$html.='<i class="icon-'.$extra_type.'-empty" rel="'.$rel.'"></i>';
		}
		$html.='</label><input type="hidden" name="c_'.$data['id'].'" value="" /></div>';
		return $html;		
	}
}