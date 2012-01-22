<?php

class Admin_CT extends Controller {
	
	
	protected function delete() {
		$id=abs(intval($this->request->getParam("id")));
		$this->tf->publications->delete($id);
		
		$this->location("?act=admin");
	}
	
	protected function add() {
		
		$this->tf->publications->text=htmlspecialchars($this->request->getParam("text"));
		$this->tf->publications->title=htmlspecialchars($this->request->getParam("title"));
		$this->tf->publications->time=time();
		$this->tf->publications->tags=array_map("intval", $this->request->getParam("tags"));
		
		if(!empty($_FILES["pic"]["tmp_name"]) && $_FILES["pic"]["size"]<1024*1024*2 ) { //лень переписывать request для файлов
			$this->tf->publications->pic=file_get_contents($_FILES["pic"]["tmp_name"]);
		} else {
			$this->tf->publications->pic='';
		}
		
		$this->tf->publications->save();

		$this->location("?act=admin");
	}

	protected function _default() {
		$view=new View("tpl/index.tpl");
		$view->admin=true;
		$view->publications=$this->tf->publications->find('id, title, text', 0, 0, "time DESC");
		$view->display();
	}

}
?>
