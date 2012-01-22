<?php

class Request {
	private $request=array();
	public $a="qwe";
	
	
	public function __construct($request) {
		$this->request=$request;
	}
	
	/*
	public function __get($name) {
		$this->getParam($name);
	}
	*/
	
	public function getParam($name, $default=FALSE) {
		if (isset($this->request[$name])) {
			return $this->request[$name];
		} else {
			if($default===FALSE) throw new Exception("Missing param: $name");
			return $default;
		}
	}


}

?>
