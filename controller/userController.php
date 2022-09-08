<?php

class UsersController 
{
    public static function register() {
        include_once 'models/users.php';
        include_once 'models/class.php';

	    // Instantiate DB & connect
	    $database   = new Database();
	    $db         = $database->connect();

	    // Instantiate blog users object
	    $users             = new Users($db);
	    $class             = new classes($db);

        $users->first_name      = $_POST['first_name'];
        $users->last_name       = $_POST['last_name'];
        $users->system_number   = $_POST['system_number'];

		// Get Class Id
        $class->code   			= $_POST['class_code'];
		$users->class_id 		= $class->getId();
        
        $users->hash_id   		= md5($users->first_name . $users->last_name . $users->system_number . $users->class_id);
       
        // create users
        if ($users->insert()) {
			
			$cookie_name = $class->code;
			$cookie_value =  $users->hash_id;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 7), "/"); // 86400 = 1 day
			
			header('Refresh:0; url='. GetUrl() . $class->code);
        }
    }

	public static function resetDone() {
        include_once 'models/users.php';
        include_once 'models/class.php';

	    // Instantiate DB & connect
	    $database   = new Database();
	    $db         = $database->connect();

	    // Instantiate blog user object
	    $user             	= new Users($db);
	    $class             	= new Classes($db);

		// Get Admin Data
		$admin_data = GetAdmin(false);


        $class->code       	= $_POST['code'];
        $user->class_id		= $class->getId();
        
        // create user
        if ($user->UnDone()) {
			// header('Refresh:0; url='. GetUrl() . $class->code);
        }
    }

	// done
	public static function Done($code) {
        include_once 'models/users.php';

	    // Instantiate DB & connect
	    $database   = new Database();
	    $db         = $database->connect();

	    // Instantiate blog user object
	    $user             	= new Users($db);

		// Get User Data
		$user_data = GetUser($code, false);

        $user->id			= $user_data['id'];
        $user->updated_at	= date('Y-m-d h:i:s');
        
        // create user
        if ($user->Done()) {
			// header('Refresh:0; url='. GetUrl() . $class->code);
        }
    }

	
    public static function list($class_id)
	{
		include_once 'models/users.php';

		// Instantiate DB & connect
		$database 		= new Database();
		$db 			= $database->connect();

		// Instantiate blog data objects
		$user 		= new Users($db);
	
		// Get Admin Data
		// $admin_data = GetAdmin();

        // Get admin login data
        $user->class_id 	= $class_id;
	
		$stmt               = $user->Read();

		if ($stmt->rowCount() > 0) {
			// $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$data = [];
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$data [] = [
					"class_id" 		=> $row['class_id'],
					"created_at" 	=> $row['created_at'],
					"first_name" 	=> $row['first_name'],
					"hash_id" 		=> $row['hash_id'],
					"im_done" 		=> $row['im_done'],
					"last_name" 	=> $row['last_name'],
					"system_number" => $row['system_number'],
					"updated_at" 	=> $row['updated_at']
				];
			}
			echo json_encode($data);
		}
		else {
			// Error List
		}
	}
}

?>