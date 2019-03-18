<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Name</td>
        <td><?php echo $blog->title ?></td>
    </tr>
    <tr>
        <td>Blog Post</td>
        <td><?php echo $blog->post ?></td>
    </tr>
    <tr>
        <td>Category</td>
        <td><?php
        $category->id = $blog->category_id;
        $category->readName();
        echo $category->name;
        ?></td>
    </tr>
    <tr>
    <td>Image</td>
    <td>
        <?php echo $blog->image ? "<img src='uploads/{$blog->image}' style='width:300px;' />" : "No image found." ?>
    </td>
</tr>
</table>