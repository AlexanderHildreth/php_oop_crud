<?php
include_once 'config/database.php';
include_once 'config/pagination.php';
include_once 'config/partials.php';
include_once 'controller/blog.php';
include_once 'controller/category.php';

$database = new Database();
$db = $database->getConnection();
$blog = new Blog($db);
$category = new Category($db);

$stmt = $blog->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

$page_title = "Blog Posts";
include_once $header;

if ($session->message) {
	$session->message();
}
?>

<div class='right-button-margin'>
	<a href='create_blog.php' class='btn btn-default pull-right'>Create Post</a>
</div>

<?php
if($num > 0){
	include_once "views/read.php";
} else {
	echo "<div class='alert alert-info'>No posts found!</div>";
}

$page_url = "index.php?";
$total_rows = $blog->countAll();
include_once 'paging.php';
include_once $footer;
?>