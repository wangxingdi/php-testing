<?php include("header.php"); ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/1.2.1/bootstrap-filestyle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    <script>
        $(function () {
            $(":file").filestyle({
                iconName: "glyphicon-picture",
                buttonText: "请选择"
            });
        });
        $(document).ready(function () {
            $('#form-add-product').on('submit', function (e) {
                e.preventDefault();
                $('#submit').attr('disabled', '');
                $("#output").html('<div class="alert alert-info" role="alert">请稍等…</span></div>');
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
            if (len >= 300) {
                val.value = val.value.substring(0, 300);
            } else {
                $('#charNum').text(300 - len);
            }
        }
    </script>
    <section class="col-md-2">
        <?php include("left_menu.php"); ?>
    </section>
    <section class="col-md-10">
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i></li>
            <li class="active">新增商品</li>
            <span class="theme-label">MarketPress v<?php echo $version; ?></span>
        </ol>
        <div class="page-header">
            <h3>商品信息录入
                <small>挑选一个令人惊奇的商品</small>
            </h3>
        </div>
        <section class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="output"></div>
                    <form action="submit_product.php" id="form-add-product" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="category">一级分类</label>
                            <select name="category" class="form-control" id="category">
                                <option value="0">请选择</option>
                                <?php
                                if ($categories_result_set = $mysqli->query("SELECT * FROM mp_categories WHERE parent_id is null ORDER BY show_order ASC")) {
                                    while ($categories_row = mysqli_fetch_array($categories_result_set)) {
                                        ?>
                                        <option value="<?php echo $categories_row['category_id']; ?>"><?php echo $categories_row['category_name']; ?></option>
                                        <?php
                                    }
                                    $categories_result_set->close();
                                } else {
                                    printf("<div class='alert alert-danger alert-pull'>类别表似乎有些问题，请检查一下。</div>");;
                                }
                                ?>
                            </select>
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#category").change(function () {
                                    var parent = $("#category option:selected").val();
                                    $.ajax({
                                        type: "POST",
                                        url: "get-sub-cats.php",
                                        data: {parent: parent}
                                    }).done(function (data) {
                                        $("#sub-cats").html(data);
                                    });
                                });
                            });
                        </script>
                        <div id="sub-cats" class="form-group"></div>
                        <div class="form-group">
                            <label for="product_name">产品名称</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" placeholder="请输入产品名称">
                        </div>
                        <div class="form-group">
                            <label for="product_affiliate_url">产品推荐链接</label>
                            <input type="text" name="product_affiliate_url" id="product_affiliate_url" class="form-control" placeholder="请输入产品推广链接">
                        </div>
                        <div class="form-group">
                            <label for="product_description">产品介绍</label>
                            <textarea name="product_description" id="product_description" cols=40 rows=5 class="form-control" onkeyup="countChar(this)" placeholder="请输入产品介绍"></textarea>
                            建议录入文字长度在300内，还剩余<span id="charNum">300</span>个文字
                        </div>
                        <div class="form-group">
                            <label for="product_image">产品图片 (若图片没有外部链接，则加载此图片，请不要重名)</label>
                            <input type='file' class="file" name="product_image" id="product_image"/>
                        </div>
                        <div class="form-group">
                            <label for="product_external_link">产品图片外部链接</label>
                            <input type="text" name="product_external_link" id="product_external_link" class="form-control" placeholder="优先从外部链接加载图片">
                        </div>
                        <div class="form-group">
                            <label for="product_price">产品价格:</label>
                            <input type="text" name="product_price" id="product_price" class="form-control" placeholder="单位元，精确到两位小数">
                        </div>
                        <div class="form-group">
                            <label for="product_permalink">固定链接:</label>
                            <input type="text" name="product_permalink" id="product_permalink" class="form-control" placeholder="录入利于SEO的固定链接">
                        </div>
                        <div class="form-group">
                            <label for="product_meta_description">Meta描述</label>
                            <textarea name="product_meta_description" id="product_meta_description" cols=40 rows=3 class="form-control" placeholder="录入SEO优化meta描述"></textarea>
                        </div>
                </div>
                <div class="panel-footer clearfix">
                    <button type="submit" id="submitButton" class="btn btn-default btn-success btn-lg pull-right">新增商品</button>
                </div>
                </form>
            </div>
        </section>
    </section>
<?php include("footer.php"); ?>