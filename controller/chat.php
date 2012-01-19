<?php

class Chat_CT extends Controller {
	
	protected function getjson() {
		$lastmessage=0;
		try {
			$lastmessage=abs(intval($this->request->lastmessage));
		} catch (Exception $e) {}
		
		$view=new View("");
		$view->messages=Factory::getInstance()->chat->find('id, name, text', 0, 0, "id ASC", "id > '$lastmessage'");
		$view->displayJson();
		
		die;
	}
	
	protected function add() {
		try {
			Factory::getInstance()->chat->name=htmlspecialchars($this->request->name);
			Factory::getInstance()->chat->text=htmlspecialchars($this->request->message);
			Factory::getInstance()->chat->save();
		} catch (Exception $e) {}
		
		die;
	}

	protected function _default() {
		$view=new View("tpl/index.tpl"); 
		$view->messages=Factory::getInstance()->chat->find('name, text', 0, 0, "id ASC");
		$view->lastmessageid=Factory::getInstance()->chat->find('MAX( `id`) AS max');
		$view->text=$view->render("tpl/chat.tpl");
		$view->display();
	}

}
?>
