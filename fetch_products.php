<?php session_start();
include("db.php");
error_reporting(E_ALL ^ E_NOTICE);
$min = $mysqli->escape_string($_POST["minimum_range"]);
$_SESSION['min'] = $min;
$max = $mysqli->escape_string($_POST["max_price"]);
$_SESSION['max'] = $max;
$catid = $mysqli->escape_string($_POST["cid"]);
$_SESSION['catid'] = $catid;
$sort = $mysqli->escape_string(chr($_POST["sort"]));;
$_SESSION['sort'] = $sort;
$count = 0;
$user_id = $_SESSION['user_id'];
if ($siteurl_sql = $mysqli->query("SELECT * FROM mp_options WHERE id='1'")) {
    $settingsRow = mysqli_fetch_array($siteurl_sql);
    $siteurl = $settingsRow['siteurl'];
    $symbol = stripslashes($settingsRow['price_symbol']);
    $strActive = strlen($symbol);
    if ($strActive > 4) {
        $ActiveSymbol = substr($symbol, 0, 4) . '...';
    } else {
        $ActiveSymbol = $symbol;
    }
    $txt_save = $settingsRow['txt_save'];
    $txt_remove = $settingsRow['txt_remove'];
    $siteurl_sql->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");;
} ?>
<script>$(document).ready(function () {
        $(".col-link").hover(function () {
            $(this).parent().find(".col-share").stop().animate({width: "90px"}, 300)
        }, function () {
            $(this).parent().find(".col-share").stop().animate({width: "-0"}, 300)
        }), $(".col-share").hover(function () {
            $(this).stop().animate({width: "90px"}, 300)
        }, function () {
            $(this).stop().animate({width: "-0"}, 300)
        }), $(".saves").click(function () {
            var t = $(this).data("id"), a = $(this).data("name"), i = "id=" + t, n = $(this);
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
    }), $(function () {
        $(".save-list").click(function () {
            var t = $(this).data("id"), a = $(this).data("name"), i = "id=" + t, n = $(this);
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
    });</script>
<?php
//Create an array of parent & sub cats
$cats = array();
$cats[] = $catid; //Adds the current cat to the array
//Check if it is a parent category (branch)
$sql_parent = $mysqli->query("SELECT branch FROM mp_categories WHERE category_id='$catid'");
$row = mysqli_fetch_array($sql_parent);
$is_branch = $row['branch'];
if ($is_branch == 1) {
    //Add sub categories to the array
    $sql = $mysqli->query("SELECT * FROM mp_categories WHERE parent_id = '$catid'");
    while ($rows = mysqli_fetch_array($sql)) {
        array_push($cats, $rows['category_id']); //Push category id to array
    }
}
$cat_str = implode(',', $cats); //For SQL query
$_SESSION['cat_str'] = $cat_str;
if ($sort == "n") {
    $sortpage = "newest";
    $result = $mysqli->query("SELECT * FROM mp_products WHERE category_id IN (" . $cat_str . ")  AND product_state=1 AND CAST(product_price AS UNSIGNED) BETWEEN '$min' AND '$max' ORDER BY product_id DESC LIMIT 0, 27");
} else if ($sort == "p") {
    $sortpage = "popular";
    $result = $mysqli->query("SELECT * FROM mp_products WHERE category_id IN (" . $cat_str . ") AND product_state=1 AND CAST(product_price AS UNSIGNED) BETWEEN '$min' AND '$max' ORDER BY product_views DESC LIMIT 0, 27");
} else if ($sort == "l") {
    $sortpage = "low";
    $result = $mysqli->query("SELECT * FROM mp_products WHERE category_id IN (" . $cat_str . ") AND product_state=1 AND CAST(product_price AS UNSIGNED) BETWEEN '$min' AND '$max' ORDER BY CAST(product_price AS DECIMAL(10,2)) ASC LIMIT 0, 27");
} else if ($sort == "h") {
    $sortpage = "high";
    $result = $mysqli->query("SELECT * FROM mp_products WHERE category_id IN (" . $cat_str . ") AND product_state=1 AND CAST(product_price AS UNSIGNED) BETWEEN '$min' AND '$max' ORDER BY CAST(product_price AS DECIMAL(10,2)) DESC LIMIT 0, 27");
} else {
    $sortpage = "non";
    $result = $mysqli->query("SELECT * FROM mp_products WHERE category_id IN (" . $cat_str . ") AND product_state=1 AND CAST(product_price AS UNSIGNED) BETWEEN '$min' AND '$max' ORDER BY product_id DESC LIMIT 0, 27");
}
$NumResults = mysqli_num_rows($result);
if ($NumResults < 1) { ?>
    <div id="no-lisings" class="no-lisings topmargin alert alert-info">We're still searching for the best products for
        you. Please check back later!
    </div>
    <?php
}
while ($row = mysqli_fetch_array($result)) {
    $count++;
    $listing_id = $row['product_id'];
    $long = $row['product_description'];
    $strd = strlen($long);
    if ($strd > 110) {
        $dlong = substr($long, 0, 107) . '...';
    } else {
        $dlong = $long;
    }
    $LongTitle = $row['product_name'];
    $strt = strlen($LongTitle);
    if ($strt > 30) {
        $tlong = substr($LongTitle, 0, 27) . '...';
    } else {
        $tlong = $LongTitle;
    }
    $PageLink = $row['product_permalink'];
    $view_count = $row['product_views'];
    ?>
    <div <?php if ($count > 3) {
        echo "class='col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeIn animation-off-mobile'";
    } else {
        echo "class='col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box'";
    } ?>> <!-- col-box-->
        <a href="<?php echo $PageLink; ?>/"><h2><?php echo $tlong; ?></h2></a>
        <div class="col-holder">
            <a class="col-link" href="offer_link.php?id=<?php echo $row['product_id']; ?>" target="_blank">
                <?php /*<img class="img-responsive" src="images/resizer/301x250/r/<?php echo $row['image'];?>" alt="<?php echo $LongTitle;?>"> */
                ?>
                <img class="img-responsive"
                     src=<?php echo $row['product_external_link']; ?> alt="<?php echo $LongTitle; ?>">
            </a>
            <div class="col-share">
                <?php if (!isset($_SESSION['username'])) { ?>
                    <a class="btn btn-default btn-lg btn-danger btn-font"
                       onclick="openLogin()"><?php echo $txt_save; ?></a>
                <?php } else {
                    $user_sql = $mysqli->query("SELECT * FROM mp_saves WHERE listing_id='$listing_id' AND user_id='$user_id'");
                    $count_save = mysqli_num_rows($user_sql);
                    $user_sql->close();
                    if ($count_save == 1) { ?>
                        <a class="btn btn-default btn-lg btn-danger btn-font save-list remove-list"
                           id="<?php echo $listing_id; ?>" data-id="<?php echo $listing_id; ?>"
                           data-name="save"><?php echo $txt_remove; ?></a>
                        <?php
                    } else { ?>
                        <a class="btn btn-default btn-lg btn-danger btn-font save-list" id="<?php echo $listing_id; ?>"
                           data-id="<?php echo $listing_id; ?>" data-name="save"><?php echo $txt_save; ?></a>
                        <?php
                    }
                } ?>
                <a class="btn-share btn-fb fab fa-facebook-f" href="javascript:void(0);"
                   onclick="popup('https://www.facebook.com/share.php?u=<?php echo $protocol . $settingsRow['siteurl']; ?>/<?php echo $PageLink; ?>/&amp;title=<?php echo urlencode(ucfirst($LongTitle)); ?>')"></a>
                <a class="btn-share btn-twitter fab fa-twitter" href="javascript:void(0);"
                   onclick="popup('https://twitter.com/home?status=<?php echo urlencode(ucfirst($LongTitle)); ?>+<?php echo $protocol . $settingsRow['siteurl']; ?>/<?php echo $PageLink; ?>/')"></a>
                <a class="btn-share btn-pin fab fa-pinterest" href="javascript:void(0);"
                   onclick="popup('//pinterest.com/pin/create%2Fbutton/?url=<?php echo $protocol . $settingsRow['siteurl']; ?>/<?php echo $PageLink; ?>/')"></a>
            </div>
        </div><!-- /.col-holder-->
        <div class="col-description-cat"><p><?php echo $dlong; ?></p></div>
        <?php
        if ($sql = $mysqli->query("SELECT price_symbol, mobSubBoxTitle, mobSubBoxBtnText, mobSubBoxDesc FROM mp_options WHERE id=1")) {
            $ActiveRow2 = mysqli_fetch_array($sql);
            $symbol = stripslashes($ActiveRow2['price_symbol']);
            $mobSubBoxTitle = stripslashes($ActiveRow2['mobSubBoxTitle']);
            $mobSubBoxBtnText = stripslashes($ActiveRow2['mobSubBoxBtnText']);
            $mobSubBoxDesc = stripslashes($ActiveRow2['mobSubBoxDesc']);
            $strActive = strlen($symbol);
            if ($strActive > 4) {
                $ActiveSymbol = substr($symbol, 0, 4) . '...';
            } else {
                $ActiveSymbol = $symbol;
            }
        } else {
            printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");;
        }
        ?>
        <div class="col-bottom col-bottom-mod">
            <div class="col-left">
                <span class="info-price"><h3><?php echo $ActiveSymbol; ?><?php echo $row['product_price']; ?></h3></span>
                <?php if (!isset($_SESSION['username'])) { ?>
                    <span class="info-saves"><a class="saves" onclick="openLogin()"><span class="fas fa-heart"></span> &nbsp;<?php echo $row['product_saves']; ?> saves</a></span>
                <?php } else {
                    if ($count_save == 1) { ?>
                        <span class="info-saves"><a class="saves remove-save" id="save-<?php echo $listing_id; ?>"
                                                    data-id="<?php echo $listing_id; ?>" data-name="save"
                                                    title="You have saved this. Click to remove."><span
                                        class="fas fa-heart"></span> &nbsp;<?php echo $row['product_saves']; ?> saves</a></span>
                        <?php
                    } else { ?>
                        <span class="info-saves"><a class="saves" id="save-<?php echo $listing_id; ?>"
                                                    data-id="<?php echo $listing_id; ?>" data-name="save"
                                                    title="Click to save this item."><span class="fas fa-heart"></span> &nbsp;<?php echo $row['product_saves']; ?> saves</a></span>
                        <?php
                    }
                } ?>
                <span class="info-saves"> &nbsp;<i
                            class="fas fa-eye"></i>&nbsp;&nbsp;<?php echo $view_count; ?> views</span>
            </div>
            <div class="col-right">
                <a class="btn btn-default btn-warning pull-right btn-font btn-checkout"
                   href="offer_link.php?id=<?php echo $row['product_id']; ?>"
                   target="_blank"><?php echo $settingsRow['buy_button']; ?></a>
            </div>
        </div>
    </div>
    <?php
    if ($count == 5) { ?>
        <div class="desktop-hide col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeIn animation-off-mobilea"
             style="padding-left:15px; padding-right:15px; margin-bottom:0;">
            <div id="sidebar-subscribe-box">
                <div class="sidebar-subscribe-box-wrapper">
                    <h2 style="margin-top: 10px; font-size: 19px;"><?php echo $_SESSION['mobSubBoxTitle']; ?></h2>
                    <p style="display: block !important;margin-bottom: 0;text-align: center;line-height: 1.5em;"><?php echo $_SESSION['mobSubBoxDesc']; ?></p>
                    <div class="sidebar-subscribe-box-form">
                        <div style="margin-top: 5px;" id="output-subscribe-mobile"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>
<nav id="page-nav"><a href="data_cat.php?page=2"></a></nav>
<script async type="text/javascript"
        src="https://cdn.staticfile.org/jquery-infinitescroll/2.1.0/jquery.infinitescroll.min.js"></script>
<script>$("#display-posts").infinitescroll({
        navSelector: "#page-nav",
        nextSelector: "#page-nav a",
        itemSelector: ".col-box",
        checkLastPage: !0,
        prefill: !0,
        scrollThreshold: 100,
        hideNav: "#page-nav",
        loading: {finishedMsg: "No more posts to load.", img: "assets/ajaxloader.gif"}
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
                var a = $(this).data("id"), t = $(this).data("name"), i = "id=" + a, e = $(this);
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
                var a = $(this).data("id"), t = $(this).data("name"), i = "id=" + a, e = $(this);
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
    });</script>
<script type="text/javascript">function openLogin() {
        window.location = "login/";
    }</script>
<script async src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>