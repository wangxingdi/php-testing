<?php
session_start();
include("db.php");
error_reporting(E_ALL ^ E_NOTICE);
$sort = $mysqli->escape_string(chr($_POST["sort"]));
$_SESSION['sort'] = $sort;
$user_id = $_SESSION['user_id'];
$count = 0;
if ($settings_result_set = $mysqli->query("SELECT * FROM mp_options WHERE id='1'")) {
    $settings_row = mysqli_fetch_array($settings_result_set);
    $siteurl = $settings_row['siteurl'];
    $price_symbol = stripslashes($settings_row['price_symbol']);
    $txt_save = $settings_row['txt_save'];
    $txt_remove = $settings_row['txt_remove'];
    $settings_result_set->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
} ?>
<script>
    $(document).ready(function () {
        $(".col-link").hover(function () {
            $(this).parent().find(".col-share").stop().animate({width: "90px"}, 300)
        },
        function () {
            $(this).parent().find(".col-share").stop().animate({width: "-0"}, 300)
        }),
        $(".col-share").hover(function () {
            $(this).stop().animate({width: "90px"}, 300)
        },
        function () {
            $(this).stop().animate({width: "-0"}, 300)
        }),
        $(".saves").click(function () {
            var t = $(this).data("product_id"), a = $(this).data("product_name"), i = "product_id=" + t, n = $(this);
            return "save" == a && ($(this).fadeIn(200).html, $.ajax({
                type: "POST",
                url: "save_lists.php",
                data: i,
                cache: !1,
                success: function (t) {
                    n.html(t)
                }
            })), !1
        })
    }),
    $(function () {
        $(".save-list").click(function () {
            var t = $(this).data("product_id"), a = $(this).data("product_name"), i = "product_id=" + t, n = $(this);
            return "save" == a && $.ajax({
                type: "POST",
                url: "save_lists.php",
                data: i,
                cache: !1,
                success: function (t) {
                    n.parent().parent().parent().find(".saves").html(t)
                }
            }), !1
        })
    });
