<?php

include("../db.php");

$del = $mysqli->escape_string($_POST['id']);

if($ImageInfo = $mysqli->query("SELECT * FROM listings WHERE catid='$del'")){

    while($GetInfo = mysqli_fetch_array($ImageInfo)){

	
	$Image = $GetInfo['image'];
	
	unlink("../uploaded_images/$Image");

}
	
	$ImageInfo->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}

$mysqli->query("DELETE FROM listings WHERE catid='$del'");

$mysqli->query("DELETE FROM categories WHERE id='$del'");


echo '<div class="alert alert-success" role="alert">Category successfully deleted</div>';

?>