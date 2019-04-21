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

<link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.pjax.js" type="text/javascript"></script>
<script src="js/jquery.ui.shake.js"></script>

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