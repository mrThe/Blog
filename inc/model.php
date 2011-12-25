<?php

abstract class Model {
	protected $tableName;
	protected $fields=array();
	static protected $db;

	static function setDb($db) {
		self::$db=$db;
	}
	
	
	public function __set($name, $value) {
		$this->fields[$name]=$value;
        //echo "Setting '$name' to '$value'<br>";
    }
	
	public function __unset($name) {
		if(isset($this->name)) return;
		unset($this->fields[$name]);
		//echo "Unsetting '$name'\n";
    }
	
	public function save(){ }
	
	public function delete(){ }
	
	public function update(){ }
	
	public function find($what="*", $limitStart=0, $limitEnd=0){
		if(count($this->fields)==0) {
			//$sql="SELECT $what FROM  `publications` LIMIT 0 , 30";
			$sql="SELECT $what FROM  `{$this->tableName}` WHERE 1";
		} else {
			$sql="SELECT * FROM  `{$this->tableName}` WHERE ";
		
			$first=true;
			foreach($this->fields as $name=>$val) {
				$name=addslashes($name);
				$val=addslashes($val);
				
				if(!$first) $sql.=" AND ";
				$sql.="`$name` = '$val'";
				
				$first=false;
			}
		}
		
		if($limitEnd!=0) {
			$sql.=" LIMIT $limitStart , $limitEnd";
		}
		
		$result=self::$db->query($sql);
		return self::$db->getAll($result);
	}
	
	public function findSql($sql){ }
}

?>
