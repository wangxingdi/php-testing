<?php include("header.php");
error_reporting(E_ALL ^ E_NOTICE);
$term = $mysqli->escape_string(trim($_GET['term']));
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

<div class="search-title topmargin"><h1>Search Results for “<?php echo $term;?>” </h1></div>

<script>
$(document).ready(function() {

$('.col-link').hover(function(){

        $(this).parent().find('.col-share').stop().animate({width: '90px'}, 300)
    }, function(){
        $(this).parent().find('.col-share').stop().animate({width: '-0'}, 300)
  });
  
     $('.col-share').hover(function(){

        $(this).stop().animate({width: '90px'}, 300)
    }, function(){
        $(this).stop().animate({width: '-0'}, 300)
  });
});

$(function() {
$(".saves").click(function() 
{
var id = $(this).data("id");
var name = $(this).data("name");
var dataString = 'id='+ id ;
var parent = $(this);

if (name=='save')
{
$(this).fadeIn(200).html;
$.ajax({
type: "POST",
url: "save_lists.php",
data: dataString,
cache: false,

success: function(html)
{
parent.html(html);
}
});
}
return false;
});
});

$(function() {
$(".save-list").click(function() 
{
var id = $(this).data("id");
var name = $(this).data("name");
var dataString = 'id='+ id ;
var parent = $(this);

if (name=='save')
{
$(this).fadeIn(200).html;
$.ajax({
type: "POST",
url: "save_lists.php",
data: dataString,
cache: false,

success: function(html)
{
parent.parent().parent().parent().find(".saves").html(html);
}
});
}
return false;
});
});
</script>

