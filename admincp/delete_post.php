<?php

include("../db.php");

$del = $mysqli->escape_string($_POST['id']);

if($ImageInfo = $mysqli->query("SELECT * FROM mp_posts WHERE id='$del'")){

    $GetInfo = mysqli_fetch_array($ImageInfo);
	
	$CheckImage = $ImageInfo->num_rows;
	
	$Image = $GetInfo['image'];
	
	$ImageInfo->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
}

if($CheckImage==1){

unlink("../uploads/$Image");

}


$DeletePosts = $mysqli->query("DELETE FROM mp_posts WHERE id='$del'");


echo '<div class="alert alert-success" role="alert">Post has been deleted successfully!</div>';

?>