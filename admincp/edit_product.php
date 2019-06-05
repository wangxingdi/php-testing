<?php include("header.php"); ?>
    <section class="col-md-2">
        <?php include("left_menu.php"); ?>
    </section>
    <section class="col-md-10">
        <ol class="breadcrumb">
            <li>Admin CP</li>
            <li>Product Listings</li>
            <li>Products</li>
            <li class="active">Edit Products</li>
            <span class="theme-label">MarketPress v<?php echo $version; ?></span>
        </ol>
        <div class="page-header">
            <h3>Edit Products
                <small>Edit/update products</small>
            </h3>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-filestyle@1.2.1/src/bootstrap-filestyle.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-form@4.2.2/dist/jquery.form.min.js"></script>
        <script>
            $(function () {
                $(":file").filestyle({iconName: "glyphicon-picture", buttonText: "Select Photo"});
            });
            $(document).ready(function () {
                $('#form-add-product').on('submit', function (e) {
                    e.preventDefault();
                    $('#submit').attr('disabled', '');
                    $("#output").html('<div class="alert alert-info" role="alert">Updating... Please Wait...</span></div>');
                    $(this).ajaxSubmit({
                        target: '#output',
                        success: afterSuccess
                    });
                });
            });
            function afterSuccess() {
                $('#submit').removeAttr('disabled');
            }
            function countChar(val) {
                var len = val.value.length;
                if (len >= 250) {
                    val.value = val.value.substring(0, 250);
                } else {
                    $('#charNum').text(250 - len);
                }
            };
        </script>
        <section class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    $from_product_id = $mysqli->escape_string($_GET['product_id']);
                    if ($products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_id='$from_product_id'")) {
                        $products_row = mysqli_fetch_array($products_result_set);
                        $SelectedCat = $products_row['category_id'];
                        $products_result_set->close();
                    } else {
                        printf("<div class='alert alert-danger alert-pull'>产品查询失败(edit_product.php)</div>");
                    }
                    ?>
                    <div id="output"></div>
                    <form action="update_product.php?id=<?php echo $from_product_id; ?>" id="form-add-product" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" class="form-control" id="category">
                                <?php
                                if ($CatSelected = $mysqli->query("SELECT * FROM mp_categories WHERE category_id='$SelectedCat' LIMIT 1")) {
                                    $CatSelectedRow = mysqli_fetch_array($CatSelected);
                                    $SelectedCat = $CatSelectedRow['category_id'];
                                    ?>
                                    <option value="<?php echo $CatSelectedRow['category_id']; ?>"><?php echo $CatSelectedRow['category_name']; ?></option>
                                    <?php
                                    $CatSelected->close();
                                } else {
                                    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
                                }
                                ?>
                                <?php
                                if ($CatSql = $mysqli->query("SELECT * FROM mp_categories WHERE category_id != '$SelectedCat' ORDER BY show_order ASC")) {
                                    while ($CatRow = mysqli_fetch_array($CatSql)) {
                                        ?>
                                        <option value="<?php echo $CatRow['category_id']; ?>"><?php echo $CatRow['category_name']; ?></option>
                                        <?php
                                    }
                                    $CatSql->close();
                                } else {
                                    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mName">Title</label>
                            <input type="text" name="mName" id="mName" class="form-control" placeholder="Add a catchy title" value="<?php echo $products_row['product_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="aff">Product affiliate / purchase link</label>
                            <input type="text" name="aff" id="aff" class="form-control" placeholder="Your Affiliate Link to the product" value="<?php echo $products_row['product_affiliate_url']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="disc">Description</label>
                            <textarea name="disc" id="disc" cols=40 rows=5 class="form-control" onkeyup="countChar(this)" placeholder="Product description (Maximum 250 characters)"><?php echo $products_row['product_description']; ?></textarea>
                            <span id="charNum">250</span> out of 250 characters left
                        </div>
                        <div class="form-group">
                            <label for="file">Product Image</label>
                            <input type='file' class="file" name="mFile" id="mFile"/>
                        </div>
                        <div class="form-group">
                            <label for="price">Price (Without &#36; sign):</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Product price" value="<?php echo $products_row['product_price']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="meta_desc">Meta Description</label>
                            <textarea name="meta_desc" id="meta_desc" cols=40 rows=3 class="form-control" placeholder="Add an SEO friendly meta description here.."><?php echo $products_row['product_meta_description']; ?></textarea>
                        </div>
                        <div class="panel-footer clearfix">
                            <button type="submit" id="submitButton" class="btn btn-default btn-success btn-lg pull-right">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
<?php include("footer.php"); ?>