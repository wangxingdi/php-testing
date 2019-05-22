<?php include("header.php");

error_reporting(E_ALL ^ E_NOTICE);

$user = $mysqli->escape_string($_GET['user']);

?>

<div class="container container-pull" id="display-posts">
<?php

$page = $_GET["page"];
$start = ($page - 1) * 9;


  $result = $mysqli->query("SELECT * FROM saves LEFT JOIN listings ON saves.listing_id=listings.id WHERE saves.user_id=$user ORDER BY saves.save_id DESC LIMIT $start, 9");

  
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

<div class="col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeInUp">

<div class="col-holder">

<a class="remove-product fa fa-remove" data-id="<?php echo $row['id'];?>" data-name="remove-save"></a>

<a href="<?php echo $PageLink;?>/">
<img class="img-responsive" src="images/resizer/500x500/r/<?php echo $row['image'];?>" alt="<?php echo $LongTitle;?>">
</a>

<a href="<?php echo $PageLink;?>/"><h2 class="title-bottom"><?php echo $tlong;?></h2></a>

</div><!-- /.col-holder-->

</div><!-- /.col-box -->

<?php }?>

</div><!-- /.container -->

<?php include("footer.php"); ?> 