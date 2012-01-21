<?php

class User extends Model  {
	//private $name="";
	private $priv="all";
	private $cookie=array();
	private $auth=false;
	private $admin_pwd;
	
	function __construct($cookie, $admin_pwd) {
		$this->cookie=$cookie;
		$this->admin_pwd=$admin_pwd;
		
		$this->checkAuth($admin_pwd);
	}
	
	private function checkAuth() {
			if($this->cookie->admin==md5($this->admin_pwd)) {
				$this->priv="admin";
			}
	}
	
	public function setAuth($pass) {
		if(md5($pass)==$this->admin_pwd) {
			$this->cookie->admin=md5($this->admin_pwd);
			return true;
		} else {
			return false;
		}
	}
	
	public function logout() {
		$this->cookie->admin="";
	}
	
	public function getPrivilage() {
		return $this->priv;
	}
}

?>
