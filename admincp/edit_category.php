<?php include("header.php"); ?>
    <section class="col-md-2">
        <?php include("left_menu.php"); ?>
    </section>
    <section class="col-md-10">
        <ol class="breadcrumb">
            <li>Admin CP</li>
            <li>Categories</li>
            <li>Manage Categories</li>
            <li class="active">Edit Category</li>
            <span class="theme-label">MarketPress v<?php echo $Settings['version']; ?></span>
        </ol>
        <div class="page-header">
            <h3>Edit Category
                <small>Edit product categories</small>
            </h3>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/1.2.1/bootstrap-filestyle.min.js"></script>
        <script>
            $(function () {
                $(":file").filestyle({iconName: "glyphicon-picture", buttonText: "Select Photo"});
            });
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#categoryForm').on('submit', function (e) {
                    e.preventDefault();
                    $('#submitButton').attr('disabled', '');
                    //show uploading message
                    $("#output").html('<div class="alert alert-info" role="alert">Submitting.. Please wait..</div>');
                    $(this).ajaxSubmit({
                        target: '#output',
                        success: afterSuccess
                    });
                });
            });
            function afterSuccess() {
                $('#submitButton').removeAttr('disabled');
            }
        </script>
        <section class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    $from_category_id = $mysqli->escape_string($_GET['category_id']);
                    if ($categories_result_set = $mysqli->query("SELECT * FROM mp_categories WHERE category_id='$from_category_id'")) {
                        $categories_row = mysqli_fetch_array($categories_result_set);
                        $parent_id = $categories_row['parent_id'];
                        $parent_categories_result_set = $mysqli->query("SELECT category_name FROM mp_categories WHERE category_id='$parent_id'");
                        $parent_categories_row = mysqli_fetch_array($parent_categories_result_set);
                        $categories_result_set->close();
                        $parent_categories_result_set->close();
                    } else {
                        printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
                    }
                    ?>
                    <div id="output"></div>
                    <form id="categoryForm" action="update_category.php?id=<?php echo $from_category_id; ?>" method="post">
                        <div class="form-group">
                            <label for="inputTitle">Category</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon fa  fa-info"></span></span>
                                <input type="text" id="inputTitle" name="inputTitle" class="form-control" placeholder="Edit category" value="<?php echo $categories_row['category_name']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputParent">Parent Category (OPTIONAL)</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon fa  fa-info"></span></span>
                                <select id="inputParent" name="inputParent" class="form-control">
                                    <?php
                                    if ($parent_categories_row['category_name'] == NULL) { ?>
                                        <option value="0">Select a parent category</option>
                                    <?php } else { ?>
                                        <option value="<?php echo $parent_id; ?>"><?php echo $parent_categories_row['category_name']; ?></option>
                                        <option value="0">Select a parent category</option>
                                    <?php }
                                    if ($all_categories_result_set = $mysqli->query("SELECT * FROM mp_categories")){
                                    while ($cat_row = mysqli_fetch_array($all_categories_result_set)) {
                                        $category_id = $cat_row['category_id'];
                                        $category_name = $cat_row['category_name'];
                                        ?>
                                        <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                        <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        } else {
                            printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
                        }
                        ?>
                        <div class="form-group">
                            <label for="inputDescription">Category Description</label>
                            <textarea class="form-control" id="inputDescription" name="inputDescription" rows="3" placeholder="Edit description of your category"><?php echo $categories_row['category_description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputIcon">Font Awesome Icon HTML (Use <a href="https://fontawesome.com" target="_blank">FontAwesome.com</a>only. Icons from other sources may not work.)</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon fa  fa-info"></span></span>
                                <input type="text" id="inputIcon" name="inputIcon" class="form-control" placeholder="For example - <i class='fas fa-cogs'></i>" value="<?php echo $categories_row['category_icon']; ?>">
                            </div>
                        </div>
                        <div class="panel-footer clearfix">
                            <button type="submit" id="submitButton" class="btn btn-default btn-success btn-lg pull-right">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
<?php include("footer.php"); ?>