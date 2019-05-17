<?php include("header_cat.php");
error_reporting(E_ALL ^ E_NOTICE);
$minimum_range = 0;
$siteurl = $settings['siteurl'];
$sort = $mysqli->escape_string($_GET['sort']);
if (!isset($sort)) {
    $sort = 'newest';
}
?>
<div class="container container-mod container-pull cat-pull" id="cat-page">
    <div class="gifts-sidebar ng-scope">
        <ul class="menu" id="menu-categories"><h3>全部分类</h3>
            <?php
            if ($cat_list_sql = $mysqli->query("SELECT * FROM mp_categories")) {
                while ($cat_list_row = mysqli_fetch_array($cat_list_sql)) {
                    $cat_name = $cat_list_row['cname'];
                    $Cat_Url = $cat_list_row['cname2'];
                    $cat_id = $cat_list_row['id'];
                    $cat_parent_id = $cat_list_row['parent_id'];
                    $is_a_branch = $cat_list_row['branch'];
                    $is_sub_cat = $cat_list_row['is_sub_cat'];
                    if ($is_sub_cat != 1) { ?>
                        <li><a class="<?php if ($Cat_Url == $cname) {
                                echo 'active ';
                            } ?>auto-localize" href="category/<?php echo $Cat_Url; ?>/"><?php echo $cat_name; ?></a>
                        </li>
                        <?php if ($is_a_branch == 1) {
                            if ($sub_cat_list = $mysqli->query("SELECT * FROM mp_categories WHERE parent_id = $cat_id")) {
                                while ($sub_cat_list_row = mysqli_fetch_array($sub_cat_list)) {
                                    $sub_cat_name = $sub_cat_list_row['cname'];
                                    $sub_Cat_Url = $sub_cat_list_row['cname2'];
                                    $sub_cat_id = $sub_cat_list_row['id'];
                                    ?>
                                    <ul class="submenu">
                                        <li style="list-style: none;">
                                            <a class="<?php if ($sub_Cat_Url == $cname) {
                                                echo 'active ';
                                            } ?>auto-localize" href="category/<?php echo $sub_Cat_Url; ?>/">
                                                <i style="font-size: 11px;" class="fas fa-arrow-right"></i> <?php echo $sub_cat_name; ?>
                                            </a>
                                        </li>
                                    </ul>
                                <?php }
                            } else {
                                printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of categories. Please check it.</div>");
                            }
                            $sub_cat_list->close();
                        }
                    }
                }
                $cat_list_sql->close();
            } else {
                printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of categories. Please check it.</div>");
            }
            ?>
        </ul>
    </div>
    <div class="cat-main">
        <h1 id="title" class="cat-main-title ng-binding"><?php echo $CategoryName; ?></h1>
        <?php
        if (!empty($SettingsRow['MailgunPrivateKey']) || !empty($SettingsRow['MailgunPublicKey']) || !empty($SettingsRow['MailgunDomain']) || !empty($SettingsRow['MailgunList']) || !empty($SettingsRow['MailgunSecret'])) { ?>
            <span class="mailbox cat-page-remove" style="margin-top: 10px;">
                <form id="formSubscribe" name="formSubscribe" method="post" action="subscribe.php">
                    <div>
                        <input type="text" class="sidebar-subscribe-box-email-field" name="email" id="email" placeholder="Enter your email..">
                        <input type="submit" value="SUBSCRIBE" id="mailSubmit" class="sidebar-subscribe-box-email-button"/>
                        <div id="output-subscribe"></div>
                    </div>
                </form>
            </span>
            <?php
        }
        ?>
        <p class="small-screen-remove gifts-description ng-binding"><?php echo $CategoryDesc; ?></p>
        <div id="row" class="row">
            <?php
            if ($max_price_sql = $mysqli->query("SELECT MAX(CAST(price AS UNSIGNED)) AS max_price FROM mp_products WHERE category_id = '$cid' ")) {
                $max_price_sql_row = mysqli_fetch_array($max_price_sql);
                $max_price = $max_price_sql_row['max_price'];
                if (!isset($max_price)) {
                    $max_price = 0;
                } else {
                    $max_price = $max_price_sql_row['max_price'];
                }
            }
            ?>
            <div class="col-md-2 min small-screen-remove">
                <input type="hidden" id="cid" name="cid" value="<?php echo $cid; ?>"/>
                <input type="hidden" id="sort" name="sort" value="<?php echo ord($sort); ?>"/>
                <input type="text" name="minimum_range" id="minimum_range" class="form-control"
                       value="<?php echo $minimum_range; ?>" disabled>
            </div>
            <div class="col-md-6 price-slider small-screen-remove" style="padding-top:12px">
                <div id="price_range"></div>
            </div>
            <div class="col-md-2 max small-screen-remove">
                <input type="text" name="max_price" id="max_price" class="form-control" value="<?php echo $max_price; ?>" disabled>
            </div>
            <div class="col-md-2 sort">
                <select id="cat_sort" name="cat_sort" class="form-control sort_value">
                    <option value="newest">Newest</option>
                    <option value="popular">Most Popular</option>
                    <option value="high">Highest to Lowest</option>
                    <option value="low">Lowest to Highest</option>
                </select>
            </div>
        </div>
        <div id="display-posts">
            <div id="loader" style="display:none;text-align:center;"><img src="assets/loader_3.svg"/></div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
