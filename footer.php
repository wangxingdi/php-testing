<?php include("db.php");
if ($sql_analytics = $mysqli->query("SELECT * FROM mp_options WHERE id=1")) {
    $row = mysqli_fetch_array($sql_analytics);
    $code = $row['analytics'];
    echo $code;
    $sql_analytics->close();
}
?>
<div class="container small-screen-remove"><?php if (!empty($Ad2)) { ?>
        <div class="col-ad-long"><?php echo $Ad2; ?></div><?php } ?></div>
<footer class="main-footer main-footer-mod">
    <div class="container container-mod"><span
                class="pull-left footer-brand">&#169; <?php echo date("Y"); ?> <?php echo $settings['name']; ?>. All Rights Reserved.</span><span
                class="pull-right footer-links"><a href="<?php if (isset($page) == 'category') {
                echo '../about_us/';
            } else {
                echo 'about_us/';
            } ?>">About Us</a> | <a href="<?php if (isset($page) == 'category') {
                echo '../privacy_policy/';
            } else {
                echo 'privacy_policy/';
            } ?>">Privacy Policy</a> | <a href="<?php if (isset($page) == 'category') {
                echo '../tos/';
            } else {
                echo 'tos/';
            } ?>">Terms of Use</a> | <a href="<?php if (isset($page) == 'category') {
                echo '../contact_us/';
            } else {
                echo 'contact_us/';
            } ?>">Contact Us</a> <span style="font-size: 9px;margin-left: 20px;"></span></span>
    </div>
</footer>
<?php if (!empty($Ad3)){ ?>
<div class="col-ad-mobile"><?php echo $Ad3; ?></div><?php } ?></div><!--wrap-->
<a class="return-to-top" href="javascript:" id="return-to-top"><i class="fas fa-chevron-up"></i></a>
<script>$(window).scroll(function () {
        $(this).scrollTop() >= 50 ? $("#return-to-top").fadeIn(200) : $("#return-to-top").fadeOut(200)
    }), $("#return-to-top").click(function () {
        $("body,html").animate({scrollTop: 0}, 500)
    });</script>
<?php if ($settings['addthisFilter'] == '1') {
    echo $settings['addthis'];
} ?>
</body>
</html>