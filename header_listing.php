<?php session_start();
include("db.php");
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
if($squ = $mysqli->query("SELECT * FROM settings WHERE id='1'")){
    $settings = mysqli_fetch_array($squ);
    $txt_home = $settings['txt_home'];
    $txt_all_cat = $settings['txt_all_cat'];
    $txt_popular = $settings['txt_popular'];
    $txt_gift_guides = $settings['txt_gift_guides'];
    $squ->close();
}else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");;
}
if(isset($_SESSION['username'])){  
$Uname = $_SESSION['username'];
if($UserSql = $mysqli->query("SELECT * FROM users WHERE username='$Uname'")){
  $UserRow = mysqli_fetch_array($UserSql);
  $UsName = strtolower($UserRow['username']);
  $_SESSION['user_id'] = $UserRow['user_id'];
  $Uid =  $_SESSION['user_id'];
  $UserEmail = $UserRow['email'];
  $UserSql->close();
}else{
  printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>"); 
}
}
if($AdsSql = $mysqli->query("SELECT * FROM siteads WHERE id='1'")){
  $AdsRow = mysqli_fetch_array($AdsSql);
  $Ad1 = stripslashes($AdsRow['ad1']);
  $Ad2 = stripslashes($AdsRow['ad2']);
  $Ad3 = stripslashes($AdsRow['ad3']);
  $AdsSql->close();
}else{
  printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
}
if(isset($_GET['pname']))
{
  $id = $mysqli->escape_string($_GET['pname']);
  if($result = $mysqli->query("SELECT * FROM listings WHERE pname='$id' LIMIT 1"))
  {  
    if(mysqli_num_rows($result)<1)
    {
     http_response_code(404);
     include('404.php');
     die();
    }
    else
    {
      $row = mysqli_fetch_array($result);
      $listing = $row['id'];
      $catid = $row['cname'];
      $GetCname =  $mysqli->query("SELECT cname FROM categories WHERE cname2='$catid' LIMIT 1");  
      $Crow = mysqli_fetch_array($GetCname);
      $pageTitle = $row['title'];
      $image = $row['image'];
      $LongDisc = $row['discription'];
      $StrDisc = strlen ($LongDisc);
      if ($StrDisc > 243) {
      $DsicLong = $LongDisc;
      }else{
      $DsicLong = $LongDisc;}
      $MetaDescription = $row['meta_description'];
      $PageLink = $row['pname'];
      $view_count = $row['views'];
      $mysqli->query("UPDATE listings SET views=views+1 WHERE pname='$id'");
      $user_sql_listing=$mysqli->query("SELECT * FROM saves WHERE listing_id='$listing' AND user_id='$Uid'");
      $count_save_listing=mysqli_num_rows($user_sql_listing);
      $user_sql_listing->close();
    }
    $result->close();
  }else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");;
  }
}
//for blog posts
if(isset($_GET['link']))
{
 $post = $mysqli->escape_string($_GET['link']);
  if($sql_post = $mysqli->query("SELECT * FROM posts WHERE link='$post' LIMIT 1"))
  {
   if(mysqli_num_rows($sql_post)<1)
   {
    http_response_code(404);
    include('404.php');
    die();
   } 
   else
   {
    $post_row = mysqli_fetch_array($sql_post);
    $pageTitle = $post_row['title'];
    $post_desc = $post_row['description'];
    $image = $post_row['image']; 
    $MetaDescription = $post_row['meta_description'];
    $PageLink = $post_row['link'];
   } 
   $sql_post->close();
  }
  else
  {
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
  }
}
//Tot Site Views
$mysqli->query("UPDATE settings SET site_hits=site_hits+1 WHERE id='1'");
  $symbol = stripslashes($settings['price_symbol']);
  $strActive = strlen ($symbol);
  if ($strActive > 4) {
  $ActiveSymbol = substr($symbol,0,4).'...';
  }else{
  $ActiveSymbol = $symbol;}
