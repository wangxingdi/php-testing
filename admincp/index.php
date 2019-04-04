<?php include("header.php");?>

<section class="col-md-2">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li>Admin CP</li>
  <li class="active">Dashboard</li>
</ol>

<div class="page-header">
  <h3>Dashboard <small>Your website dashboard</small></h3>
  
</div>

<section class="col-md-8">

<section class="col-md-6 box-space-right">

<div class="panel panel-default">

<div class="panel-heading"><h4>Listings Statistics</h4></div>

    <div class="panel-body">

<ul>

<?php
if($TotalProducts = $mysqli->query("SELECT id FROM listings")){

    $CountTotal = $TotalProducts->num_rows;
  
?> 
     <li class="fa fa-file-text-o"><span>Total Product Listings: <?php echo $CountTotal;?></span></li>

<?php

    $TotalProducts->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}

if($ActiveProducts= $mysqli->query("SELECT id FROM listings WHERE active=1")){

    $CountActive = $ActiveProducts->num_rows;
?>     

	<li class="fa fa-file-text-o"><span>Total Active Product Listings: <?php echo $CountActive;?></span></li>

<?php

    $ActiveProducts->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}

if($PendingProducts = $mysqli->query("SELECT id FROM listings WHERE active=0")){

    $CountProducts = $PendingProducts->num_rows;
?>      
    <li class="fa fa-file-text-o"><span>Total Pending Product Listings: <?php echo $CountProducts;?></span></li>
<?php

    $PendingProducts->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}

?> 
</ul>

</div>

</div><!--panel panel-default-->  

</section><!--col-md-6-->

<section class="col-md-6">

<div class="panel panel-default">

<div class="panel-heading"><h4>Site Statistics</h4></div>

    <div class="panel-body">

<ul>

<?php 
if($SiteHits = $mysqli->query("SELECT SUM(hits) AS HITS FROM listings")){

    $CountHits = mysqli_fetch_array($SiteHits);
  
?>      
    <li class="fa fa-bar-chart-o"><span>Total Affiliate Link Clicks: <?php echo $CountHits['HITS'];?></span></li>
<?php

    $SiteHits->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}

if($TotalApprovedVideos = $mysqli->query("SELECT SUM(views) AS VIEWS FROM listings")){

    $TotalVidNum = mysqli_fetch_array($TotalApprovedVideos);
?>

<li class="fa fa-bar-chart-o"><span>Total Listing Pages Views: <?php echo $TotalVidNum['VIEWS'];?></span></li> 

<?php


    $TotalApprovedVideos->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}

 
?>    
    <li class="fa fa-bar-chart-o"><span>Total Site Views: <?php echo $Settings['site_hits'];?></span></li>

</ul>

</div>

</div><!--panel panel-default--> 

</section><!--col-md-6-->
</section><!--col-md-8-->

<section class="col-md-8 box-space-top">

<div class="panel panel-default">

<div class="panel-heading"><h4>Last 10 Active Posts</h4></div>

    <div class="panel-body">

<?php

$DisplayApproved= $mysqli->query("SELECT * FROM listings WHERE active='1' ORDER BY id DESC LIMIT 10");

	$NumberOfApp = $DisplayApproved->num_rows;
	
	if ($NumberOfApp==0)
	{
	echo '<div class="alert alert-danger">There are no approved posts to display at this moment.</div>';
	}
	if ($NumberOfApp>0)
	{
	?>
       <table class="table table-bordered">

        <thead>

            <tr>
				<th>Thumb</th>
                
                <th>Title</th>

                <th>Added On</th>
                
            </tr>

        </thead>

        <tbody>
    <?php
	}
	
	while($AppRow = mysqli_fetch_assoc($DisplayApproved)){
	
	$AppLongTitle = stripslashes($AppRow['title']);
	$CropAppTitle = strlen ($AppLongTitle);
	if ($CropAppTitle > 200) {
	$SortAppTitle = substr($AppLongTitle,0,200).'...';
	}else{
	$SortAppTitle = $AppLongTitle;}
	
	$AppPostLink = preg_replace("![^a-z0-9]+!i", "-", $AppLongTitle);
	$AppPostLink = urlencode($AppPostLink);
	$AppPostLink = strtolower($AppPostLink);

?>        

            <tr>
				<td><a data-toggle="modal" href="preview.php?id=<?php echo $AppRow['id'];?>" data-target="#ProductModal">
                <img src="timthumb.php?src=http://<?php echo $SiteLink;?>/uploaded_images/<?php echo $AppRow['image'];?>&amp;h=50&amp;w=50&amp;q=100" alt="<?php echo $AppLongTitle;?>" class="img-responsive"></a></td>
                
                <td><a data-toggle="modal" href="preview.php?id=<?php echo $AppRow['id'];?>" data-target="#ProductModal"><?php echo ucfirst($SortAppTitle);?></a></td>


                <td><?php echo $AppRow['date'];?></td>

            </tr>
<?php } ?>
    
         
        </tbody>

    </table>
    

</div>

</div><!--panel panel-default--> 

</section><!--col-md-8-->


<section class="hide col-md-8 box-space-top">

<div class="panel panel-default">

<div class="panel-heading"><h4>Last 10 Pending Product Listings</h4></div>

    <div class="panel-body">

<?php

$DisplayPending= $mysqli->query("SELECT * FROM listings WHERE active=0 ORDER BY id DESC LIMIT 10");

	$NumberOfPen = $DisplayPending->num_rows;
	
	if ($NumberOfPen==0)
	{
	echo '<div class="alert alert-danger">There are no approval pending posts to display at this moment.</div>';
	}
	if ($NumberOfPen>0)
	{
	?>
       <table class="table table-bordered">

        <thead>

            <tr>
				<th>Thumb</th>
                
                <th>Title</th>

                <th>Added On</th>
                
            </tr>

        </thead>

        <tbody>
    <?php
	}
	
	while($PenRow = mysqli_fetch_assoc($DisplayPending)){
	
	$PenLongTitle = stripslashes($PenRow['title']);
	$CropPenTitle = strlen ($PenLongTitle);
	if ($CropPenTitle > 200) {
	$SortPenTitle = substr($PenLongTitle,0,200).'...';
	}else{
	$SortPenTitle = $PenLongTitle;}
	
	$PenPostLink = preg_replace("![^a-z0-9]+!i", "-", $PenLongTitle);
	$PenPostLink = urlencode($PenPostLink);
	$PenPostLink = strtolower($PenPostLink);

?>        

            <tr>
				<td><a data-toggle="modal" href="preview.php?id=<?php echo $PenRow['id'];?>" data-target="#ProductModal">
               <img src="timthumb.php?src=http://<?php echo $SiteLink;?>/uploaded_images/<?php echo $PenRow['image'];?>&amp;h=50&amp;w=50&amp;q=100" alt="<?php echo $PenLongTitle;?>" class="img-responsive">
              </a></td>
                
                <td><a data-toggle="modal" href="preview.php?id=<?php echo $PenRow['id'];?>" data-target="#ProductModal"><?php echo ucfirst($SortPenTitle);?></a></td>

                <td><?php echo $PenRow['date'];?></td>

            </tr>
<?php } ?>
    
         
        </tbody>

    </table>
    

</div>

</div><!--panel panel-default--> 

<!--Product Modal-->
<div class="modal fade" id="ProductModal" tabindex="-1" role="dialog" aria-labelledby="ProductModalLabel" aria-hidden="true">
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

</section><!--col-md-8-->

</section><!--col-md-10-->

<?php include("footer.php");?>