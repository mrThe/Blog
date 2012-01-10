<?php

class Admin_CT extends Controller {
	
	
	protected function delete() {
		try {
			$id=abs(intval($this->request->id));
			Factory::getInstance()->publications->delete($id);
			header("Location: ?act=admin");
			die;
		} catch (Exception $e) {}
	}
	
	protected function add() {
		try {
			Factory::getInstance()->publications->text=htmlspecialchars($this->request->text);
			Factory::getInstance()->publications->title=htmlspecialchars($this->request->title);
			Factory::getInstance()->publications->time=time();
			Factory::getInstance()->publications->tags=array_map("intval", $this->request->tags);
			
			if(!empty($_FILES["pic"]["tmp_name"]) && $_FILES["pic"]["size"]<1024*1024*2 ) { //лень переписывать request для файлов
				Factory::getInstance()->publications->pic=file_get_contents($_FILES["pic"]["tmp_name"]);
			} else {
				Factory::getInstance()->publications->pic='';
			}
			
			Factory::getInstance()->publications->save();
			
			header("Location: ?act=admin");
			die;
		} catch (Exception $e) {}
	}

	protected function _default() {
		$view=new View("tpl/index.tpl");
		$view->admin=true;
		$view->publications=Factory::getInstance()->publications->find('id, title, text', 0, 0, "time DESC");
		$view->display();
	}

}
?>
