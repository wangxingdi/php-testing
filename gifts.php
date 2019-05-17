<?php include("header_gifts.php");
$count = 0;
error_reporting(E_ALL ^ E_NOTICE);
$sort = $mysqli->escape_string($_GET['sort']);
?>
<div class="container container-mod container-pull gifts-pull">
<div id="listNavGifts" class="list-nav list-nav-mod list-nav-gifts small-screen-remove">
<ul><li><a id="newest-gifts" data-sort="110" <?php if ($sort=="newest"){ echo "class=active";}?>><h3><i class="fas fa-bolt i-mod"></i>Newest</h3></a></li><li><a id="popular-gifts" data-sort="112" <?php if ($sort=="popular"){ echo "class=active";}?>><h3><i class="fas fa-cart-plus i-mod"></i>Popular</h3></a></li></ul></div>
<?php
if(!empty($SettingsRow['MailgunPrivateKey']) || !empty($SettingsRow['MailgunPublicKey']) || !empty($SettingsRow['MailgunDomain']) || !empty($SettingsRow['MailgunList']) || !empty($SettingsRow['MailgunSecret']))
{ ?>
<div class="mailbox mailbox-remove-gifts" style="width:38%; margin-top: 0;"> 
<form id="formSubscribe" name="formSubscribe" method="post" action="subscribe.php"><div><input type="text" class="sidebar-subscribe-box-email-field" name="email" id="email" placeholder="Enter your email.."><input type="submit" value="SUBSCRIBE" id="mailSubmit" class="sidebar-subscribe-box-email-button" /><div id="output-subscribe"></div></div></form></div>
<?php
}
?> 
<div id="display-posts-gifts"><div class="loader" style="text-align:center;"><img src="assets/loader_3.svg" /></div></div>
</div><!-- /.container -->
<?php include("footer.php"); ?>
<script type="text/javascript">var sort_default_gift="<?php echo $sort; ?>";"newest"!=sort_default_gift&&"popular"!=sort_default_gift&&(window.location="404.php"),sort_default_gift=sort_default_gift.charCodeAt(0),$.ajax({url:"fetch_gifts.php",method:"post",data:{sort:sort_default_gift},success:function(t){$("#display-posts-gifts").html(t)}});</script>