<?php
class Classes
{
    // DB stuf
	private $conn;
	private $table = DB_PREFIX.'class';

    // Admins Properties
	public $id;	
	public $code;	
	public $title;	
	public $active;	
	public $admin_id;	
	public $created_at;
    
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
				code		= :code,
				title		= :title,
				active		= :active,
				admin_id	= :admin_id
			";

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean Data
		$this->code 				= htmlspecialchars(strip_tags($this->code));
		$this->title				= htmlspecialchars(strip_tags($this->title));
		$this->active				= htmlspecialchars(strip_tags($this->active));
		$this->admin_id				= htmlspecialchars(strip_tags($this->admin_id));

		// Bind Data
		$stmt->bindParam(':code'			, $this->code);
		$stmt->bindParam(':title'			, $this->title);
		$stmt->bindParam(':active'			, $this->active);
		$stmt->bindParam(':admin_id'		, $this->admin_id);

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

    // GET All Class
	public function Read()
	{
		// create query
		$query = "SELECT 
				*
			FROM 
				$this->table c
			WHERE 
				c.admin_id=?";

		// prepare statement
		$stmt = $this->conn->prepare($query);

		// Bined ID
		$stmt->bindParam(1, $this->admin_id);

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
				$this->table c
			WHERE 
				c.active=1 AND
				c.code=?";

		// prepare statement
		$stmt = $this->conn->prepare($query);

		// Bined ID
		$stmt->bindParam(1, $this->code);

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
    
	// GET Class Id
	public function getId()
	{
		// create query
		$query = "SELECT 
				id
			FROM 
				$this->table c
			WHERE c.code=?";

		// prepare statement
		$stmt = $this->conn->prepare($query);

		// Bined ID
		$stmt->bindParam(1, $this->code);

		// Execute Query
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            var_dump($e->getCode());
            var_dump($e->getMessage());
            var_dump($e->errorInfo);
        }

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['id'];
	}
}

?>