<?php
include("config.php");

if(isset($_POST['pass']) && md5($_POST['pass'])==$admin_pwd) { //auth
	setcookie("admin",md5($admin_pwd),time()+3600*24*7,"/");
	
}


echo file_get_contents("tpl/header.html");

//auth chk
if(isset($_COOKIE['admin']) && $_COOKIE['admin']=md5($admin_pwd)) {

	//post add

	if(isset($_POST['title']) && isset($_POST['text'])) {
		$title=mysql_escape_string(htmlspecialchars($_POST['title']));
		$text=mysql_escape_string(htmlspecialchars($_POST['text']));
		
		$pic='';
		if(!empty($_FILES["pic"]["tmp_name"]) && $_FILES["pic"]["size"]<1024*1024*2 ) {
			$pic=mysql_escape_string(file_get_contents($_FILES["pic"]["tmp_name"]));
		}
		
		
		if($mysqli->query("INSERT INTO `publications` (`title`, `text`, `time`, `pic`) VALUES ('$title', '$text', '".time()."', '$pic')")) echo "Added!<br>";
		
		//$mysqli->insert_id;
		$tag_query="INSERT INTO  `pub_tag` (`pub_id` ,`tag_id`) VALUES ";
		foreach($_POST['tags'] as $tag) {
			$tag=abs(intval($tag));
			$tag_query.="('{$mysqli->insert_id}',  '$tag'), ";
		}
		if(isset($tag)) {
			$mysqli->query(trim($tag_query,", "));
		}
		
	}


	?>
	
	<form method='POST' action='admin.php' enctype='multipart/form-data'>
	
	
	<div class="table-row">
		<label>Title:</label>
		<input name="title" type="text" maxlength="255"	>
	</div><br>

	
	<div class="table-row">
		<label>Pic:</label>
		<input type="file" name="pic">
	</div><br>
	
	<div class="table-row">
		<label>Text:</label>
		<textarea name="text"  style="width: 500px; height: 200px;"></textarea>
	</div><br>
	
	<div class="table-row">
		<label>Tags:</label>
		<div class="tags">
			<?php
				$result = $mysqli->query("SELECT * FROM  `tags` ");
				while($row=$result->fetch_array(MYSQLI_ASSOC)) {
					echo "|<input type=\"checkbox\" name=\"tags[]\" value=\"{$row['id']}\">{$row['name']} ";
				}
			?> |
		</div>
	</div><br>
	
	<div class="table-row">
	<label>&nbsp;</label>
		<input type="submit" value="Post!">
	</div><br>
			
	</form>
	
	<?php

} else {
	//no auth
	?>
	
	<form method='POST' action='admin.php'>
		<div>
		Password:</br>
        </div>
		
		<div>
			<input name="pass" type="password"></br>
		</div>
		</br>
		<input type="submit" value="Enter!">
	</form>
	
	<?php
}


echo file_get_contents("tpl/footer.html");

?>
