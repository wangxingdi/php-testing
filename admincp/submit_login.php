<?php
session_start();
ob_start();
include('../db.php');
if (!isset($_SESSION['adminuser'])) {
    if ($_POST) {
        $username = $mysqli->escape_string($_POST['inputUsername']);
        $password = $mysqli->escape_string($_POST['inputPassword']);
        $gpassword = md5($password);
        if ($UserCheck = $mysqli->query("SELECT * FROM mp_admin WHERE admin_username='$username' and admin_password='$gpassword'")) {
            $VdUser = mysqli_fetch_array($UserCheck);
            $Count = mysqli_num_rows($UserCheck);
            $UserCheck->close();
        } else {
            printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of admin. Please check it</div>");
        }
        if ($Count == 1) {
            $_SESSION["adminuser"] = $username;
            ?>
            <script type="text/javascript">
                function leave() {
                    window.location = "index.php";
                }
                setTimeout("leave()", 1000);
            </script>
            <?php
            die('<div class="alert alert-success" role="alert">正在登录，请稍等...</div>');
        } else {
            ?>
            <script>
                $('.panel').shake();
            </script>
            <?php
            die('<div class="alert alert-danger" role="alert">错误的用户名或者密码.</div>');
        }
    }
}
ob_end_flush();
?>