<?php
    session_start();
    ob_start();
    if (!isset($_SESSION['adminuser'])) {
    header("location:login.php");
}
    include("../db.php");
    if ($SiteSettings = $mysqli->query("SELECT * FROM mp_options WHERE id='1'")) {
    $Settings = mysqli_fetch_array($SiteSettings);
    $SiteLink = $Settings['siteurl'];
    $SiteSettings->close();
    } else {
        printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of settings. Please check it</div>");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>管理员控制台</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.staticfile.org/font-awesome/5.8.2/css/all.min.css" rel="stylesheet" type="text/css"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap.min.js@3.3.5/bootstrap.min.js"></script>
        <script src="js/jquery.menu.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-pjax@2.0.1/jquery.pjax.min.js" type="text/javascript"></script>
        <script src="https://cdn.staticfile.org/jquery-timeago/1.6.6/jquery.timeago.min.js" type="text/javascript"></script>
        <script src="https://cdn.staticfile.org/jscolor/2.0.4/jscolor.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $(document).pjax('a[target!="_blank"]', '.main-header');
            });
            jQuery(document).ready(function () {
                jQuery("abbr.timeago").timeago();
            });
        </script>
    </head>
    <body>
        <div id="wrap">
            <div class="container-fluid">
                <header class="main-header">
                    <a class="logo" href="index.php"><img class="img-responsive" src="images/admin-banner.png" alt="管理员控制台"></a>
                    <a class="header-link pull-right" href="logout.php">注销</a>
                </header>