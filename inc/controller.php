<?php

abstract class Controller {
	protected $request;
	protected $user;
	protected $tf;
	
	public function __construct($request, $user, $factory) {
		$this->request=$request;
		$this->user=$user;
		$this->tf=$factory;
	}
	
	public function _run() {
		if(is_string($this->request->method) && method_exists($this, $this->request->method)) {
			if(substr($this->request->method,0,1)=="_") throw new Exception("Access error!");
			$this->{$this->request->method}();
		}
				
		$this->_default();
	}
	
	abstract protected function _default();

	protected function location($url) {
		header("Location: $url");
		die;
	}
}
?>
