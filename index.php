<?php
error_reporting(E_ALL);

include("inc/config.php");
include("inc/mysql.php");
include("inc/model.php");
include("inc/view.php");

mysql::connect($sql['user'], $sql['pass'], $sql['database'], $sql['host']);
model::setDb(new mysql());

//FRONT CONTROLLER
if(isset($_GET['act']) && isset($controllers[$_GET['act']])) {
	include($controllers[$_GET['act']]);
} else {
	include($controllers['publications']);
}

?>
