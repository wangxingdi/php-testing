<?php include("header.php");
error_reporting(E_ALL ^ E_NOTICE);
?>

<div class="container container-pull" id="display-posts">
    <div class="col-top">
        <div class="col-md-8">
            <div class="page-titles"><h1>关于我们</h1></div>
            <?php
            if ($pages = $mysqli->query("SELECT * FROM  mp_pages WHERE id='1'")) {
                $pagerow = mysqli_fetch_array($pages);
            ?>
                <p><?php echo $pagerow['page']; ?></p>
            <?php
                $pages->close();
            } else {
                printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of pages, Please check it.</div>");;
            }
            ?>
        </div>
        <div class="col-md-4 mobile-remove">
            <?php include("side_bar.php"); ?>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>