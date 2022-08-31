<?php

class AdminsController 
{
    public static function register() {
        include_once 'models/admins.php';

	    // Instantiate DB & connect
	    $database   = new Database();
	    $db         = $database->connect();

	    // Instantiate blog admins object
	    $admins             = new Admins($db);

        $admins->name       = $_POST['name'];
        $admins->username   = $_POST['username'];
        $admins->password   = md5($_POST['password']);
       
        // create admins
        if ($admins->insert()) {
			
			$cookie_name = 'admin';
			$cookie_value = $admins->username.'@'.$admins->password;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 7), "/"); // 86400 = 1 day

            header('Location: '. GetUrl());
        }
    }

    public static function login()
	{
		include_once 'models/admins.php';

		// Instantiate DB & connect
		$database 		= new Database();
		$db 			= $database->connect();

		// Instantiate blog active_phone objects
		$admins 		= new Admins($db);

		if ($_POST['password'] == '' || $_POST['username'] == '') {
            // set error
			die();
		}
        
        // Get admin login data
        $admins->username 	= $_POST['username'];
        $admins->password 	= md5($_POST['password']);
	
		$stmt               = $admins->Info();

		if ($stmt->rowCount() > 0) {
            // Success Login
			
			$cookie_name = 'admin';
			$cookie_value = $admins->username.'@'.$admins->password;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 7), "/"); // 86400 = 1 day

			header('Location: '. GetUrl());
		}
		else {
			// Error Login
			header('Location: '. GetUrl() .'register');
		}
	}
}

?>