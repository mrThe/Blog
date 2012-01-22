<?php

class Chat_CT extends Controller {
	
	protected function getjson() {
		$lastmessage=abs(intval($this->request->getParam("lastmessage")));		
		
		$view=new View("");
		$view->messages=$this->tf->chat->find('id, name, text', 0, 0, "id ASC", "id > '$lastmessage'");
		$view->displayJson();
		
		die;
	}
	
	protected function add() {
		$this->tf->chat->name=htmlspecialchars($this->request->getParam("name"));
		$this->tf->chat->text=htmlspecialchars($this->request->getParam("message"));
		$this->tf->chat->save();
		
		die;
	}

	protected function _default() {
		$view=new View("tpl/index.tpl"); 
		$view->messages=$this->tf->chat->find('name, text', 0, 0, "id ASC");
		$view->lastmessageid=$this->tf->chat->find('MAX( `id`) AS max');
		$view->text=$view->render("tpl/chat.tpl");
		$view->display();
	}

}
?>
