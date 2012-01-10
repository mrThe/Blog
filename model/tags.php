<?php

class Tags extends Model {
	
	public function __construct() {
		parent::__construct('tags');
	}

	
	public function delete($id){
		parent::delete($id);
		self::$db->query("DELETE FROM `pub_tag` WHERE `tag_id` = '$id'");
	}
	
	
	public function getTagsByPubId($id) {
		$sql="SELECT id, name  FROM `pub_tag` INNER JOIN {$this->getTable()} ON pub_tag.tag_id={$this->getTable()}.id WHERE `pub_id` = '{$id}'";
		//die($sql);
		$result=self::$db->query($sql);
		return self::$db->getAll($result);
	}
	
	public function findSql($sql){ }
}
?>
