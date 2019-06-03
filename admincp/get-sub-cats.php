<?php include("../db.php"); ?>

<label for="category-sub">Sub Category [OPTIONAL]</label>
<select name="category-sub" class="form-control" id="category-sub">
<option value="0">Select a Sub Category</option>
<?php
if($_POST)
{
	$parent = $_POST['parent'];

	if($sql = $mysqli->query("SELECT * FROM mp_categories WHERE is_sub_cat=1 AND parent_id = '$parent'"))
	{
		while ($sqlRow = mysqli_fetch_array($sql))
		{?>   
  			<option value="<?php echo $sqlRow['category_id'];?>"><?php echo $sqlRow['cname'];?></option>
<?php   }
	$sql->close();
 	}
 	else
 	{
    	printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");;
	}
}?>
</select>