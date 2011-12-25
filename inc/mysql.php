<?php
include("database.php");

class mysql extends Database {
	
	static function connect($login, $pwd, $database, $host="localhost") {
		self::setDb( new mysqli($host, $login, $pwd, $database) );
		self::getDb()->set_charset("utf8");
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
