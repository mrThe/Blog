<?php

class Cookie extends Request {
	
	public function __construct() {
		parent::__construct($_COOKIE);
	}
	
	public function __set($key, $val) {
		setcookie($key, $val, time()+3600*24*7,"/");
	}
}

?>
