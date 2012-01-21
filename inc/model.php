<?php

abstract class Model {
	protected $tableName;
	protected $fields=array();
	protected $db;
	protected $tf;

	function __construct($tableName, $db, $tf) {
		$this->tableName=$tableName;
		$this->db=$db;
		$this->tf=$tf;
	}
	
	protected function getTable() {
		return $this->tableName;
	}
	
	
	public function __set($name, $value) {
		$this->fields[$name]=$value;
    }
	
	public function __unset($name) {
		if(isset($this->name)) return;
		unset($this->fields[$name]);
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

			$this->db->query("INSERT INTO `{$this->getTable()}` ($columns) VALUES ($values)");
			return $this->db->getLastId();
	}
	
	public function update(){ } //в ТЗ небыло, а я ленивый, не буду делать просто так :3
	
	public function delete($id){
		$this->db->query("DELETE FROM `{$this->getTable()}` WHERE `id` = '$id'");
	}
	
	
	
	public function find($what="*", $limitStart=0, $limitEnd=0, $orderby='', $where="1"){
		if(count($this->fields)==0) {
			$sql="SELECT $what FROM  `{$this->getTable()}` WHERE $where";
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
		
		if($orderby!='') {
			$sql.=" order by $orderby";
		}
		
		if($limitEnd!=0) {
			$sql.=" LIMIT $limitStart , $limitEnd";
		}

		$result=$this->db->query($sql);
		return $this->db->getAll($result);
	}
	
	public function findSql($sql){ }
}

?>