?>
<!doctype html>
<html>
<head>
<base href="<?php echo $protocol . $settings['siteurl']; ?>/" />
<meta charset="utf-8">
<title><?php echo $pageTitle;?> | <?php echo $settings['name']; ?></title>
<meta name="description" content="<?php echo strip_tags($MetaDescription); ?>" />
<meta name="keywords" content="<?php echo $settings['keywords']; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Facebook Meta Tags-->
<meta property="fb:app_id"          content="<?php echo $settings['fbapp']; ?>" /> 
<meta property="og:url"             content="<?php echo $protocol . $settings['siteurl']; ?>/<?php echo $PageLink;?>/" /> 
<meta property="og:title"           content="<?php echo $pageTitle;?> | <?php echo $settings['name']; ?>" />
<meta property="og:description"   content="<?php echo strip_tags($MetaDescription); ?>" /> 
<meta property="og:image"           content="<?php echo $protocol . $settings['siteurl'];?>/images/<?php echo $image;?>" />
<!--End Facebook Meta Tags-->
<!--Twitter Meta Tags-->
<meta name="twitter:card" content="summary_large_image" />
<meta property="og:image" content="<?php echo $protocol . $settings['siteurl'];?>/images/<?php echo $image;?>?'.uniqid().'" />
<meta property="og:url" content="<?php echo $protocol . $settings['siteurl']; ?>/<?php echo $PageLink;?>/" />
<meta property="og:title" content="<?php echo $pageTitle;?> | <?php echo $settings['name']; ?>" />
<meta property="og:description" content="<?php echo strip_tags($MetaDescription); ?>" />
<!--End Twitter Meta Tags-->
<link href="https://rawcdn.githack.com/img0/tijwiw/870f118a17c9e60c5739dc046fc5405b70913045/config/logo/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
<link href="templates/default/css/main.php" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="cv-top-overlay"></div>
<header id="masthead">
<div id="nav-container"><div class="nav-accent nav-accent-left" ng-hide="hide_header"></div><div class="nav-accent nav-accent-right" ng-hide="hide_header"></div><div id="logo"><span id="search-bar"><form class="search-form" role="search" name="srch-term" method="get" action="search.php" ng-controller="SearchPartialCtrl"><fieldset class="searchbox"><i class="fa fa-search"></i><input class="elasticsearch" name="term" type="text" autocomplete="off" placeholder="Search..." ng-change="search(term)" ng-model="term"></fieldset></form></span><a class="auto-localize" id="center-logo" href="<?php echo $protocol . $settings['siteurl']; ?>" target="_self"><img src="assets/logo.png" alt="<?php echo $settings['name']; ?>"></a>
<!-- LOGIN/REGISTRATION START -->
<!-- MOBILE LOGIN START -->
<div><ul class="navbar-nav navbar-right user-icon"><li id="dropdown" class="dropdown">
    <?php if(!isset($_SESSION['username'])){?>
      <a onclick="changeColor()" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span><i class="fa fa-user mobile-user-button" style="font-size: 14px;padding: .5rem 1rem;border-radius: 5px;"></i></span></a>
      <ul class="dropdown-menu" role="menu"><li><a href="login/"><i style="padding-right: 5px;" class="fas fa-sign-in-alt"></i>Log In</a></li><li><a href="register/"><i style="padding-right: 5px;" class="fas fa-user-plus"></i>Register</a></li>
        <?php }else{ ?>
        <li class="dropdown"><a style="color:green;" onclick="changeColor()" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span><i class="fa fa-user mobile-user-button" style="font-size: 14px;padding: .5rem 1rem;border-radius: 5px;"></i></span></a><ul class="dropdown-menu" role="menu">
            <li><a href="wish_list/"><span class="fa fa-heart"></span>&nbsp; Wish List</a></li>
            <li><a href="profile/"><span class="fa fa-user"></span>&nbsp; My Profile</a></li>
            <li class="divider"></li>
            <li><a href="logout/"><span class="fa fa-unlock-alt"></span>&nbsp; Logout</a></li>
          </ul></li>
        <?php } ?>
          </ul></li>
    </ul>
</div>
<!-- MOBILE LOGIN END -->
<!-- DESKTOP LOGIN START -->
<ul id="navbarRight" class="navbar-nav navbar-right"> 
  <?php if(!isset($_SESSION['username'])){?>
    <li><a href="login/">Log In</a> | <a href="register/">Register</a></li>
        <?php }else{ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Account <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="wish_list/"><span class="fa fa-heart remove-mobile"></span>&nbsp; Wish List</a></li>
            <li><a href="profile/"><span class="fa fa-user remove-mobile"></span>&nbsp; My Profile</a></li>
            <li class="divider"></li>
            <li><a href="logout/"><span class="fa fa-unlock-alt remove-mobile"></span>&nbsp; Logout</a></li>
          </ul>
        </li>
        <?php } ?>
      </ul>  
      <!-- DESKTOP LOGIN END--->    
