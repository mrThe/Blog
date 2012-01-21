<?php

class Tags extends Model {
	
	public function __construct($db, $tf) {
		parent::__construct('tags', $db, $tf);
	}

	
	public function delete($id){
		parent::delete($id);
		$this->db->query("DELETE FROM `pub_tag` WHERE `tag_id` = '$id'");
	}
	
	
	public function getTagsByPubId($id) {
		$sql="SELECT id, name  FROM `pub_tag` INNER JOIN {$this->getTable()} ON pub_tag.tag_id={$this->getTable()}.id WHERE `pub_id` = '{$id}'";
		//die($sql);
		$result=$this->db->query($sql);
		return $this->db->getAll($result);
	}
	
	public function findSql($sql){ }
}
?>
