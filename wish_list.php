<?php include("header.php");

error_reporting(E_ALL ^ E_NOTICE);

$sort = $mysqli->escape_string($_GET['sort']);

?>

<div class="container container-pull" id="display-posts">


<script>
$(function() {
$(".remove-product").click(function() 
{
var id = $(this).data("id");
var name = $(this).data("name");
var dataString = 'id='+ id ;
var parent = $(this);
var deleteContainer = $(this).parent();

if (name=='remove-save')
{
$(this).fadeIn(200).html;
$.ajax({
type: "POST",
url: "save_lists.php",
data: dataString,
cache: false,

success: function(html)
{
deleteContainer.slideUp('slow', function() {$(this).remove();});
}
});
}
return false;
});
});

</script>

<div class="other-titles"><h1 style="margin-top:15px;">My Wish List</h1></div>

<?php
  $result = $mysqli->query("SELECT * FROM mp_saves LEFT JOIN mp_products ON mp_saves.product_id=mp_products.product_id WHERE mp_saves.user_id=$Uid ORDER BY mp_saves.save_id DESC LIMIT 0, 9");
  
  $NumResults = mysqli_num_rows($result);
  
  if($NumResults<1){ 
  
?>
    
<div class="no-lisings">Wish list is empty. Save your favorite products to see them here.</div>

    <?php }
  
  while($row = mysqli_fetch_array($result))
    {
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

?>

<div class="col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeIn">

<div class="col-holder">

<a class="remove-product fa fa-remove" data-id="<?php echo $row['id'];?>" data-name="remove-save"></a>

<a href="<?php echo $PageLink;?>/">
    <img class="img-responsive" src="../cache/timthumb.php?src=./images/<?php echo $row['product_image']; ?>&amp;h=500&amp;w=500&amp;q=100" alt="<?php echo $LongTitle;?>">
</a>

<a href="<?php echo $PageLink;?>/"><h2 class="title-bottom"><?php echo $tlong;?></h2></a>

</div><!-- /.col-holder-->

</div><!-- /.col-box -->

<?php }?>

<nav id="page-nav"><a href="data_wish_list.php?page=2&user=<?php echo $Uid;?>"></a></nav>

<script src="https://cdn.staticfile.org/jquery-infinitescroll/2.1.0/jquery.infinitescroll.min.js"></script>
  <script>
  
  
  $('#display-posts').infinitescroll({
    navSelector  : '#page-nav',    // selector for the paged navigation 
        nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
        itemSelector : '.col-box',     //
    loading: {
                  finishedMsg: 'No more posts to load.',
                  img: 'assets/ajaxloader.gif'
  }
  }, function(newElements, data, url){
    


$(".remove-product").unbind( "click" );   
$(function() {
$(".remove-product").click(function() 
{
var id = $(this).data("id");
var name = $(this).data("name");
var dataString = 'id='+ id ;
var parent = $(this);
var deleteContainer = $(this).parent();

if (name=='remove-save')
{
$(this).fadeIn(200).html;
$.ajax({
type: "POST",
url: "save_lists.php",
data: dataString,
cache: false,

success: function(html)
{
deleteContainer.slideUp('slow', function() {$(this).remove();});
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