<?php

class Auth_CT extends Controller {

	
	protected function auth() {
		if($this->user->setAuth($this->request->getParam("pass"))) {
			$this->location("?act=admin");
		}
	}
	
	
	protected function logout() {
		if($this->user->logout()) {
			$this->location(".");
		}
	}
	
	
	protected function _default() {
		$view=new View("tpl/index.tpl");
		$view->text=$view->render("tpl/auth.tpl");
		$view->display();
	}
	
}

?>
