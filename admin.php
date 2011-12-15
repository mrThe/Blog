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
		if(isset($_FILES["pic"]["name"]) && $_FILES["pic"]["size"]<1024*1024*2 ) {
			$pic=mysql_escape_string(file_get_contents($_FILES["pic"]["tmp_name"]));
		}
		
		if($mysqli->query("INSERT INTO `publications` (`title`, `text`, `time`, `pic`) VALUES ('$title', '$text', '".time()."', '$pic')")) echo "Added!<br>";
		
	}


	?>
	
	<form method='POST' action='admin.php' enctype='multipart/form-data'>
		<div>
		Title:</br>
		Pic:</br>
		Text:</br>
        </div>
		
		<div>
			<input name="title" type="text" maxlength="255" style="width: 500px"></br>
			<input type="file" name="pic"><br>
			<textarea name="text" rows="20" style="width: 500px"></textarea></br>
		</div>
		</br>
		<input type="submit" value="Post!">
	</form>
	
	<?php

} else {
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
