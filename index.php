<?php

echo file_get_contents("tpl/header.html");


include("config.php");


$result = $mysqli->query("SELECT * FROM  `publications` ORDER BY  `time` DESC");
while($row=$result->fetch_array(MYSQLI_ASSOC)) {
	
	$tags="";
	$tag_res = $mysqli->query("SELECT id, name  FROM `pub_tag` INNER JOIN tags ON pub_tag.tag_id=tags.id WHERE `pub_id` = '{$row['id']}'");
	while($tag_row=$tag_res->fetch_array(MYSQLI_ASSOC)) {
		$tags.=$tag_row['name'].", ";
	}
	$tags=trim($tags,", ");
	
	
	echo "
	<br>
	<h1>{$row['title']}</h1>
	<img src='img.php?id={$row['id']}' alt='Picture'><br><br>
	{$row['text']}
	<hr>
	$tags
	<hr>
	";
	
	
}



echo file_get_contents("tpl/footer.html");

?>
