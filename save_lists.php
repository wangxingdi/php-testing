<?php session_start();

include("db.php");

if($sql = $mysqli->query("SELECT * FROM mp_options WHERE id = 1"))
{
	$sqlRow = mysqli_fetch_array($sql);
	$txt_save = $sqlRow['txt_save'];
	$txt_remove = $sqlRow['txt_remove'];
	$sql->close();
}
else
{
	printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
}

if($_POST['id'])
{
$id=$_POST['id'];

//User Details

if(isset($_SESSION['username'])){
  
$Uname = $_SESSION['username'];

if($UserSql = $mysqli->query("SELECT * FROM mp_users WHERE user_name='$Uname'")){

    $UserRow = mysqli_fetch_array($UserSql);
    
  $_SESSION['user_id'] = $UserRow['user_id'];
  $Uid =  $_SESSION['user_id'];

  $UserSql->close();
}else{
  
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");

}

//End User Details


$id = $mysqli->escape_string($id);

//Verify IP address in favip table

$user_sql=$mysqli->query("SELECT user_id, listing_id FROM mp_saves WHERE listing_id='$id' AND user_id='$Uid'");

$count_of_save=mysqli_num_rows($user_sql);

if($count_of_save==0)
{ ?>
  
 <script>
 var id = '<?php echo $id; ?>';
 var txt_save = '<?php echo $txt_save; ?>';
 var txt_remove = '<?php echo $txt_remove; ?>';
 $('#' + id).addClass('remove-list');
 $('#' + id).text(txt_remove);
 $('#listing-' + id).addClass('remove-list');
 $('#listing-' + id).text(txt_remove);
 $('#wishlist-' + id).addClass('remove-list');
 $('#wishlist-' + id).text('REMOVE FROM WISHLIST');
 $('#save-' + id).addClass('remove-save');
 $('#save-' + id).attr("title", 'You have saved this. Click to remove.');
</script>

<?php 
// Update Vote.
$mysqli->query("UPDATE mp_products SET product_saves=product_saves+1 WHERE product_id='$id'");

// Insert IP address and Message Id in favip table.
$mysqli->query("INSERT INTO mp_saves (listing_id, user_id) values ('$id','$Uid')");

//disply results
$products_result_set=$mysqli->query("SELECT * FROM mp_products WHERE product_id='$id'");
$products_row=mysqli_fetch_array($products_result_set);
$product_saves=$products_row['product_saves'];

echo '<span class="fa fa-heart-o"></span> '.$product_saves.' saves</span>';

}else {

// Update Vote.
$mysqli->query("UPDATE mp_products SET product_saves=product_saves-1 WHERE product_id='$id'");

// Insert IP address and Message Id in favip table.
$mysqli->query("DELETE FROM mp_saves WHERE listing_id='$id' AND user_id='$Uid'");
?>

<script>
 var id = '<?php echo $id; ?>';
 var txt_save = '<?php echo $txt_save; ?>';
 var txt_remove = '<?php echo $txt_remove; ?>';
 $('#' + id).removeClass('remove-list');
 $('#' + id).text(txt_save);
 $('#listing-' + id).removeClass('remove-list');
 $('#listing-' + id).text(txt_save);
 $('#wishlist-' + id).removeClass('remove-list');
 $('#wishlist-' + id).text('ADD TO WISHLIST');
 $('#save-' + id).removeClass('remove-save');
 $('#save-' + id).attr("title", 'Click to save this item.');
</script>

<?php
$products_result_set=$mysqli->query("SELECT * FROM mp_products WHERE product_id='$id'");
$products_row=mysqli_fetch_array($products_result_set);
$product_saves=$products_row['product_saves'];

echo '<span class="fa fa-heart-o"></span> '.$product_saves.' saves</span>';
}
}
}
?>