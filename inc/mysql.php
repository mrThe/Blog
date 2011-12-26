<?php
include("database.php");

class mysql extends Database {
	
	static function connect($login, $pwd, $database, $host="localhost") {
		$db=new mysqli($host, $login, $pwd, $database);
		
		if ($db->connect_error) die('Error!');
		
		self::setDb( $db );
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
