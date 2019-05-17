<?php include("header.php"); ?>
    <section class="col-md-2">

        <?php include("left_menu.php"); ?>

    </section><!--col-md-2-->

    <section class="col-md-10">

        <ol class="breadcrumb">
            <li>Admin CP</li>
            <li>Product Listings</li>
            <li class="active">Pending Products</li>
        </ol>

        <div class="page-header">
            <h3>Pending Products
                <small>Manage pending products</small>
            </h3>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
//Delete	
                $('button.btnDelete').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).closest('tr').data('id');
                    $('#myModal').data('id', id).modal('show');
                });

                $('#btnDelteYes').click(function () {
                    var id = $('#myModal').data('id');
                    var dataString = 'id=' + id;
                    $('[data-id=' + id + ']').remove();
                    $('#myModal').modal('hide');
                    //ajax
                    $.ajax({
                        type: "POST",
                        url: "delete_product.php",
                        data: dataString,
                        cache: false,
                        success: function (html) {
//$(".fav-count").html(html);
                            $("#output").html(html);
                        }
                    });
//ajax ends
                });
//Desapprove
                $('button.btnActivate').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).closest('tr').data('id');
                    $('#ActivateModal').data('id', id).modal('show');
                });

                $('#btnActivateYes').click(function () {
                    var id = $('#ActivateModal').data('id');
                    var dataString = 'id=' + id;
                    $('[data-id=' + id + ']').remove();
                    $('#ActivateModal').modal('hide');
                    $.ajax({
                        type: "POST",
                        url: "activate_product.php",
                        data: dataString,
                        cache: false,
                        success: function (html) {
                            $("#output").html(html);
                        }
                    });
                });
            });
        </script>

        <section class="col-md-8">

            <p>Pending products will only display products submitted by users that has not been activated yet.
                Administrator submission will not be added to pending products section </p>

            <div id="output"></div>

            <?php
            error_reporting(E_ALL ^ E_NOTICE);
            // How many adjacent pages should be shown on each side?
            $adjacents = 5;
            $products_result_set = $mysqli->query("SELECT COUNT(*) as num FROM mp_products WHERE product_state='0' ORDER BY product_id DESC");

            //$query = $mysqli->query("SELECT COUNT(*) as num FROM photos WHERE  photos.active=1 ORDER BY photos.id DESC");

            $products_row = mysqli_fetch_array($products_result_set);
            $products_num = $products_row['num'];

            $targetpage = "pending_listings.php";
            $limit = 15;                                //how many items to show per page
            $page = $_GET['page'];

            if ($page)
                $start = ($page - 1) * $limit;            //first item to display on this page
            else
                $start = 0;                                //if no page var is given, set start to 0
            /* Get data. */
            $products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_state='0' ORDER BY product_id DESC LIMIT $start, $limit");
            /* Setup page vars for display. */
            if ($page == 0) $page = 1;                    //if no page var is given, default to 1.
            $prev = $page - 1;                            //previous page is page - 1
            $next = $page + 1;                            //next page is page + 1
            $lastpage = ceil($products_num / $limit);        //lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;                        //last page minus 1

            $pagination = "";
            if ($lastpage > 1) {
                $pagination .= "<ul class=\"pagination pagination-lg\">";
                //previous button
                if ($page > 1)
                    $pagination .= "<li><a href=\"$targetpage?page=$prev.html\">&laquo;</a></li>";
                else
                    $pagination .= "<li class=\"disabled\"><a href=\"#\">&laquo;</a></li>";

                //pages
                if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
                {
                    for ($counter = 1; $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
                        else
                            $pagination .= "<li><a href=\"$targetpage?page=$counter.html\">$counter</a></li>";
                    }
                } elseif ($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
                {
                    //close to beginning; only hide later pages
                    if ($page < 1 + ($adjacents * 2)) {
                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                            if ($counter == $page)
                                $pagination .= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
                            else
                                $pagination .= "<li><a href=\"$targetpage?page=$counter.html\">$counter</a></li>";
                        }
                        $pagination .= "...";
                        $pagination .= "<li><a href=\"$targetpage?page=$lpm1.html\">$lpm1</a></li>";
                        $pagination .= "<li><a href=\"$targetpage?page=$lastpage.html\">$lastpage</a></li>";
                    } //in middle; hide some front and some back
                    elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                        $pagination .= "<li><a href=\"$targetpage?page=1.html\">1</a></li>";
                        $pagination .= "<li><a href=\"$targetpage?page=2.html\">2</a></li>";
                        $pagination .= "...";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                            if ($counter == $page)
                                $pagination .= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
                            else
                                $pagination .= "<li><a href=\"$targetpage?page=$counter.html\">$counter</a></li>";
                        }
                        $pagination .= "...";
                        $pagination .= "<li><a href=\"$targetpage?page=$lpm1.html\">$lpm1</a></li>";
                        $pagination .= "<li><a href=\"$targetpage?page=$lastpage.html\">$lastpage</a></li>";
                    } //close to end; only hide early pages
                    else {
                        $pagination .= "<li><a href=\"$targetpage?page=1.html\">1</a></li>";
                        $pagination .= "<li><a href=\"$targetpage?page=2.html\">2</a></li>";
                        $pagination .= "...";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                            if ($counter == $page)
                                $pagination .= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
                            else
                                $pagination .= "<li><a href=\"$targetpage?page=$counter.html\">$counter</a></li>";
                        }
                    }
                }

                //next button
                if ($page < $counter - 1)
                    $pagination .= "<li><a href=\"$targetpage?page=$next.html\">&raquo;</a></li>";
                else
                    $pagination .= "<li class=\"disabled\"><a href=\"#\">&raquo;</a></li>";
                $pagination .= "</ul>\n";
            }

            $products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_state='0' ORDER BY product_id DESC limit $start,$limit");
            $products_num = mysqli_num_rows($products_result_set);
            if ($products_num == 0) {
                echo '<div class="alert alert-danger">There are no deactivated product listings to display at this moment.</div>';
            }
            if ($products_num > 0)
            {
            ?>
            <table class="table table-bordered">

                <thead>

                <tr>
                    <th>Thumb</th>

                    <th>Title</th>

                    <th>Added On</th>

                    <th>Manage</th>

                </tr>

                </thead>

                <tbody>
                <?php
                }

                while ($products_row = mysqli_fetch_assoc($products_result_set)) {
                    $product_name = stripslashes($products_row['product_name']);
                    $Feat = $products_row['feat'];
                    ?>
                    <tr class="btnDelete" data-id="<?php echo $products_row['product_id']; ?>">
                        <td><a data-toggle="modal" href="preview.php?id=<?php echo $products_row['product_id']; ?>"
                               data-target="#ProductModal"><img
                                        src="timthumb.php?src=http://<?php echo $SiteLink; ?>/images/<?php echo $products_row['product_image']; ?>&amp;h=50&amp;w=50&amp;q=100"
                                        alt="<?php echo $product_name; ?>" class="img-responsive"></a></td>
                        <td><a data-toggle="modal" href="preview.php?id=<?php echo $products_row['product_id']; ?>"
                               data-target="#ProductModal"><?php echo ucfirst($product_name); ?></a></td>
                        <td><?php echo $products_row['product_load_date']; ?></td>
                        <td>
                            <button class="btn btn-danger btnDelete">Delete</button>
                            <button class="btn btn-info btnActivate">Activate</button>
                            <a class="btn btn-success btnEdit"
                               href="edit_product.php?id=<?php echo $products_row['product_id']; ?>">Edit</a>
                        </td>

                    </tr>
                <?php } ?>


                </tbody>

            </table>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Confirmation</h4>

                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to DELETE this product listing?</p>
                            <p class="text-warning">
                                <small>This action cannot be undone.</small>
                            </p>
                        </div>
                        <!--/modal-body-collapse -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="btnDelteYes">Yes</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                        <!--/modal-footer-collapse -->
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <!--Approve Modal-->
            <div class="modal fade" id="ActivateModal" tabindex="-1" role="dialog" aria-labelledby="ActivateModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Confirmation</h4>

                        </div>
                        <div class="modal-body">
                            <p> Are you sure you want to ACTIVATE this product listing?</p>
                            <p class="text-info">
                                <small>You can deactivate this product listing by navigating to Product Listings >
                                    Active Products.
                                </small>
                            </p>
                            <p class="text-info">
                                <small>You can not add this product listing to Pending Products section again.</small>
                            </p>
                        </div>
                        <!--/modal-body-collapse -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="btnActivateYes">Yes</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                        <!--/modal-footer-collapse -->
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <!--Product Modal-->
            <div class="modal fade" id="ProductModal" tabindex="-1" role="dialog" aria-labelledby="ProductModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">


                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <script>
                $('body').on('hidden.bs.modal', '.modal', function () {
                    $(this).removeData('bs.modal');
                });
            </script>

            <?php echo $pagination; ?>

        </section>

    </section><!--col-md-10-->

<?php include("footer.php"); ?>