<?php

abstract class Database {
	private $db=false;
	
	protected function getDb() {
		return $this->db;
	}
	
	protected function setDb($db) {
		$this->db=$db;
	}
	
	public function __construct($login, $pwd, $database, $host="localhost") { }
	
	public function query($sql) {}
	
	public function getRow($query) { }
	
	public function getLastId() { }
}

?>
