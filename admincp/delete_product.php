<?php

include("../db.php");

$del = $mysqli->escape_string($_POST['id']);

if($ImageInfo = $mysqli->query("SELECT * FROM listings WHERE id='$del'")){

    $GetInfo = mysqli_fetch_array($ImageInfo);
	
	$CheckImage = $ImageInfo->num_rows;
	
	$Image = $GetInfo['image'];
	
	$ImageInfo->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}

if($CheckImage==1){

unlink("../images/$Image");

}


$DeletePosts = $mysqli->query("DELETE FROM listings WHERE id='$del'");


echo '<div class="alert alert-success" role="alert">Product listing successfully deleted</div>';

?>