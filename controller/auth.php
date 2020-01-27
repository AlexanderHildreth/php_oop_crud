<?php
require_once '/controller/session.php';

class Auth {
	private $conn;
    private $table_name = "users";

    public $user_id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $timestamp;
    public $session;

    public function __construct($db){
        $this->conn = $db;
        $session = new Session;
    }

    function register() {
    	$query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . " WHERE email=`" . $this->email . "`";
        $check = $this->conn->prepare($query);
        $check->execute();
        $row = $check->fetch(PDO::FETCH_ASSOC);

        if($row['total_rows'] == 0) {
        	$query = '';
	    	$query = "INSERT INTO " . $this->table_name . " SET first_name=:first_name, last_name=:last_name, email=:email, password=:password, created=:created";

	        $stmt = $this->conn->prepare($query);
	        
	        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
	        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
	        $this->email = htmlspecialchars(strip_tags($this->email));
	        $this->password = htmlspecialchars($this->hashPassword($this->password));
	        $this->timestamp = date('Y-m-d H:i:s');

	        $stmt->bindParam(":first_name", $this->first_name);
	        $stmt->bindParam(":last_name", $this->last_name);
	        $stmt->bindParam(":email", $this->email);
	        $stmt->bindParam(":password", $this->password);
	        $stmt->bindParam(":created", $this->timestamp);

	        if($stmt->execute()){
	            return true;
	        } else {
	            return false;
	        }	
        } else {
        	$error = 'Error: Email address already exists!';
        	$session->setError($error);
        }

    }

    function login($email, $password){
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ? LIMIT 0, 1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($this->verifyPassword($row['password'], $password)) {
	        $this->email = $row['email'];
	        $this->password = $row['password'];
	        $this->first_name = $row['first_name'];
	        $this->last_name = $row['last_name'];

	        return true;
        } else {
        	$error = 'Password incorrect!';
        	$session->setError($error);

        	return false;
        }
    }

    private function hashPassword($password) {
    	$password = strip_tags($password);
		$option = array(
			'cost' => 12,
		);

		$password = password_hash($password, PASSWORD_BCRYPT, $option);
		
		return $password;
    } 

    private function verifyPassword($hash, $password) {
    	if (password_verify($password, $hash)) {
    		return true;
    	} else {
    		return false;
    	}
    }
}