<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Name</td>
        <td><?php echo $product->name ?></td>
    </tr>

    <tr>
        <td>Price</td>
        <td>R <?php echo $product->price ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?php echo $product->description ?></td>
    </tr>
    <tr>
        <td>Category</td>
        <td><?php
        $category->id = $product->category_id;
        $category->readName();
        echo $category->name;
        ?></td>
    </tr>
    <tr>
    <td>Image</td>
    <td>
        <?php echo $product->image ? "<img src='uploads/{$product->image}' style='width:300px;' />" : "No image found." ?>
    </td>
</tr>
</table>