<?php

class Publications_CT extends Controller {
	
	protected function _default() {
		if(!is_null($this->request->id)) {
			$id=abs(intval($this->request->id));
			$this->tf->publications->id=$id;
		}

		$pubs=$this->tf->publications->find('id, title, text', 0, 0, "time DESC");

		$view=new View("tpl/index.tpl");
		$view->publications=$pubs;

		$view->display();
	}

}
?>
