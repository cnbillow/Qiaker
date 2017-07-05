<?php
class debug {
	static public $log = array();
	
	static public function start($mod){
		self::$log[$mod]['starttime'] = microtime( TRUE );
	}
	
	static public function stop($mod){
		self::$log[$mod]['endtime'] = microtime( TRUE );
		self::$log[$mod]['total'] = self::$log[$mod]['endtime'] - self::$log[$mod]['starttime'];
	}
	
	static public function trace(){
		print_r(self::$log);
	}
	
	static public function spent(){
		if(config::get('showruntime')){	
			$str = '';
			foreach(self::$log as $key => $logs){
				$log = self::$log[$key];
				if(!isset($log['endtime'])) self::stop($key);
				$str .= Helper_String::format('{0}执行时间: {1}s <br />',$key,round($log['total'],3));
			}
			return $str;
		}
	}
}
