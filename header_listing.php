<?php session_start();
include("db.php");
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
if ($options_result_set = $mysqli->query("SELECT * FROM mp_options WHERE id='1'")) {
    $settings = mysqli_fetch_array($options_result_set);
    $txt_home = $settings['txt_home'];
    $txt_all_cat = $settings['txt_all_cat'];
    $txt_popular = $settings['txt_popular'];
    $txt_gift_guides = $settings['txt_gift_guides'];
    $options_result_set->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>配置表查询失败(header_listing.php)</div>");;
}
if (isset($_SESSION['username'])) {
    $user_name = $_SESSION['username'];
    if ($users_result_set = $mysqli->query("SELECT * FROM mp_users WHERE user_name='$user_name'")) {
        $users_row = mysqli_fetch_array($users_result_set);
        $UsName = strtolower($users_row['user_name']);
        $_SESSION['user_id'] = $users_row['user_id'];
        $Uid = $_SESSION['user_id'];
//        $UserEmail = $users_row['user_email'];
        $users_result_set->close();
    } else {
        printf("<div class='alert alert-danger alert-pull'>用户表查询失败(header_listing.php)</div>");
    }
}
if ($ads_result_set = $mysqli->query("SELECT * FROM mp_siteads WHERE ads_id='1'")) {
    $ads_row = mysqli_fetch_array($ads_result_set);
    $Ad1 = stripslashes($ads_row['ads_ad1']);
    $Ad2 = stripslashes($ads_row['ads_ad2']);
    $Ad3 = stripslashes($ads_row['ads_ad3']);
    $ads_result_set->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>广告表查询失败(header_listing.php)</div>");
}
if (isset($_GET['pname'])) {
    $product_permalink = $mysqli->escape_string($_GET['pname']);
    if ($products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_permalink='$product_permalink' LIMIT 1")) {
        if (mysqli_num_rows($products_result_set) < 1) {
            http_response_code(404);
            include('404.php');
            die();
        } else {
            $products_row = mysqli_fetch_array($products_result_set);
            $product_id = $products_row['product_id'];
            $category_id = $products_row['category_id'];
            $categories_result_set = $mysqli->query("SELECT category_name FROM mp_categories WHERE category_id='$category_id' LIMIT 1");
            $categories_row = mysqli_fetch_array($categories_result_set);
            $product_name = $products_row['product_name'];
            $product_image = $products_row['product_image'];
            $product_description = $products_row['product_description'];
            $product_meta_description = $products_row['product_meta_description'];
            $product_permalink = $products_row['product_permalink'];
            $product_views = $products_row['product_views'];
            $mysqli->query("UPDATE mp_products SET product_views=product_views+1 WHERE product_permalink='$product_permalink'");
            $saves_result_set = $mysqli->query("SELECT * FROM mp_saves WHERE listing_id='$product_id' AND user_id='$Uid'");
            $count_save_listing = mysqli_num_rows($saves_result_set);
            $saves_result_set->close();
        }
        $products_result_set->close();
    } else {
        printf("<div class='alert alert-danger alert-pull'>产品表查询异常(header_listing.php)</div>");;
    }
}
//for blog posts
if (isset($_GET['link'])) {
    $post = $mysqli->escape_string($_GET['link']);
    if ($sql_post = $mysqli->query("SELECT * FROM mp_posts WHERE link='$post' LIMIT 1")) {
        if (mysqli_num_rows($sql_post) < 1) {
            http_response_code(404);
            include('404.php');
            die();
        } else {
            $post_row = mysqli_fetch_array($sql_post);
            $pageTitle = $post_row['title'];
            $post_desc = $post_row['description'];
            $image = $post_row['image'];
            $MetaDescription = $post_row['meta_description'];
            $PageLink = $post_row['link'];
        }
        $sql_post->close();
    } else {
        printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
    }
}
//Tot Site Views
$mysqli->query("UPDATE mp_options SET site_hits=site_hits+1 WHERE id='1'");
$symbol = stripslashes($settings['price_symbol']);
$strActive = strlen($symbol);
if ($strActive > 4) {
    $ActiveSymbol = substr($symbol, 0, 4) . '...';
} else {
    $ActiveSymbol = $symbol;
}
?>
<!doctype html>
<html>
<head>
    <base href="<?php echo $protocol . $settings['siteurl']; ?>/"/>
    <meta charset="utf-8">
    <title><?php echo $pageTitle; ?> | <?php echo $settings['name']; ?></title>
    <meta name="description" content="<?php echo strip_tags($MetaDescription); ?>"/>
    <meta name="keywords" content="<?php echo $settings['keywords']; ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Facebook Meta Tags-->
    <meta property="fb:app_id" content="<?php echo $settings['fbapp']; ?>"/>
    <meta property="og:url" content="<?php echo $protocol . $settings['siteurl']; ?>/<?php echo $PageLink; ?>/"/>
    <meta property="og:title" content="<?php echo $pageTitle; ?> | <?php echo $settings['name']; ?>"/>
    <meta property="og:description" content="<?php echo strip_tags($MetaDescription); ?>"/>
    <meta property="og:image" content="<?php echo $protocol . $settings['siteurl']; ?>/images/<?php echo $image; ?>"/>
    <!--End Facebook Meta Tags-->
    <!--Twitter Meta Tags-->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta property="og:image"
          content="<?php echo $protocol . $settings['siteurl']; ?>/images/<?php echo $image; ?>?'.uniqid().'"/>
    <meta property="og:url" content="<?php echo $protocol . $settings['siteurl']; ?>/<?php echo $PageLink; ?>/"/>
    <meta property="og:title" content="<?php echo $pageTitle; ?> | <?php echo $settings['name']; ?>"/>
    <meta property="og:description" content="<?php echo strip_tags($MetaDescription); ?>"/>
    <!--End Twitter Meta Tags-->
    <link href="assets/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <link href="css/main.php" rel="stylesheet" type="text/css">
    <link href="css/test1.css" rel="stylesheet" type="text/css">
    <link href="css/test2.css" rel="stylesheet" type="text/css">
    <link href="css/test3.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
