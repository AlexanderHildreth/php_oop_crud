<?php
require 'config/database.php';
require 'config/partials.php';
require 'controller/product.php';
require 'controller/category.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$category = new Category($db);

$page_title = "Create Product";
require $header;

echo "<div class='right-button-margin'>";
echo "<a href='index.php' class='btn btn-default pull-right'>Read Products</a>";
echo "</div>";

if($_POST) {
  $product->name = $_POST['name'];
  $product->price = $_POST['price'];
  $product->description = $_POST['description'];
  $product->category_id = $_POST['category_id'];
  $image =! empty($_FILES["image"]["name"]) ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
  $product->image = $image;

  if($product->create()){
    echo "<div class='alert alert-success'>Success, product created!</div>";
    echo $product->uploadPhoto();
  } else {
    echo "<div class='alert alert-danger'>Error, product not created!</div>";
  }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
  <table class='table table-hover table-responsive table-bordered'>
    <tr>
      <td>Name</td>
      <td><input type='text' name='name' class='form-control' /></td>
    </tr> 
    <tr>
      <td>Price</td>
      <td><input type='text' name='price' class='form-control' /></td>
    </tr> 
    <tr>
      <td>Description</td>
      <td><textarea name='description' class='form-control'></textarea></td>
    </tr> 
    <tr>
      <td>Category</td>
      <td>
        <?php
            $stmt = $category->read();
            echo "<select class='form-control' name='category_id'>";
            echo "<option>Select category</option>";

            while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
  			    	//change?
              extract($row_category);

              echo "<option value='{$id}'>{$name}</option>";
            }

            echo "</select>";
          ?>
       </td>
     </tr> 
     <tr>
      <td>Photo</td>
      <td><input type="file" name="image" /></td>
    </tr>
    <tr>
      <td></td>
      <td>
        <button type="submit" class="btn btn-primary">Create</button>
      </td>
    </tr> 
  </table>
</form>

<?php
require $footer;
?>