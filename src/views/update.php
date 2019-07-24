<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post"  enctype="multipart/form-data">
	<table class='table table-hover table-responsive table-bordered'>
		<tr>
			<td>Post Title</td>
			<td><input type='text' name='title' value='<?php echo $blog->title; ?>' class='form-control' /></td>
		</tr>
		<tr>
			<td>Post</td>
			<td><textarea name='post' class='form-control'><?php echo $blog->post; ?></textarea></td>
		</tr>
		<tr>
			<td>Category</td>
			<td>
				<?php
				$stmt = $category->read();

				echo "<select class='form-control' name='category_id'>";
				echo "<option>Please select...</option>";
				while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
					$category_id = $row_category['id'];
					$category_name = $row_category['name'];

					if($blog->category_id == $category_id){
						echo "<option value='$category_id' selected>";
					} else {
						echo "<option value='$category_id'>";
					}

					echo "$category_name</option>";
				}

				echo "</select>";
				?>
			</td>
		</tr>
			<td>Photo</td>
			<td>
				<?php if (!empty($blog->image) && $blog->image) {
					$src = $blog->image;
	        		echo '<img src="uploads/' . $src . '" style="width:250px;" />';
	        	} else {
	        		echo '<img src="uploads/no_image.png" style="width:250px;" />';
				} ?>
				
				<input type="file" name="image" />
	    	</td>
		<tr>
			<td></td>
			<td>
				<button type="submit" class="btn btn-primary">Update</button>
			</td>
		</tr>

	</table>
</form>