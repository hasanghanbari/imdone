<?php
function GetUrl()
{
    return 'http://localhost/imdone/';
}

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
?>