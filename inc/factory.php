<?php
	
class Factory {
 
    protected static $instance;  // object instance
    protected static $classes=array();
 
    public static function getInstance() {
        if ( is_null(self::$instance) ) {
            self::$instance = new Factory;
        }
        return self::$instance;
    }
 
    public function __get($class) {
		if(!isset(self::$classes[$class])) {
			include(ROOT_PATH."/model/$class.php");
			self::$classes[$class]=new $class();
		}
		return self::$classes[$class];
	}
 
}

?>
