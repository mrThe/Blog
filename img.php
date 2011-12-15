<?php
include("config.php");
if(!(isset($_GET['id']) and is_numeric($_GET['id']))) {
	header("Location: nopic.jpg");
	die;
}
$id=abs(intval($_GET['id']));


if(file_exists("tmp/$id.jpg")) {
	header("Location: tmp/$id.jpg");
	die;
} else {
	$result=$mysqli->query("SELECT `pic`  FROM `publications` WHERE `id` = '$id'");
	$row=$result->fetch_array(MYSQLI_ASSOC);
	if(isset($row['pic']) && strlen($row['pic'])>0) {
		file_put_contents("tmp/$id.jpg", $row['pic']);
		header("Location: tmp/$id.jpg");
		die;
	}
}


header("Location: nopic.gif");

?>
