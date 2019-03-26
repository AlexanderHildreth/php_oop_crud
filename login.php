<?php
include_once 'config/database.php';
include_once 'config/partials.php';
include_once 'controller/auth.php';

$database = new Database();
$db = $database->getConnection();
$auth = new Auth($db, $session);

$page_title = "Login";
include_once $header;
if ($_POST && !empty($_POST['email']) && !empty($_POST['password'])) {
	if ($auth->login($_POST['email'], $_POST['password'])) {
		$session->logged = true;
		$_SESSION['last_activity'] = time();
		$_SESSION['expire_time'] = (1 * 60 * 60) + 1;
		$_SESSION['username'] = $auth->first_name . ' ' . $auth->last_name;

		$success = "<div class='alert alert-success alert-dismissable'><i class='fa fa-check-circle'></i> Successfully logged in <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";

		$session->setSuccess($success);
		header("location:index.php");
	} else {
		echo "<div class='alert alert-danger alert-dismissable'><i class='fa fa-exclamation-circle'></i> Error: Email and/or password incorrect <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
	}
}

require 'views/login.php';
include_once $footer;