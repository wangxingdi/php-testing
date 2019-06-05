<?php
session_start();
ob_start();
include('db.php');
if ($squ = $mysqli->query("SELECT * FROM mp_options WHERE id='1'")) {
    $settings = mysqli_fetch_array($squ);
    $squ->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again</div>");
}
if (!isset($_SESSION['username'])) {
    if ($_POST) {
        $username = $mysqli->escape_string($_POST['username']);
        $password = $mysqli->escape_string($_POST['password']);
        $gpassword = md5($password);
        if ($UserCheck = $mysqli->query("SELECT * FROM mp_users WHERE user_name ='$username' and user_password ='$gpassword'")) {
            $VdUser = mysqli_fetch_array($UserCheck);
            $Count = mysqli_num_rows($UserCheck);
            $UserCheck->close();
        } else {
            printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again</div>");
        }
        if ($Count == 1) {
            //required variables are empty
            $_SESSION["username"] = $username;
            //header("location:index.html");
            ?>
            <script type="text/javascript">
                function leave() {
                    window.location = "wish_list/";
                }
                setTimeout("leave()", 1000);
            </script>
            <?php
            die('<div class="alert alert-info">Login success! Redirecting....</div>');
        } else {
            ?>
            <script>
                $('#submitButtonLogin').removeAttr('disabled'); //enable submit button
            </script>
            <?php
            die('<div class="alert alert-danger">Username or password is wrong.</div>');
        }
    }
}
ob_end_flush();
?>