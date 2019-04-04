<?php

include("../db.php");

//Get Site Settings

if($SiteSettings = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $Settings = mysqli_fetch_array($SiteSettings);
	
	$SiteLink = $Settings['siteurl'];
	
	$SiteSettings->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}

$id = $mysqli->escape_string($_GET['id']);

	if($result = $mysqli->query("SELECT * FROM listings WHERE id=$id LIMIT 1")){	
	$row = mysqli_fetch_array($result);
	
	$catid = $row['catid'];
	
	$UserId = $row['uid'];
	
	$GetCname =  $mysqli->query("SELECT cname FROM categories WHERE id=$catid LIMIT 1");	
	$Crow = mysqli_fetch_array($GetCname);
	
	$LongDisc = $row['discription'];
	$StrDisc = strlen ($LongDisc);
	if ($StrDisc > 275) {
	$DsicLong = substr($LongDisc,0,275).'...';
	}else{
	$DsicLong = $LongDisc;}
	
	$ProductTitle = $row['title'];
	$PageLink = preg_replace("![^a-z0-9]+!i", "-", $ProductTitle);
	$PageLink = strtolower($PageLink);

$result->close();

}else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");;
}

if($UserId==0){
	$Username = "Admin ('You')";

}else{

//Get user info

$Uname = $_SESSION['username'];

if($UserSql = $mysqli->query("SELECT * FROM users WHERE user_id='$UserId'")){

    $UserRow = mysqli_fetch_array($UserSql);
	
	 $CountUsers = $UserSql->num_rows;
	
    $UserSql->close();
	
}else{
     
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
	 
}

if($CountUsers==0){
	
	$Username = "User no longer exist (Deleted)";
			
}else{
	
	$Username = $UserRow['username'];

}
	
}

//Get Category

if($CatSelected = $mysqli->query("SELECT * FROM categories WHERE id='$catid' LIMIT 1")){

$CatSelectedRow = mysqli_fetch_array($CatSelected);

$CatSelected->close();

}else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}

?>


<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><?php echo $ProductTitle;?></h4>
           </div>
           <div class="modal-body">

<!--Data-->

<img src="timthumb.php?src=http://<?php echo $SiteLink;?>/uploaded_images/<?php echo $row['image'];?>&amp;h=550&amp;w=650&amp;q=100" data-src="http://<?php echo $SiteLink;?>/uploads/<?php echo $row['image'];?>" alt="<?php echo $FeatTitle;?>" class="img-responsive slide-img">

<p class="col-description"><?php echo $DsicLong;?></p>

<div class="col-info"><h1>&#36;<?php echo $row['price'];?></h1></div>

<div class="col-info"><strong>By:</strong> <?php echo $Username;?><br/> <strong>Category:</strong> <?php echo $CatSelectedRow['cname'];?> </div>

<a class="btn btn-warning btn-block btn-lg btn-font btn-pull" href="../aff_link.php?id=<?php echo $row['id'];?>" target="_blank"><?php echo $Settings['buy_button'];?></a>

</div><!--col-center-items-->

<!--Data-->
</div>
   <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
          <!-- /.modal-content -->
