<?php

include('../db.php');

if($squ = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $settings = mysqli_fetch_array($squ);
	
	$Active = $settings['active'];

    $squ->close();
}else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");;
}


$UploadDirectory	= '../uploaded_images/';
 

if (!@file_exists($UploadDirectory)) {
	//destination folder does not exist
	die("Make sure Upload directory exist!");
}

if($_POST)
{		
	if(!isset($_POST['category']) || strlen($_POST['category'])<1 || $_POST['category'] <1)
	{
		//required variables are empty
		die('<div class="alert alert-danger" role="alert">Please select a category.</div>');
	}
	
	if(!isset($_POST['mName']) || strlen($_POST['mName'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger" role="alert">Please add a title.</div>');
	}

	if(!isset($_POST['meta_desc']) || strlen($_POST['meta_desc'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger" role="alert">Please add a meta description.</div>');
	}
	
	if(!isset($_POST['aff']) || strlen($_POST['aff'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger" role="alert">Please enter product purchase link.</div>');
	}
	
	if(!isset($_POST['aff']) || strlen($_POST['aff'])>1)
	{
	
	$CheckLink = $mysqli->escape_string($_POST['aff']);

	if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $CheckLink)) {
  		//do nothing
	}else {
  	
	die('<div class="alert alert-danger" role="alert">Please enter full product purchase link.</div>');
	
	}
	}
	
	if(!isset($_POST['disc']) || strlen($_POST['disc'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger" role="alert">Please add a small description.</div>');
	}
	
		
	if(!isset($_FILES['mFile']))
	{
		//required variables are empty
		die('<div class="alert alert-danger" role="alert">Please add a image</div>');
	}
	
	if(!isset($_POST['price']) || strlen($_POST['price'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger" role="alert">Please add price.</div>');
	}
	
	if($_FILES['mFile']['error'])
	{
		//File upload error encountered
		die(upload_errors($_FILES['mFile']['error']));
	}

	$FileName			= strtolower($_FILES['mFile']['name']); //uploaded file name
	$ImageExt			= substr($FileName, strrpos($FileName, '.')); //file extension
	$FileType			= $_FILES['mFile']['type']; //file type
	$FileSize			= $_FILES['mFile']["size"]; //file size
	$RandNumber   		= rand(0, 9999999999); //Random number to make each filename unique.
	$Date		        = date("F j, Y");
	
	$FileTitle			= $mysqli->escape_string($_POST['mName']); // file title
	$pname              = preg_replace("![^a-z0-9]+!i", "-", $FileTitle);
    $pname              = urlencode($pname);
    $pname              = strtolower($pname);
    $pname              = strip_tags($pname);
    if(isset($_POST['category-sub']) && strlen($_POST['category-sub'])>0 && $_POST['category-sub']>0)
    {
    	$Category       = $mysqli->escape_string($_POST['category-sub']); // sub category
    }
    else
    {
    	$Category       = $mysqli->escape_string($_POST['category']); // category 
    }
	if($sql_cname2 = $mysqli->query("SELECT cname2 FROM categories WHERE id='$Category' "))
	{
		$cname2_row = mysqli_fetch_array($sql_cname2);
		$cname2 = $cname2_row['cname2'];
	}
	else
	{
		die('<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>');
	}
	$AffURL             = $mysqli->escape_string($_POST['aff']); // afflite url
	$Description        = $mysqli->escape_string($_POST['disc']); // description
	$Price              = $mysqli->escape_string($_POST['price']); // price
	$MetaDescription    = $mysqli->escape_string($_POST['meta_desc']); // price
    $external           = $mysqli->escape_string($_POST['external']);

	
		switch(strtolower($FileType))
	{
		//allowed file types
		case 'image/png': //png file
		case 'image/gif': //gif file 
		case 'image/jpeg': //jpeg file
			break;
		default:
			die('<div class="alert alert-danger" role="alert">Unsupported Image File. Please upload JPEG, PNG or GIF files</div>'); //output error
	}
	
	function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
  
	//Image File Title will be used as new File name
	$NewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($FileTitle));
	$NewFileName = clean($NewFileName);
	$NewFileName = $NewFileName.'_'.$RandNumber.$ImageExt;

 //Rename and save uploded image file to destination folder.
   if(move_uploaded_file($_FILES['mFile']["tmp_name"], $UploadDirectory . $NewFileName ))
   {
	
		
// Insert info into database table.. do w.e!
		if(!$mysqli->query("INSERT INTO listings(title, aff_url, discription, price, image, catid, date, saves, uid, feat, active, meta_description, pname, cname, external_link) VALUES ('$FileTitle', '$AffURL','$Description','$Price','$NewFileName','$Category','$Date','0','0','0','1', '$MetaDescription', '$pname', '$cname2', '$external')"))
		{
			echo "Error : " . $mysqli->error;
		}

?>

<script>
$('#AddProduct').delay(1000).resetForm(1000);
</script>

<?php		
		die('<div class="alert alert-success" role="alert">Product added successfully.</div>');
		
   
   }else{
   		die('<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>');
   } 
}

function upload_errors($err_code) {
	switch ($err_code) { 
        case UPLOAD_ERR_INI_SIZE: 
            return '<div class="alert alert-danger" role="alert">Image file size is too big. Please try a smaller image</div>'; 
        case UPLOAD_ERR_FORM_SIZE: 
            return '<div class="alert alert-danger" role="alert">Image file size is too big. Please try a smaller image</div>'; 
        case UPLOAD_ERR_PARTIAL: 
            return '<div class="alert alert-danger" role="alert">Product listing submitted but product image did not uploaded properly.</div>'; 
        case UPLOAD_ERR_NO_FILE: 
            return '<div class="alert alert-danger" role="alert">Product listing submitted but product image not uploaded.</div>'; 
        case UPLOAD_ERR_NO_TMP_DIR: 
            return '<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>'; 
        case UPLOAD_ERR_CANT_WRITE: 
            return '<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>'; 
        case UPLOAD_ERR_EXTENSION: 
            return '<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>'; 
        default: 
            return '<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>'; 
    }  
} 
?>