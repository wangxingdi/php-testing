<?php
    session_start();
    ob_start();
    if(isset($_SESSION['adminuser'])){
        header("location:index.php");
    }
    include("../db.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员控制台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.staticfile.org/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js" type="text/javascript"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" type="text/javascript"></script>
<![endif]-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.0/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap.min.js@3.3.5/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-pjax@2.0.1/jquery.pjax.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-shake@1.0.0/jquery.ui.shake.min.js" type="text/javascript"></script>
    <script>
        $(function(){
            $(document).pjax('a', '.main-header');
        });
    </script>
</head>
<body>
<div id="wrap">
    <div class="container-fluid">
        <header class="main-header">
            <a class="logo" href="index.php"><img class="img-responsive" src="images/logo.png" alt="Admin Penal"></a>
        </header>