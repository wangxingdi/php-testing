<?php include("header_listing.php");
error_reporting(E_ALL ^ E_NOTICE);
if ($sql = $mysqli->query("SELECT * FROM mp_options WHERE id=1")) {
    $ActiveRow2 = mysqli_fetch_array($sql);
    $symbol = stripslashes($ActiveRow2['price_symbol']);
    $strActive = strlen($symbol);
    if ($strActive > 4) {
        $ActiveSymbol = substr($symbol, 0, 4) . '...';
    } else {
        $ActiveSymbol = $symbol;
    }
    $txt_save = $ActiveRow2['txt_save'];
    $txt_remove = $ActiveRow2['txt_remove'];
    $txt_related = $ActiveRow2['txt_related'];
} else {
    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");;
}
?>
<div class="container prod-container container-pull container-pull-mobile" id="display-posts">
    <script async src="js/jquery.csbuttons.min.js"></script>
    <script>$(document).ready(function () {
            $(".csbuttons").cSButtons({
                total: "#total",
                url: "<?php echo $protocol . $settings['siteurl'];?>/<?php echo $PageLink;?>/"
            })
        }),
        $(function () {
            $(".saves").click(function () {
                var t = $(this).data("id"), a = $(this).data("name"), s = "id=" + t, e = $(this);
                return "save" == a && ($(this).fadeIn(200).html, $.ajax({
                    type: "POST",
                    url: "save_lists.php",
                    data: s,
                    cache: !1,
                    success: function (t) {
                        e.html(t)
                    }
                })), !1
            })
        }),
        $(function () {
            $(".save-list").click(function () {
                var t = $(this).data("id"), a = $(this).data("name"), s = "id=" + t, e = $(this);
                return "save" == a && ($(this).fadeIn(200).html, $.ajax({
                    type: "POST",
                    url: "save_lists.php",
                    data: s,
                    cache: !1,
                    success: function (t) {
                        e.parent().parent().parent().find(".saves").html(t)
                    }
                })), !1
            })
        });
    </script>
    <div class="col-top col-top-mod">
        <div class="col-md-8 col-md-8-mod listing-mobile wow fadeIn">
            <div class="col-holder">
                <div class="col-info mobile-remove">
                    <div class="col-info-left"><h1 class="title-mod"><?php echo $products_row['product_name']; ?></h1>
                        <?php
                        if (!isset($_SESSION['username'])) { ?>
                            <span class="info-saves">
                                <a onclick="openLogin()">
                                    <span class="fas fa-heart"></span> &nbsp;
                                    <?php echo $products_row['product_saves']; ?> saves</a>
                            </span>
                        <?php } else {
                            if ($count_save_listing == 1) { ?>
                                <span class="info-saves">
                                    <a class="saves remove-save" id="save-<?php echo $product_id; ?>" data-id="<?php echo $product_id; ?>" data-name="save" title="You have saved this. Click to remove.">
                                        <span class="fas fa-heart"></span> &nbsp;
                                        <?php echo $products_row['product_saves']; ?> saves
                                    </a>
                                </span>
                        <?php
                            } else { ?>
                                <span class="info-saves">
                                    <a class="saves" id="save-<?php echo $product_id; ?>" data-id="<?php echo $product_id; ?>" data-name="save" title="Click to save this item.">
                                        <span class="fas fa-heart"></span> &nbsp;
                                        <?php echo $products_row['product_saves']; ?> saves
                                    </a>
                                </span>
                                <?php
                            }
                        } ?>
