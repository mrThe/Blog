<?php

class Publications_CT extends Controller {
	
	protected function _default() {
		$id=$this->request->getParam('id', NULL);
		if(!is_null($id)) {
			$this->tf->publications->id=abs(intval($id));
		}

		$pubs=$this->tf->publications->find('id, title, text', 0, 0, "time DESC");

		$view=new View("tpl/index.tpl");
		$view->publications=$pubs;

		$view->display();
	}

}
?>
