<?php

include('../db.php');

if($squ = $mysqli->query("SELECT * FROM mp_options WHERE id='1'")){

    $settings = mysqli_fetch_array($squ);
	
	$Active = $settings['active'];

    $squ->close();
}else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");;
}


$UploadDirectory	= '../images/';
 

if (!@file_exists($UploadDirectory)) {
	//destination folder does not exist
	die("Make sure Upload directory exist!");
}

if($_POST)
{		
	
	if($_FILES['mFile2']['error'])
	{
		//File upload error encountered
		die(upload_errors($_FILES['mFile2']['error']));
	}

	$FileName			= strtolower($_FILES['mFile2']['name']); //uploaded file name
	$ImageExt			= substr($FileName, strrpos($FileName, '.')); //file extension
	$FileType			= $_FILES['mFile2']['type']; //file type
	$FileSize			= $_FILES['mFile2']["size"]; //file size
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
  
	//Image File Title will be used as new File name
	$NewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), pathinfo($_FILES['mFile2']['name'], PATHINFO_FILENAME));
	$NewFileName = clean($NewFileName);
	$NewFileName = $NewFileName.'_'.$RandNumber.$ImageExt;

 //Rename and save uploded image file to destination folder.
   if(move_uploaded_file($_FILES['mFile2']["tmp_name"], $UploadDirectory . $NewFileName ))
   {
	
		
// Insert info into database table.. do w.e!
		$mysqli->query("INSERT INTO images (name) VALUES ('$NewFileName')");

?>

<script>
$('#UploadImage').delay(1000).resetForm(1000);
</script>
	
		<div class='form-group'>

<label for='url'>Image URL</label>

<input style="width:60%; display: inline-block;" type='text' name='url' id='imageUrl' class='form-control' value='http://<?php echo $settings['siteurl'];?>/images/<?php echo $NewFileName;?>' placeholder='Upload image to get the URL here'> <span><button class="btn btn-primary" onclick='copy()'>Copy URL</button></span><span id="copy-output" style="margin-left: 5px;display: none;">URL Copied!</span>

</div>

<?php
		
   
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
            return '<div class="alert alert-danger" role="alert">Product listing submitted but product image did not uploaded.</div>'; 
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
