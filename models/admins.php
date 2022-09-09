<?php
class Admins
{
    // DB stuf
	private $conn;
	private $table = DB_PREFIX.'admins';

    // Admins Properties
	public $id;
	public $name;
	public $username;
	public $password;
    
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
				name 		= :name,
				username 	= :username,
				password 	= :password
			";

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean Data
		$this->name 				= htmlspecialchars(strip_tags($this->name));
		$this->username				= htmlspecialchars(strip_tags($this->username));
		$this->password				= htmlspecialchars(strip_tags($this->password));

		// Bind Data
		$stmt->bindParam(':name'				, $this->name);
		$stmt->bindParam(':username'			, $this->username);
		$stmt->bindParam(':password'			, $this->password);

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

    // GET Single Admin
	public function Info()
	{
		// create query
		$query = "SELECT 
				*
			FROM 
				$this->table a
			WHERE 
				a.username=? AND
                a.password=?";

		// prepare statement
		$stmt = $this->conn->prepare($query);

		// Bined ID
		$stmt->bindParam(1, $this->username);
		$stmt->bindParam(2, $this->password);

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