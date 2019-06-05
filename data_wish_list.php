<?php include("header.php");
error_reporting(E_ALL ^ E_NOTICE);
$user = $mysqli->escape_string($_GET['user']);
?>

<div class="container container-pull" id="display-posts">
    <?php

    $page = $_GET["page"];
    $start = ($page - 1) * 9;
    $result = $mysqli->query("SELECT * FROM mp_saves LEFT JOIN mp_products ON mp_saves.product_id=mp_products.product_id WHERE mp_saves.user_id=$user ORDER BY mp_saves.save_id DESC LIMIT $start, 9");
    while ($row = mysqli_fetch_array($result)) {
        $long = $row['product_description'];
        $strd = strlen($long);
        if ($strd > 140) {
            $dlong = $long;
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
        ?>

        <div class="col-sm-12 col-sm-12-mod col-xs-12 col-md-4 col-lg-4 col-box wow fadeInUp">
            <div class="col-holder">
                <a class="remove-product fa fa-remove" data-id="<?php echo $row['product_id']; ?>"
                   data-name="remove-save"></a>
                <a href="<?php echo $PageLink; ?>/">
                    <img class="img-responsive" src="../cache/timthumb.php?src=./images/<?php echo $row['product_image']; ?>&amp;h=500&amp;w=500&amp;q=100" alt="<?php echo $LongTitle; ?>">
                </a>
                <a href="<?php echo $PageLink; ?>/"><h2 class="title-bottom"><?php echo $tlong; ?></h2></a>
            </div>
        </div>
    <?php } ?>
</div>

<?php include("footer.php"); ?> 