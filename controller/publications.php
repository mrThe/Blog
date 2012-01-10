<?php

class Publications_CT extends Controller {
	
	protected function _default() {
		try {
			$id=abs(intval($this->request->id));
			Factory::getInstance()->publications->id=$id;
		} catch (Exception $e) {}

		$pubs=Factory::getInstance()->publications->find('id, title, text', 0, 0, "time DESC");

		$view=new View("tpl/index.tpl");
		$view->publications=$pubs;

		$view->display();
	}

}
?>
