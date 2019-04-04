<?php
include('db.php');

$id = $mysqli->escape_string($_GET['id']);

if($Sql = $mysqli->query("SELECT * FROM listings WHERE id='$id'")){

   $row = mysqli_fetch_array($Sql);
   
   $AffURL = $row['aff_url'];

   
   $Sql->close();

}else{
     
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");;
}

//Tot Hits
	
	$mysqli->query("UPDATE listings SET hits=hits+1 WHERE id='$id'");
	
	header( 'Location: '.$AffURL.'' ) ;
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $row['title'];?></title>
</head>

<body>
</body>
</html>