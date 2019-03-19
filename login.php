<?php
include_once 'config/database.php';
include_once 'config/partials.php';
include_once 'controller/auth.php';

$database = new Database();
$db = $database->getConnection();
$auth = new auth($db);

$page_title = "Login";
include_once $header;
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {


	if ($_POST['email'] == ''  && $_POST['password'] == '') {
		$_SESSION['logged'] = true;
		$_SESSION['timeout'] = time();
		$_SESSION['username'] = '';

		$_SESSION['success'] .= "<div class='alert alert-success alert-dismissable'><i class='fa fa-check-circle'></i> Successfully logged in <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
		header("location:index.php");
	} else {
		echo "<div class='alert alert-danger alert-dismissable'><i class='fa fa-exclamation-circle'></i> Error: Email and/or password incorrect <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
	}
}

require 'views/login.php';
include_once $footer;