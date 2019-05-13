<?php include("header.php");
error_reporting(E_ALL ^ E_NOTICE);
$sort = $mysqli->escape_string($_GET['sort']);
if (!empty($Ad4)) {
    ?>
    <div id="feat-img" class="feat-img"><?php echo $Ad4; ?></div>
    <?php
} else {
    ?>
    <script type='text/javascript'>
        $(function () {
            $("#container").addClass("feat-img-hidden")
        });
    </script>
    <?php
}
?>
<div id="container" class="container container-mod container-pull">
    <div id="listNav" class="list-nav list-nav-mod small-screen-remove">
        <ul>
            <li><a id="popular" data-sort="112" <?php if ($sort == "popular") {
                    echo "class=active";
                } ?>><h3><i class="fas fa-fire i-mod"></i><?php echo $txt_popular_index; ?></h3></a></li>
            <li><a id="low" data-sort="108" <?php if ($sort == "low") {
                    echo "class=active";
                } ?>><h3><i class="fas fa-arrow-circle-down i-mod"></i><?php echo $txt_low; ?></h3></a></li>
            <li><a id="high" data-sort="104" <?php if ($sort == "high") {
                    echo "class=active";
                } ?>><h3><i class="fas fa-arrow-circle-up i-mod"></i><?php echo $txt_high; ?></h3></a></li>
            <!--
            <span><a class="icon gifts-alone" id="gifts" href="gifts-under-20-newest/" data-sort="103" class=""><h3><i class="fas fa-gift i-mod fa-rotate-90"></i><?php echo $txt_gifts_under; ?> <?php echo $ActiveSymbol; ?><?php echo $gifts_under_limit; ?></h3></a></span>
-->
        </ul>
    </div>

    <?php
    if (!empty($SettingsRow['MailgunPrivateKey']) || !empty($SettingsRow['MailgunPublicKey']) || !empty($SettingsRow['MailgunDomain']) || !empty($SettingsRow['MailgunList']) || !empty($SettingsRow['MailgunSecret'])) {
        ?>
        <div style="width:33%; margin-right: 15px;" class="mailbox mailbox-remove">
            <form id="formSubscribe" name="formSubscribe" method="post" action="subscribe.php">
                <input type="text" class="sidebar-subscribe-box-email-field" name="email" id="email"
                       placeholder="Enter your email..">
                <input type="submit" value="SUBSCRIBE" id="mailSubmit" class="sidebar-subscribe-box-email-button"/>
                <div id="output-subscribe"></div>
            </form>
        </div>
        <?php
    }
    ?>
    <div id="display-posts-main">
        <div class="loader" style="text-align:center;"><img src="images/loader_3.svg"/></div>
    </div>
</div>
<?php include("footer.php"); ?>
<script type="text/javascript">
    var sort_default = "<?php echo $sort; ?>";
    sort_default = sort_default.charCodeAt(0), $.ajax({
        url: "fetch_main.php",
        method: "post",
        data: {sort: sort_default},
        success: function (t) {
            $("#display-posts-main").html(t)
        }
    });
</script>