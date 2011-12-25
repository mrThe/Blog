<?php
include("inc/config.php");
include("inc/mysql.php");

mysql::connect($sql['user'], $sql['pass'], $sql['database'], $sql['host']);
$sql=new mysql();

$nopic="nopic.gif";

if(!(isset($_GET['id']) and is_numeric($_GET['id']))) {
	header("Location: $nopic");
	die;
}
$id=abs(intval($_GET['id']));


if(file_exists("tmp/$id.jpg")) {
	header("Location: tmp/$id.jpg");
	die;
} else {
	$result=$sql->query("SELECT `pic`  FROM `publications` WHERE `id` = '$id'");
	$row=$sql->getRow($result);
	if(isset($row['pic']) && strlen($row['pic'])>0) {
		file_put_contents("tmp/$id.jpg", $row['pic']);
		header("Location: tmp/$id.jpg");
		die;
	}
}

header("Location: $nopic");
?>
