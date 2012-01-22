<?php

class Tags_CT extends Controller {
	
	protected function _default() {
		$tag=$this->request->getParam("tag");
	
		$pubs=$this->tf->publications->getPublicationsByTag(abs(intval($tag)));

		$view=new View("tpl/index.tpl");
		$view->publications=$pubs;

		$view->display();
	}

}
?>
