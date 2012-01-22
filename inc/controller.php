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
		$method=$this->request->getParam("method", NULL);
		
		if(method_exists($this, $method)) {
			if(substr($method,0,1)=="_") throw new Exception("Access error!");
			$this->{$method}();
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
