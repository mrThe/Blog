<?php
include("inc/config.php");
include("inc/mysql.php");

$sql=new mysql($sql['user'], $sql['pass'], $sql['database'], $sql['host']);

$nopic="nopic.gif";

if(!(isset($_GET['id']) and is_numeric($_GET['id']))) {
	header("Location: $nopic");
	die;
}
$id=abs(intval($_GET['id']));

function redirect($url) {
	header("Location: $url");
	die;
}

$url=$nopic;

if(file_exists("tmp/$id.jpg")) {
	$url="tmp/$id.jpg";
} else {
	$result=$sql->query("SELECT `pic`  FROM `publications` WHERE `id` = '$id'");
	$row=$sql->getRow($result);
	if(isset($row['pic']) && strlen($row['pic'])>0) {
		file_put_contents("tmp/$id.jpg", $row['pic']);
		$url="tmp/$id.jpg";
	}
}


redirect("$url");
?>
