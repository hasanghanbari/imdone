<?php
date_default_timezone_set("Asia/Tehran");

require_once 'config/database.php';
require_once 'app/functions.php';
require_once 'libs/AltoRouter/AltoRouter.php';

require_once 'controller/adminController.php';
require_once 'controller/classController.php';
require_once 'controller/userController.php';

$folder_root = '/imdone';

function GetUrl()
{
    return 'http://localhost/imdone/';
    // return 'https://done.ghanbari1.ir/';
}

?>