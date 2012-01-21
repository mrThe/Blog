<?php

class Publications extends Model {

	public function __construct($db, $tf) {
		parent::__construct('publications', $db, $tf);
	}
	
	public function save(){
		$id=parent::save();
		if(count($this->fields['tags'])>0) {
			$sql="INSERT INTO `pub_tag` (`pub_id`, `tag_id`)  VALUES  ('$id', '".implode("'), ('$id', '", $this->fields['tags'])."');";
			$this->db->query($sql);
		}
		return $id;
	}
	
	
	public function delete($id){
		parent::delete($id);
		$this->db->query("DELETE FROM `pub_tag` WHERE `pub_id` = '$id'");
	}
	
	
	public function find($what="*", $limitStart=0, $limitEnd=0, $orderby=''){
		$pubs=parent::find($what, $limitStart, $limitEnd, $orderby);
		$pubs=$this->addTags($pubs);
		return $pubs;
	}
	
	private function addTags($pubs) {
		for($i=0;$i<count($pubs);$i++) {
			$pubs[$i]['tags']=$this->tf->tags->getTagsByPubId($pubs[$i]['id']);
		}
		return $pubs;
	}
	
	public function getPublicationsByTag($id) {
		$sql="SELECT DISTINCT id, title, text FROM `{$this->getTable()}` INNER JOIN pub_tag ON pub_tag.pub_id={$this->getTable()}.id WHERE pub_tag.tag_id = '$id'";
		$result=$this->db->query($sql);
		$pubs=$this->db->getAll($result);
		return $this->addTags($pubs);
	}
	
	//public function findSql($sql){ }
}
?>
