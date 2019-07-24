<?php
if($_POST){
    session_start();
    include_once 'config/database.php';
    include_once 'controller/blog.php';
 
    $database = new Database();
    $db = $database->getConnection();
 
    $blog = new Blog($db);
    $blog->id = $_POST['object_id'];
     
    if($blog->delete()){
       $_SESSION['success'] = "<div class='alert alert-success'><i class='fa fa-check-circle'></i> Post deleted! <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
    } else {
       $_SESSION['error'] = "<div class='alert alert-danger'><i class='fa fa-exclamation-circle'></i> Error deleting post!<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
    }
}
?>