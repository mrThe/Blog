<?php

class Auth_CT extends Controller {

	
	protected function auth() {
		try {
			if($this->user->setAuth($this->request->pass)) {
				header("Location: ?act=admin");
				die();
			}
		} catch (Exception $e) {}
	}
	
	
	protected function logout() {
		try {
			if($this->user->logout()) {
				header("Location: .");
				die();
			}
		} catch (Exception $e) {}
	}
	
	
	protected function _default() {
		$view=new View("tpl/index.tpl");
		$view->text=$view->render("tpl/auth.tpl");
		$view->display();
	}
	
}

?>
