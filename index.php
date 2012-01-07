<?php
error_reporting(E_ALL);

include("inc/config.php");
include("inc/mysql.php");
include("inc/model.php");
include("inc/view.php");

model::setDb( new mysql($sql['user'], $sql['pass'], $sql['database'], $sql['host']) );

//FRONT CONTROLLER
if(isset($_GET['act']) && isset($controllers[$_GET['act']])) {
	include($controllers[$_GET['act']]);
} else {
	include($controllers['publications']);
}

?>
