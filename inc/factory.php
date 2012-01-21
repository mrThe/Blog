<?php
	
class Factory {
 
    protected $classes=array();
    protected $db;
    
    public function __construct($db) {
		$this->db=$db;
	}
 
    public function __get($class) {
		if(!isset($this->classes[$class])) {
			include(ROOT_PATH."/model/$class.php");
			$this->classes[$class]=new $class($this->db, $this);
		}
		return $this->classes[$class];
	}
 
}

?>
