<?php
include("model/tags.php");
include("model/publications.php");


if(isset($_GET['tag'])) {
	$id=abs(intval($_GET['tag']));
	
	$Pub=new Publications();
	$pubs=$Pub->getPublicationsByTag($id);
} else {
	die("oops!"); //TODO: add tag list
}


$view=new View("tpl/index.tpl");
$view->publications=$pubs;

$view->display();

?>
