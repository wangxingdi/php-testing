<?php include("header_listing.php");

error_reporting(E_ALL ^ E_NOTICE);

?>

<div style="margin-bottom: 20px;" class="container" id="page" ng-class="{large: $root.large_container, nomargin: $root.hide_header}"><!-- ngView: --><div ng-view="" store-last-url="" ng-hide="status_code == 404" id="view" ng-class="ready == true ? 'ready' : ''" ng-app="ngAnimate" class="ng-scope"><style class="ng-scope">h1{
    margin-top: 20px;
}</style>

<div class="blog-post ng-scope">
  <h1 class="blog-title ng-binding post-title"><?php echo $pageTitle; ?></h1>
  <div class="intro ng-binding"><?php echo $post_desc; ?></div>
</div>

<div class="blog-right ng-scope">
    
    <h1>Recent Articles</h1>

<?php
    $posts_sql = $mysqli->query("SELECT * FROM mp_posts WHERE active=1 ORDER BY id DESC LIMIT 20");
    while($posts_row = mysqli_fetch_array($posts_sql))
    {
        
        $tlong = $posts_row['title'];   
        $PostLink = $posts_row['link'];
        $image = $posts_row['image'];

?>

    <article class="blog-item ng-scope" ng-repeat="post in blogPosts"><div class="image"><a href="blog/<?php echo $PostLink; ?>/"><img alt="<?php echo $tlong; ?>" src="uploads/resizer/300x178/r/<?php echo $image;?>"></a></div><h3><a href="blog/<?php echo $PostLink; ?>/" class="ng-binding"><?php echo $tlong; ?></a></h3></article><!-- end ngRepeat: post in blogPosts -->

<?php } ?>

</div>

<div class="ng-hide" ng-hide="status_code != 404"><!-- ngIf: status_code == 404 --><!-- ngIf: status_code == 404 --></div><noscript><h1 style="font-size: 32px" id="not-found-error">Please enable or upgrade to a browser that supports javascript.</h1></noscript></div>

</div> <!-- container -->

<?php include("footer.php"); ?> 

<?php
 
 if($settings['addthisFilter'] == '2')
 {
  echo $settings['addthis'];
 }

?>