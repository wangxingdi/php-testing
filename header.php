<?php
    session_start();
    include("db.php");
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
    $protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
    if ($options_result_set = $mysqli->query("SELECT * FROM mp_options WHERE id='1'")) {
        $options_row = mysqli_fetch_array($options_result_set);
        $meta_description = $options_row['descrp'];
        $txt_home = $options_row['txt_home'];
        $txt_all_cat = $options_row['txt_all_cat'];
        $txt_popular = $options_row['txt_popular'];
        $txt_gift_guides = $options_row['txt_gift_guides'];
        $txt_gifts_under = $options_row['txt_gifts_under'];
        $gifts_under_limit = $options_row['gifts_under_limit'];
        $txt_newest = $options_row['txt_newest'];
        $txt_popular_index = $options_row['txt_popular_index'];
        $txt_high = $options_row['txt_high'];
        $txt_low = $options_row['txt_low'];
        $buy_button = $options_row['buy_button'];
        $txt_save = $options_row['txt_save'];
        $txt_remove = $options_row['txt_remove'];
        $price_symbol = $options_row['price_symbol'];
        $options_result_set->close();
    } else {
        printf("<div class='alert alert-danger alert-pull'>查询配置表失败(header.php)</div>");
    }
    $pageName = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if ($pageName == $protocol . $options_row['siteurl'] . '/wish_list/') {
        $pageTitle = '愿望清单 | ';
    } else if ($pageName == $protocol . $options_row['siteurl'] . '/profile/') {
        $pageTitle = '我的资料 | ';
    } else if ($pageName == $protocol . $options_row['siteurl'] . '/login/') {
        $pageTitle = '登录 | ';
    } else if ($pageName == $protocol . $options_row['siteurl'] . '/register/') {
        $pageTitle = '注册 | ';
    } else if ($pageName == $protocol . $options_row['siteurl'] . '/recover/') {
        $pageTitle = '重置账户 | ';
    } else if ($pageName == $protocol . $options_row['siteurl'] . '/about_us/') {
        $pageTitle = '关于我们 | ';
    } else if ($pageName == $protocol . $options_row['siteurl'] . '/contact_us/') {
        $pageTitle = '联系我们 | ';
    } else if ($pageName == $protocol . $options_row['siteurl'] . '/privacy_policy/') {
        $pageTitle = '隐私政策 | ';
    } else if ($pageName == $protocol . $options_row['siteurl'] . '/tos/') {
        $pageTitle = '使用条款 | ';
    } else {
        $pageTitle = '';
    }
    if (isset($_GET['link'])) {
        $post = $mysqli->escape_string($_GET['link']);
        if ($sql_post_title = $mysqli->query("SELECT title, meta_description FROM mp_posts WHERE link='$post' LIMIT 1")) {
            $post_row_title = mysqli_fetch_array($sql_post_title);
            $pageTitle = $post_row_title['title'] . ' | ';
            $meta_description = $post_row_title['meta_description'];
            $post_count_no = mysqli_num_rows($sql_post_title);
            if ($post_count_no < 1) {
                $pageTitle = "Page not found! - ";
            }
            $sql_post_title->close();
        } else {
            printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of posts. Please check it.</div>");
        }
    }
    if (isset($_SESSION['username'])) {
        $Uname = $_SESSION['username'];
        if ($UserSql = $mysqli->query("SELECT * FROM mp_users WHERE user_name='$Uname'")) {
            $UserRow = mysqli_fetch_array($UserSql);
            $UsName = strtolower($UserRow['user_name']);
            $_SESSION['user_id'] = $UserRow['user_id'];
            $Uid = $_SESSION['user_id'];
            $UserEmail = $UserRow['user_email'];
            $UserSql->close();
        } else {
            printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of users. Please check it.</div>");
        }
    }
    if ($AdsSql = $mysqli->query("SELECT * FROM mp_ads WHERE ads_id='1'")) {
        $AdsRow = mysqli_fetch_array($AdsSql);
        $Ad1 = stripslashes($AdsRow['ads_ad1']);
        $Ad2 = stripslashes($AdsRow['ads_ad2']);
        $Ad3 = stripslashes($AdsRow['ads_ad3']);
        $Ad4 = stripslashes($AdsRow['ads_ad4']);
        $AdsSql->close();
    } else {
        printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of siteads. Please check it.</div>");
    }
