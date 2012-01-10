<?php
error_reporting(E_ALL);
define("ROOT_PATH", dirname(__FILE__));

include(ROOT_PATH."/inc/config.php");
include(ROOT_PATH."/inc/mysql.php");
include(ROOT_PATH."/inc/model.php");
include(ROOT_PATH."/inc/view.php");
include(ROOT_PATH."/inc/user.php");
include(ROOT_PATH."/inc/frontcontroller.php");
include(ROOT_PATH."/inc/request.php");
include(ROOT_PATH."/inc/cookie.php");
include(ROOT_PATH."/inc/factory.php");
include(ROOT_PATH."/inc/controller.php");


model::setDb( new mysql($sql['user'], $sql['pass'], $sql['database'], $sql['host']) );

$user=new User(new Cookie(), $admin_pwd);
$request=new Request($_REQUEST);

$fc=new FrontController($controllers, $privileges, $user);
$fc->dispath($request);
?>
