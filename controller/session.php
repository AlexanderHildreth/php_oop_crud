<?php
class Session {
	public $logged;
	public $error;
	public $success; 

	public function __construct(){
		session_start();

        $this->session = $_SESSION;
    }

    public function setError($error) {
    	$this->error = $error;
    }

    public function setSuccess($success) {
    	$this->success = $success;
    }
}