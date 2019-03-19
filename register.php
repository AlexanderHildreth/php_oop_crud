<?php
include_once 'config/database.php';
include_once 'config/partials.php';
include_once 'controller/auth.php';

$database = new Database();
$db = $database->getConnection();
$auth = new auth($db);

$page_title = "Register";
include_once $header;

$_SESSION['error'] = '';
$_SESSION['success'] = '';

if ($_POST) {
	
	if($_POST['password'] == $_POST['confirm_password']) {
		$auth->first_name = $_POST['first_name'];
		$auth->last_name = $_POST['last_name'];
		$auth->email = $_POST['email'];
		$auth->password = $_POST['password'];
	} else {
		$_SESSION['error'] = "<div class='alert alert-danger alert-dismissable'><i class='fa fa-exclamation-circle'></i> Error: Passwords do not match!<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
			header("location:register.php");
	}
	
	if ($auth->register()) {
		if($auth->login($auth->email, $auth->password)){
			$_SESSION['logged'] = true;
			$_SESSION['last_activity'] = time();
			$_SESSION['expire_time'] = (1 * 60 * 60) + 1;
			$_SESSION['username'] = $auth->first_name . ' ' . $auth->last_name;
			$_SESSION['success'] = "<div class='alert alert-success alert-dismissable'><i class='fa fa-check-circle'></i> Successfully logged in <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
			header("location:index.php");
		}
	} else {
		echo "<div class='alert alert-danger alert-dismissable'><i class='fa fa-exclamation-circle'></i> " . $_SESSION['error'] . "<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
	}
}

require 'views/register.php';
include_once $footer;