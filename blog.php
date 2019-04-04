<?php include("header_blog.php");
error_reporting(E_ALL ^ E_NOTICE);
?>
<div class="container" id="page" style="margin-top: 70px;"><div id="view" class="ng-scope ready"><div class="row ng-scope"><h1 class="recent">RECENT ARTICLES</h1><div class="blog">
    <?php
    $sql_posts = $mysqli->query("SELECT * FROM posts WHERE active=1 ORDER BY id DESC LIMIT 0, 9");
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
<article class="col-md-12 blog-item ng-scope wow fadeIn animation-off-mobile"><div class="image" style="float: left; "><a href="blog/<?php echo $PageLink; ?>/"><img class="img-responsive" alt="<?php echo $LongTitle;?>" src="uploaded_images/resizer/300x178/r/<?php echo $row['image'];?>"></a></div><div class="blog-item-header" style="float: left; padding-right: 10px"><h3 style="text-transform: uppercase;"><a href="blog/<?php echo $PageLink; ?>/" class="ng-binding"><?php echo $tlong;?></a></h3><div class="intro ng-binding" style="font-size: 14px; line-height: 1.75em;"><?php echo strip_tags($dlong);?></div><div class="intro published-date ng-binding"><?php echo $date; ?></div></div></article>
<?php }?>
<nav id="page-nav"><a href="data_post.php?page=2"></a></nav>
<script src="js/jquery.infinitescroll.min.js"></script>
<script>$(".blog").infinitescroll({navSelector:"#page-nav",nextSelector:"#page-nav a",itemSelector:".blog-item",loading:{finishedMsg:"No more posts to load.",img:"templates/default/images/loader.gif"}},function(t,a,i){$(".col-link").hover(function(){$(this).parent().find(".col-share").stop().animate({width:"90px"},300)},function(){$(this).parent().find(".col-share").stop().animate({width:"-0"},300)}),$(".col-share").hover(function(){$(this).stop().animate({width:"90px"},300)},function(){$(this).stop().animate({width:"-0"},300)}),$(".saves").unbind("click"),$(function(){$(".saves").click(function(){var t=$(this).data("id"),a=$(this).data("name"),i="id="+t,e=$(this);return"save"==a&&($(this).fadeIn(200).html,$.ajax({type:"POST",url:"save_lists.php",data:i,cache:!1,success:function(t){e.html(t)}})),!1})}),$(".save-list").unbind("click"),$(function(){$(".save-list").click(function(){var t=$(this).data("id"),a=$(this).data("name"),i="id="+t,e=$(this);return"save"==a&&($(this).fadeIn(200).html,$.ajax({type:"POST",url:"save_lists.php",data:i,cache:!1,success:function(t){e.parent().parent().parent().find(".saves").html(t)}})),!1})})});</script>
</div><!-- blog -->
</div><!-- row -->
</div> <!-- view -->
</div> <!-- container -->
<?php include("footer.php"); ?> 
<style class="ng-scope">
.blog .blog-item h3,.intro{margin-left:10px;float:left;margin-top:10px}header{background:#fff}body{background:#f4f4f4}.main-footer-mod{position:relative}.main-footer{height:75px}#page{margin-bottom:140px}.blog-item{width:100%;background:#fff;box-shadow:0 2px 1px rgba(0,0,0,.1);border-radius:3px}article img{border:none}.blog-item .image{width:30%}article h3 a{color:#3f3f3f}.blog .blog-item h3{display:block;text-align:left;font-size:22px}.intro{color:#666!important}.published-date{font-size:12px}.blog-item-header{width:70%}@media(max-width:860px){.intro{font-size:10px}}@media(max-width:770px){.intro{display:none}}@media(max-width:560px){.blog-item-header{width:60%}.blog-item .image{width:40%}.blog .blog-item h3{font-size:18px}}
</style>