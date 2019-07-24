<?php
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
include_once 'config/database.php';
include_once 'config/partials.php';
include_once 'controller/product.php';
include_once 'controller/category.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

$product->id = $id;

$product->readOne();
$page_title = "View Product";
include_once $header;

echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Products";
    echo "</a>";
echo "</div>";

include_once "views/partials/view_table.php";
include_once $footer;
?>	