<?php session_start();
include("db.php");
error_reporting(E_ALL ^ E_NOTICE);
$sort = $mysqli->escape_string(chr($_POST["sort"]));
$_SESSION['sort'] = $sort;
$user_id = $_SESSION['user_id'];
$count = 0;
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
    $gifts_under_limit = $settingsRow['gifts_under_limit'];
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
if ($sort == "n") {
    $sortpage = "newest";
    $result = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 AND CAST(product_price AS UNSIGNED) <= '$gifts_under_limit' ORDER BY product_id DESC LIMIT 0, 27");
} else if ($sort == "p") {
    $sortpage = "popular";
    $result = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 AND CAST(product_price AS UNSIGNED) <= '$gifts_under_limit' ORDER BY product_views DESC LIMIT 0, 27");
} else {
    $sortpage = "none";
    $result = $mysqli->query("SELECT * FROM mp_products WHERE product_state=1 AND CAST(product_price AS UNSIGNED) <= '$gifts_under_limit' ORDER BY product_id DESC LIMIT 0, 27");
}
$NumResults = mysqli_num_rows($result);
if ($NumResults < 1) {
    ?>
    <div class="no-lisings alert alert-info">We're still searching for the best products for you. Please check back
        later!
    </div>
<?php }
while ($row = mysqli_fetch_array($result)) {
    $count++;
    $listing_id = $row['product_id'];
    $long = $row['product_description'];
    $strd = strlen($long);
    if ($strd > 243) {
        $dlong = substr($long, 0, 240) . '...';
    } else {
        $dlong = $long;
    }
    $LongTitle = $row['product_name'];
    $strt = strlen($LongTitle);
    if ($strt > 40) {
        $tlong = substr($LongTitle, 0, 37) . '...';
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
    } ?> style="padding-left:15px; padding-right:15px;">
        <a href="<?php echo $PageLink; ?>/"><h2><?php echo $tlong; ?></h2></a>
        <div class="col-holder">
            <a class="col-link" href="offer_link.php?id=<?php echo $row['product_id']; ?>" target="_blank">
                <img class="img-responsive" src="../cache/timthumb.php?src=./images/<?php echo $row['product_image']; ?>&amp;h=250&amp;w=300&amp;q=100" alt="<?php echo $LongTitle; ?>">
            </a>
            <div class="col-share">
                <?php if (!isset($_SESSION['username'])) { ?>
                    <a class="btn btn-default btn-lg btn-danger btn-font"
                       onclick="openLogin()"><?php echo $txt_save; ?></a>
                <?php } else {
                    $user_sql = $mysqli->query("SELECT * FROM saves WHERE listing_id='$listing_id' AND user_id='$user_id'");
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
        </div>
        <div class="col-description"><p><?php echo $dlong; ?></p></div>
        <div class="col-bottom">
            <div class="col-left"><span
                        class="info-price"><h3><?php echo $ActiveSymbol; ?><?php echo $row['product_price']; ?></h3></span>
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
            <div class="col-right"><a class="btn btn-default btn-warning pull-right btn-font btn-checkout"
                                      href="offer_link.php?id=<?php echo $row['product_id']; ?>"
                                      target="_blank"><?php echo $settingsRow['buy_button']; ?></a></div>
        </div>
    </div>
    <?php
    if ($count == 5) { ?>
        <div class="desktop-hide col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeInUp"
             style="padding-left:15px; padding-right:15px; margin-bottom:0;">
            <div id="sidebar-subscribe-box">
                <div class="sidebar-subscribe-box-wrapper">
                    <h2 style="margin-top: 10px; font-size: 19px;"><?php /*echo $_SESSION['mobSubBoxTitle']; */?></h2>
                    <p style="display: block !important;margin-bottom: 0;text-align: center;line-height: 1.5em;"><?php echo $_SESSION['mobSubBoxDesc']; ?></p>
                    <div class="sidebar-subscribe-box-form">
                        <div style="margin-top: 5px;" id="output-subscribe-mobile"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>
<nav id="page-nav"><a href="data_gifts.php?page=2"></a></nav>
<script async src="https://cdn.staticfile.org/jquery-infinitescroll/2.1.0/jquery.infinitescroll.min.js"></script>
<script>$("#display-posts-gifts").infinitescroll({
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
</div><!-- /.container -->
<script async src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
<script type="text/javascript">function openLogin() {
        window.location = "login/";
    }</script>