</div> <!-- HEADER SECTION END -->
<!-- LOGIN/REGISTRATION END -->
<nav class="nav" id="menu" ng-hide="hide_header"> <!-- MAIN MENU START -->
<button class="navtoggle" type="button" id="menutoggle" aria-hidden="true"><i class="fa fa-bars"></i></button>
<ul><li><a class="auto-localize" href="<?php echo $protocol . $settings['siteurl']; ?>" target="_self"><span class="icon"><i class="fa fa-home"></i></span><span><?php echo $txt_home; ?></span></a></li>
<?php
if($FeatCatSql = $mysqli->query("SELECT * FROM categories WHERE featured = 1 ORDER BY show_order ASC")){
    while($FeatCatRow = mysqli_fetch_array($FeatCatSql)){    
    $FeatCatName = $FeatCatRow['cname'];
    $FeatCatUrl = $FeatCatRow['cname2'];
    $FeatCatIcon = $FeatCatRow['icon'];
?>    
  <li><a class="auto-localize" href="category/<?php echo $FeatCatUrl;?>/"><span class="icon"><?php echo $FeatCatIcon; ?></span><span><?php echo $FeatCatName;?></span></a></li>
              <?php
}$FeatCatSql->close(); 
}else{
   printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
}
?>
<li class="dropdown"><a><span class="icon"><i class="fa fa-bars"></i></span><span><?php echo $txt_all_cat; ?></span></a><div class="dropdown-content">
<?php
if($CatSql = $mysqli->query("SELECT * FROM categories WHERE is_sub_cat = 0 AND featured = 0 ORDER BY show_order ASC")){
  while($CatRow = mysqli_fetch_array($CatSql)){  
    $CatName = $CatRow['cname'];
    $CatUrl = $CatRow['cname2'];
?>  
  <a class="auto-localize" href="category/<?php echo $CatUrl;?>/"><?php echo $CatName;?></a>
  <?php
}$CatSql->close(); 
}else{
  printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
}
?>
<a style="border-top: 1px solid rgba(0,0,0,0.2);" class="auto-localize" href="blog/"><i style="padding: 0 7px 0 0;font-size: 18px;" class="fas fa-book-reader"></i>Blog</a>
<a style="border-top: 1px solid rgba(0,0,0,0.2);" class="auto-localize" href="contact_us/"><i style="padding: 0 7px 0 0;font-size: 18px;" class="fas fa-envelope"></i>Contact Us</a>
</div></li></ul> <!-- MAIN MENU END -->
</nav> <!-- END OF HEADER NAVIGATION ON DESKTOP-->
</div>
<div id="mobile-nav"><ul id="mobile-stick-top"><li><a class="auto-localize" href="<?php echo $protocol . $settings['siteurl']; ?>" target="_self"><i class="fa fa-home fa-white"><span><?php echo $txt_home; ?></span></i></a></li><li><a href="popular/"><i class="fa fa-fire fa-white"><span><?php echo $txt_popular; ?></span></i></a><div class="mobile-search-box" id="mob-search"><form role="search" name="srch-term" method="get" action="search.php"><input type="text" name="term"><input type="submit"></form></div></li><li class="dropdown dropdown-mobile"><a href="javascript:void(0);" id="open-dropdown-mobile" onclick="openMenu()"><i class="fa fa-bars fa-white"><span><?php echo $txt_gift_guides; ?></span></i></a><div class="dropdown-content" id="mobile-dropdown">
<?php
if($MobCatSql = $mysqli->query("SELECT * FROM categories WHERE is_sub_cat = 0 ORDER BY show_order ASC")){
    while($MobCatRow = mysqli_fetch_array($MobCatSql)){
    $MobCatName = $MobCatRow['cname'];
    $MobCatUrl = $MobCatRow['cname2'];
?>    
<a id="mobile-menu" class="auto-localize" href="category/<?php echo $MobCatUrl;?>/"><?php echo $MobCatName;?></a>
  <?php
}$MobCatSql->close(); 
}else{
  printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
}
?>
<a style="border-top: 1px solid rgba(0,0,0,0.2);margin: 8px 0px;" class="auto-localize" href="blog/">Blog</a><a style="border-top: 1px solid rgba(0,0,0,0.2);" class="auto-localize" href="contact_us/">Contact Us</a></div></li><li><a id="open-mobile-search" onclick="openSearch()"><i class="fa fa-search fa-white"><span>Search</span></i></a></li></ul></div></header>
<style type="text/css">.wow{visibility: visible !important;}</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>new WOW().init();</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>var yourNavigation=$(".mobile-nav");stickyDiv="stickymobnav",yourHeader=50,$(window).scroll(function(){$(this).scrollTop()>yourHeader?yourNavigation.addClass(stickyDiv):yourNavigation.removeClass(stickyDiv)}),$(".dropdown-content").height()>400&&($(".dropdown-content").css("max-height","400px"),$(".dropdown-content").css("overflow-y","scroll"));</script>
<?php if(!isset($settings['addthisFilter']) || $settings['addthisFilter'] == '2'){echo $settings['addthis'];}?>
<script type="text/javascript">function popup(n){var o=(screen.width-700)/2,t="width=700, height=400";return t+=", top="+(screen.height-400)/2+", left="+o,t+=", directories=no",t+=", location=no",t+=", menubar=no",t+=", resizable=no",t+=", scrollbars=no",t+=", status=no",t+=", toolbar=no",newwin=window.open(n,"windowname5",t),window.focus&&newwin.focus(),!1}$(document).ready(function(){$(".col-link").hover(function(){$(this).parent().find(".col-share").stop().animate({width:"90px"},300)},function(){$(this).parent().find(".col-share").stop().animate({width:"-0"},300)}),$(".col-share").hover(function(){$(this).stop().animate({width:"90px"},300)},function(){$(this).stop().animate({width:"-0"},300)})});</script>