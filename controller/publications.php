<?php
include("model/publications.php");
$publication=new Publications();

if(isset($_GET['id'])) {
	$id=abs(intval($_GET['id']));
	$publication->id=$id;
}

$pubs=$publication->find('id, title, text');

$view=new View("tpl/index.tpl");
$view->publications=$pubs;

$view->display();

?>
