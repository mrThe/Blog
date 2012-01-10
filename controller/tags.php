<?php

class Tags_CT extends Controller {
	
	protected function _default() {
		try {
			$id=abs(intval($this->request->tag));
			$pubs=Factory::getInstance()->publications->getPublicationsByTag($id);
		} catch (Exception $e) {}

		$view=new View("tpl/index.tpl");
		$view->publications=$pubs;

		$view->display();
	}

}
?>
