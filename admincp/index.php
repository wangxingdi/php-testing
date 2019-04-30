<?php include("header.php");?>
    <section class="col-md-2">
        <?php include("left_menu.php");?>
    </section>
    <section class="col-md-10">
        <ol class="breadcrumb">
            <li>管理员控制台</li>
            <li class="active">仪表盘</li>
            <span class="theme-label">Amazon Dominator v<?php echo $Settings['version'];?></span>
        </ol>
        <div class="page-header">
            <h3 style="display: inline-block;">仪表盘</h3> <span><a class="btn-add" href="new_product.php">新增商品</a></span>
        </div>
        <section class="col-md-8 box-space-right">
            <section class="col-md-6 at-a-glance">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>概览</h4></div>
                    <div class="panel-body">
                        <ul>
                            <?php
                                if($TotalProducts = $mysqli->query("SELECT id FROM listings")){
                                    $CountTotal = $TotalProducts->num_rows;
                            ?>
                            <li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-home"></i> <a href="active_listings.php"><?php echo $CountTotal . ' '; if($CountTotal==1){echo '商品';}else{echo '商品';};?></a></span></li>
                            <?php
                                    $TotalProducts->close();
                                }else{
                                    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of listings. Please check it.</div>");
                                }
                                if($TotalPosts = $mysqli->query("SELECT id FROM posts")){
                                    $CountTotalPosts = $TotalPosts->num_rows;
                            ?>
                            <li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-wordpress"></i> <a href="manage_posts.php"><?php echo $CountTotalPosts . ' '; if($CountTotalPosts==1){echo '文章';}else{echo '文章';} ?></a></span></li>
                            <?php
                                    $TotalPosts->close();
                                }else{
                                    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of listings. Please check it.</div>");
                                }
                            ?>
                            <li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-chart-bar"></i> <?php echo $Settings['site_hits'];?> 网站访问量</span></li>
                            <?php
                                if($TotalProducts = $mysqli->query("SELECT SUM(views) AS VIEWS FROM listings")){
                                    $TotalProductsCount = mysqli_fetch_array($TotalProducts);
                            ?>
                                    <li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-chart-bar"></i> <?php echo $TotalProductsCount['VIEWS'];?> 商品访问量</span></li>
                            <?php
                                    $TotalProducts->close();
                                }else{
                                    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of listings. Please check it</div>");
                                }
                                if($LinkHits = $mysqli->query("SELECT SUM(hits) AS HITS FROM listings")){
                                    $CountLinkHits = mysqli_fetch_array($LinkHits);
                            ?>
                                    <li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-chart-bar"></i> <?php echo $CountLinkHits['HITS'];?> 推广链接点击量</span></li>
                            <?php
                                    $LinkHits->close();
                                }else{
                                    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of listings. Please check it.</div>");
                                }
                                if($Saves = $mysqli->query("SELECT save_id FROM saves")){
                                    $CountSaves = $Saves->num_rows;
                            ?>
                                    <li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-heart"></i> <?php echo $CountSaves;?> 关注</span></li>
                            <?php
                                    $Saves->close();
                                }else{
                                    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of saves. Please check it.</div>");
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </section>
        </section>
        <section class="col-md-8 box-space-top">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>最近上架商品</h4>
                </div>
                <div class="panel-body">
                    <?php
                        $DisplayApproved= $mysqli->query("SELECT * FROM listings WHERE active='1' ORDER BY id DESC LIMIT 10");
                        $NumberOfApp = $DisplayApproved->num_rows;
                        if ($NumberOfApp==0) {
                            echo '<div class="alert alert-danger">现在你还没有上架任何商品.</div>';
                        }
                        if ($NumberOfApp>0){
                    ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>缩略图</th>
                            <th>标题</th>
                            <th>上架日期</th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php
                        }
                        while($AppRow = mysqli_fetch_assoc($DisplayApproved)){
                            $AppLongTitle = stripslashes($AppRow['title']);
                            $CropAppTitle = strlen ($AppLongTitle);
                            if ($CropAppTitle > 200) {
                                $SortAppTitle = substr($AppLongTitle,0,200).'...';
                            }else{
                                $SortAppTitle = $AppLongTitle;}
                            $AppPostLink = preg_replace("![^a-z0-9]+!i", "-", $AppLongTitle);
                            $AppPostLink = urlencode($AppPostLink);
                            $AppPostLink = strtolower($AppPostLink);
                    ?>
                            <tr>
                                <td><a href="edit_product.php?id=<?php echo $AppRow['id'];?>">
                                        <!--
                                        <img style="margin:0 auto;" src="timthumb.php?src=http://<?php echo $SiteLink;?>/uploads/<?php echo $AppRow['image'];?>&amp;h=50&amp;w=50&amp;q=100" alt="<?php echo $AppLongTitle;?>" class="img-responsive"></a></td>
                                        -->
                                        <img style="margin:0 auto;" src="timthumb.php?src=<?php echo $AppRow['external_link'];?>&amp;h=50&amp;w=50&amp;q=100" alt="<?php echo $AppLongTitle;?>" class="img-responsive"></a></td>
                                <td><a href="edit_product.php?id=<?php echo $AppRow['id'];?>"><?php echo ucfirst($SortAppTitle);?></a></td>
                                <td><?php echo $AppRow['date'];?></td>
                            </tr>
                    <?php
                        }
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="col-md-8 box-space-top">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>最近发表的文章</h4></div>
                <div class="panel-body">
                <?php
                    $posts= $mysqli->query("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
                    $NumberOfPen = $posts->num_rows;
                    if ($NumberOfPen==0) {
                        echo '<div class="alert alert-danger">目前你还没有发表任何文章.</div>';
                    }
                    if ($NumberOfPen>0){
                ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>缩略图</th>
                            <th>标题</th>
                            <th>发表日期</th>
                        </tr>
                        </thead>
                        <tbody>
                <?php
                    }
                    while($PenRow = mysqli_fetch_assoc($posts)){
                        $PenLongTitle = stripslashes($PenRow['title']);
                        $CropPenTitle = strlen ($PenLongTitle);
                        if ($CropPenTitle > 200) {
                            $SortPenTitle = substr($PenLongTitle,0,200).'...';
                        }else{
                            $SortPenTitle = $PenLongTitle;
                        }
                        $PenPostLink = preg_replace("![^a-z0-9]+!i", "-", $PenLongTitle);
                        $PenPostLink = urlencode($PenPostLink);
                        $PenPostLink = strtolower($PenPostLink);
                ?>
                        <tr>
                            <td><a href="edit_post.php?id=<?php echo $PenRow['id'];?>">
                                    <img style="margin:0 auto;" src="timthumb.php?src=http://<?php echo $SiteLink;?>/uploads/<?php echo $PenRow['image'];?>&amp;h=50&amp;w=50&amp;q=100" alt="<?php echo $PenLongTitle;?>" class="img-responsive">
                                </a>
                            </td>
                            <td><a href="edit_post.php?id=<?php echo $PenRow['id'];?>"><?php echo ucfirst($SortPenTitle);?></a></td>
                            <td><?php echo $PenRow['date'];?></td>
                        </tr>
                <?php
                    }
                ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="ProductModal" tabindex="-1" role="dialog" aria-labelledby="ProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    </div>
                </div>
            </div>
            <script>
                $('body').on('hidden.bs.modal', '.modal', function () {
                    $(this).removeData('bs.modal');
                });
            </script>
        </section>
    </section>
<?php include("footer.php");?>