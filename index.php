<?php
include_once 'config/database.php';
include_once 'config/pagination.php';
include_once 'config/partials.php';
include_once 'controller/product.php';
include_once 'controller/category.php';
 
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$category = new Category($db);

$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

$page_title = "Read Products";
include_once $header;

if($num > 0){
    include_once "views/partials/read.php";
} else {
    echo "<div class='alert alert-info'>No products found!</div>";
}

$page_url = "index.php?";
$total_rows = $product->countAll();
include_once 'paging.php';
include_once $footer;
?>