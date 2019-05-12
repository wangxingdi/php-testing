<?php include("header.php");
    error_reporting(E_ALL ^ E_NOTICE);
    $count = 0;
    if($SiteSettings = $mysqli->query("SELECT * FROM mp_options WHERE id='1'")){
        $SettingsRow = mysqli_fetch_array($SiteSettings);
        $txt_gifts_under = $SettingsRow['txt_gifts_under'];
        $gifts_under_limit = $SettingsRow['gifts_under_limit'];
        $txt_newest = $SettingsRow['txt_newest'];
        $txt_popular_index = $SettingsRow['txt_popular_index'];
        $txt_high = $SettingsRow['txt_high'];
        $txt_low = $SettingsRow['txt_low'];
        $SiteSettings->close();
    }else{
        printf("<div class='alert alert-danger alert-pull'>配置表查询失败(index.php)</div>");
    }
    $sort = $mysqli->escape_string($_GET['sort']);
    if(!empty($Ad4)) {
?>
        <div id="feat-img" class="feat-img"><?php echo $Ad4; ?><div class="feat-img-close"><a id="feat-img-close">&times;</a></div></div>
<?php
    } else {
?>
        <script type='text/javascript'>$(function(){$("#container").addClass("feat-img-hidden")});</script>
<?php
    }
?>
<div id="container" class="container container-mod container-pull">
    <div id="listNav" class="list-nav list-nav-mod small-screen-remove">
        <ul>
<!-- 首页副分类
            <li><a id="newest" data-sort="110" <?php if ($sort==""){ echo "class=active"; }else if ($sort=="none"){ echo "class=active"; }?>><h3><i class="fas fa-bolt i-mod"></i><?php echo $txt_newest; ?></h3></a></li>
-->
            <li><a id="popular" data-sort="112" <?php if ($sort=="popular"){ echo "class=active"; }?>><h3><i class="fas fa-fire i-mod"></i><?php echo $txt_popular_index; ?></h3></a></li>
            <li><a id="low" data-sort="108" <?php if ($sort=="low"){ echo "class=active"; }?>><h3><i class="fas fa-arrow-circle-down i-mod"></i><?php echo $txt_low; ?></h3></a></li>
            <li><a id="high" data-sort="104" <?php if ($sort=="high"){ echo "class=active"; }?>><h3><i class="fas fa-arrow-circle-up i-mod"></i><?php echo $txt_high; ?></h3></a></li>
<!--
            <span><a class="icon gifts-alone" id="gifts" href="gifts-under-20-newest/" data-sort="103" class=""><h3><i class="fas fa-gift i-mod fa-rotate-90"></i><?php echo $txt_gifts_under; ?> <?php echo $ActiveSymbol; ?><?php echo $gifts_under_limit; ?></h3></a></span>
-->
        </ul>
    </div>

    <?php
        if(!empty($SettingsRow['MailgunPrivateKey']) || !empty($SettingsRow['MailgunPublicKey']) || !empty($SettingsRow['MailgunDomain']) || !empty($SettingsRow['MailgunList']) || !empty($SettingsRow['MailgunSecret'])) {
    ?>
            <div style="width:33%; margin-right: 15px;" class="mailbox mailbox-remove">
                <form id="formSubscribe" name="formSubscribe" method="post" action="subscribe.php">
                    <input type="text" class="sidebar-subscribe-box-email-field" name="email" id="email" placeholder="Enter your email..">
                    <input type="submit" value="SUBSCRIBE" id="mailSubmit" class="sidebar-subscribe-box-email-button" />
                    <div id="output-subscribe"></div>
                </form>
            </div>
    <?php
        }
    ?>
    <div id="display-posts-main">
        <div class="loader" style="text-align:center;"><img src="images/loader_3.svg" /></div>
    </div>
</div>
<!-- /.container -->
<?php include("footer.php"); ?> 
<script type="text/javascript">var sort_default="<?php echo $sort; ?>";sort_default=sort_default.charCodeAt(0),$.ajax({url:"fetch_main.php",method:"post",data:{sort:sort_default},success:function(t){$("#display-posts-main").html(t)}});</script>