?>
    <!doctype html>
    <html>
        <head>
            <base href="<?php echo $protocol . $options_row['siteurl']; ?>/">
            <meta charset="utf-8">
            <title>
                <?php
                    if (isset($_GET['term'])) {
                        echo 'Search results for "' . trim($_GET['term']) . '" | ';
                    } else {
                        echo $pageTitle;
                    }
                    echo $options_row['name'];
                ?>
            </title>
            <meta name="description" content="<?php echo $meta_description; ?>"/>
            <meta name="keywords" content="<?php echo $options_row['keywords']; ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta property="fb:app_id" content="<?php echo $options_row['fbapp']; ?>"/>
            <meta property="og:url" content="<?php echo $protocol . $options_row['siteurl']; ?>"/>
            <meta property="og:title" content="<?php echo $options_row['name']; ?>"/>
            <meta property="og:description" content="<?php echo $options_row['descrp']; ?>"/>
            <!--<meta property="og:image" content="<?php /*echo $protocol . $options_row['siteurl']; */?>/images/logo.png"/>-->
            <meta name="twitter:card" content="summary_large_image"/>
            <!--<meta property="og:image" content="<?php /*echo $protocol . $options_row['siteurl']; */?>/images/logo.png"/>-->
            <meta property="og:url" content="<?php echo $protocol . $options_row['siteurl']; ?>"/>
            <meta property="og:title" content="<?php echo $options_row['name']; ?>"/>
            <meta property="og:description" content="<?php echo $options_row['descrp']; ?>"/>
            <link href="assets/favicon.ico" rel="shortcut icon" type="image/x-icon" />
            <link href="css/test1.css" rel="stylesheet" type="text/css" />
            <link href="css/test2.css" rel="stylesheet" type="text/css" />
            <link href="css/test3.css" rel="stylesheet" type="text/css" />
            <link href="css/main.php" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"/>
        </head>
        <body>
            <div id="fb-root"></div>
            <div id="cv-top-overlay"></div>
            <header id="masthead">
                <div id="nav-container">
                    <div class="nav-accent nav-accent-left"></div>
                    <div class="nav-accent nav-accent-right"></div>
                    <div id="logo">
                        <span id="search-bar">
                            <form class="search-form" role="search" name="srch-term" method="get" action="search.php">
                                <fieldset class="searchbox">
                                    <i class="fa fa-search"></i>
                                    <input class="elasticsearch" name="term" type="text" autocomplete="off" placeholder="搜索..." />
                                </fieldset>
                            </form>
                        </span>
                        <a class="auto-localize" id="center-logo" href="<?php echo $protocol . $options_row['siteurl']; ?>" target="_self">
                            <img src="https://gss0.baidu.com/-fo3dSag_xI4khGko9WTAnF6hhy/zhidao/wh%3D600%2C800/sign=bf24ca75d92a60595245e91c180418a3/8718367adab44aedc0589858bd1c8701a18bfb7c.jpg" alt="<?php echo $options_row['name']; ?>"/>
                        </a>
                        <div>
                            <ul class="navbar-nav navbar-right user-icon">
                                <li id="dropdown" class="dropdown">
                                    <?php
                                        if (!isset($_SESSION['username'])){
                                    ?>
                                            <a onclick="changeColor()" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                <span>
                                                    <i class="fa fa-user mobile-user-button" style="font-size: 14px;padding: .5rem 1rem;border-radius: 5px;"></i>
                                                </span>
                                            </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="login/"><i style="padding-right: 5px;" class="fas fa-sign-in-alt"></i>登录</a></li>
                                        <li><a href="register/"><i style="padding-right: 5px;" class="fas fa-user-plus"></i>注册</a></li>
                                    <?php
                                        } else {
                                    ?>
                                        <li class="dropdown logged">
                                            <a style="color:green;" onclick="changeColor()" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                <span><i class="fa fa-user mobile-user-button" style="font-size: 14px;padding: .5rem 1rem;border-radius: 5px;"></i></span>
                                            </a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="wish_list/"><span class="fa fa-heart"></span>&nbsp; 愿望清单</a></li>
                                                <li><a href="profile/"><span class="fa fa-user"></span>&nbsp; 我的资料</a></li>
                                                <li class="divider"></li>
                                                <li><a href="logout/"><span class="fa fa-unlock-alt"></span>&nbsp; 注销</a></li>
                                            </ul>
                                        </li>
                                    <?php
                                        }
                                    ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <ul id="navbarRight" class="navbar-nav navbar-right">
                            <?php
                                if (!isset($_SESSION['username'])) {
                            ?>
                            <li><a href="login/">登录</a> | <a href="register/">注册</a></li>
                            <?php
                                } else {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">我的账户 <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="wish_list/"><span class="fa fa-heart remove-mobile"></span>&nbsp; 愿望清单</a></li>
                                    <li><a href="profile/"><span class="fa fa-user remove-mobile"></span>&nbsp; 我的资料</a></li>
                                    <li class="divider"></li>
                                    <li><a href="logout/"><span class="fa fa-unlock-alt remove-mobile"></span>&nbsp; 注销</a></li>
                                </ul>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                    <nav class="nav" id="menu" ng-hide="hide_header">
                        <button class="navtoggle" type="button" aria-hidden="true"><i class="fa fa-bars"></i></button>
                        <ul>
                            <li><a class="auto-localize" href="<?php echo $protocol . $options_row['siteurl']; ?>" target="_self">
                                    <span class="icon"><i class="fa fa-home"></i></span>
                                    <span>
                                        <?php echo $txt_home; ?>
                                    </span>
                                </a>
                            </li>
                            <?php
                                if ($categories_result_set = $mysqli->query("SELECT * FROM mp_categories WHERE is_featured = 1 ORDER BY show_order ASC")) {
                                    while ($categories_row = mysqli_fetch_array($categories_result_set)) {
                                        $category_id = $categories_row['category_id'];
                                        $category_slug = $categories_row['category_slug'];
                                        $category_name = $categories_row['category_name'];
                                        $category_icon = $categories_row['category_icon'];
                                        $CategoryDesc = $categories_row['category_description'];
                            ?>
                            <li>
                                <a class="auto-localize" href="gifts/<?php echo $category_slug; ?>/">
                                    <span class="icon"><?php echo $category_icon; ?></span>
                                    <span><?php echo $category_name; ?></span>
                                </a>
                            </li>
                            <?php
                                }
                                $categories_result_set->close();
                                } else {
                                    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of categories. Please check it.</div>");
                                }
                            ?>
                            <li class="dropdown"><a><span class="icon"><i class="fa fa-bars"></i></span><span><?php echo $txt_all_cat; ?></span></a>
                                <div class="dropdown-content">
                                    <?php
                                        if ($categories_result_set = $mysqli->query("SELECT * FROM mp_categories WHERE parent_id is null AND is_featured = 0 ORDER BY show_order ASC")) {
                                            while ($categories_row = mysqli_fetch_array($categories_result_set)) {
                                                $category_name = $categories_row['category_name'];
                                                $category_slug = $categories_row['category_slug'];
                                    ?>
                                    <a class="auto-localize" href="gifts/<?php echo $category_slug; ?>/"><?php echo $category_name; ?></a>
                                    <?php
                                        }
                                            $categories_result_set->close();
                                        } else {
                                            printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of categories. Please check it.</div>");
                                        }
                                    ?>
                                    <a style="border-top: 1px solid rgba(0,0,0,0.2);" class="auto-localize" href="blog/">
                                        <i style="padding: 0 7px 0 0;font-size: 18px;" class="fas fa-book-reader"></i>博客
                                    </a>
                                    <a style="border-top: 1px solid rgba(0,0,0,0.2);" class="auto-localize" href="contact_us/"><i style="padding: 0 7px 0 0;font-size: 18px;" class="fas fa-envelope"></i>联系我们</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div id="mobile-nav">
                    <ul id="mobile-stick-top">
                        <li><a class="auto-localize" href="<?php echo $protocol . $options_row['siteurl']; ?>">
                                <i class="fa fa-home fa-white"><span><?php echo $txt_home; ?></span></i>
                            </a>
                        </li>
                        <li><a href="popular/">
                                <i class="fa fa-fire fa-white">
                                    <span><?php echo $txt_popular; ?></span>
                                </i>
                            </a>
                            <div class="mobile-search-box" id="mob-search">
                                <form role="search" name="srch-term" method="get" action="search.php"><input type="text" name="term">
                                    <input type="submit" />
                                </form>
                            </div>
                        </li>
                        <li class="dropdown dropdown-mobile">
                            <a href="javascript:void(0);" id="open-dropdown-mobile" onclick="openMenu()">
                                <i class="fa fa-bars fa-white">
                                    <span><?php echo $txt_gift_guides; ?></span>
                                </i>
                            </a>
                            <div class="dropdown-content" id="mobile-dropdown">
                                <?php
                                    if ($categories_result_set = $mysqli->query("SELECT * FROM mp_categories WHERE parent_id is null ORDER BY show_order ASC")) {
                                        while ($categories_row = mysqli_fetch_array($categories_result_set)) {
                                            $category_name = $categories_row['category_name'];
                                            $category_slug = $categories_row['category_slug'];
                                ?>
                                <a id="mobile-menu" class="auto-localize" href="gifts/<?php echo $category_slug; ?>/"><?php echo $category_name; ?></a>
                                <?php
                                        }
                                        $categories_result_set->close();
                                    } else {
                                        printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of categories. Please check it.</div>");
                                    }
                                ?>
                                <a style="border-top: 1px solid rgba(0,0,0,0.2);margin: 8px 0px;" class="auto-localize" href="blog/">博客</a>
                                <a style="border-top: 1px solid rgba(0,0,0,0.2);" class="auto-localize" href="contact_us/">联系我们</a>
                            </div>
                        </li>
                        <li><a id="open-mobile-search" onclick="openSearch()"><i class="fa fa-search fa-white"><span>搜索</span></i></a></li>
                    </ul>
                </div>
            </header>
            <style type="text/css">.wow {visibility: visible !important;}</style>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
            <script src="js/login.js"></script>
            <script>new WOW().init();</script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
            <script src="js/index.js"></script>
            <script>
                var yourNavigation = $(".mobile-nav");
                stickyDiv = "stickymobnav", yourHeader = 50, $(window).scroll(function () {
                    $(this).scrollTop() > yourHeader ? yourNavigation.addClass(stickyDiv) : yourNavigation.removeClass(stickyDiv)
                }), $(".dropdown-content").height() > 400 && ($(".dropdown-content").css("max-height", "400px"), $(".dropdown-content").css("overflow-y", "scroll"));
                $(function () {
                    var a = window.location.href;
                    $(".nav ul li a").each(function () {
                        this.href === a && $(this).addClass("selected")
                    });
                });
                var _hmt = _hmt || [];
                (function() {
                    var hm = document.createElement("script");
                    hm.src = "https://hm.baidu.com/hm.js?509c646257ed98523a09fb935c772953";
                    var s = document.getElementsByTagName("script")[0];
                    s.parentNode.insertBefore(hm, s);
                })();
            </script>
            <?php
                if ($options_row['addthisFilter'] == '3') {
                    echo $options_row['addthis'];
                }
            ?>
        </body>
    </html>