<!--                        <span class="info-saves"> &nbsp;-->
<!--                            <i class="fas fa-eye"></i>&nbsp;&nbsp;-->
<!--                            --><?php //echo $product_views; ?><!-- views-->
<!--                        </span>-->
                    </div>
                </div>
                <a class="col-link" href="<?php echo $products_row['product_affiliate_url']; ?>" target="_blank">
                    <img src=<?php echo $products_row['product_external_link']; ?> alt="<?php echo $products_row['product_name']; ?>" class="img-responsive slide-img" style="width: 650px; height: 550px;">
                </a>
                <div class="col-share">
                <?php
                    if (!isset($_SESSION['username'])) {
                ?>
                        <a class="btn btn-default btn-lg btn-danger btn-font" onclick="openLogin()"><?php echo $txt_save; ?></a>
                <?php
                    } else {
                        if ($count_save_listing == 1) {
                ?>
                        <a class="btn btn-default btn-lg btn-danger btn-font save-list remove-list" id="listing-<?php echo $product_id; ?>" data-id="<?php echo $product_id; ?>" data-name="save"><?php echo $txt_remove; ?></a>
                <?php
                        } else {
                ?>
                        <a class="btn btn-default btn-lg btn-danger btn-font save-list" id="listing-<?php echo $product_id; ?>" data-id="<?php echo $product_id; ?>" data-name="save"><?php echo $txt_save; ?></a>
                <?php
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-md-4-mod">
            <div class="col-sm-top mobile-remove">
                <?php
                    if (!empty($Ad1)) {
                        echo $Ad1;
                    }
                ?>
            </div>
            <div class="col-sm-top col-description">
                <h1 class="desktop-remove"><?php echo $products_row['product_name']; ?></h1>
                <p style="text-align:justify;"><?php echo $product_description; ?></p>
                <div class="col-center-items col-center-items-mod">
                    <h1 class="price"><?php echo $ActiveSymbol; ?><?php echo $products_row['product_price']; ?></h1>
                    <?php if (!isset($_SESSION['username'])) { ?>
                        <a onclick="openLogin()" class="btn-product btn-product-mod btn btn-warning btn-block btn-lg btn-font btn-wishlist desktop-remove">
                            <i class="fas fa-cart-plus"></i> ADD TO WISHLIST
                        </a>
                    <?php } else {
                        if ($count_save_listing == 1) { ?>
                            <a id="btn-wishlist" class="btn-product btn-product-mod btn btn-warning btn-block btn-lg btn-font btn-wishlist-remove desktop-remove save-list remove-list"
                               id="wishlist-<?php echo $product_id; ?>" data-id="<?php echo $product_id; ?>" data-name="save">
                                <i class="fas fa-trash-alt"></i> REMOVE FROM WISHLIST
                            </a>
                            <?php
                        } else { ?>
                            <a id="btn-wishlist" class="btn-product btn-product-mod btn btn-warning btn-block btn-lg btn-font btn-wishlist desktop-remove save-list"
                               id="wishlist-<?php echo $product_id; ?>" data-id="<?php echo $product_id; ?>" data-name="save">
                                <i class="fas fa-cart-plus"></i> ADD TO WISHLIST
                            </a>
                            <?php
                        }
                    } ?>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#btn-wishlist').click(function () {
                                if ($(this).html() == '<i class="fas fa-cart-plus"></i> ADD TO WISHLIST') {
                                    $(this).removeClass('btn-wishlist');
                                    $(this).addClass('btn-wishlist-remove');
                                    $(this).addClass('remove-list');
                                    $(this).html('<i class="fas fa-trash-alt"></i> REMOVE FROM WISHLIST');
                                } else {
                                    $(this).removeClass('btn-wishlist-remove');
                                    $(this).addClass('btn-wishlist');
                                    $(this).removeClass('remove-list');
                                    $(this).html('<i class="fas fa-cart-plus"></i> ADD TO WISHLIST');
                                }
                            });
                        });
                    </script>
                    <a class="btn-product btn-product-mod btn btn-warning btn-block btn-lg btn-font btn-pull btn-pull-mod btn-checkout"
                       href="<?php echo $products_row['product_affiliate_url']; ?>" target="_blank">
                        <i class="fas fa-money-check-alt"></i> <?php echo $settings['buy_button']; ?>
                    </a>
                    <br/>
                </div><!--col-center-items-->
            </div><!--col-sm-top-->
        </div><!--col-md-4-->
    </div><!--col-top-->
</div><!-- /.container -->
<div class="container prod-container">
    <div class="col-social-page col-social-page-mod">
        <a id="fb-bg" class="socail-icons csbuttons" data-type="facebook"><span class="fab fa-facebook-f"></span></a>
        <a id="twitter-bg" class="socail-icons csbuttons" data-type="twitter"><span class="fab fa-twitter"></span></a>
        <a id="pinterest-bg" class="socail-icons csbuttons" data-type="pinterest"><span class="fab fa-pinterest"></span></a>
        <a id="gplus-bg" class="socail-icons csbuttons" data-type="google"><span class="fab fa-google-plus"></span></a>
    </div>
    <div class="col-comments">
        <div class="fb-comments" data-href="<?php echo $protocol . $settings['siteurl']; ?>/<?php echo $PageLink; ?>/" data-num-posts="6" data-width="100%"></div>
    </div>
