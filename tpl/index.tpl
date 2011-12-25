<?php
include("header.tpl");

foreach($data['publications'] as $pub) {
	$id=$pub['id'];
	$title=$pub['title'];
	$text=$pub['text'];
	$tags=$pub['tags'];
	include("post.tpl");
}

include("footer.tpl");
?>
