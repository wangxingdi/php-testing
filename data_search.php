<?php include("header.php");
error_reporting(E_ALL ^ E_NOTICE);
$term = $mysqli->escape_string($_GET['term']);
$user_id = $_SESSION['user_id'];
if($sql = $mysqli->query("SELECT * FROM mp_options WHERE id=1"))
 {

  $ActiveRow2 = mysqli_fetch_array($sql);
  $symbol = stripslashes($ActiveRow2['price_symbol']);
  $strActive = strlen ($symbol);
  if ($strActive > 4) {
  $ActiveSymbol = substr($symbol,0,4).'...';
  }else{
  $ActiveSymbol = $symbol;}
  $txt_save = $ActiveRow2['txt_save'];
  $txt_remove = $ActiveRow2['txt_remove'];
}
else
{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again</div>");;
} 
?>
<div class="container container-pull" id="display-posts">
<?php
$page = $_GET["page"];
$start = ($page - 1) * 27;
$result = $mysqli->query("SELECT * FROM mp_products WHERE (product_name like '%$term%' OR product_description like '%$term%') AND product_state='1' ORDER BY product_id DESC LIMIT $start, 27");
$NumResults = mysqli_num_rows($result);
if($NumResults<1){   
?>
<div class="no-lisings">No listings to display at the moment. Please check back again soon.</div>
<?php }  
  while($row = mysqli_fetch_array($result))
    {
        $listing_id = $row['product_id'];
        $long = $row['product_description'];
        $strd = strlen ($long);
        if ($strd > 140) {
        $dlong = $long;
        }else{
        $dlong = $long;} 
        $LongTitle = $row['product_name'];
        $strt = strlen ($LongTitle);
        if ($strt > 40) {
        $tlong = substr($LongTitle,0,37).'...';
        }else{
        $tlong = $LongTitle;}
        $PageLink = $row['product_permalink'];
        $view_count = $row['product_views'];
?>
<div class="col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeIn animation-off-mobile" style="padding-left:15px; padding-right:15px;">
<a href="<?php echo $PageLink;?>/"><h2><?php echo $tlong;?></h2></a>
<div class="col-holder">
<a class="col-link col-link-data" href="offer_link.php?id=<?php echo $row['product_id'];?>" target="_blank">
    <img class="img-responsive" src="../cache/timthumb.php?src=./images/<?php echo $row['product_image']; ?>&amp;h=250&amp;w=300&amp;q=100" alt="<?php echo $LongTitle; ?>">
</a>
<div class="col-share col-share-data">
<?php if(!isset($_SESSION['username'])){?>
<a class="btn btn-default btn-lg btn-danger btn-font" onclick="openLogin()"><?php echo $txt_save; ?></a>
<?php }else{
$user_sql=$mysqli->query("SELECT * FROM mp_saves WHERE listing_id='$listing_id' AND user_id='$user_id'");
$count_save=mysqli_num_rows($user_sql);
$user_sql->close();
if($count_save==1)
{ ?>
 <a class="btn btn-default btn-lg btn-danger btn-font save-list-data remove-list" id="<?php echo $listing_id;?>" data-id="<?php echo $listing_id;?>" data-name="save"><?php echo $txt_remove; ?></a>
<?php
}else { ?>
<a class="btn btn-default btn-lg btn-danger btn-font save-list-data" id="<?php echo $listing_id;?>" data-id="<?php echo $listing_id;?>" data-name="save"><?php echo $txt_save; ?></a>
<?php
}
} ?>
<a class="btn-share btn-fb fab fa-facebook-f" href="javascript:void(0);" onclick="popup('https://www.facebook.com/share.php?u=<?php echo $protocol . $settings['siteurl'];?>/<?php echo $PageLink;?>/&amp;title=<?php echo urlencode(ucfirst($LongTitle));?>')"></a>
<a class="btn-share btn-twitter fab fa-twitter" href="javascript:void(0);" onclick="popup('https://twitter.com/home?status=<?php echo urlencode(ucfirst($LongTitle));?>+<?php echo $protocol . $settings['siteurl'];?>/<?php echo $PageLink;?>/')"></a>
<a class="btn-share btn-pin fab fa-pinterest" href="javascript:void(0);" onclick="popup('//pinterest.com/pin/create%2Fbutton/?url=<?php echo $protocol . $settings['siteurl'];?>/<?php echo $PageLink;?>/')"></a>
</div>
</div><!-- /.col-holder-->
<p><?php echo $dlong;?></p>
<div class="col-bottom col-bottom-mod">
<div class="col-left">
<span class="info-price"><h3><?php echo $ActiveSymbol; ?><?php echo $row['product_price'];?></h3></span>
<?php if(!isset($_SESSION['username'])){?>
<span class="info-saves"><a class="saves" onclick="openLogin()"><span class="fas fa-heart"></span> &nbsp;<?php echo $row['product_saves'];?> saves</a></span>
<?php }else{
  if($count_save==1)
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
 <span class="info-saves"> &nbsp;<i class="fas fa-eye"></i>&nbsp;&nbsp;<?php echo $view_count; ?> views</span>
</div>
<div class="col-right">
<a class="btn btn-default btn-warning pull-right btn-font btn-checkout" href="offer_link.php?id=<?php echo $row['product_id'];?>" target="_blank"><?php echo $settings['buy_button'];?></a>
</div>
</div><!-- /.col-bottom -->
</div><!-- /.col-box -->
<?php }?>
</div><!-- /.container -->
<?php include("footer.php"); ?> 