<?php

class Tags extends Model {
	protected $tableName="tags";
	
	public function save(){ }
	
	public function delete(){ }
	
	public function update(){ }
	
	//public function find(){ }
	
	public function getTagsByPubId($id) {
		$sql="SELECT id, name  FROM `pub_tag` INNER JOIN {$this->tableName} ON pub_tag.tag_id={$this->tableName}.id WHERE `pub_id` = '{$id}'";
		//die($sql);
		$result=self::$db->query($sql);
		return self::$db->getAll($result);
	}
	
	public function findSql($sql){ }
}
?>
