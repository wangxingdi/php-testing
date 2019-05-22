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
<title>Admin Control Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://rawcdn.githack.com/img0/tijwiw/870f118a17c9e60c5739dc046fc5405b70913045/config/logo/favicon.ico" rel="shortcut icon" type="image/x-icon"/>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--<script type="text/javascript" src="js/login.js"></script>-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-shake@1.0.0/jquery.ui.shake.min.js"></script>

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

<a class="logo" href="index.php"><img class="img-responsive" src="assets/logo.png" alt="Admin Penal"></a>

</header>