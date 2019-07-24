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

$search_term = isset($_GET['search']) ? $_GET['search'] : '';
$page_title = "You searched for \"{$search_term}\"";

include_once $header;

$stmt = $blog->search($search_term, $from_record_num, $records_per_page);

$page_url="search.php?search={$search_term}&";
$total_rows = $blog->countAll_BySearch($search_term);
include_once 'views/read.php';
include_once $footer;
?>