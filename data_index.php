<?php include("header.php");
error_reporting(E_ALL ^ E_NOTICE);
$sort = $_SESSION['sort'];
$user_id = $_SESSION['user_id'];
?>
<div class="container container-pull" id="display-posts-main">
<?php
$page = $mysqli->escape_string($_GET['page']);
$start = ($page - 1) * 3;
  if ($sort=="n"){
    $sortpage = "newest";
  $result = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 ORDER BY product_id DESC LIMIT $start, 3");
  }else if ($sort=="p"){
    $sortpage = "popular";
  $result = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 ORDER BY views DESC LIMIT $start, 3");
  }else if ($sort=="l"){
    $sortpage = "low";
  $result = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 ORDER BY CAST(product_price AS DECIMAL(10,2)) ASC LIMIT $start, 3");
  }else if ($sort=="h"){
    $sortpage = "high";
  $result = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 ORDER BY CAST(product_price AS DECIMAL(10,2)) DESC LIMIT $start, 3");
  }else{
    $sortpage = "none";
  $result = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 ORDER BY product_id DESC LIMIT $start, 3");
  }
  $NumResults = mysqli_num_rows($result);
  if($NumResults<1){
?>
<div class="no-lisings alert alert-info">We're still searching for the best products for you. Please check back later!</div>
    <?php }
  while($row = mysqli_fetch_array($result))
    {
      $listing_id = $row['product_id'];
      $product_description = $row['product_description'];
      $product_name = $row['product_name'];
      $product_permalink = $row['product_permalink'];;
//      $product_views = $row['product_views'];
      $img_path = $row['product_external_link'];
      $upload_directory = 'images/';
      if(empty($img_path)){
          $img_path = $upload_directory . $row['product_image'];
      }
?>
<div class="col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeIn animation-off-mobile"  style="padding-left:15px; padding-right:15px;">
<a href="<?php echo $product_permalink;?>.html" target="_blank"><h2><?php echo $product_name;?></h2></a>
<div class="col-holder">
<a class="col-link col-link-data" href="<?php echo $row['product_affiliate_url'];?>" target="_blank">
    <img class="img-responsive" src=<?php echo $img_path; ?> alt="<?php echo $product_name; ?>">
</a>
<div class="col-share col-share-data">
<?php if(!isset($_SESSION['username'])){?>
<a class="btn btn-default btn-lg btn-danger btn-font btn-checkout" onclick="openLogin()"><?php echo $txt_save; ?></a>
<?php }else{
$user_sql=$mysqli->query("SELECT * FROM mp_saves WHERE listing_id='$listing_id' AND user_id='$user_id'");
$count_save_data=mysqli_num_rows($user_sql);
$user_sql->close();
if($count_save_data==1)
{ ?>
 <a class="btn btn-default btn-lg btn-danger btn-font save-list-data remove-list" id="<?php echo $listing_id;?>" data-id="<?php echo $listing_id;?>" data-name="save"><?php echo $txt_remove; ?></a>
<?php
}else { ?>
<a class="btn btn-default btn-lg btn-danger btn-font save-list-data" id="<?php echo $listing_id;?>" data-id="<?php echo $listing_id;?>" data-name="save"><?php echo $txt_save; ?></a>
<?php
}
} ?>
</div>
</div>
<div class="col-description"><p><?php echo $product_description;?></p></div>
<div class="col-bottom">
<div class="col-left">
<span class="info-price"><h3><?php echo $price_symbol; ?><?php echo $row['product_price'];?></h3></span>
<?php if(!isset($_SESSION['username'])){?>
<span class="info-saves"><a class="saves" onclick="openLogin()"><span class="fas fa-heart"></span> &nbsp;<?php echo $row['product_saves'];?> saves</a></span>
<?php }else{
  if($count_save_data==1)
  { ?>
    <span class="info-saves"><a class="saves-data remove-save" id="save-<?php echo $listing_id;?>" data-id="<?php echo $listing_id;?>" data-name="save" title="You have saved this. Click to remove."><span class="fas fa-heart"></span> &nbsp;<?php echo $row['product_saves'];?> saves</a></span>
<?php
  }
  else
  { ?>
    <span class="info-saves"><a class="saves-data" id="save-<?php echo $listing_id;?>" data-id="<?php echo $listing_id;?>" data-name="save" title="Click to save this item."><span class="fas fa-heart"></span> &nbsp;<?php echo $row['product_saves'];?> saves</a></span>
<?php
  }
 }?>
<!--<span class="info-saves"> &nbsp;-->
<!--    <i class="fas fa-eye"></i>&nbsp;&nbsp;--><?php //echo $product_views; ?><!-- views-->
<!--</span>-->
</div>
<div class="col-right">
<a class="btn btn-default btn-warning pull-right btn-font btn-checkout" href="<?php echo $row['product_affiliate_url'];?>" target="_blank"><?php echo $buy_button;?></a>
</div>
</div>
</div>
<?php }?>
</div>
<?php include("footer.php"); ?> a