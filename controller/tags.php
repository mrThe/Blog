<?php

class Tags_CT extends Controller {
	
	protected function _default() {
		if(is_null($this->request->tag)) throw new Exception("Missing param!");
		$id=abs(intval($this->request->tag));
		$pubs=$this->tf->publications->getPublicationsByTag($id);

		$view=new View("tpl/index.tpl");
		$view->publications=$pubs;

		$view->display();
	}

}
?>
