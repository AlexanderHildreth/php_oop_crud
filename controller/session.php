<?php
class Session {
	public $logged;
	public $error;
	public $success;
	public $message; 

	public function __construct(){
		session_start();
    }

    public function setError($error) {
    	$this->message = $error;
    }

    public function setSuccess($success) {
    	$this->message = $success;
    }

    public function parTest() {
    	print_r('test');
    }
}