<?php

class ClassController 
{
    public static function create() {
        include_once 'models/class.php';

	    // Instantiate DB & connect
	    $database   = new Database();
	    $db         = $database->connect();

	    // Instantiate blog class object
	    $class             	= new Classes($db);

		// Get Admin Data
		$admin_data = GetAdmin();


        $class->code       	= $_POST['code'];
        $class->title   	= $_POST['title'];
        $class->active   	= $_POST['active'];
        $class->admin_id   	= $admin_data['id'];
       
        // create class
        if ($class->insert()) {
            header('Location: '. GetUrl() .'class/list');
        }
    }

    public static function list()
	{
		include_once 'models/class.php';

		// Instantiate DB & connect
		$database 		= new Database();
		$db 			= $database->connect();

		// Instantiate blog active_phone objects
		$class 		= new Classes($db);
	
		// Get Admin Data
		$admin_data = GetAdmin();

        // Get admin login data
        $class->admin_id 	= $admin_data['id'];
	
		$stmt               = $class->Read();

		if ($stmt->rowCount() > 0) {
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Set Header
			$data_head = '
			<thead>
				<tr>
				<th scope="col">#</th>
				<th scope="col">عنوان</th>
				<th scope="col">آدرس</th>
				<th scope="col">فعال</th>
				</tr>
			</thead>
			';
			// Set Body
			$data_body = '
			<tbody>';
			foreach ($row as $key => $value) {
				$data_body .= '
				<tr>
				<th scope="row">'. ($key+1) .'</th>
				<td>'. $value['title'] .'</td>
				<td><a href="'. GetUrl() . $value['code'] .'">'. GetUrl() . $value['code'] .'</a></td>
				<td>'. $value['active'] .'</td>
				</tr>
				';
			}
			$data_body .= '
			</tbody>
			';
			require 'views/list_class.php';
		}
		else {
			// Error List
		}
	}
	
	public static function info($id) {
		include_once 'models/class.php';

		// Instantiate DB & connect
		$database 		= new Database();
		$db 			= $database->connect();

		// Instantiate blog active_phone objects
		$class 		= new Classes($db);
	
		$show_user_login 	= false;
		$admin_login 		= false;
		$user_login 		= false;

		// Get Admin Data
		$redirect = false;
		$admin_data = GetAdmin($redirect);

		if (count($admin_data) == 0) {
			$user_data = GetUser($id, $redirect);
			$show_user_login = count($user_data) == 0;
			
			if (count($user_data) > 0) {
				$user_login = true;
			}
		}
		else {
			// Get admin login data
			$class->admin_id 	= $admin_data['id'];
			$admin_login 		= true;
		}

		$class->code 		= $id;
	
		$stmt               = $class->Info();
		if ($stmt->rowCount() === 0)  {
			header('Location: '. GetUrl() .'class/list');
		}
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];


		$class_name = 'کلاس '. $row['title'];
		$class_code = $row['code'];
		$class_id 	= $row['id'];

		require 'views/info_class.php';
	}
}

?>