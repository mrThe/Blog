<?php

class Publications extends Model {

	public function __construct() {
		parent::__construct('publications');
	}
	//public function save(){ }
	
	//public function delete(){ }
	
	//public function update(){ }
	
	public function find($what="*", $limitStart=0, $limitEnd=0){
		$pubs=parent::find($what, $limitStart, $limitEnd);
		$pubs=$this->addTags($pubs);
		return $pubs;
	}
	
	private function addTags($pubs) {
		require_once('model/tags.php');
		$Tag=new Tags();
		for($i=0;$i<count($pubs);$i++) {
			$pubs[$i]['tags']=$Tag->getTagsByPubId($pubs[$i]['id']);
		}
		return $pubs;
	}
	
	public function getPublicationsByTag($id) {
		$sql="SELECT DISTINCT id, title, text FROM `{$this->getTable()}` INNER JOIN pub_tag ON pub_tag.pub_id={$this->getTable()}.id WHERE pub_tag.tag_id = '$id'";
		$result=self::$db->query($sql);
		$pubs=self::$db->getAll($result);
		return $this->addTags($pubs);
	}
	
	public function findSql($sql){ }
}
?>
