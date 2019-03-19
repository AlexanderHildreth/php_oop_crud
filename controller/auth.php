<?php
class auth {
	private $conn;
    private $table_name = "users";

    public $user_id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $timestamp;

    public function __construct($db){
        $this->conn = $db;
    }

    function readOne(){
        /*$query = "SELECT DISTINCT FROM " . $this->table_name . " WHERE email = ? LIMIT 0, 1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->email = $row['email'];
        $this->password = $row['password'];
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];*/
    }
}