<?php

abstract class Controller {
	
	protected $request;
	protected $user;
	
	public function __construct($request, $user) {
		$this->request=$request;
		$this->user=$user;
	}
	
	public function _run() {
		try {
			if(is_string($this->request->method) && method_exists($this, $this->request->method)) {
				if(substr($this->request->method,0,1)=="_") throw new Exception("Access error!");
				$this->{$this->request->method}();
			}
		} catch (Exception $e) {}
				
		$this->_default();
	}
	
	abstract protected function _default();

}
?>
