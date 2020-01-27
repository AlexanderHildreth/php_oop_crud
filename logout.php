<?php
	require_once 'config/session.php';
	$session = new Sesh();
	
	$session->logged = false;
	unset($session->success);
	unset($session->error);
if (!$session->logged) {
	$success = "<div class='alert alert-success alert-dismissable'><i class='fa fa-check-circle'></i> Successfully logged out <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
	$session->setSuccess($success); 
	header("location:index.php");
} else {
	$error =  "<div class='alert alert-danger alert-dismissable'><i class='fa fa-exclamation-circle'></i> Error: Please try again <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
	$session->setSuccess($error);
}