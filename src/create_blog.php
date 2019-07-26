<?php
include_once __DIR__ . '/config/database.php';
include_once __DIR__ . '/config/partials.php';
include_once __DIR__ . '/controller/blog.php';
include_once __DIR__ . '/controller/category.php';

$database = new Database();
$db = $database->getConnection();
$blog = new Blog($db);
$category = new Category($db);

$page_title = "Create Post";
require $header;

echo "<div class='right-button-margin'>";
echo "<a href='index.php' class='btn btn-default pull-right'>Read blogs</a>";
echo "</div>";

if($_POST) {
  $blog->title = $_POST['title'];
  $blog->post = $_POST['post'];
  $blog->category_id = $_POST['category_id'];
  $image =! empty($_FILES["image"]["name"]) ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
  $blog->image = $image;

  if($blog->create()){
    $blog->uploadPhoto();
    $_SESSION['success'] = "<div class='alert alert-success'><i class='fa fa-check-circle'></i> Success, post created! <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
    header("location:index.php");
  } else {
    echo "<div class='alert alert-danger'><i class='fa fa-exclamation-circle'></i> " . $_SESSION['error'] . "<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
  }
}

require 'views/create.php';
require $footer;
?>