<?php include("header.php");?>
    <section class="col-md-2">
        <?php include("left_menu.php");?>
    </section>
    <section class="col-md-10">
        <ol class="breadcrumb">
            <li>管理员控制台</li>
            <li class="active">仪表盘</li>
            <span class="theme-label">MarketPress v<?php echo $version;?></span>
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
                                if($products_result_set = $mysqli->query("SELECT product_id FROM mp_products")){
                                    $products_num = $products_result_set->num_rows;
                            ?>
                            <li><span><i style="padding-right:5px;font-size:18px;" class="fas fa-cart-plus"></i> <a href="active_listings.php"><?php echo $products_num . ' 个产品';?></a></span></li>
                            <?php
                                    $products_result_set->close();
                                }else{
                                    printf("<div class='alert alert-danger alert-pull'>查询产品表出现异常。</div>");
                                }
                                if($posts_result_set = $mysqli->query("SELECT id FROM mp_posts")){
                                    $posts_num = $posts_result_set->num_rows;
                            ?>
                            <li><span><i style="padding-right:5px;font-size:18px;" class="fab fa-wordpress"></i> <a href="manage_posts.php"><?php echo $posts_num . ' 篇文章'; ?></a></span></li>
                            <?php
                                    $posts_result_set->close();
                                }else{
                                    printf("<div class='alert alert-danger alert-pull'>查询文章表出现异常</div>");
                                }
                            ?>
                            <?php
                                if($saves_result_set = $mysqli->query("SELECT save_id FROM mp_saves")){
                                    $saves_num = $saves_result_set->num_rows;
                            ?>
                                    <li><span><i style="padding-right:5px;font-size:18px;" class="fas fa-heart"></i> <?php echo $saves_num;?> 关注</span></li>
                            <?php
                                    $saves_result_set->close();
                                }else{
                                    printf("<div class='alert alert-danger alert-pull'>查询关注表出现异常</div>");
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
                    <h4>最近上架的产品</h4>
                </div>
                <div class="panel-body">
                    <?php
                        $products_result_set= $mysqli->query("SELECT * FROM mp_products WHERE product_state='1' ORDER BY product_load_date DESC LIMIT 5");
                        $products_num = $products_result_set->num_rows;
                        if ($products_num==0) {
                            echo '<div class="alert alert-danger">现在你还没有上架任何产品。</div>';
                        }
                        if ($products_num>0){
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
                        while($products_row = mysqli_fetch_assoc($products_result_set)){
                            $product_id = $products_row['product_id'];
                            $product_name = $products_row['product_name'];
                            $product_external_link = $products_row['product_external_link'];
                            $product_load_date = $products_row['product_load_date'];
                    ?>
                            <tr>
                                <td>
                                    <a href="edit_product.php?product_id=<?php echo $product_id;?>">
                                        <img style="margin:0 auto;" src="../cache/timthumb.php?src=<?php echo $product_external_link;?>&amp;h=50&amp;w=50&amp;q=60" alt="<?php echo $product_name;?>" class="img-responsive" />
                                    </a>
                                </td>
                                <td><a href="edit_product.php?product_id=<?php echo $product_id;?>"><?php echo $product_name;?></a></td>
                                <td><?php echo $product_load_date;?></td>
                            </tr>
                    <?php
                        }
                    $products_result_set->close();
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="col-md-8 box-space-top">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>最近发表的文章</h4>
                </div>
                <div class="panel-body">
                <?php
                    $posts_result_set= $mysqli->query("SELECT * FROM mp_posts ORDER BY id DESC LIMIT 5");
                    $posts_num = $posts_result_set->num_rows;
                    if ($posts_num==0) {
                        echo '<div class="alert alert-danger">目前您还没有发表任何文章。</div>';
                    }
                    if ($posts_num>0){
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
                    while($posts_row = mysqli_fetch_assoc($posts_result_set)){
                        $id = $posts_row['id'];
                        $title = $posts_row['title'];
                        $external_link = $posts_row['external_link'];
                        $date = $posts_row['date'];
                ?>
                        <tr>
                            <td><a href="edit_post.php?id=<?php echo $id;?>">
                                    <img style="margin:0 auto;" src="../cache/timthumb.php?src=<?php echo $external_link;?>&amp;h=50&amp;w=50&amp;q=60" alt="<?php echo $title;?>" class="img-responsive" />
                                </a>
                            </td>
                            <td><a href="edit_post.php?id=<?php echo $id;?>"><?php echo $title;?></a></td>
                            <td><?php echo $date;?></td>
                        </tr>
                <?php
                    }
                $posts_result_set->close();
                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </section>
<?php include("footer.php");?>