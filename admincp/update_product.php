<?php

include('../db.php');
$id = $mysqli->escape_string($_GET['id']);
if($products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_id='$id'")){
    $products_row = mysqli_fetch_array($products_result_set);
	$ImageFile = $products_row['product_image'];
    $products_result_set->close();
}else{
	 printf("<div class='alert alert-danger alert-pull'>产品查询失败(update_product.php)</div>");
}

$UploadDirectory	= '../images/'; //Upload Directory, ends with slash & make sure folder exist


if (!@file_exists($UploadDirectory)) {
	//destination folder does not exist
	die('<div class="alert alert-danger">Make sure Upload directory exist!</div>');
}

if($_POST)
{	

	if(!isset($_POST['category']) || strlen($_POST['category'])<1)
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
	
	if(!isset($_POST['price']) || strlen($_POST['price'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger" role="alert">Please add price.</div>');
	}

	
	
	$Date		        = date("F j, Y");
	$FileTitle			= $mysqli->escape_string($_POST['mName']); // file title
	$pname              = preg_replace("![^a-z0-9]+!i", "-", $FileTitle);
    $pname              = urlencode($pname);
    $pname              = strtolower($pname);
    $pname              = strip_tags($pname);
	$Category           = $mysqli->escape_string($_POST['category']); // category 
	if($sql_cname2 = $mysqli->query("SELECT cname2 FROM mp_categories WHERE category_id='$Category' "))
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

	
	
	if(isset($_FILES['mFile']))
	{
		
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
  
	//File Title will be used as new File name
	$NewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($FileTitle));
	$NewFileName = clean($NewFileName);
	$NewFileName = $NewFileName.'_'.$RandNumber.$ImageExt;
   //Rename and save uploded file to destination folder.
   if(move_uploaded_file($_FILES['mFile']["tmp_name"], $UploadDirectory . $NewFileName ))
   {
	   
	unlink("../images/".$ImageFile);
	
	$mysqli->query("UPDATE listings SET title='$FileTitle', aff_url='$AffURL', discription='$Description', price='$Price', image='$NewFileName', catid='$Category', meta_description='$MetaDescription', pname='$pname', cname='$cname2' WHERE id='$id'");

   }
   }else{
	   
	$mysqli->query("UPDATE listings SET title='$FileTitle', aff_url='$AffURL', discription='$Description', price='$Price', catid='$Category', meta_description='$MetaDescription', pname='$pname', cname='$cname2' WHERE id='$id'");
	   
 }

	die('<div class="alert alert-success" role="alert">Product listing updated successfully.</div>');

		
   }else{
	   
   		die('<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>');
   }


if(isset($_FILES['inputfile']))
	{
//function outputs upload error messages, http://www.php.net/manual/en/features.file-upload.errors.php#90522
function upload_errors($err_code) {
	switch ($err_code) { 
        case UPLOAD_ERR_INI_SIZE: 
            return '<div class="alert alert-danger" role="alert">Image file size is too big. Please try a smaller image</div>'; 
        case UPLOAD_ERR_FORM_SIZE: 
            return '<div class="alert alert-danger" role="alert">Image file size is too big. Please try a smaller image</div>'; 
        case UPLOAD_ERR_PARTIAL: 
            return '<div class="alert alert-danger" role="alert">Product listing updated but product image did not uploaded properly.</div>'; 
        case UPLOAD_ERR_NO_FILE: 
            return '<div class="alert alert-danger" role="alert">Product listing updated but product image did not uploaded.</div>'; 
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
	}
?>