</div>
<div class="container prod-container display-posts" style="padding-left: 10px;padding-right: 10px;margin-top:0;">
    <div class="other-titles">
        <h3><?php echo $txt_related; ?></h3>
    </div>
    <?php
    if ($RelSql = $mysqli->query("SELECT * FROM mp_products WHERE category_id='$catid' and product_state=1 ORDER BY RAND() LIMIT 9")) {
        while ($RelRow = mysqli_fetch_array($RelSql)) {
            $listing_id = $RelRow['product_id'];
            $RelLongDisc = $RelRow['product_description'];
            $RelStrDisc = strlen($RelLongDisc);
            if ($RelStrDisc > 243) {
                $RelDsicLong = substr($RelLongDisc, 0, 240) . '...';
            } else {
                $RelDsicLong = $RelLongDisc;
            }
            $RelTitle = $RelRow['product_name'];
            $RelStrt = strlen($RelTitle);
            if ($RelStrt > 29) {
                $tlong = substr($RelTitle, 0, 26) . '...';
            } else {
                $tlong = $RelTitle;
            }
            $RelLink = $RelRow['product_permalink'];
//            $view_count = $RelRow['product_views'];
            ?>
            <div class="col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeIn">
                <a href="<?php echo $RelLink; ?>/"><h2 class="title-bottom"><?php echo $tlong; ?></h2></a>
                <div class="col-holder">
                    <a class="col-link" href="<?php echo $RelLink; ?>/">
                        <img class="img-responsive" src="../cache/timthumb.php?src=./images/<?php echo $row['product_image']; ?>&amp;h=250&amp;w=300&amp;q=100" alt="<?php echo $tlong; ?>">
                    </a>
                    <div class="col-share">
                        <?php if (!isset($_SESSION['username'])) { ?>
                            <a class="btn btn-default btn-lg btn-danger btn-font" onclick="openLogin()"><?php echo $txt_save; ?></a>
                        <?php } else {
                            $user_sql = $mysqli->query("SELECT * FROM mp_saves WHERE listing_id='$listing_id' AND user_id='$Uid'");
                            $count_save = mysqli_num_rows($user_sql);
                            $user_sql->close();
                            if ($count_save == 1) { ?>
                                <a class="btn btn-default btn-lg btn-danger btn-font save-list remove-list" id="<?php echo $listing_id; ?>" data-id="<?php echo $listing_id; ?>" data-name="save"><?php echo $txt_remove; ?></a>
                                <?php
                            } else { ?>
                                <a class="btn btn-default btn-lg btn-danger btn-font save-list" id="<?php echo $listing_id; ?>" data-id="<?php echo $listing_id; ?>" data-name="save"><?php echo $txt_save; ?></a>
                                <?php
                            }
                        } ?>
                        <a class="btn-share btn-fb fab fa-facebook-f" href="javascript:void(0);" onclick="popup('https://www.facebook.com/share.php?u=<?php echo $protocol . $settings['siteurl']; ?>/<?php echo $RelLink; ?>/&amp;title=<?php echo urlencode(ucfirst($tlong)); ?>')"></a>
                        <a class="btn-share btn-twitter fab fa-twitter" href="javascript:void(0);" onclick="popup('https://twitter.com/home?status=<?php echo urlencode(ucfirst($tlong)); ?>+<?php echo $protocol . $settings['siteurl']; ?>/<?php echo $RelLink; ?>/')"></a>
                        <a class="btn-share btn-pin fab fa-pinterest" href="javascript:void(0);" onclick="popup('//pinterest.com/pin/create%2Fbutton/?url=<?php echo $protocol . $settings['siteurl']; ?>/<?php echo $RelLink; ?>/')"></a>
                    </div>
                </div><!-- /.col-holder-->
                <div class="col-description"><p><?php echo $RelDsicLong; ?></p></div>
                <div class="col-bottom">
                    <div class="col-left">
                        <span class="info-price"><h3><?php echo $ActiveSymbol; ?><?php echo $RelRow['product_price']; ?></h3></span>
                        <?php if (!isset($_SESSION['username'])) { ?>
                            <span class="info-saves">
                                <a onclick="openLogin()">
                                    <span class="fas fa-heart"></span> &nbsp;<?php echo $RelRow['product_saves']; ?> saves
                                </a>
                            </span>
                        <?php } else {
                            if ($count_save == 1) { ?>
                                <span class="info-saves">
                                    <a class="saves remove-save" id="save-<?php echo $listing_id; ?>" data-id="<?php echo $listing_id; ?>" data-name="save" title="You have saved this. Click to remove.">
                                        <span class="fas fa-heart"></span> &nbsp;<?php echo $RelRow['product_saves']; ?> saves
                                    </a>
                                </span>
                                <?php
                            } else { ?>
                                <span class="info-saves">
                                    <a class="saves" id="save-<?php echo $listing_id; ?>" data-id="<?php echo $listing_id; ?>" data-name="save" title="Click to save this item.">
                                        <span class="fas fa-heart"></span> &nbsp;<?php echo $RelRow['product_saves']; ?> saves
                                    </a>
                                </span>
                                <?php
                            }
                        } ?>
<!--                        <span class="info-saves"> &nbsp;-->
<!--                            <i class="fas fa-eye"></i>&nbsp;&nbsp;--><?php //echo $view_count; ?><!-- views-->
<!--                        </span>-->
                    </div>
                    <div class="col-right">
                        <a class="btn btn-default btn-warning pull-right btn-font btn-checkout" href="<?php echo $RelRow['product_affiliate_url']; ?>" target="_blank"><?php echo $settings['buy_button']; ?></a>
                    </div>
                </div>
            </div>
            <?php
        }
        $RelSql->close();
    } else {
        printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");;
    }
    ?>
</div><!-- /.container-->
<?php include("footer.php"); ?>
<script type="text/javascript">
    function openLogin() {
        window.location = "login/";
    }
</script>