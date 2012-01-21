<?php

class FrontController {
	private $controllers;
	private $privileges;
	private $admin_pwd;
	private $user;
	private $factory;
	
	public function __construct($controllers, $privileges, $user, $factory) {
		$this->controllers=$controllers;
		$this->privileges=$privileges;
		$this->user=$user;
		$this->factory=$factory;
	}
	
	public function dispath($request) {
		$controller='publications';
		
		if(is_string($request->act) && isset($this->controllers[$request->act])) {
			if( !$this->checkPrivilage($request->act) ) {
				$controller='auth';
			} else {
				$controller=$request->act;
			}
		}
		
		include(ROOT_PATH."/".$this->controllers[$controller]);
		$controller=$controller."_CT";
		$controller=new $controller($request, $this->user, $this->factory);
		$controller->_run();
	}
	
	private function checkPrivilage($controller) {
		if($this->user->getPrivilage()=="admin") return true;
		return ($this->user->getPrivilage() == $this->privileges[$controller]);
	}
	
}

?>