<?php


  $result = $mysqli->query("SELECT * FROM mp_products WHERE (product_name like '%$term%' OR product_description like '%$term%') AND product_state='1' ORDER BY product_id DESC LIMIT 0, 27");
  
  $NumResults = mysqli_num_rows($result);
  
  if($NumResults<1){ 
  
?>
    
<div class="no-results">
  <h3>Your search for "<span class="tt-text"><?php echo $term;?></span>" did not produce any results</h3>
  <ul class="search-again">
  <li>Make sure all words are spelled correctly</li>
  <li>Try different keywords</li>
  <li>Try more general keywords</li>
  </ul>
  </div>

    <?php }
  
  while($row = mysqli_fetch_array($result))
    {
      $listing_id = $row['id'];
      $long = $row['discription'];
      $strd = strlen ($long);
      if ($strd > 140) {
      $dlong = $long;
      }else{
      $dlong = $long;}
      
      $LongTitle = $row['title'];
      $strt = strlen ($LongTitle);
      if ($strt > 40) {
      $tlong = substr($LongTitle,0,37).'...';
      }else{
      $tlong = $LongTitle;}
      
      $PageLink = $row['pname'];
      $view_count = $row['views'];
?>

<div <?php if($count>3){ echo "class='col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeIn animation-off-mobile'";}else{echo "class='col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box'";} ?> style="padding-left:15px; padding-right:15px;">

<a href="<?php echo $PageLink;?>/"><h2><?php echo $tlong;?></h2></a>

<div class="col-holder">
<a class="col-link" href="<?php echo $row['product_affiliate_url'];?>" target="_blank">
    <img class="img-responsive" src="../cache/timthumb.php?src=./images/<?php echo $row['product_image']; ?>&amp;h=250&amp;w=300&amp;q=100" alt="<?php echo $LongTitle; ?>">
</a>
<div class="col-share">
<?php if(!isset($_SESSION['username'])){?>
<a class="btn btn-default btn-lg btn-danger btn-font" onclick="openLogin()"><?php echo $txt_save; ?></a>
<?php }else{

$user_sql=$mysqli->query("SELECT * FROM mp_saves WHERE product_id='$listing_id' AND user_id='$user_id'");

$count_save=mysqli_num_rows($user_sql);

$user_sql->close();

if($count_save==1)
{ ?>
 <a class="btn btn-default btn-lg btn-danger btn-font save-list remove-list" id="<?php echo $listing_id;?>" data-id="<?php echo $listing_id;?>" data-name="save"><?php echo $txt_remove; ?></a>
<?php
}else { ?>
<a class="btn btn-default btn-lg btn-danger btn-font save-list" id="<?php echo $listing_id;?>" data-id="<?php echo $listing_id;?>" data-name="save"><?php echo $txt_save; ?></a>
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
<span class="info-price"><h3><?php echo $ActiveSymbol; ?><?php echo $row['price'];?></h3></span>
<?php if(!isset($_SESSION['username'])){?>
<span class="info-saves"><a class="saves" onclick="openLogin()"><span class="fas fa-heart"></span> &nbsp;<?php echo $row['saves'];?> saves</a></span>
<?php }else{
  if($count_save==1)
  { ?>
    <span class="info-saves"><a class="saves remove-save" id="save-<?php echo $listing_id;?>" data-id="<?php echo $listing_id;?>" data-name="save" title="You have saved this. Click to remove."><span class="fas fa-heart"></span> &nbsp;<?php echo $row['saves'];?> saves</a></span>
<?php  
  }
  else
  { ?>
    <span class="info-saves"><a class="saves" id="save-<?php echo $listing_id;?>" data-id="<?php echo $listing_id;?>" data-name="save" title="Click to save this item."><span class="fas fa-heart"></span> &nbsp;<?php echo $row['saves'];?> saves</a></span>
<?php  
  }  
 }?> 
<span class="info-saves"> &nbsp;<i class="fas fa-eye"></i>&nbsp;&nbsp;<?php echo $view_count; ?> views</span>

</div>
<div class="col-right">
<a class="btn btn-default btn-warning pull-right btn-font btn-checkout" href="spe_link.php?id=<?php echo $row['id'];?>" target="_blank"><?php echo $settings['buy_button'];?></a>
</div>
</div><!-- /.col-bottom -->

</div><!-- /.col-box -->

<?php }?>

<nav id="page-nav"><a href="data_search.php?page=2&term=<?php echo $term;?>"></a></nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.1.0/jquery.infinitescroll.min.js"></script>
    <script>
    
        $('#display-posts').infinitescroll({
        navSelector  : '#page-nav',    // selector for the paged navigation 
        nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
        itemSelector : '.col-box',  
        checkLastPage:  true,  
        prefill : true,
        scrollThreshold: 100,
        hideNav : '#page-nav',
        loading: {
                        finishedMsg: 'No more posts to load.',
                        img: 'assets/ajaxloader.gif'
    }
    }, function(newElements, data, url){
        
           $('.col-link-data').hover(function(){

        $(this).parent().find('.col-share-data').stop().animate({width: '90px'}, 300)
    }, function(){
        $(this).parent().find('.col-share-data').stop().animate({width: '-0'}, 300)
  });
  
     $('.col-share-data').hover(function(){

        $(this).stop().animate({width: '90px'}, 300)
    }, function(){
        $(this).stop().animate({width: '-0'}, 300)
  });

$(".saves-data").unbind( "click" );      
$(function() {
$(".saves-data").click(function() 
{
var id = $(this).data("id");
var name = $(this).data("name");
var dataString = 'id='+ id ;
var parent = $(this);

if (name=='save')
{
$(this).fadeIn(200).html;
$.ajax({
type: "POST",
url: "save_lists.php",
data: dataString,
cache: false,

success: function(html)
{
parent.html(html);
}
});
}
return false;
});
});

$(".save-list-data").unbind( "click" );  
$(function() {
$(".save-list-data").click(function() 
{
var id = $(this).data("id");
var name = $(this).data("name");
var dataString = 'id='+ id ;
var parent = $(this);

if (name=='save')
{
$(this).fadeIn(200).html;
$.ajax({
type: "POST",
url: "save_lists.php",
data: dataString,
cache: false,

success: function(html)
{
parent.parent().parent().parent().find(".saves-data").html(html);
}
});
}
return false;
});
}); 
        
    }); 

</script>

</div><!-- /.container -->

<?php include("footer.php"); ?> 

<script type="text/javascript">
  function openLogin()
  {
    window.location = "../login/";
  }
</script>