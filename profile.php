<?php include("header.php");
error_reporting(E_ALL ^ E_NOTICE);
?>
<?php
if (!isset($_SESSION['username'])) {
    ?>
    <script type="text/javascript">
        function leave() {
            window.location = "index.html";
        }
        setTimeout("leave()", 2);
    </script>
<?php } else {
    ?>
    <div class="container container-pull" id="display-posts">
        <script>
            $(document).ready(function () {
                $('#FromProfile').on('submit', function (e) {
                    e.preventDefault();
                    $('#submitButton').attr('disabled', '');
                    $("#output-profile").html('<div class="alert alert-info">Submiting... Please wait...</div>');
                    $(this).ajaxSubmit({
                        target: '#output-profile',
                        success: afterSuccess
                    });
                });
            });
            function afterSuccess() {
                $('#submitButton').removeAttr('disabled');
            }
        </script>
        <?php
        if ($Profile = $mysqli->query("SELECT * FROM mp_users WHERE user_id='$Uid'")) {
            $ProfileRow = mysqli_fetch_array($Profile);
            $Profile->close();
        } else {
            printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
        }
        ?>
        <div class="col-top">
            <div class="col-md-8">
                <div class="page-titles"><h1>Edit my info</h1></div>
                <div class="col-form">
                    <div id="output-profile"></div>
                    <form action="submit_profile.php" id="FromProfile" method="post">
                        <div class="form-group">
                            <label for="uName">Username</label>
                            <input type="text" class="form-control" disabled="disabled" name="uName" id="uName"
                                   value="<?php echo $ProfileRow['user_name']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="uEmail">Email</label>
                            <input type="text" class="form-control" name="uEmail" id="uEmail"
                                   value="<?php echo $ProfileRow['user_email']; ?>"
                                   placeholder="Enter a valid email address"/>
                        </div>
                        <button type="submit" class="btn btn-default btn-warning pull-right btn-font" id="submitButton">
                            Update
                        </button>
                    </form>
                </div>
                <div class="col-form">
                    <script>
                        $(document).ready(function () {
                            $('#FromPassword').on('submit', function (e) {
                                e.preventDefault();
                                $('#submitButton').attr('disabled', '');
                                $("#outputmsg").html('<div class="alert alert-info">Submiting... Please wait...</div>');
                                $(this).ajaxSubmit({
                                    target: '#outputmsg',
                                    success: afterSuccess
                                });
                            });
                        });
                        function afterSuccess() {
                            $('#submitButton').removeAttr('disabled');
                        }
                    </script>
                    <div id="outputmsg"></div>
                    <form action="submit_password.php" id="FromPassword" method="post">
                        <div class="form-group">
                            <label for="nPassword">Current Password</label>
                            <input type="password" class="form-control" name="nPassword" id="uPassword"
                                   placeholder="Please provide your current password"/>
                        </div>
                        <div class="form-group">
                            <label for="uPassword">New Password</label>
                            <input type="password" class="form-control" name="uPassword" id="uPassword"
                                   placeholder="Please provide the new password"/>
                        </div>
                        <div class="form-group">
                            <label for="cPassword">Conform Password</label>
                            <input type="password" class="form-control" name="cPassword" id="cPassword"
                                   placeholder="Retype the above password"/>
                        </div>
                        <button type="submit" class="btn btn-default btn-warning pull-right btn-font" id="submitButton">
                            Update
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 mobile-remove">
                <?php include("side_bar.php"); ?>
            </div>
        </div>
    </div>
<?php }
include("footer.php"); ?>