</script>
<?php
if ($sort == "n") {
    $sortpage = "newest";
    $products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 ORDER BY product_id DESC LIMIT 0, 9");
} else if ($sort == "p") {
    $sortpage = "popular";
    $products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 ORDER BY product_views DESC LIMIT 0, 9");
} else if ($sort == "l") {
    $sortpage = "low";
    $products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 ORDER BY CAST(product_price AS DECIMAL(10,2)) DESC LIMIT 0, 9");
} else if ($sort == "h") {
    $sortpage = "high";
    $products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 ORDER BY CAST(product_price AS DECIMAL(10,2)) ASC LIMIT 0, 9");
} else {
    $sortpage = "none";
    $products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 ORDER BY product_id DESC LIMIT 0, 9");
}
$products_num = mysqli_num_rows($products_result_set);
if ($products_num < 1) {
    ?>
    <div class="no-lisings alert alert-info">We're still searching for the best products for you. Please check back later!</div>
<?php }
while ($products_row = mysqli_fetch_array($products_result_set)) {
    $count++;
    $product_id = $products_row['product_id'];
    $product_description = $products_row['product_description'];
    $product_name = $products_row['product_name'];
    $product_permalink = $products_row['product_permalink'];
    $product_views = $products_row['product_views'];
    $year = date('Y');
    $month = date('m');
    $upload_directory = 'uploads/';
    $img_path = $products_row['product_external_link'];
    if(empty($img_path)){
        $img_path = $upload_directory . $products_row['product_image'];
    }
    ?>
    <div <?php if ($count > 3) {
        echo "class='col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeIn animation-off-mobile'";
    } else {
        echo "class='col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box'";
    } ?> style="padding-left:15px; padding-right:15px;">
        <a href="<?php echo $product_permalink; ?>/" target="_blank">
            <h2><?php echo $product_name; ?></h2>
        </a>
        <div class="col-holder">
            <!--
            <a class="col-link" href="offer_link.php?id=<?php /*echo $product_id; */?>" target="_blank">
            -->
            <a class="col-link" href="<?php echo $product_permalink; ?>/" target="_blank">
                <img class="img-responsive" src=<?php echo $img_path; ?> alt="<?php echo $product_name; ?>">
            </a>
            <div class="col-share">
                <?php if (!isset($_SESSION['username'])) { ?>
                    <a class="btn btn-default btn-lg btn-danger btn-font" onclick="openLogin()"><?php echo $txt_save; ?></a>
                <?php } else {
                    $user_sql = $mysqli->query("SELECT * FROM mp_saves WHERE listing_id='$product_id' AND user_id='$user_id'");
                    $count_save = mysqli_num_rows($user_sql);
                    $user_sql->close();
                    if ($count_save == 1) { ?>
                        <a class="btn btn-default btn-lg btn-danger btn-font save-list remove-list" id="<?php echo $product_id; ?>" data-id="<?php echo $product_id; ?>" data-name="save"><?php echo $txt_remove; ?></a>
                        <?php
                    } else { ?>
                        <a class="btn btn-default btn-lg btn-danger btn-font save-list" id="<?php echo $product_id; ?>" data-id="<?php echo $product_id; ?>" data-name="save"><?php echo $txt_save; ?></a>
                        <?php
                    }
                } ?>
            </div>
        </div>
        <div class="col-description">
            <p><?php echo $product_description; ?></p>
        </div>
        <div class="col-bottom">
            <div class="col-left">
                <span class="info-price">
                    <h3><?php echo $price_symbol; ?><?php echo $products_row['product_price']; ?></h3>
                </span>
                <?php
                    if (!isset($_SESSION['username'])) { ?>
                        <span class="info-saves"><a class="saves" onclick="openLogin()"><span class="fas fa-heart"></span> &nbsp;<?php echo $products_row['product_saves']; ?> saves</a></span>
                <?php
                    } else {
                            if ($count_save == 1) { ?>
                                <span class="info-saves">
                                    <a class="saves remove-save" id="save-<?php echo $product_id; ?>" data-id="<?php echo $product_id; ?>" data-name="save" title="You have saved this. Click to remove.">
                                        <span class="fas fa-heart"></span> &nbsp;<?php echo $products_row['product_saves']; ?> saves
                                    </a>
                                </span>
                                <?php
                            } else { ?>
                                <span class="info-saves">
                                    <a class="saves" id="save-<?php echo $product_id; ?>" data-id="<?php echo $product_id; ?>" data-name="save" title="Click to save this item."><span class="fas fa-heart">
                                        </span> &nbsp;<?php echo $products_row['product_saves']; ?> saves
                                    </a>
                                </span>
                                <?php
                            }
                    }
                ?>
                <span class="info-saves"> &nbsp;
                    <i class="fas fa-eye"></i>&nbsp;&nbsp;<?php echo $product_views; ?> views
                </span>
            </div>
            <div class="col-right">
                <!--
                <a class="btn btn-default btn-warning pull-right btn-font btn-checkout" href="offer_link.php?id=<?php /*echo $product_id; */?>" target="_blank"><?php /*echo $settings_row['buy_button']; */?></a>
                -->
                <a class="btn btn-default btn-warning pull-right btn-font btn-checkout" href="<?php echo $product_permalink; ?>/" target="_blank"><?php echo $settings_row['buy_button']; ?></a>
            </div>
        </div>
    </div>
    <?php
    if ($count == 5) { ?>
        <div class="desktop-hide col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeIn animation-off-mobile"
             style="padding-left:15px; padding-right:15px; margin-bottom:0;">
            <div id="sidebar-subscribe-box">
                <div class="sidebar-subscribe-box-wrapper">
                    <h2 style="margin-top: 10px; font-size: 19px;"><?php echo $_SESSION['mobSubBoxTitle']; ?></h2>
                    <p style="display: block !important;margin-bottom: 0;text-align: center;line-height: 1.5em;"><?php echo $_SESSION['mobSubBoxDesc']; ?></p>
                    <div class="sidebar-subscribe-box-form">
                        <form id="mobileSubscribe" name="mobileSubscribe" action="subscribe.php" class="sidebar-subscribe-box-form" method="post">
                            <input class="sidebar-subscribe-box-email-field" id="email-mobile" name="email" autocomplete="off" placeholder="Enter your email address"/>
                            <input class="sidebar-subscribe-box-email-button" title="" type="submit" value="<?php echo $_SESSION['mobSubBoxBtnText']; ?>"/>
                        </form>
                        <div style="margin-top: 5px;" id="output-subscribe-mobile"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>
<nav id="page-nav"><a href="data_index.php?page=2"></a></nav>
<script async src="js/jquery.infinitescroll.min.js"></script>
<script>
    $("#display-posts-main").infinitescroll({
        navSelector: "#page-nav",
        nextSelector: "#page-nav a",
        itemSelector: ".col-box",
        checkLastPage: !0,
        prefill: !0,
        scrollThreshold: 100,
        hideNav: "#page-nav",
        loading: {finishedMsg: "No more posts to load.", img: "images/ajaxloader.gif"}
    }, function (a, t, i) {
        $(".col-link-data").hover(function () {
            $(this).parent().find(".col-share-data").stop().animate({width: "90px"}, 300)
        }, function () {
            $(this).parent().find(".col-share-data").stop().animate({width: "-0"}, 300)
        }), $(".col-share-data").hover(function () {
            $(this).stop().animate({width: "90px"}, 300)
        }, function () {
            $(this).stop().animate({width: "-0"}, 300)
        }), $(".saves-data").unbind("click"), $(function () {
            $(".saves-data").click(function () {
                var a = $(this).data("product_id"), t = $(this).data("product_name"), i = "product_id=" + a, e = $(this);
                return "save" == t && ($(this).fadeIn(200).html, $.ajax({
                    type: "POST",
                    url: "save_lists.php",
                    data: i,
                    cache: !1,
                    success: function (a) {
                        e.html(a)
                    }
                })), !1
            })
        }), $(".save-list-data").unbind("click"), $(function () {
            $(".save-list-data").click(function () {
                var a = $(this).data("product_id"), t = $(this).data("product_name"), i = "product_id=" + a, e = $(this);
                return "save" == t && ($(this).fadeIn(200).html, $.ajax({
                    type: "POST",
                    url: "save_lists.php",
                    data: i,
                    cache: !1,
                    success: function (a) {
                        e.parent().parent().parent().find(".saves-data").html(a)
                    }
                })), !1
            })
        })
    });
</script>
<script aysnc src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
<script type="text/javascript">
    function openLogin() {
        window.location = "login/";
    }
</script>