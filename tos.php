<?php include("header.php");

error_reporting(E_ALL ^ E_NOTICE);

?>

<div class="container container-pull" id="display-posts">

<div class="col-top">

<div class="col-md-8">

<div class="page-titles"><h1>Terms of Use</h1></div>

<?php

if($pages = $mysqli->query("SELECT * FROM  mp_pages WHERE id='3'")){

    $pagerow = mysqli_fetch_array($pages);

?>

<p><?php echo $pagerow['page'];?></p>

<?php    
	
	$pages->close();


}else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");;

}
?>

</div><!--col-md-8-->

<div class="col-md-4 mobile-remove">

<?php include("side_bar.php");?>


</div><!--col-md-4-->

</div><!--col-top-->

</div><!-- /.container -->

<?php include("footer.php"); ?> 