<div id="fb-root"></div>
<!--
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
-->
<div id="cv-top-overlay"></div>
<header id="masthead">
    <div id="nav-container">
        <div class="nav-accent nav-accent-left" ng-hide="hide_header"></div>
        <div class="nav-accent nav-accent-right" ng-hide="hide_header"></div>
        <div id="logo"><span id="search-bar"><form class="search-form" role="search" name="srch-term" method="get"
                                                   action="search.php" ng-controller="SearchPartialCtrl"><fieldset
                            class="searchbox"><i class="fa fa-search"></i><input class="elasticsearch" name="term"
                                                                                 type="text" autocomplete="off"
                                                                                 placeholder="Search..."
                                                                                 ng-change="search(term)"
                                                                                 ng-model="term"></fieldset></form></span><a
                    class="auto-localize" id="center-logo" href="<?php echo $protocol . $settings['siteurl']; ?>"
                    target="_self"><img src="https://gss0.baidu.com/-fo3dSag_xI4khGko9WTAnF6hhy/zhidao/wh%3D600%2C800/sign=bf24ca75d92a60595245e91c180418a3/8718367adab44aedc0589858bd1c8701a18bfb7c.jpg" alt="<?php echo $settings['name']; ?>"></a>
            <!-- LOGIN/REGISTRATION START -->
            <!-- MOBILE LOGIN START -->
            <div>
                <ul class="navbar-nav navbar-right user-icon">
                    <li id="dropdown" class="dropdown">
                        <?php if (!isset($_SESSION['username'])){ ?>
                        <a onclick="changeColor()" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><span><i class="fa fa-user mobile-user-button"
                                                          style="font-size: 14px;padding: .5rem 1rem;border-radius: 5px;"></i></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="login/"><i style="padding-right: 5px;" class="fas fa-sign-in-alt"></i>Log
                                    In</a></li>
                            <li><a href="register/"><i style="padding-right: 5px;" class="fas fa-user-plus"></i>Register</a>
                            </li>
                            <?php } else { ?>
                                <li class="dropdown"><a style="color:green;" onclick="changeColor()" href="#"
                                                        class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                        aria-expanded="false"><span><i
                                                    class="fa fa-user mobile-user-button"
                                                    style="font-size: 14px;padding: .5rem 1rem;border-radius: 5px;"></i></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="wish_list/"><span class="fa fa-heart"></span>&nbsp; Wish List</a>
                                        </li>
                                        <li><a href="profile/"><span class="fa fa-user"></span>&nbsp; My Profile</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="logout/"><span class="fa fa-unlock-alt"></span>&nbsp; Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- MOBILE LOGIN END -->
            <!-- DESKTOP LOGIN START -->
            <ul id="navbarRight" class="navbar-nav navbar-right">
                <?php if (!isset($_SESSION['username'])) { ?>
                    <li><a href="login/">Log In</a> | <a href="register/">Register</a></li>
                <?php } else { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My
                            Account <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="wish_list/"><span class="fa fa-heart remove-mobile"></span>&nbsp; Wish List</a>
                            </li>
                            <li><a href="profile/"><span class="fa fa-user remove-mobile"></span>&nbsp; My Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="logout/"><span class="fa fa-unlock-alt remove-mobile"></span>&nbsp; Logout</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <!-- DESKTOP LOGIN END--->
        </div> <!-- HEADER SECTION END -->
        <!-- LOGIN/REGISTRATION END -->
        <nav class="nav" id="menu" ng-hide="hide_header"> <!-- MAIN MENU START -->
            <button class="navtoggle" type="button" id="menutoggle" aria-hidden="true"><i class="fa fa-bars"></i>
            </button>
            <ul>
                <li><a class="auto-localize" href="<?php echo $protocol . $settings['siteurl']; ?>" target="_self"><span
                                class="icon"><i class="fa fa-home"></i></span><span><?php echo $txt_home; ?></span></a>
                </li>
                <?php
                if ($categories_result_set = $mysqli->query("SELECT * FROM mp_categories WHERE is_featured = 1 ORDER BY show_order ASC")) {
                    while ($categories_row = mysqli_fetch_array($categories_result_set)) {
                        $category_name = $categories_row['category_name'];
                        $category_slug = $categories_row['category_slug'];
                        $category_icon = $categories_row['category_icon'];
                        ?>
                        <li>
                            <a class="auto-localize" href="category/<?php echo $category_slug; ?>/">
                                <span class="icon"><?php echo $category_icon; ?></span>
                                <span><?php echo $category_name; ?></span>
                            </a>
                        </li>
                        <?php
                    }
                    $categories_result_set->close();
                } else {
                    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
                }
                ?>
                <li class="dropdown">
                    <a><span class="icon"><i class="fa fa-bars"></i></span><span><?php echo $txt_all_cat; ?></span></a>
                    <div class="dropdown-content">
                        <?php
                        if ($categories_result_set = $mysqli->query("SELECT * FROM mp_categories WHERE parent_id is null AND is_featured = 0 ORDER BY show_order ASC")) {
                            while ($categories_row = mysqli_fetch_array($categories_result_set)) {
                                $category_name = $categories_row['category_name'];
                                $category_slug = $categories_row['category_slug'];
                                ?>
                                <a class="auto-localize" href="category/<?php echo $category_slug; ?>/"><?php echo $category_name; ?></a>
                                <?php
                            }
                            $categories_result_set->close();
                        } else {
                            printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
                        }
                        ?>
                        <a style="border-top: 1px solid rgba(0,0,0,0.2);" class="auto-localize" href="blog/"><i style="padding: 0 7px 0 0;font-size: 18px;" class="fas fa-book-reader"></i>Blog</a>
                        <a style="border-top: 1px solid rgba(0,0,0,0.2);" class="auto-localize" href="contact_us/"><i style="padding: 0 7px 0 0;font-size: 18px;" class="fas fa-envelope"></i>Contact Us</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
    <!-- MAIN MENU END -->
    <!-- END OF HEADER NAVIGATION ON DESKTOP-->
    <div id="mobile-nav">
        <ul id="mobile-stick-top">
            <li><a class="auto-localize" href="<?php echo $protocol . $settings['siteurl']; ?>" target="_self">
                    <i class="fa fa-home fa-white"><span><?php echo $txt_home; ?></span></i></a></li>
            <li><a href="popular/"><i class="fa fa-fire fa-white"><span><?php echo $txt_popular; ?></span></i></a>
                <div class="mobile-search-box" id="mob-search">
                    <form role="search" name="srch-term" method="get" action="search.php">
                        <input type="text" name="term">
                        <input type="submit">
                    </form>
                </div>
            </li>
            <li class="dropdown dropdown-mobile">
                <a href="javascript:void(0);" id="open-dropdown-mobile" onclick="openMenu()">
                    <i class="fa fa-bars fa-white"><span><?php echo $txt_gift_guides; ?></span></i>
                </a>
                <div class="dropdown-content" id="mobile-dropdown">
                    <?php
                    if ($categories_result_set = $mysqli->query("SELECT * FROM mp_categories WHERE parent_id is null ORDER BY show_order ASC")) {
                        while ($categories_row = mysqli_fetch_array($categories_result_set)) {
                            $category_name = $categories_row['category_name'];
                            $category_slug = $categories_row['category_slug'];
                            ?>
                            <a id="mobile-menu" class="auto-localize" href="category/<?php echo $category_slug; ?>/"><?php echo $category_name; ?></a>
                            <?php
                        }
                        $categories_result_set->close();
                    } else {
                        printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
                    }
                    ?>
                    <a style="border-top: 1px solid rgba(0,0,0,0.2);margin: 8px 0px;" class="auto-localize" href="blog/">Blog</a>
                    <a style="border-top: 1px solid rgba(0,0,0,0.2);" class="auto-localize" href="contact_us/">Contact Us</a>
                </div>
            </li>
            <li><a id="open-mobile-search" onclick="openSearch()">
                    <i class="fa fa-search fa-white"><span>Search</span></i>
                </a>
            </li>
        </ul>
    </div>
</header>
<style type="text/css">
    .wow {
        visibility: visible !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/wow/1.1.2/wow.min.js"></script>
<script>new WOW().init();</script>
<script async src="https://cdn.jsdelivr.net/npm/bootstrap.min.js@3.3.5/bootstrap.min.js"></script>
<script>
    var yourNavigation = $(".mobile-nav");
    stickyDiv = "stickymobnav", yourHeader = 50, $(window).scroll(function () {
        $(this).scrollTop() > yourHeader ? yourNavigation.addClass(stickyDiv) : yourNavigation.removeClass(stickyDiv)
    }), $(".dropdown-content").height() > 400 && ($(".dropdown-content").css("max-height", "400px"), $(".dropdown-content").css("overflow-y", "scroll"));
</script>
<?php
if (!isset($settings['addthisFilter']) || $settings['addthisFilter'] == '2') {
    echo $settings['addthis'];
} ?>
<script type="text/javascript">
    function popup(n) {
        var o = (screen.width - 700) / 2, t = "width=700, height=400";
        return t += ", top=" + (screen.height - 400) / 2 + ", left=" + o, t += ", directories=no", t += ", location=no", t += ", menubar=no", t += ", resizable=no", t += ", scrollbars=no", t += ", status=no", t += ", toolbar=no", newwin = window.open(n, "windowname5", t), window.focus && newwin.focus(), !1
    }
    $(document).ready(function () {
        $(".col-link").hover(function () {
            $(this).parent().find(".col-share").stop().animate({width: "90px"}, 300)
        }, function () {
            $(this).parent().find(".col-share").stop().animate({width: "-0"}, 300)
        }), $(".col-share").hover(function () {
            $(this).stop().animate({width: "90px"}, 300)
        }, function () {
            $(this).stop().animate({width: "-0"}, 300)
        })
    });
</script>