<?php

abstract class Database {
	static private $db=false;
	
	static protected function getDb() {
		return self::$db;
	}
	
	static protected function setDb($db) {
		self::$db=$db;
	}
	
	static function connect($login, $pwd, $database, $host="localhost") { }
	
	public function query($sql) {}
	
	public function getRow($query) { }
	
	public function getLastId() { }
}

?>