<script>$('#cat_sort').val('<?php echo $sort; ?>');
    var sort_value = '<?php echo $sort; ?>';
    sort_value = sort_value.charCodeAt(0);
    $('#cat_sort').change(function (e) {
        $('#cat_sort').attr('disabled', '');
        $('#cat_sort').removeAttr('disabled');
        e.preventDefault();
        sort_value = $('#cat_sort').val().charCodeAt(0);
    });
    $(document).ready(function () {
        $("#price_range").slider({
            range: true,
            min: 0,
            max: '<?php echo $max_price; ?>',
            values: [ <?php echo $minimum_range; ?>, <?php echo $max_price; ?>],
            change: function (event, ui, cid, sort_value) {
                $("#minimum_range").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
                load_product(ui.values[0], ui.values[1], <?php echo $cid; ?>, sort_value);
            }
        });
        load_product(<?php echo $minimum_range; ?>, <?php echo $max_price; ?>, <?php echo $cid; ?>, sort_value);

        function load_product(minimum_range, max_price, cid, sort) {
            $.ajax({
                url: "fetch_products.php",
                method: "POST",
                data: {minimum_range: minimum_range, max_price: max_price, cid: cid, sort: sort_value},
                success: function (data) {
                    $('#display-posts').html(data);
                }
            });
        }
    });
</script>
<script type="text/javascript">var sort = "<?php echo $sort; ?>";
    sort = sort.charCodeAt(0);
    var cat_url = "<?php echo $CategoryUrl; ?>", pageurl = "";
    $("#cat_sort").change(function (r) {
        $("#cat_sort").attr("disabled", ""), $("#cat_sort").removeAttr("disabled"), r.preventDefault();
        var a = $("#minimum_range").val(), t = $("#max_price").val(), e = $("#cid").val();
        switch ($("#cat_sort").val()) {
            case"newest":
                sort = 110, pageurl = "category/" + cat_url + "/";
                break;
            case"popular":
                sort = 112, pageurl = "category/" + cat_url + "/popular/";
                break;
            case"high":
                sort = 104, pageurl = "category/" + cat_url + "/high/";
                break;
            case"low":
                sort = 108, pageurl = "category/" + cat_url + "/low/";
                break;
            default:
                sort = 110, pageurl = "category/" + cat_url + "/"
        }
        $.ajax({
            url: "fetch_products.php",
            method: "POST",
            data: {minimum_range: a, max_price: t, cid: e, sort: sort},
            success: function (r) {
                $("#display-posts").html(r), window.history.pushState("object or string", "Title", pageurl)
            }
        });
    });
    0 == $("#minimum_range").val() && 0 == $("#max_price").val() && ($("#row").hide(), $("#display-posts").css("margin-top", "0"));
</script>