<?php

include('../db.php');


$id = $mysqli->escape_string($_GET['id']);


if($_POST)
{	
	include('../include/media_embed.php');
	
	$CheckUrl = $_POST['mLink'];
	
	if(!isset($_POST['inputTitle']) || strlen($_POST['inputTitle'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger" role="alert">Please add a post title</div>');
	}
	
	if(!isset($_POST['category']) || strlen($_POST['category'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger">Please select a category</div>');
	}
	
	if(!isset($_POST['desc']) || strlen($_POST['desc'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger">Please add a description</div>');
	}
	
	$VideoTitle			= $mysqli->escape_string($_POST['inputTitle']); 
	$VideoURL			= $mysqli->escape_string($_POST['mLink']);
	$Catagory           = $mysqli->escape_string($_POST['category']);
	$Description        = $mysqli->escape_string($_POST['desc']);
	
$pattern="@^https://vine.co/v/\w*$@i";

	if(preg_match($pattern, $CheckUrl)){
	// valid
	
	include('include/simple_html_dom.php');
	
	if (substr($CheckUrl, 0, 7) == "http://"){
		
    $CheckUrl = $CheckUrl;
	
	}elseif (substr($CheckUrl, 0, 8) == "https://"){
    
	$CheckUrl = str_replace("https", "http", $CheckUrl);
	
	$Vid = preg_replace('/^.*\//','',$CheckUrl);
	
	
	$html 				= file_get_html($CheckUrl);
	
	foreach($html->find("//meta[@property='twitter:player:stream']") as $element)
       $VineURL = $element->content;

	foreach($html->find("//meta[@property='twitter:image']") as $element)
       $VineImage = $element->content;

		
	}
	
	$VideoType = 'vine.co';
	
	$VineEmbed = '<iframe class="vine-embed" src="https://vine.co/v/'.$Vid.'/embed/simple?audio=1" width="630" height="630" frameborder="0"></iframe><script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script>';
	//Insert Vines
	
	//$mysqli->query("INSERT INTO media(title, image, video_type, vine_mp4, video_url, video_embed, type, catid, uid, date, active) VALUES ('$FileTitle','$VineImage','$VideoType','$VineURL','$VideoURL','$VineEmbed','$Type','$Catagory','$Uid','$Date','$Active')") or die (mysqli_error());
	
	$mysqli->query("UPDATE media SET title='$VideoTitle', image='$VineImage', video_type='$VideoType', vine_mp4='$VineURL', video_url='$VideoURL', video_embed='$VineEmbed', catid='$Catagory',description='$Description' WHERE id='$id'");
	
	//Other then Vine
	
	}else {

//Get Embed Code

$em = new media_embed($VideoURL);
	$site = $em->get_site();
	if($site != "")
	{
		$SmallThumb = $em->get_thumb("medium");
		$LargeThumb = $em->get_thumb("large");
		$EmbedCode = $em->get_iframe();
					
		
	}
	else
	{
		die('<div class="alert alert-danger">Unsupported video source</div>');
	}

//URL info

$parse = parse_url($VideoURL);
$host = $parse['host'];
$host = str_replace ('www.','', $host);

			
//Insert other videos
		//$mysqli->query("INSERT INTO media(title, image, thumb, video_type, video_url, video_embed, type, catid, uid, date, active) VALUES ('$FileTitle','$LargeThumb','$SmallThumb','$host','$VideoURL','$EmbedCode','$Type','$Catagory','$Uid','$Date','$Active')");
		
		$mysqli->query("UPDATE media SET title='$VideoTitle', image='$LargeThumb', thumb='$SmallThumb', video_type='$host', video_url='$VideoURL', video_embed='$EmbedCode', catid='$Catagory',description='$Description' WHERE id='$id'");


}//vine end		

	   

	die('<div class="alert alert-success" role="alert">Post updated successfully.</div>');

		
   }else{
	   
   		die('<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>');
   }

?>