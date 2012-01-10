<?php

class Request {
	private $request=array();
	
	
	public function __construct($request) {
		$this->request=$request;
	}
	
	public function __get($key) {
		if (isset($this->request[$key])) {
			return $this->request[$key];
		} else {
			throw new Exception("Not set '$key' param!");
		}
	}
}

?>
