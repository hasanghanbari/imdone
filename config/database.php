<?php 
/**
 * connect database
 */
class Database
{
	private $dbhost = 'localhost';
	private $dbname = 'im_done';
	private $dbuname = 'root';
	private $dbpass = '';
	
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