<?php
include(ROOT_PATH."/inc/database.php");

class mysql extends Database {
	
	public function __construct($login, $pwd, $database, $host="localhost") {
		$db=new mysqli($host, $login, $pwd, $database);
		
		if ($db->connect_error) die('Error!');
		
		$this->setDb($db);
		$this->getDb()->set_charset("utf8");
		return $this;
	}
	
	public function query($sql) {
		return self::getDb()->query($sql);
	}
	
	public function getRow($query) {
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function getLastId() {
		return self::getDb()->insert_id;
	}
	
	public function getAll($query) {
		$result=array();
		while($row=$query->fetch_array(MYSQLI_ASSOC)) {
			$result[]=$row;
		}
		return $result;
	}
}
?>
