<?php include("header.php"); ?>
    <section class="col-md-2">
        <?php include("left_menu.php"); ?>
    </section>
    <section class="col-md-10">
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i></li>
            <li class="active">Users</li>
            <span class="theme-label">MarketPress v<?php echo $Settings['version']; ?></span>
        </ol>
        <div class="page-header">
            <h3>Users
                <small>Manage your website users</small>
            </h3>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
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
                    $.ajax({
                        type: "POST",
                        url: "delete_user.php",
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
            <div id="output"></div>
            <?php
            error_reporting(E_ALL ^ E_NOTICE);
            $adjacents = 5;
            $query = $mysqli->query("SELECT COUNT(*) as num FROM mp_users ORDER BY user_id DESC");
            $total_pages = mysqli_fetch_array($query);
            $total_pages = $total_pages['num'];
            $targetpage = "users.php";
            $limit = 15;
            $page = $_GET['page'];
            if ($page)
                $start = ($page - 1) * $limit;
            else
                $start = 0;
            $result = $mysqli->query("SELECT * FROM mp_users ORDER BY user_id DESC LIMIT $start, $limit");
            if ($page == 0) $page = 1;
            $prev = $page - 1;
            $next = $page + 1;
            $lastpage = ceil($total_pages / $limit);
            $lpm1 = $lastpage - 1;
            $pagination = "";
            if ($lastpage > 1) {
                $pagination .= "<ul class=\"pagination pagination-lg\">";
                if ($page > 1)
                    $pagination .= "<li><a href=\"$targetpage?page=$prev\">&laquo;</a></li>";
                else
                    $pagination .= "<li class=\"disabled\"><a href=\"#\">&laquo;</a></li>";
                if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
                {
                    for ($counter = 1; $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
                        else
                            $pagination .= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                    }
                } elseif ($lastpage > 5 + ($adjacents * 2)) {
                    if ($page < 1 + ($adjacents * 2)) {
                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                            if ($counter == $page)
                                $pagination .= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
                            else
                                $pagination .= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                        }
                        $pagination .= "...";
                        $pagination .= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                        $pagination .= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";
                    } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                        $pagination .= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                        $pagination .= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                        $pagination .= "...";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                            if ($counter == $page)
                                $pagination .= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
                            else
                                $pagination .= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                        }
                        $pagination .= "...";
                        $pagination .= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                        $pagination .= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";
                    } else {
                        $pagination .= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                        $pagination .= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                        $pagination .= "...";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                            if ($counter == $page)
                                $pagination .= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
                            else
                                $pagination .= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                        }
                    }
                }
                if ($page < $counter - 1)
                    $pagination .= "<li><a href=\"$targetpage?page=$next\">&raquo;</a></li>";
                else
                    $pagination .= "<li class=\"disabled\"><a href=\"#\">&raquo;</a></li>";
                $pagination .= "</ul>\n";
            }
            $q = $mysqli->query("SELECT * FROM mp_users ORDER BY user_id DESC limit $start,$limit");
            $numr = mysqli_num_rows($q);
            if ($numr == 0) {
                echo '<div class="alert alert-danger">There are no registered users to display at this moment.</div>';
            }
            if ($numr > 0){
            ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Registered Date</th>
                    <th>Manage</th>
                </tr>
                </thead>
                <tbody>
                <?php
                }
                while ($Row = mysqli_fetch_assoc($q)) {
                    $User = stripslashes($Row['user_name']);
                    $UserLink = preg_replace("![^a-z0-9]+!i", "-", $User);
                    $UserLink = urlencode($UserLink);
                    $UserLink = strtolower($UserLink);
                    ?>
                    <tr class="btnDelete" data-id="<?php echo $Row['user_id']; ?>">
                        <td><?php echo ucfirst($Row['user_name']); ?></td>
                        <td><?php echo $Row['user_email']; ?></td>
                        <td><?php echo $Row['user_register_date']; ?></td>
                        <td>
                            <button class="btn btn-danger btnDelete">Delete</button>
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
                            <p>Are you sure you want to DELETE this User?</p>
                            <p class="text-danger">
                                <small>Products posted by user will not be deleted.</small>
                            </p>
                            <p class="text-warning">
                                <small>This action cannot be undone.</small>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="btnDelteYes">Yes</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $pagination; ?>
        </section>
    </section>
<?php include("footer.php"); ?>