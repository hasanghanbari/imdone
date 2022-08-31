<?php
class Users
{
    // DB stuf
	private $conn;
	private $table = 'users';

    // Users Properties
	public $id;
	public $hash_id;
	public $first_name;
	public $last_name;
	public $system_number;
	public $im_done;
	public $class_id;
    
	// constructor DB
	public function __construct($db)
	{
		$this->conn = $db;
	}

    // Insert Claim
	public function insert()
	{
		// Crate query
		$query = "INSERT INTO $this->table
			SET
				hash_id			= :hash_id,
				first_name		= :first_name,
				last_name		= :last_name,
				system_number	= :system_number,
				class_id		= :class_id
			";

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean Data
		$this->hash_id 				= htmlspecialchars(strip_tags($this->hash_id));
		$this->first_name 			= htmlspecialchars(strip_tags($this->first_name));
		$this->last_name			= htmlspecialchars(strip_tags($this->last_name));
		$this->system_number		= htmlspecialchars(strip_tags($this->system_number));
		$this->class_id				= htmlspecialchars(strip_tags($this->class_id));

		// Bind Data
		$stmt->bindParam(':hash_id'			, $this->hash_id);
		$stmt->bindParam(':first_name'		, $this->first_name);
		$stmt->bindParam(':last_name'		, $this->last_name);
		$stmt->bindParam(':system_number'	, $this->system_number);
		$stmt->bindParam(':class_id'		, $this->class_id);

		// Execute query
		try {
			// Execute query
			if ($stmt->execute()) {
				return true;
			}
		} catch (PDOException $e) {
			var_dump($e->getCode());
			var_dump($e->getMessage());
			var_dump($e->errorInfo);
		}

		printf("Error: %s.\n", $stmt->error);

		return false;
	}

	
	// Done
	public function Done()
	{
		// Update query
		$query = "UPDATE $this->table
			SET 
				im_done 	= :im_done
			WHERE
				id 		    = :id";
		
		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean Data
		$this->im_done 		= htmlspecialchars(strip_tags(1));
		$this->id 			= htmlspecialchars(strip_tags($this->id));
		
		// Bind Data
		$stmt->bindParam(':im_done'		, $this->im_done);
		$stmt->bindParam(':id'			, $this->id);
		
		// Execute query
		try {
			// Execute query
			if ($stmt->execute()) {
				return true;
			}
		} catch (PDOException $e) {
			var_dump($e->getCode());
			var_dump($e->getMessage());
			var_dump($e->errorInfo);
		}
		
		printf("Error: %s.\n", $stmt->error);
		
		return false;
	}
	
	// UnDone All Class
	public function UnDone()
	{
		// Update query
		$query = "UPDATE $this->table
			SET 
				im_done 	= :im_done
			WHERE
				class_id 	= :class_id";
		
		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean Data
		$this->im_done 		= htmlspecialchars(strip_tags(0));
		$this->class_id 	= htmlspecialchars(strip_tags($this->class_id));
		
		// Bind Data
		$stmt->bindParam(':im_done'		, $this->im_done);
		$stmt->bindParam(':class_id'	, $this->class_id);
		
		// Execute query
		try {
			// Execute query
			if ($stmt->execute()) {
				return true;
			}
		} catch (PDOException $e) {
			var_dump($e->getCode());
			var_dump($e->getMessage());
			var_dump($e->errorInfo);
		}
		
		printf("Error: %s.\n", $stmt->error);
		
		return false;
	}

    // GET All Users
	public function Read()
	{
		// create query
		$query = "SELECT 
				*
			FROM 
				$this->table u
			WHERE 
				u.class_id=?";

		// prepare statement
		$stmt = $this->conn->prepare($query);

		// Bined ID
		$stmt->bindParam(1, $this->class_id);

		// Execute Query
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            var_dump($e->getCode());
            var_dump($e->getMessage());
            var_dump($e->errorInfo);
        }

		return $stmt;
	}

    // GET Single Admin
	public function Info()
	{
		// create query
		$query = "SELECT 
				*
			FROM 
				$this->table u
			WHERE 
				u.hash_id=? AND
				u.class_id=?";

		// prepare statement
		$stmt = $this->conn->prepare($query);

		// Bined ID
		$stmt->bindParam(1, $this->hash_id);
		$stmt->bindParam(2, $this->class_id);

		// Execute Query
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            var_dump($e->getCode());
            var_dump($e->getMessage());
            var_dump($e->errorInfo);
        }

		return $stmt;
	}
}

?>