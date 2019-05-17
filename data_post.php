<?php include("header.php");

error_reporting(E_ALL ^ E_NOTICE);

?>

<div class="container" id="page">

<?php

 $page = $mysqli->escape_string($_GET["page"]);
 $start = ($page - 1) * 9;

    $sql_posts = $mysqli->query("SELECT * FROM mp_posts WHERE active=1 ORDER BY id DESC LIMIT $start, 9");
    
    $NumResults = mysqli_num_rows($sql_posts);
    
    if($NumResults<1){ 
    
?>
    
<div class="no-lisings">No posts to display at the moment. Please check back again soon.</div>

    <?php }

    while($row = mysqli_fetch_array($sql_posts))
    {
        $long = $row['description'];
        $strd = strlen ($long);
        if ($strd > 290) {
        $dlong = substr($long,0,287).'...';
        }else{
        $dlong = $long;}
        
        $LongTitle = $row['title'];
        $strt = strlen ($LongTitle);
        if ($strt > 100) {
        $tlong = substr($LongTitle,0,97).'...';
        }else{
        $tlong = $LongTitle;}
        
        $PageLink = $row['link'];
        $date = $row['date'];

?>

<article class="blog-item ng-scope wow fadeIn animation-off-mobile">

<div class="image" style="float: left; "><a href="view_post.php?link=<?php echo $PageLink; ?>"><img ng-src="timthumb.php?src=http://<?php echo $settings['siteurl'];?>/images/<?php echo $row['image'];?>" alt="<?php echo $LongTitle;?>" src="timthumb.php?src=https://<?php echo $settings['siteurl'];?>/images/<?php echo $row['image'];?>&amp;h=178&amp;w=300&amp;q=100"></a></div>

<div class="blog-item-header" style="float: left; padding-right: 10px"><h3><a href="view_post.php?link=<?php echo $PageLink; ?>" class="ng-binding"><?php echo $tlong;?>
</a></h3>

<div class="intro ng-binding" style="font-size: 14px; line-height: 1.75em;"><?php echo strip_tags($dlong);?></div>

<div class="intro published-date ng-binding"><?php echo $date; ?>

</div></div></article>

<?php }?>

</div> <!-- container -->

<?php include("footer.php"); ?> 