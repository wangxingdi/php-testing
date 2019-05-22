<?php session_start();
include("db.php");
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
if($squ = $mysqli->query("SELECT * FROM settings WHERE id='1'")){
    $settings = mysqli_fetch_array($squ);
    $gifts_under_limit = $settings['gifts_under_limit'];
    $txt_home = $settings['txt_home'];
    $txt_all_cat = $settings['txt_all_cat'];
    $txt_popular = $settings['txt_popular'];
    $txt_gift_guides = $settings['txt_gift_guides'];
    $squ->close();
}else{
     printf("<div class='alert alert-danger alert-pull'>There seems tco be an issue. Please try again.</div>");;
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
  $Ad4 = stripslashes($AdsRow['ad4']);
  $AdsSql->close();
}else{
  printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
}
$mysqli->query("UPDATE settings SET site_hits=site_hits+1 WHERE id='1'");
  $symbol = stripslashes($settings['price_symbol']);
  $strActive = strlen ($symbol);
  if ($strActive > 4) {
  $ActiveSymbol = substr($symbol,0,4).'...';
  }else{
  $ActiveSymbol = $symbol;}
  $_SESSION['mobSubBoxTitle'] = stripslashes($settings['mobSubBoxTitle']);
  $_SESSION['mobSubBoxBtnText'] = stripslashes($settings['mobSubBoxBtnText']);
  $_SESSION['mobSubBoxDesc'] = stripslashes($settings['mobSubBoxDesc']);
?>
<!doctype html>
<html>
<head>
<base href="<?php echo $protocol . $settings['siteurl']; ?>/" />
<meta charset="utf-8">
<title>Gifts Under <?php echo $ActiveSymbol; ?><?php echo $gifts_under_limit; ?> | <?php echo $settings['name']; ?></title>
<meta name="description" content="Unique gifts under $20 to buy" />
<meta name="keywords" content="gifts under $20" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Facebook Meta Tags-->
<meta property="fb:app_id"          content="<?php echo $settings['fbapp']; ?>" /> 
<meta property="og:url"             content="<?php echo $protocol . $settings['siteurl']; ?>" /> 
<meta property="og:title"           content="<?php echo $settings['name'];?>" />
<meta property="og:description"   content="<?php echo $settings['descrp'];?>" /> 
<meta property="og:image"           content="<?php echo $protocol . $settings['siteurl']; ?>/images/logo.png" /> 
<!--End Facebook Meta Tags-->
<!--Twitter Meta Tags-->
<meta name="twitter:card" content="summary_large_image" />
<meta property="og:image" content="<?php echo $protocol . $settings['siteurl']; ?>/images/logo.png" />
<meta property="og:url" content="<?php echo $protocol . $settings['siteurl']; ?>" />
<meta property="og:title" content="<?php echo $settings['name'];?>" />
<meta property="og:description" content="<?php echo $settings['descrp'];?>" />
<!--End Twitter Meta Tags-->
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
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
<div id="nav-container">
<div class="nav-accent nav-accent-left" ng-hide="hide_header"></div><div class="nav-accent nav-accent-right" ng-hide="hide_header"></div><div id="logo"><span id="search-bar"><form class="search-form" role="search" name="srch-term" method="get" action="search.php" ng-controller="SearchPartialCtrl"><fieldset class="searchbox"><i class="fa fa-search"></i><input class="elasticsearch" name="term" type="text" autocomplete="off" placeholder="Search..." ng-change="search(term)" ng-model="term"></fieldset></form></span><a class="auto-localize" id="center-logo" href="<?php echo $protocol . $settings['siteurl']; ?>" target="_self"><img src="images/logo.png" alt="<?php echo $settings['name']; ?>"></a>
<!-- MOBILE LOGIN START -->
<div>
  <ul class="navbar-nav navbar-right user-icon"><li id="dropdown" class="dropdown">
      <?php if(!isset($_SESSION['username'])){?>
          <a onclick="changeColor()" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span><i class="fa fa-user mobile-user-button" style="font-size: 14px;padding: .5rem 1rem;border-radius: 5px;"></i></span></a>
          <ul class="dropdown-menu" role="menu"><li><a href="login/"><i style="padding-right: 5px;" class="fas fa-sign-in-alt"></i>Log In</a></li><li><a href="register/"><i style="padding-right: 5px;" class="fas fa-user-plus"></i>Register</a></li>
        <?php }else{ ?>
        <li class="dropdown logged">
          <a style="color:green;" onclick="changeColor()" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span><i class="fa fa-user mobile-user-button" style="font-size: 14px;padding: .5rem 1rem;border-radius: 5px;"></i></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="wish_list/"><span class="fa fa-heart"></span>&nbsp; Wish List</a></li>
            <li><a href="profile/"><span class="fa fa-user"></span>&nbsp; My Profile</a></li>
            <li class="divider"></li>
            <li><a href="logout/"><span class="fa fa-unlock-alt"></span>&nbsp; Logout</a></li>
          </ul></li>
        <?php } ?> 
      </ul></li>
  </ul>
</div><!-- /.navbar-collapse -->
<!-- MOBILE LOGIN END -->
<ul id="navbarRight" class="navbar-nav navbar-right"> <!-- LOGIN/REGISTRATION CODE START--->
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
      </ul>  <!-- LOGIN/REGISTRATION CODE END--->
</div> <!-- HEADER SECTION END -->
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
}?>
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
<div id="mobile-nav"><ul id="mobile-stick-top"><li><a class="auto-localize" href="<?php echo $protocol . $settings['siteurl']; ?>" target="_self"><i class="fa fa-home fa-white"><span><?php echo $txt_home; ?></span></i></a></li><li><a href="popular/"><i class="fa fa-fire fa-white"><span><?php echo $txt_popular; ?></span></i></a>
<div class="mobile-search-box" id="mob-search">
<form role="search" name="srch-term" method="get" action="search.php"><input type="text" name="term"><input type="submit"></form></div></li>
<li class="dropdown dropdown-mobile"><a href="javascript:void(0);" id="open-dropdown-mobile" onclick="openMenu()"><i class="fa fa-bars fa-white"><span><?php echo $txt_gift_guides; ?></span></i></a>
<div class="dropdown-content" id="mobile-dropdown">
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
<a style="border-top: 1px solid rgba(0,0,0,0.2);margin: 8px 0px;" class="auto-localize" href="blog/">Blog</a>
<a style="border-top: 1px solid rgba(0,0,0,0.2);" class="auto-localize" href="contact_us/">Contact Us</a>
</div></li><li><a id="open-mobile-search" onclick="openSearch()"><i class="fa fa-search fa-white"><span>Search</span></i></a></li></ul></div></header>
<style type="text/css">.wow{visibility: visible !important;}</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>new WOW().init();</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>var yourNavigation=$(".mobile-nav");stickyDiv="stickymobnav",yourHeader=50,$(window).scroll(function(){$(this).scrollTop()>yourHeader?yourNavigation.addClass(stickyDiv):yourNavigation.removeClass(stickyDiv)}),$(".dropdown-content").height()>400&&($(".dropdown-content").css("max-height","400px"),$(".dropdown-content").css("overflow-y","scroll"));</script>
<?php if($settings['addthisFilter'] == '3'){echo $settings['addthis'];}?>