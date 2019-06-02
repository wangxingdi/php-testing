<?php include("header_gifts.php");
$count = 0;
error_reporting(E_ALL ^ E_NOTICE);
$sort = $mysqli->escape_string($_GET['sort']);
?>
<div class="container container-mod container-pull gifts-pull">
    <div id="listNavGifts" class="list-nav list-nav-mod list-nav-gifts small-screen-remove">
        <ul>
            <li><a id="newest-gifts" data-sort="110" <?php if ($sort == "newest") {
                    echo "class=active";
                } ?>><h3><i class="fas fa-bolt i-mod"></i>Newest</h3></a></li>
            <li><a id="popular-gifts" data-sort="112" <?php if ($sort == "popular") {
                    echo "class=active";
                } ?>><h3><i class="fas fa-cart-plus i-mod"></i>Popular</h3></a></li>
        </ul>
    </div>
    <div id="display-posts-gifts">
        <div class="loader" style="text-align:center;"><img src="assets/loader.svg"/></div>
    </div>
</div>
<?php include("footer.php"); ?>
<script type="text/javascript">var sort_default_gift = "<?php echo $sort; ?>";
    "newest" != sort_default_gift && "popular" != sort_default_gift && (window.location = "404.php"), sort_default_gift = sort_default_gift.charCodeAt(0), $.ajax({
        url: "fetch_gifts.php",
        method: "post",
        data: {sort: sort_default_gift},
        success: function (t) {
            $("#display-posts-gifts").html(t)
        }
    });</script>