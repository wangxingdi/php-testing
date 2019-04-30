    <?php include("header.php");?>
<section class="col-md-2">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li><i class="fa fa-home"></i></li>
  <li>Article Listings</li>
  <li class="active">Deactivated Posts</li>
  <span class="theme-label">Amazon Dominator v<?php echo $Settings['version'];?></span>
</ol>

<div class="page-header">
  <h3>Deactivated Posts <small>Manage deactivated posts</small></h3>
</div>

<script type="text/javascript">
$(document).ready(function(){
//Delete	
$('button.btnDelete').on('click', function (e) {
    e.preventDefault();
    var id = $(this).closest('tr').data('id');
    $('#myModal').data('id', id).modal('show');
});

$('#btnDelteYes').click(function () {
    var id = $('#myModal').data('id');
	var dataString = 'id='+ id ;
    $('[data-id=' + id + ']').remove();
    $('#myModal').modal('hide');
	//ajax
	$.ajax({
type: "POST",
url: "delete_post.php",
data: dataString,
cache: false,
success: function(html)
{
//$(".fav-count").html(html);
$("#output").html(html);
}
});
//ajax ends
});
//Desapprove
$('button.btnActivate').on('click', function (e) {
    e.preventDefault();
    var id = $(this).closest('tr').data('id');
    $('#ActivateModal').data('id', id).modal('show');
});

$('#btnActivateYes').click(function () {
    var id = $('#ActivateModal').data('id');
	var dataString = 'id='+ id ;
    $('[data-id=' + id + ']').remove();
    $('#ActivateModal').modal('hide');
	//ajax
	$.ajax({
type: "POST",
url: "activate_post.php",
data: dataString,
cache: false,
success: function(html)
{
//$(".fav-count").html(html);
$("#output").html(html);
}
});
//ajax ends
});
});
</script>

<section class="col-md-8">

<div id="output"></div>
      
<?php
error_reporting(E_ALL ^ E_NOTICE);
// How many adjacent pages should be shown on each side?
	$adjacents = 5;
	
	$query = $mysqli->query("SELECT COUNT(*) as num FROM posts WHERE active=2 ORDER BY id DESC");
	
	//$query = $mysqli->query("SELECT COUNT(*) as num FROM photos WHERE  photos.active=1 ORDER BY photos.id DESC");
	
	$total_pages = mysqli_fetch_array($query);
	$total_pages = $total_pages['num'];
	
	$targetpage = "deactivated_posts.php";
	$limit = 15; 								//how many items to show per page
	$page = $_GET['page'];
	 
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
 	/* Get data. */
	$result = $mysqli->query("SELECT * FROM posts WHERE active=2 ORDER BY id DESC LIMIT $start, $limit");
	 
	//$result = $mysqli->query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<ul class=\"pagination pagination-lg\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<li><a href=\"$targetpage?page=$prev.html\">&laquo;</a></li>";
		else
			$pagination.= "<li class=\"disabled\"><a href=\"#\">&laquo;</a></li>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
				else
					$pagination.= "<li><a href=\"$targetpage?page=$counter.html\">$counter</a></li>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter.html\">$counter</a></li>";					
				}
				$pagination.= "...";
				$pagination.= "<li><a href=\"$targetpage?page=$lpm1.html\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lastpage.html\">$lastpage</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"$targetpage?page=1.html\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=2.html\">2</a></li>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter.html\">$counter</a></li>";					
				}
				$pagination.= "...";
				$pagination.= "<li><a href=\"$targetpage?page=$lpm1.html\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lastpage.html\">$lastpage</a></li>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li><a href=\"$targetpage?page=1.html\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=2.html\">2</a></li>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter.html\">$counter</a></li>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<li><a href=\"$targetpage?page=$next.html\">&raquo;</a></li>";
		else
			$pagination.= "<li class=\"disabled\"><a href=\"#\">&raquo;</a></li>";
		$pagination.= "</ul>\n";		
	}
	
	$q= $mysqli->query("SELECT * FROM posts WHERE active=2 ORDER BY id DESC limit $start,$limit");


	$numr = mysqli_num_rows($q);
	if ($numr==0)
	{
	echo '<div class="alert alert-danger">There are no deactivated posts to display at this moment.</div>';
	}
	if ($numr>0)
	{
	?>
       <table class="table table-bordered">

        <thead>

            <tr>
				<th>Featured Image</th>
                
                <th>Title</th>

                <th>Posted On</th>

                <th>Manage</th>

            </tr>

        </thead>

        <tbody>
    <?php
	}
	
	while($Row=mysqli_fetch_assoc($q)){
	
	$LongTitle = stripslashes($Row['title']);
	$CropTitle = strlen ($LongTitle);
	if ($CropTitle > 200) {
	$SortTitle = substr($LongTitle,0,200).'...';
	}else{
	$SortTitle = $LongTitle;}
	
	$PhotoLink = preg_replace("![^a-z0-9]+!i", "-", $LongTitle);
	$PhotoLink = urlencode($PhotoLink);
	$PhotoLink = strtolower($PhotoLink);
	
	$Feat = $Row['feat'];

?>        

            <tr class="btnDelete" data-id="<?php echo $Row['id'];?>">
				<td><a data-toggle="modal" href="preview.php?id=<?php echo $Row['id'];?>" data-target="#ProductModal"><img src="timthumb.php?src=http://<?php echo $SiteLink;?>/uploads/<?php echo $Row['image'];?>&amp;h=50&amp;w=50&amp;q=100" alt="<?php echo $LongTitle;?>" class="img-responsive"></a></td>
                
                <td><a data-toggle="modal" href="preview.php?id=<?php echo $Row['id'];?>" data-target="#ProductModal"><?php echo ucfirst($SortTitle);?></a></td>

                <td><?php echo $Row['date'];?></td>

                <td>
                <!--Testing Modal-->
                
               <button class="btn btn-danger btnDelete">Delete</button>
               <button class="btn btn-info btnActivate">Activate</button>
               <a class="btn btn-success btnEdit" href="edit_post.php?id=<?php echo $Row['id'];?>">Edit</a>
				<!--Testing Modal-->
                </td>

            </tr>
<?php } ?>
    
         
        </tbody>

    </table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Confirmation</h4>

            </div>
            <div class="modal-body">
				<p>Are you sure you want to DELETE this post?</p>
                <p class="text-warning"><small>This action cannot be undone.</small></p>		
            </div>
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnDelteYes">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal --> 

<!--Approve Modal-->
<div class="modal fade" id="ActivateModal" tabindex="-1" role="dialog" aria-labelledby="ActivateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Confirmation</h4>

            </div>
            <div class="modal-body">
                 <p> Are you sure you want to ACTIVATE this post?</p>
				 <p class="text-info"><small>You can deactivate this post by navigating to Blog > Manage Posts.</small></p>	
            </div>
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnActivateYes">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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

<?php echo $pagination;?>

</section>

</section><!--col-md-10-->

<?php include("footer.php");?>