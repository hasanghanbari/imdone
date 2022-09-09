<?php 
/**
 * connect database
 */
class Database
{
	private $dbhost = DATABASE_HOST; //'localhost';
	private $dbname = DATABASE_NAME; //'im_done';
	private $dbuname =DATABASE_USERNAME; // 'root';
	private $dbpass = DATABASE_PASSWORD; //'';

	// private $dbhost = 'localhost';
	// private $dbname = 'ghanbari_imdone';
	// private $dbuname = 'ghanbari_imdone';
	// private $dbpass = 'dc5GpG2pDd12@';
	
	private $conn;
	
	public function connect()
	{
		$this->conn = null;

		$response = array();
		try
		{
			$this->conn = new PDO(
				'mysql:host='.$this->dbhost.';dbname='. $this->dbname.';', 
				$this->dbuname, 
				$this->dbpass,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
			);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			$response["message"] = "ERROR IN SERVER";
			$response["serverMessage"] = $e->getMessage();
			$response["status"] = "500";
			echo json_encode($response);
		}
		return $this->conn;
	}
}
?>