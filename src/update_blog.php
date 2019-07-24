<?php
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include_once 'config/database.php';
include_once 'config/partials.php';
include_once 'controller/blog.php';
include_once 'controller/category.php';

$database = new Database();
$db = $database->getConnection();
$blog = new Blog($db);
$category = new Category($db);

$blog->id = $id;
$blog->readOne();

$page_title = "Update Post";
include_once $header;

echo "<div class='right-button-margin'>";
echo "<a href='index.php' class='btn btn-primary pull-right'><span class='glyphicon glyphicon-list'></span> Blog Posts</a>";
echo "</div>";

if($_POST){
	$blog->title = $_POST['title'];
	$blog->post = $_POST['post'];
	$blog->category_id = $_POST['category_id'];
	$image = (!empty($_FILES["image"]["name"])) ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
	$blog->image = $image;
	if($blog->update()){
		$_SESSION['success'] = '';
		if ($blog->uploadPhoto()) {
			$_SESSION['success'] .= "<div class='alert alert-success alert-dismissable'><i class='fa fa-check-circle'></i> Post was updated! <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
			header("location:index.php");
		} else {
			echo $_SESSION['success'];
		}
	} else {
		echo "<div class='alert alert-danger alert-dismissable'><i class='fa fa-exclamation-circle'></i> " . $_SESSION['error'] . " <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
	}
}


require 'views/update.php';
include_once $footer;
?>