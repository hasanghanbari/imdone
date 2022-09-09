<?php
date_default_timezone_set("Asia/Tehran");

if(!file_exists('config/config.php')){
	header('Location: install/start.php'); exit();
}

require_once 'config/config.php';
require_once 'config/database.php';
require_once 'app/functions.php';
require_once 'libs/AltoRouter/AltoRouter.php';

require_once 'controller/adminController.php';
require_once 'controller/classController.php';
require_once 'controller/userController.php';

$db_connection = new Database();
if(!$db_connection->connect()){
	header('Location: install/start.php'); exit();
}

$folder_root = '/'.FOLDER_ROOT;

function GetUrl()
{
    return 'http://'.SITE_URL.'/';
    // return 'https://done.ghanbari1.ir/';
}

?>