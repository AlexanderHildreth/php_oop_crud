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
?>
<form role='search' action='search.php'>
	<div class='input-group col-lg-3 col-md-3 col-sm-6 col-xs-6 pull-left margin-right-1em'>
		<?php $search_value = isset($search_term) ? "value='{$search_term}'" : "" ?>
		<input type='text' class='form-control' placeholder='Type post title name or post...' name='search' id='search-term' required <?php echo $search_value ?> />
		<div class='input-group-btn'>
			<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>
		</div>
	</div>
</form>

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