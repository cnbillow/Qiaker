<?php
/**
 *	一个支持读写分离的MYSQL操作类
 *
 *	@author Eric,
 *  @copyright	Quanyng Network Inc. 2011
 *	@version 1.0
 */
class MySQL {
    public $querynum = 0;
    public $link = null;
    private $charset;
    private $cur_db = '';
    private $ro_exist = false;
    private $link_ro = null;
    private $link_rw = null;
	private static $_db=null;
    private $search = array('/union(\s*(\/\*.*\*\/)?\s*)+select/i', '/load_file(\s*(\/\*.*\*\/)?\s*)+\(/i', '/into(\s*(\/\*.*\*\/)?\s*)+outfile/i');
	private $replace = array('union &nbsp; select', 'load_file &nbsp; (', 'into &nbsp; outfile');
    public function MySQL(){}
	public static function getdb(){
		if(! self::$_db){
			self::$_db=new MySQL();
			self::$_db->connect(DB_HOST, DB_USER, DB_PW, DB_NAME, DB_CHARSET);
		}
		return self::$_db;
	}
    public function connect($dbhost, $dbuser, $dbpw, $dbname = '',$charset='', $pconnect = 0, $halt = TRUE) {
        if($pconnect) {
            $this->link = mysql_pconnect($dbhost, $dbuser, $dbpw);
            if(!$this->link) {
                $halt && $this->halt('Can not connect to MySQL server');
            }
        } else {
            $this->link = mysql_connect($dbhost, $dbuser, $dbpw);
            if(!$this->link) {
                $halt && $this->halt('Can not connect to MySQL server');
            }
        }
		$this->charset = $charset;
        if(!$this->link && !$halt) return false;
        if($this->link_rw == null){
            $this->link_rw = $this->link;
        }
        if($this->version() > '4.1') {
            if($this->charset) {
                mysql_query("SET character_set_connection=$this->charset,
                character_set_results=$this->charset,
                character_set_client=binary", $this->link);
            }
            if($this->version() > '5.0.1') {
                mysql_query("SET sql_mode=''", $this->link);
            }
        }
        if($dbname) {
            $this->select_db($dbname);
        }
    }

    public function select_db($dbname) {
        $this->cur_db = $dbname;
        if($this->ro_exist){
            mysql_select_db($dbname, $this->link_ro);
        }
        return mysql_select_db($dbname, $this->link_rw);
    }
    public function fetch_array($query, $result_type = MYSQL_ASSOC) {
        return mysql_fetch_array($query, $result_type);
    }
    public function fetch_one_array($sql, $type = '') {
        $qr = $this->query($sql, $type);
        return $this->fetch_array($qr);
    }
    public function query($sql, $type = '') {
        $this->link = &$this->link_rw;
        if($this->ro_exist && preg_match ("/^(\s*)select/i", $sql)){
            $this->link = &$this->link_ro;
        }
        $func = $type == 'UNBUFFERED' && function_exists('mysql_unbuffered_query') ?
            'mysql_unbuffered_query' : 'mysql_query';
        if(!($query = $func($sql, $this->link)) && $type != 'SILENT') {
            $this->halt('MySQL Query Error', $sql);
        }
        $this->querynum++;
        return $query;
    }

	public function get_one($sql){
        if(!preg_match('/LIMIT\s+1\s*$/i',$sql)){
            $sql.=' LIMIT 1';
        }
		return mysql_fetch_assoc($this->query($sql));
	}

    public function findAll($sql,$key=''){
        return $this->getAll($sql,$key);
    }
    public function findOne($sql){
        if(!preg_match('/LIMIT\s+1\s*$/i',$sql)){
            $sql.=' LIMIT 1';
        }
        $rs = $this->query($sql);
        $r =  mysql_fetch_row($rs);
        $this->free_result($rs);
        return $r[0];
    }
    public function fetchPairs($sql){
        $rows = $row = array();
		$rs = $this->query($sql);
        while($row = mysql_fetch_row($rs)){
            $rows[$row[0]]=$row[1];
        }
        $this->free_result($query);
        return $rows;
    }
    public function fetchCols($sql, $split=false,$data=array()){
        $query = $this->query($sql);
        $rs = $row = array();
        if(empty($data)){
            while($row = mysql_fetch_row($query)){
                $rs[]= $row[0];
            }
        }else{
            while($row = mysql_fetch_row($query)){
                $rs[]=$data[$row[0]];
            }
        }
        $this->free_result($query);
        return $split ? implode($split,$rs) : $rs;
    }
	public function insert($table,$array, $id = false,$sqlstr=false,$replace=false){
		if(empty($array) or empty($table)){
			return false;
		}
		$sql='';
        $IF = $replace ? 'REPLACE':'INSERT';
        $m = isset($array[0]) && is_array($array[0]);
		if($m){
            $tmp = array();
			$fields = array_keys($array[0]);
			$sql = "{$IF} INTO {$table} (`";
			$sql.=implode('`,`', $fields);
			$sql.="`) VALUES ";
			foreach($array as $val){
				$tmp[]="('".implode("','",$val)."')";
			}
			$sql.=implode(',',$tmp);
		}else{
			$fields = array_keys($array);
			$sql = "{$IF} INTO {$table} (`";
			$sql.=implode('`,`', $fields);
			$sql.="`) VALUES ('";
			$sql.=implode("','", $array);
			$sql.="')";
		}
		if($sqlstr){
			echo $sql;
		}
		$rs = $this->query($sql);
        return $id ? $this->insert_id() : $rs;
	}
	public function update($table,$array,$condition){
		if(empty($array) || empty($condition) || empty($table)){
			return false;
		}
		$sql = "UPDATE {$table} SET ";
		$tmp = array();
		foreach($array as $field => $value){
            if($value==='++'){
                $tmp[]= "`{$field}`=`{$field}`+1";
            }elseif($value==='--'){
                $tmp[]= "`{$field}`=`{$field}`-1";
            }else{
			    $tmp[]= "`{$field}`='{$value}'";
            }
		}
		$sql.= implode(',',$tmp);
		$sql.= ' WHERE '.$condition;
		return $this->query($sql);
	}
	public function getAll($sql,$key='',$mark=false){
		$rows = $row = array();
		$rs = $this->query($sql);
		if($key){
			if($mark){
				while($row = mysql_fetch_assoc($rs)){
					$rows[$row[$key]][]=$row;
				}
			}else{
				while($row = mysql_fetch_assoc($rs)){
					$rows[$row[$key]]=$row;
				}
			}
		}else{
			while($row = mysql_fetch_assoc($rs)){
				$rows[]=$row;
			}
		}
		return $rows;
	}
    public function affected_rows() {
        return mysql_affected_rows($this->link);
    }
    public function error() {
        return (($this->link) ? mysql_error($this->link) : mysql_error());
    }
    public function errno() {
        return intval(($this->link) ? mysql_errno($this->link) : mysql_errno());
    }
    public function result($query, $row) {
        $query = @mysql_result($query, $row);
        return $query;
    }
    public function num_rows($query) {
        $query = mysql_num_rows($query);
        return $query;
    }
    public function num_fields($query) {
        return mysql_num_fields($query);
    }
    public function free_result($query) {
        if($query){
            return mysql_free_result($query);
        }else{
            return true;
        }
    }
    public function insert_id() {
        return ($id = mysql_insert_id($this->link)) >= 0 ? $id :
            $this->result($this->query("SELECT last_insert_id()"), 0);
    }
    public function fetch_row($query) {
        $query = mysql_fetch_row($query);
        return $query;
    }
    public function version() {
        return mysql_get_server_info($this->link);
    }
    public function close() {
        @mysql_close();
    }
    function escape($string){
		if(!is_array($string)) return str_replace(array('\n', '\r'), array(chr(10), chr(13)), mysql_real_escape_string(preg_replace($this->search, $this->replace, $string), $this->link));
		foreach($string as $key=>$val) $string[$key] = $this->escape($val);
		return $string;
	}
    private function halt($message = '', $sql = '') {
        $dberror = $this->error();
        $dberrno = $this->errno();
        echo "<div style=\"position:absolute;font-size:11px;font-family:verdana,arial;background:#EBEBEB;padding:0.5em;\">
            <b>MySQL Error</b><br>
            <b>Message</b>: $message<br>
            <b>SQL</b>: $sql<br>
            <b>Error</b>: $dberror<br>
            <b>Errno.</b>: $dberrno<br>
            </div>";
        exit();
    }

    public function __destruct(){
        $this->close();
    }
}
?>