<?php

abstract class Model {
	protected $tableName;
	protected $fields=array();
	static protected $db;

	static function setDb($db) {
		self::$db=$db;
	}
		
	function __construct($tableName) {
		$this->tableName=$tableName;
	}
	
	protected function getTable() {
		return $this->tableName;
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
	
	public function save(){
			$columns="";
			$values="";

			$first=true;
			foreach($this->fields as $name=>$val) {
				if(is_array($val)) continue;
				$name=addslashes($name);
				$val=addslashes($val);
				
				if(!$first) {
					$columns.=", ";
					$values.=", ";
				}
				
				$columns.="`$name`";
				$values.="'$val'";
				
				$first=false;
			}
		
			self::$db->query("INSERT INTO `{$this->getTable()}` ($columns) VALUES ($values)");
			return self::$db->getLastId();
	}
	
	public function update(){ } //в ТЗ небыло, а я ленивый, не буду делать просто так :3
	
	public function delete($id){
		self::$db->query("DELETE FROM `{$this->getTable()}` WHERE `id` = '$id'");
	}
	
	
	
	public function find($what="*", $limitStart=0, $limitEnd=0, $orderby=''){
		if(count($this->fields)==0) {
			$sql="SELECT $what FROM  `{$this->getTable()}` WHERE 1";
		} else {
			$sql="SELECT * FROM  `{$this->getTable()}` WHERE ";
		
			$first=true;
			foreach($this->fields as $name=>$val) {
				if(is_array($val)) continue;
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
		
		if($orderby!='') {
			$sql.=" order by $orderby";
		}
		
		$result=self::$db->query($sql);
		return self::$db->getAll($result);
	}
	
	public function findSql($sql){ }
}

?>
