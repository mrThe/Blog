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
		$controller="publications";
		
		$act=$request->getParam("act", "publications");
		if(isset($this->controllers[$act])) {
			if( !$this->checkPrivilage($act) ) {
				$controller='auth';
			} else {
				$controller=$act;
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
