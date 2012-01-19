<?php

$sql['host']="localhost";
$sql['user']="root";
$sql['pass']="123";
$sql['database']="test";

$admin_pwd=md5('123');

$controllers['auth']="controller/auth.php";
$controllers['publications']="controller/publications.php";
$controllers['tags']="controller/tags.php";
$controllers['chat']="controller/chat.php";

$controllers['admin']="controller/admin.php";

// $privileges - privileges for page. can be "all" or "admin"
$privileges['publications']="all";
$privileges['tags']="all";
$privileges['auth']="all";
$privileges['chat']="all";

$privileges['admin']="admin";
?>
