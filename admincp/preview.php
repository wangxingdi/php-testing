<?php
include("../db.php");
if ($options_result_set = $mysqli->query("SELECT * FROM mp_options WHERE id='1'")) {
    $options_row = mysqli_fetch_array($options_result_set);
    $SiteLink = $options_row['siteurl'];
    $options_result_set->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}
$id = $mysqli->escape_string($_GET['id']);
if ($products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_id=$id LIMIT 1")) {
    $products_row = mysqli_fetch_array($products_result_set);
    $category_id = $products_row['category_id'];
//	    $UserId = $products_row['uid'];
//      $categories_result_set =  $mysqli->query("SELECT category_name FROM mp_categories WHERE category_id=$category_id LIMIT 1");
//	    $Crow = mysqli_fetch_array($categories_result_set);
    $LongDisc = $products_row['product_discription'];
    $StrDisc = strlen($LongDisc);
    if ($StrDisc > 275) {
        $DsicLong = substr($LongDisc, 0, 275) . '...';
    } else {
        $DsicLong = $LongDisc;
    }
    $ProductTitle = $products_row['title'];
    $PageLink = preg_replace("![^a-z0-9]+!i", "-", $ProductTitle);
    $PageLink = strtolower($PageLink);
    $products_result_set->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");;
}
if (false) {
    $Username = "Admin ('You')";
} else {
//Get user info
    /*$Uname = $_SESSION['username'];
    if($UserSql = $mysqli->query("SELECT * FROM users WHERE user_id='$UserId'")){
        $UserRow = mysqli_fetch_array($UserSql);
        $CountUsers = $UserSql->num_rows;
        $UserSql->close();
    }else{
         printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
    }
    if($CountUsers==0){
        $Username = "User no longer exist (Deleted)";
    }else{
        $Username = $UserRow['username'];
    }*/
}
if ($categories_result_set = $mysqli->query("SELECT * FROM mp_categories WHERE category_id='$catid' LIMIT 1")) {
    $categories_row = mysqli_fetch_array($categories_result_set);
    $categories_result_set->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><?php echo $ProductTitle; ?></h4>
</div>
<div class="modal-body">
    <img src="timthumb.php?src=http://<?php echo $SiteLink; ?>/images/<?php echo $row['image']; ?>&amp;h=550&amp;w=650&amp;q=100"
         data-src="http://<?php echo $SiteLink; ?>/images/<?php echo $row['image']; ?>" alt="<?php echo $FeatTitle; ?>"
         class="img-responsive slide-img">
    <p class="col-description"><?php echo $DsicLong; ?></p>
    <div class="col-info"><h1>&#36;<?php echo $row['price']; ?></h1></div>
    <div class="col-info"><strong>By:</strong> <?php echo $Username; ?><br/>
        <strong>Category:</strong> <?php echo $categories_row['category_name']; ?> </div>
    <a class="btn btn-warning btn-block btn-lg btn-font btn-pull" href="../aff_link.php?id=<?php echo $row['id']; ?>"
       target="_blank"><?php echo $options_row['buy_button']; ?></a>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>