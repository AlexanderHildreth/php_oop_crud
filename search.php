<?php
include_once 'config/database.php';
include_once 'config/pagination.php';
include_once 'controller/product.php';
include_once 'controller/category.php';
 
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$category = new Category($db);

$search_term = isset($_GET['search']) ? $_GET['search'] : '';
$page_title = "You searched for \"{$search_term}\"";

include_once "views/partials/header.php";

$stmt = $product->search($search_term, $from_record_num, $records_per_page);

$page_url="search.php?search={$search_term}&";
$total_rows = $product->countAll_BySearch($search_term);
include_once 'views/partials/read.php';
include_once "views/partials/footer.php";
?>