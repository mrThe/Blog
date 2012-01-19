<?php

class FrontController {
	private $controllers;
	private $privileges;
	private $admin_pwd;
	private $user;
	
	public function __construct($controllers, $privileges, $user) {
		$this->controllers=$controllers;
		$this->privileges=$privileges;
		$this->user=$user;
	}
	
	public function dispath($request) {
		
		try {
			
			$controller='publications';
			
		
			if(is_string($request->act) && isset($this->controllers[$request->act])) {
				if( !$this->checkPrivilage($request->act) ) {
					$controller='auth';
				} else {
					$controller=$request->act;
				}
			}
			
		} catch (Exception $e) {}
		
		include(ROOT_PATH."/".$this->controllers[$controller]);
		$controller=$controller."_CT";
		$controller=new $controller($request, $this->user);
		$controller->_run();
	}
	
	private function checkPrivilage($controller) {
		if($this->user->getPrivilage()=="admin") return true;
		return ($this->user->getPrivilage() == $this->privileges[$controller]);
	}
	
}

?>
