<?php

include('../db.php');


$id = $mysqli->escape_string($_GET['id']);

//Get Photo Info

if($results = $mysqli->query("SELECT * FROM mp_posts WHERE id='$id'")){

    $row = mysqli_fetch_array($results);
	
	$ImageFile = $row['image'];
	
    $results->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again</div>");;
}

$UploadDirectory	= '../images/'; //Upload Directory, ends with slash & make sure folder exist


if (!@file_exists($UploadDirectory)) {
	//destination folder does not exist
	die('<div class="alert alert-danger">Make sure Upload directory exist!</div>');
}

if($_POST)
{	
	
	if(!isset($_POST['mName']) || strlen($_POST['mName'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger" role="alert">Please add a title.</div>');
	}
	
	if(!isset($_POST['desc']) || strlen($_POST['desc'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger" role="alert">Please add a small description.</div>');
	}

	 if(!isset($_POST['meta_desc']) || strlen($_POST['meta_desc'])<1)
    {
        //required variables are empty
        die('<div class="alert alert-danger" role="alert">Please add a meta description.</div>');
    }
	
	$Date		        = date("F j, Y");
	$FileTitle			= $mysqli->escape_string(trim($_POST['mName'])); // file title
	$Description        = $mysqli->escape_string($_POST['desc']); // description
	$MetaDescription    = $mysqli->escape_string($_POST['meta_desc']); // meta description
	$Link               = preg_replace("![^a-z0-9]+!i", "-", $FileTitle);
    $Link               = strtolower($Link);
    $Link               = urlencode($Link);
    $Link               = strip_tags($Link);
	
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
	
	$mysqli->query("UPDATE mp_posts SET title='$FileTitle', description='$Description', meta_description='$MetaDescription', image='$NewFileName', link='$Link' WHERE id='$id'");

   }
   }else{
	   
	$mysqli->query("UPDATE mp_posts SET title='$FileTitle', description='$Description', meta_description='$MetaDescription', link='$Link' WHERE id='$id'");
	   
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