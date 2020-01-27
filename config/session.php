<?php 
require_once '/controller/session.php';

class Sesh extends Session {
	
	function __construct() {
		$this->message();		
	}

	public function message() {
		print_r($this->message);
	}
}