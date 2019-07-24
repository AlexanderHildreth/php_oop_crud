<?php
class Database {
	// this hostname needs to stay as is. because the PHP is a different service, the link is established in the docker-compose.yml file. If it does change,
	// it needs to match the name of the link under the "website" service
	private $host = "mysql";
	// db name, i've named it oop_crud, can be changed
	private $db_name = "oop_crud";
	// Root user
	private $username = "root";
	// Password specified in the docker-compose.yml file, can be changed
	private $password = "secret";
	public $conn;

	public function getConnection() {
		$this->conn = null;
		try {
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
		} catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}

		return $this->conn;
	}
}