<?php
/* $dir = scandir('./config');
print_r($dir);
print('<br />'); */
include_once __DIR__ . '/config/database.php';
include_once __DIR__ . '/config/pagination.php';
include_once __DIR__ . '/config/partials.php';
include_once __DIR__ . '/controller/blog.php';
include_once __DIR__ . '/controller/category.php';

$database = new Database();
$db = $database->getConnection();
$blog = new Blog($db);
$category = new Category($db);

$stmt = $blog->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

$page_title = "Blog Posts";
include_once $header;

?>

<div class='right-button-margin'>
	<a href='create_blog.php' class='btn btn-default pull-right'>Create Post</a>
</div>

<?php
if ($_SESSION['success']) {
	echo $_SESSION['success'];
} else {
	echo $_SESSION['error'];
}
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