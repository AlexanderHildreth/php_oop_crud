<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <th>Post Title</th>
        <th>Description</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    <?php 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        ?>
        <tr>
            <td><?php echo $title ?></td>
            <td><?php echo $post ?></td>
            <td><?php
            $category->id = $category_id;
            $category->readName();
            echo $category->name; ?>
        </td>

        <td>
            <a href='read_blog.php?id=<?php echo $id; ?>' class='btn btn-primary left-margin'>
                <span class='glyphicon glyphicon-list'></span> Read
            </a>

            <a href='update_blog.php?id=<?php echo $id; ?>' class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edit
            </a>

            <a data-delete-id='<?php echo $id; ?>' class='btn btn-danger delete-object'>
                <span class='glyphicon glyphicon-remove'></span> Delete
            </a>
        </td>

    </tr>
<?php } ?>
</table>