<?php

include('../db.php');

if($squ = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $settings = mysqli_fetch_array($squ);
    
    $Active = $settings['active'];

    $squ->close();
}else{
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again</div>");;
}

$UploadDirectory    = '../images/';

if (!@file_exists($UploadDirectory)) {
    //destination folder does not exist
    die("Make sure Upload directory exist!");
}


if($_POST)
{       
    
    if(!isset($_POST['mName']) || strlen($_POST['mName'])<1)
    {
        //required variables are empty
        die('<div class="alert alert-danger" role="alert">Please add a title.</div>');
    }
    
    
    if(strlen(strip_tags(($_POST['desc'])))<1)
    {
        //required variables are empty
        die('<div class="alert alert-danger" role="alert">Please add a description.</div>');
    }  

    if(!isset($_POST['meta_desc']) || strlen($_POST['meta_desc'])<1)
    {
        //required variables are empty
        die('<div class="alert alert-danger" role="alert">Please add a meta description.</div>');
    } 

    if(!isset($_FILES['mFile']))
    {
        //required variables are empty
        die('<div class="alert alert-danger" role="alert">Please add a image</div>');
    }

    if($_FILES['mFile']['error'])
    {
        //File upload error encountered
        die(upload_errors($_FILES['mFile']['error']));
    } 

    $FileName           = strtolower($_FILES['mFile']['name']); //uploaded file name
    $ImageExt           = substr($FileName, strrpos($FileName, '.')); //file extension
    $FileType           = $_FILES['mFile']['type']; //file type
    $FileSize           = $_FILES['mFile']["size"]; //file size
    $RandNumber         = rand(0, 9999999999); //Random number to make each filename unique.
    $Date               = date("F j, Y");
    $FileTitle          = $mysqli->escape_string(trim($_POST['mName'])); // file title
    $Description        = $mysqli->escape_string($_POST['desc']); // description
    $MetaDescription    = $mysqli->escape_string($_POST['meta_desc']); // meta description
    $Link               = preg_replace("![^a-z0-9]+!i", "-", $FileTitle);
    $Link               = strtolower($Link);
    $Link               = urlencode($Link);
    $Link               = strip_tags($Link);

    if($sql = $mysqli->query("SELECT COUNT(link) AS count FROM posts WHERE link = '$Link' "))
    {
        $sqlRow = mysqli_fetch_array($sql);
        $count = $sqlRow['count'];
        if($count>0)
        {
            $Link = $Link . '-2';
        }
        $sql->close();
    }
    else
    {
        die('<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>');
    }

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
    
    function clean($string) 
    {
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

    $mysqli->query("INSERT INTO posts(title, description, meta_description, date, image, active, link) VALUES ('$FileTitle', '$Description', '$MetaDescription', '$Date', '$NewFileName', 1, '$Link')");

?>

<script>
$('#AddPost').delay(1000).resetForm(1000);
</script>

<?php       
        die('<div class="alert alert-success" role="alert">Post added successfully!</div>');
        
   
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