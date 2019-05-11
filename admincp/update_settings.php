<?php

include('../db.php');

//Get User Settings

if($SiteSettings = $mysqli->query("SELECT * FROM mp_options WHERE id='1'")){

    $Settings = mysqli_fetch_array($SiteSettings);
  
  $Active = $Settings['active'];
  
  $SiteSettings->close();
  
}else{
    
   printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Try again</div>");;
}

//Get User Info


$UploadDirectory  = '../images/'; //Upload Directory, ends with slash & make sure folder exist

if (!@file_exists($UploadDirectory)) {
  //destination folder does not exist
  die('<div class="alert alert-danger">Make sure Upload directory exists!</div>');
}


if($_POST)
{ 

  if(!isset($_POST['inputTitle']) || strlen($_POST['inputTitle'])<1)
  {
    //required variables are empty
    die('<div class="alert alert-danger" role="alert">Please enter your site title</div>');
  }
  
  if(!isset($_POST['inputSiteurl']) || strlen($_POST['inputSiteurl'])<1)
  {
    //required variables are empty
    die('<div class="alert alert-danger" role="alert">Please enter your site link</div>');
  }
   if(!isset($_POST['inputBuy']) || strlen($_POST['inputBuy'])<1)
  {
    //required variables are empty
    die('<div class="alert alert-danger" role="alert">The "Buy Button Text" in the Text Content Settings is empty.</div>');
  }
  if(!isset($_POST['inputPriceSymbol']) || strlen($_POST['inputPriceSymbol'])<1)
  {
    //required variables are empty
    die('<div class="alert alert-danger" role="alert">The "Price Symbol" in the Text Content Settings is empty.</div>');
  }
  if(!isset($_POST['inputSave']) || strlen($_POST['inputSave'])<1)
  {
    //required variables are empty
    die('<div class="alert alert-danger" role="alert">The "Save Button Text" in the Text Content Settings is empty.</div>');
  }
  if(!isset($_POST['inputGiftsUnder']) || strlen($_POST['inputGiftsUnder'])<1)
  {
    //required variables are empty
    die('<div class="alert alert-danger" role="alert">The "Gifts Under $20 Text" in the Text Content Settings is empty.</div>');
  }
  if(!isset($_POST['inputGiftsUnderLimit']) || strlen($_POST['inputGiftsUnderLimit'])<1)
  {
    //required variables are empty
    die('<div class="alert alert-danger" role="alert">The "Gifts Under Limit" in the Text Content Settings is empty.</div>');
  }
  if(!isset($_POST['inputRelatedTxt']) || strlen($_POST['inputRelatedTxt'])<1)
  {
    //required variables are empty
    die('<div class="alert alert-danger" role="alert">The "Related Products Text" in the Text Content Settings is empty.</div>');
  }
  if(!isset($_POST['inputSubBoxTitle']) || strlen($_POST['inputSubBoxTitle'])<1)
  {
    //required variables are empty
    die('<div class="alert alert-danger" role="alert">Please enter subscription box title</div>');
  }

  if(!isset($_POST['inputSubBoxBtnText']) || strlen($_POST['inputSubBoxBtnText'])<1)
  {
    //required variables are empty
    die('<div class="alert alert-danger" role="alert">Please enter subscription box button text</div>');
  }

  if(!isset($_POST['inputSubBoxDesc']) || strlen($_POST['inputSubBoxDesc'])<1)
  {
    //required variables are empty
    die('<div class="alert alert-danger" role="alert">Please enter subscription box description</div>');
  }
    
  if(!isset($_POST['inputFbpage']) || strlen($_POST['inputFbpage'])>1)
  {
  $CheckFacebookPage = $mysqli->escape_string($_POST['inputFbpage']);

  if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $CheckFacebookPage)) {
      //do nothing
  }else {
    
  die('<div class="alert alert-danger" role="alert">Please enter full Facebook url.</div>');
  
  }
  }
  
  if(!isset($_POST['inputTwitter']) || strlen($_POST['inputTwitter'])>1)
  {
  $CheckTwitter = $mysqli->escape_string($_POST['inputTwitter']);

  if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $CheckTwitter)) {
      //do nothing
  }else {
    
  die('<div class="alert alert-danger" role="alert">Please enter full Twitter url.</div>');
  
  }
  }
  
  if(!isset($_POST['inputPinterest']) || strlen($_POST['inputPinterest'])>1)
  {
  $CheckPinterest = $mysqli->escape_string($_POST['inputPinterest']);

  if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $CheckPinterest)) {
      //do nothing
  }else {
    
  die('<div class="alert alert-danger" role="alert">Please enter full Pinterest url.</div>');
  
  }
  }
  
  
  if(!isset($_POST['inputGplus']) || strlen($_POST['inputGplus'])>1)
  {
  $CheckGplus = $mysqli->escape_string($_POST['inputGplus']);

  if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $CheckGplus)) {
      //do nothing
  }else {
    
  die('<div class="alert alert-danger" role="alert">Please enter full Google+ url.</div>');
  
  }
  }
  
    
  $SiteTitle      = $mysqli->escape_string(trim($_POST['inputTitle'])); // file title
  $SiteLink           = $mysqli->escape_string(trim($_POST['inputSiteurl']));
  $MetaDescription    = $mysqli->escape_string($_POST['inputDescription']);
  $MetaKeywords     = $mysqli->escape_string($_POST['inputKeywords']);
  $SiteEmail        = $mysqli->escape_string($_POST['inputEmail']);
  $HomeMenu       = $mysqli->escape_string($_POST['inputHome']);
  $AllCatMenu     = $mysqli->escape_string($_POST['inputCategories']);
  $PopularMenu       = $mysqli->escape_string($_POST['inputPopular']);
  $GiftGuidesMenu    = $mysqli->escape_string($_POST['inputGiftGuides']);
  $SortNewest     = $mysqli->escape_string($_POST['inputNewest']);
  $SortPopular    = $mysqli->escape_string($_POST['inputPopularIndex']);
  $SortHigh     = $mysqli->escape_string($_POST['inputHigh']);
  $SortLow     = $mysqli->escape_string($_POST['inputLow']);
  $BuyButton      = $mysqli->escape_string(trim($_POST['inputBuy']));
  $PriceSymbol     =   $mysqli->escape_string($_POST['inputPriceSymbol']);
  $SaveButton     = $mysqli->escape_string(trim($_POST['inputSave']));
  $RemoveButton   = $mysqli->escape_string(trim($_POST['inputRemove']));
  $GiftsUnder     = $mysqli->escape_string(trim($_POST['inputGiftsUnder']));
  $GiftsUnderLimit = $mysqli->escape_string(trim($_POST['inputGiftsUnderLimit']));
  $RelatedTxt     = $mysqli->escape_string(trim($_POST['inputRelatedTxt']));
  $FBApp          = $mysqli->escape_string($_POST['inputFbapp']);
  $FBPage           = $mysqli->escape_string($_POST['inputFbpage']);
  $TwitterLink      = $mysqli->escape_string($_POST['inputTwitter']);
  $PinterestLink      = $mysqli->escape_string($_POST['inputPinterest']);
  $GooglePlusLink     = $mysqli->escape_string($_POST['inputGplus']);
  $whatsNewCol = $mysqli->escape_string($_POST['inputWhatsNewColor']);
  $whatsNewColMono = $mysqli->escape_string($_POST['inputWhatsNewColorMono']);
  $whatsNewColBorder = $mysqli->escape_string($_POST['inputWhatsNewColorBorder']);
  $whatsNewColTxt = $mysqli->escape_string($_POST['inputWhatsNewColorText']);
  $featCol1 = $mysqli->escape_string($_POST['inputFeatColor1']);
  $featCol1Mono = $mysqli->escape_string($_POST['inputFeatColor1Mono']);
  $featCol1Border = $mysqli->escape_string($_POST['inputFeatColor1Border']);
  $featCol2 = $mysqli->escape_string($_POST['inputFeatColor2']);
  $featCol2Mono = $mysqli->escape_string($_POST['inputFeatColor2Mono']);
  $featCol2Border = $mysqli->escape_string($_POST['inputFeatColor2Border']);
  $featCol3 = $mysqli->escape_string($_POST['inputFeatColor3']);
  $featCol3Mono = $mysqli->escape_string($_POST['inputFeatColor3Mono']);
  $featCol3Border = $mysqli->escape_string($_POST['inputFeatColor3Border']);
  $featCol4 = $mysqli->escape_string($_POST['inputFeatColor4']);
  $featCol4Mono = $mysqli->escape_string($_POST['inputFeatColor4Mono']);
  $featCol4Border = $mysqli->escape_string($_POST['inputFeatColor4Border']);
  $featCol5 = $mysqli->escape_string($_POST['inputFeatColor5']);
  $featCol5Mono = $mysqli->escape_string($_POST['inputFeatColor5Mono']);
  $featCol5Border = $mysqli->escape_string($_POST['inputFeatColor5Border']);
  $allCatCol = $mysqli->escape_string($_POST['inputAllCatColor']);
  $allCatColMono = $mysqli->escape_string($_POST['inputAllCatColorMono']);
  $allCatColBorder = $mysqli->escape_string($_POST['inputAllCatColorBorder']);
  $mobWhatsNewCol = $mysqli->escape_string($_POST['inputMobWhatsNewColor']);
  $mobWhatsNewColMono = $mysqli->escape_string($_POST['inputMobWhatsNewColorMono']);
  $mobWhatsNewColBorder = $mysqli->escape_string($_POST['inputMobWhatsNewColorBorder']);
  $mobPopularCol = $mysqli->escape_string($_POST['inputMobPopularColor']);
  $mobPopularColMono = $mysqli->escape_string($_POST['inputMobPopularColorMono']);
  $mobPopularColBorder = $mysqli->escape_string($_POST['inputMobPopularColorBorder']);
  $mobGiftGuidesCol = $mysqli->escape_string($_POST['inputGiftGuidesColor']);
  $mobGiftGuidesColMono = $mysqli->escape_string($_POST['inputGiftGuidesColorMono']);
  $mobGiftGuidesColBorder = $mysqli->escape_string($_POST['inputGiftGuidesColorBorder']);
  $mobSearchCol = $mysqli->escape_string($_POST['inputMobSearchColor']);
  $mobSearchColMono = $mysqli->escape_string($_POST['inputMobSearchColorMono']);
  $mobSearchColBorder = $mysqli->escape_string($_POST['inputMobSearchColorBorder']);
  $CheckOutBtnColor = $mysqli->escape_string($_POST['inputCheckOutColor']);
  $SaveBtnColor  = $mysqli->escape_string($_POST['inputSaveBtnColor']);
  $RemoveBtnColor = $mysqli->escape_string($_POST['inputRemoveBtnColor']);
  $SortBG  = $mysqli->escape_string($_POST['inputSortBG']);
  $SortTXT = $mysqli->escape_string($_POST['inputSortTXT']);
  $GiftsTXT = $mysqli->escape_string($_POST['inputGiftsTXT']);
  $mobSubBoxTitle = $mysqli->escape_string($_POST['inputSubBoxTitle']);
  $mobSubBoxBtnTxt = $mysqli->escape_string($_POST['inputSubBoxBtnText']);
  $mobSubBoxDesc = $mysqli->escape_string($_POST['inputSubBoxDesc']);
  $mailgunPrivateKey = $mysqli->escape_string($_POST['inputMailgunPrivateKey']);
  $mailgunPublicKey = $mysqli->escape_string($_POST['inputMailgunPublicKey']);
  $mailgunDomain = $mysqli->escape_string($_POST['inputMailgunDomain']);
  $mailgunList = $mysqli->escape_string($_POST['inputMailgunList']);
  $mailgunSecret = $mysqli->escape_string($_POST['inputMailgunSecret']);
  $analytics = $mysqli->escape_string($_POST['inputAnalytics']);
  $addthis = $mysqli->escape_string($_POST['inputAddthis']);
  $addthisFilter = $mysqli->escape_string($_POST['addthisFilter']);
  
  if(isset($_FILES['inputfile']))
  {

  if($_FILES['inputfile']['error'])
  {
    //File upload error encountered
    die(upload_errors($_FILES['inputfile']['error']));
  }
  
  $Logo       = strtolower($_FILES['inputfile']['name']); //uploaded file name
  $ImageExt     = substr($Logo, strrpos($Logo, '.')); //file extension
  $FileType     = $_FILES['inputfile']['type']; //file type
  $FileSize     = $_FILES['inputfile']["size"]; //file size
    
  switch(strtolower($FileType))
  {
    //allowed file types
    case 'image/png': //png file
      break;
    default:
      die('<div class="alert alert-danger" role="alert">Unsupported File! Please upload only PNG file as your logo.</div>'); //output error
  }
  
   $NewLogoName = 'logo'.$ImageExt;
   $logoUpload = move_uploaded_file($_FILES['inputfile']["tmp_name"], $UploadDirectory . $NewLogoName );
  }

  if(isset($_FILES['inputfavicon']))
  {
    if($_FILES['inputfavicon']['error'])
    {
       //File upload error encountered
       die(upload_errors($_FILES['inputfavicon']['error']));
    }
      $Favicon       = strtolower($_FILES['inputfavicon']['name']); //uploaded file name
      $FaviconImageExt     = substr($Favicon, strrpos($Favicon, '.')); //file extension
      $FaviconFileType     = $_FILES['inputfavicon']['type']; //file type
      $FaviconFileSize     = $_FILES['inputfavicon']["size"]; //file size
    
      switch(strtolower($FaviconFileType))
      {
        //allowed file types
        case 'image/x-icon': //ico file
          break;
        default:
          die('<div class="alert alert-danger" role="alert">Unsupported File! Please upload only .ICO file as your favicon. <a href="http://tools.dynamicdrive.com/favicon/" target="_blank">Generate favicons here</a></div>'); //output error
      }
  
    $NewFaviconName = 'favicon'.$FaviconImageExt;
   $faviconUpload = move_uploaded_file($_FILES['inputfavicon']["tmp_name"], $UploadDirectory . $NewFaviconName );
  }
   //Rename and save uploded files to destination folder.
   if($logoUpload && $faviconUpload)
   {
    
  // Insert info into database table.. do w.e!
  $mysqli->query("UPDATE settings SET name='$SiteTitle',siteurl='$SiteLink',keywords='$MetaKeywords',descrp='$MetaDescription',email='$SiteEmail',buy_button='$BuyButton',fbapp='$FBApp',fbpage='$FBPage',twitter='$TwitterLink',pinterest='$PinterestLink',google_plus='$GooglePlusLink', price_symbol='$PriceSymbol', mobSubBoxTitle='$mobSubBoxTitle', mobSubBoxBtnText='$mobSubBoxBtnTxt', mobSubBoxDesc='$mobSubBoxDesc', MailgunPrivateKey='$mailgunPrivateKey', MailgunPublicKey='$mailgunPublicKey', MailgunDomain='$mailgunDomain', MailgunList='$mailgunList', MailgunSecret='$mailgunSecret', analytics='$analytics', addthis='$addthis', addthisFilter='$addthisFilter', txt_home='$HomeMenu', txt_all_cat='$AllCatMenu', txt_popular='$PopularMenu', txt_gift_guides='$GiftGuidesMenu', txt_save='$SaveButton', txt_remove='$RemoveButton', txt_gifts_under='$GiftsUnder', gifts_under_limit='$GiftsUnderLimit', txt_related='$RelatedTxt', txt_newest='$SortNewest', txt_popular_index='$SortPopular', txt_high='$SortHigh', txt_low='$SortLow' WHERE id=1");

  $mysqli->query("UPDATE colors SET whats_new_col='$whatsNewCol', whats_new_col_mono='$whatsNewColMono', whats_new_col_border='$whatsNewColBorder', whats_new_col_text='$whatsNewColTxt', feat_col_1='$featCol1', feat_col_2='$featCol2', feat_col_3='$featCol3', feat_col_4='$featCol4', feat_col_5='$featCol5', feat_col_1_mono='$featCol1Mono', feat_col_2_mono='$featCol2Mono', feat_col_3_mono='$featCol3Mono', feat_col_4_mono='$featCol4Mono', feat_col_5_mono='$featCol5Mono',feat_col_1_border='$featCol1Border', feat_col_2_border='$featCol2Border', feat_col_3_border='$featCol3Border', feat_col_4_border='$featCol4Border', feat_col_5_border='$featCol5Border', all_cat_col='$allCatCol', all_cat_col_mono='$allCatColMono', all_cat_col_border='$allCatColBorder', mob_whats_new_color='$mobWhatsNewCol', mob_popular_color='$mobPopularCol', mob_gift_guides_color='$mobGiftGuidesCol', mob_search_color='$mobSearchCol', mob_whats_new_color_mono='$mobWhatsNewColMono', mob_popular_color_mono='$mobPopularColMono', mob_gift_guides_color_mono='$mobGiftGuidesColMono', mob_search_color_mono='$mobSearchColMono', mob_whats_new_color_border='$mobWhatsNewColBorder', mob_popular_color_border='$mobPopularColBorder', mob_gift_guides_color_border='$mobGiftGuidesColBorder', mob_search_color_border='$mobSearchColBorder', btn_check_out='$CheckOutBtnColor', btn_save='$SaveBtnColor', btn_remove='$RemoveBtnColor', sort_bg_col='$SortBG', sort_txt_col='$SortTXT', gifts_col='$GiftsTXT' WHERE id=1 ");
  
   } 
   else{ // end checking logo and favicon upload
   
  $mysqli->query("UPDATE settings SET name='$SiteTitle',siteurl='$SiteLink',keywords='$MetaKeywords',descrp='$MetaDescription',email='$SiteEmail',buy_button='$BuyButton',fbapp='$FBApp',fbpage='$FBPage',twitter='$TwitterLink',pinterest='$PinterestLink',google_plus='$GooglePlusLink', price_symbol='$PriceSymbol', mobSubBoxTitle='$mobSubBoxTitle', mobSubBoxBtnText='$mobSubBoxBtnTxt', mobSubBoxDesc='$mobSubBoxDesc', MailgunPrivateKey='$mailgunPrivateKey', MailgunPublicKey='$mailgunPublicKey', MailgunDomain='$mailgunDomain', MailgunList='$mailgunList', MailgunSecret='$mailgunSecret', analytics='$analytics', addthis='$addthis', addthisFilter='$addthisFilter', txt_home='$HomeMenu', txt_all_cat='$AllCatMenu', txt_popular='$PopularMenu', txt_gift_guides='$GiftGuidesMenu', txt_save='$SaveButton', txt_remove='$RemoveButton', txt_gifts_under='$GiftsUnder', gifts_under_limit='$GiftsUnderLimit', txt_related='$RelatedTxt', txt_newest='$SortNewest', txt_popular_index='$SortPopular', txt_high='$SortHigh', txt_low='$SortLow' WHERE id=1");

   $mysqli->query("UPDATE colors SET whats_new_col='$whatsNewCol', whats_new_col_mono='$whatsNewColMono', whats_new_col_border='$whatsNewColBorder', whats_new_col_text='$whatsNewColTxt', feat_col_1='$featCol1', feat_col_2='$featCol2', feat_col_3='$featCol3', feat_col_4='$featCol4', feat_col_5='$featCol5', feat_col_1_mono='$featCol1Mono', feat_col_2_mono='$featCol2Mono', feat_col_3_mono='$featCol3Mono', feat_col_4_mono='$featCol4Mono', feat_col_5_mono='$featCol5Mono',feat_col_1_border='$featCol1Border', feat_col_2_border='$featCol2Border', feat_col_3_border='$featCol3Border', feat_col_4_border='$featCol4Border', feat_col_5_border='$featCol5Border', all_cat_col='$allCatCol', all_cat_col_mono='$allCatColMono', all_cat_col_border='$allCatColBorder', mob_whats_new_color='$mobWhatsNewCol', mob_popular_color='$mobPopularCol', mob_gift_guides_color='$mobGiftGuidesCol', mob_search_color='$mobSearchCol', mob_whats_new_color_mono='$mobWhatsNewColMono', mob_popular_color_mono='$mobPopularColMono', mob_gift_guides_color_mono='$mobGiftGuidesColMono', mob_search_color_mono='$mobSearchColMono', mob_whats_new_color_border='$mobWhatsNewColBorder', mob_popular_color_border='$mobPopularColBorder', mob_gift_guides_color_border='$mobGiftGuidesColBorder', mob_search_color_border='$mobSearchColBorder', btn_check_out='$CheckOutBtnColor', btn_save='$SaveBtnColor', btn_remove='$RemoveBtnColor', sort_bg_col='$SortBG', sort_txt_col='$SortTXT', gifts_col='$GiftsTXT' WHERE id=1 ");
   
    }

    die('<div class="alert alert-success" role="alert">Site settings updated successfully.</div>');

    
 } else{
      die('<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>');
}


if(isset($_FILES['inputfile']) || isset($_FILES['inputfavicon']))
  {
//function outputs upload error messages, http://www.php.net/manual/en/features.file-upload.errors.php#90522
function upload_errors($err_code) {
  switch ($err_code) { 
        case UPLOAD_ERR_INI_SIZE: 
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini'; 
        case UPLOAD_ERR_FORM_SIZE: 
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form'; 
        case UPLOAD_ERR_PARTIAL: 
            return 'The uploaded file was only partially uploaded'; 
        case UPLOAD_ERR_NO_FILE: 
            return 'No file was uploaded'; 
        case UPLOAD_ERR_NO_TMP_DIR: 
            return 'Missing a temporary folder'; 
        case UPLOAD_ERR_CANT_WRITE: 
            return 'Failed to write file to disk'; 
        case UPLOAD_ERR_EXTENSION: 
            return 'File upload stopped by extension'; 
        default: 
            return 'Unknown upload error'; 
    } 
} 
  }//End Logo and Favicon upload

?>

