<?php include("header.php");?>

<section class="col-md-2">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li>Admin CP</li>
  <li class="active">Dashboard</li>
  <span class="theme-label">Amazon Dominator v<?php echo $Settings['version'];?></span>
</ol>

<div class="page-header">
  <h3 style="display: inline-block;">Dashboard</h3> <span><a class="btn-add" href="new_product.php">Add New Product</a></span>
  
</div>

<section class="col-md-8 box-space-right">

<section class="col-md-6 at-a-glance">

<div class="panel panel-default">

<div class="panel-heading"><h4>At a Glance</h4></div>

    <div class="panel-body">

<ul>

<?php
if($TotalProducts = $mysqli->query("SELECT id FROM listings")){

    $CountTotal = $TotalProducts->num_rows;
  
?> 
    <li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-home"></i> <a href="active_listings.php"><?php echo $CountTotal . ' '; if($CountTotal==1){echo 'product';}else{echo 'products';};?></a></span></li>

<?php

    $TotalProducts->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
} 

if($TotalPosts = $mysqli->query("SELECT id FROM posts")){

    $CountTotalPosts = $TotalPosts->num_rows;
  
?> 
    <li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-wordpress"></i> <a href="manage_posts.php"><?php echo $CountTotalPosts . ' '; if($CountTotalPosts==1){echo 'post';}else{echo 'posts';} ?></a></span></li>

<?php

    $TotalPosts->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
}

?>

<li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-chart-bar"></i> <?php echo $Settings['site_hits'];?> total website views</span></li>

<?php

if($TotalProducts = $mysqli->query("SELECT SUM(views) AS VIEWS FROM listings")){

$TotalProductsCount = mysqli_fetch_array($TotalProducts);

?>

<li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-chart-bar"></i> <?php echo $TotalProductsCount['VIEWS'];?> total product views</span></li> 

<?php

$TotalProducts->close();
	
}else{
    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again</div>");
}

if($LinkHits = $mysqli->query("SELECT SUM(hits) AS HITS FROM listings")){

    $CountLinkHits = mysqli_fetch_array($LinkHits);
  
?>      
    <li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-chart-bar"></i> <?php echo $CountLinkHits['HITS'];?> affiliate link clicks</span></li>
<?php

    $LinkHits->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
} 

if($Saves = $mysqli->query("SELECT save_id FROM saves")){

    $CountSaves = $Saves->num_rows;
  
?>      
    <li><span><i style="padding-right:5px;font-size:18px;" class="fa fa-heart"></i> <?php echo $CountSaves;?> total saves</span></li>
<?php

    $Saves->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
} 

?>

</ul>

</div>

</div><!--panel panel-default-->  

</section><!--col-md-6-->

</section><!--col-md-8-->

<section class="col-md-8 box-space-top">

<div class="panel panel-default">

<div class="panel-heading"><h4>Recent Products</h4></div>

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
				<th>Image</th>
                
                <th>Title</th>

                <th>Date Posted</th>
                
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
				<td><a href="edit_product.php?id=<?php echo $AppRow['id'];?>">
                <img style="margin:0 auto;" src="timthumb.php?src=http://<?php echo $SiteLink;?>/uploaded_images/<?php echo $AppRow['image'];?>&amp;h=50&amp;w=50&amp;q=100" alt="<?php echo $AppLongTitle;?>" class="img-responsive"></a></td>
                
                <td><a href="edit_product.php?id=<?php echo $AppRow['id'];?>"><?php echo ucfirst($SortAppTitle);?></a></td>


                <td><?php echo $AppRow['date'];?></td>

            </tr>
<?php } ?>
    
         
        </tbody>

    </table>
    

</div>

</div><!--panel panel-default--> 

</section><!--col-md-8-->


<section class="col-md-8 box-space-top">

<div class="panel panel-default">

<div class="panel-heading"><h4>Recent Posts</h4></div>

    <div class="panel-body">

<?php

$posts= $mysqli->query("SELECT * FROM posts ORDER BY id DESC LIMIT 10");

	$NumberOfPen = $posts->num_rows;
	
	if ($NumberOfPen==0)
	{
	echo '<div class="alert alert-danger">You have not posted any articles so far.</div>';
	}
	if ($NumberOfPen>0)
	{
	?>
       <table class="table table-bordered">

        <thead>

            <tr>
				<th>Image</th>
                
                <th>Title</th>

                <th>Date Posted</th>
                
            </tr>

        </thead>

        <tbody>
    <?php
	}
	
	while($PenRow = mysqli_fetch_assoc($posts)){
	
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
				<td><a href="edit_post.php?id=<?php echo $PenRow['id'];?>">
               <img style="margin:0 auto;" src="timthumb.php?src=http://<?php echo $SiteLink;?>/uploaded_images/<?php echo $PenRow['image'];?>&amp;h=50&amp;w=50&amp;q=100" alt="<?php echo $PenLongTitle;?>" class="img-responsive">
              </a></td>
                
                <td><a href="edit_post.php?id=<?php echo $PenRow['id'];?>"><?php echo ucfirst($SortPenTitle);?></a></td>

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