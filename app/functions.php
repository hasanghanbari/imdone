<?php
function GetAdmin($redirect = true)
{
    // Instantiate DB & connect
    $database   = new Database();
    $db         = $database->connect();

    include_once 'models/admins.php';

    $admins             = new Admins($db);

    if(!isset($_COOKIE['admin'])) {
        if ($redirect) {
            header('Location: '. GetUrl() .'logout');
            die();
        }
        return [];
    }

    $admin_cookie 		= $_COOKIE['admin'];
    $admin_cookie 		= explode('@', $admin_cookie);
    $admins->username 	= $admin_cookie[0];
    $admins->password 	= $admin_cookie[1];
    $result_admin 		= $admins->Info();

    if ($result_admin->rowCount() == 0) {
        if ($redirect) {
            header('Location: '. GetUrl() .'logout');
            die();
        }
        return [];
    }

    $row_admin          = $result_admin->fetchAll(PDO::FETCH_ASSOC)[0];

    return [
        "id" => $row_admin['id'],
        "name" => $row_admin['name']
    ];
}

function GetUser($code, $redirect = true)
{
    // Instantiate DB & connect
    $database   = new Database();
    $db         = $database->connect();

    include_once 'models/users.php';
    include_once 'models/class.php';

    $users             = new Users($db);
    $class             = new Classes($db);

    if(!isset($_COOKIE[$code])) {
        // if ($redirect) {
        //     header('Location: '. GetUrl() .'logout');
        //     die();
        // }
        return [];
    }

    $users_cookie 		= $_COOKIE[$code];
    $users->hash_id 	= $users_cookie;

    // Get Class Id
    $class->code        = $code;
    $users->class_id    = $class->getId();

    $result_users 		= $users->Info();

    if ($result_users->rowCount() == 0) {
        // if ($redirect) {
        //     header('Location: '. GetUrl() .'logout');
        //     die();
        // }
        return [];
    }

    $row_users          = $result_users->fetchAll(PDO::FETCH_ASSOC)[0];

    return [
        "id"            => $row_users['id'],
        "first_name"    => $row_users['first_name'],
        "last_name"     => $row_users['last_name'],
        "system_number" => $row_users['system_number'],
        "im_done"       => $row_users['im_done']
    ];
}


function G2J($date)
{
    require_once 'libs/jdf.php';
	$time_zone="UTC";
	$d = explode(' ',$date);
	$d_date = explode('-',$d[0]); //date
	$d_time = explode(':',$d[1]); //time
	$year = $d_date[0];
	$month = $d_date[1];
	$day = $d_date[2];
	$hour=$d_time[0];
	$minute=$d_time[1];
	$second=$d_time[2];
	$Jd = gregorian_to_jalali($year,$month,$day);
	if ($Jd[1]<=6)
		$timestamp =gmmktime($hour,$minute,$second,$month,$day,$year)+16200;
	else
		$timestamp =gmmktime($hour,$minute,$second,$month,$day,$year)+12600;
	return jdate("Y/m/d H:i:s",$timestamp,$none='',$time_zone);
}

function J2G($date)
{
    require_once 'libs/jdf.php';
	$time_zone="UTC";
	$d = explode(' ',$date);
	$d_date = explode('/',$d[0]); //date
	$d_time = explode(':',$d[1]); //time
	$year = $d_date[0];
	$month = $d_date[1];
	$day = $d_date[2];
	$hour=$d_time[0];
	$minute=$d_time[1];
	$second=$d_time[2];
	$Jd = jalali_to_gregorian($year,$month,$day,' - ');
	if ($Jd[1]<=6)
		$timestamp =jmktime($hour,$minute,$second,$month,$day,$year)+16200;
	else
		$timestamp =jmktime($hour,$minute,$second,$month,$day,$year)+12600;
	return date("Y/m/d H:i:s",$timestamp,$none='',$time_zone);
}
?>