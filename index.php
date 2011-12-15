<?php

echo file_get_contents("tpl/header.html");


include("config.php");


$result = $mysqli->query("SELECT * FROM  `publications` ORDER BY  `time` DESC");
while($row=$result->fetch_array(MYSQLI_ASSOC)) {
	
	echo "
	<br>
	<h1>{$row['title']}</h1>
	<img src='img.php?id={$row['id']}' alt='Picture'><br><br>
	{$row['text']}
	<hr>
	";
	
	
}



echo file_get_contents("tpl/footer.html");

?>
