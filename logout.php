<?php
	session_start();
	$_SESSION['logged'] = false;
	unset($_SESSION['success']);
	unset($_SESSION['error']);
if (!$_SESSION['logged']) {
	$_SESSION['success'] = "<div class='alert alert-success alert-dismissable'><i class='fa fa-check-circle'></i> Successfully logged out <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
	header("location:index.php");
} else {
	echo "<div class='alert alert-danger alert-dismissable'><i class='fa fa-exclamation-circle'></i> Error: Please try again <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}