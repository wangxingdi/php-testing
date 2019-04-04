<?php include("header.php");?>

<section class="col-md-2">

<link rel="stylesheet" type="text/css" href="css/style-new.css">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li>Admin CP</li>
  <li class="active">Settings</li>
</ol>

<div class="page-header">
  <h3>All Settings <small>Update your website settings</small></h3>
</div>

<script src="js/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script>
$(function(){
$(":file").filestyle({iconName: "glyphicon-picture", buttonText: "Select Photo"});
});

$(document).ready(function()
{
    $('#settingsForm').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitButton').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output").html('<div class="alert alert-info" role="alert">Submitting.. Please wait..</div>');
        
        $(this).ajaxSubmit({
        target: '#output',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{   
     
    $('#submitButton').removeAttr('disabled'); //enable submit button
   
}
$(document).ready(function()
{
    $('#neon').on("click", function()
    {
        $('#inputWhatsNewColor').val('FAFAFA');
        $('#inputWhatsNewColorMono').val('EDEDED');
        $('#inputWhatsNewColorBorder').val('C7C7C7');
        $('#inputWhatsNewColorText').val('333333');
        $('#inputFeatColor1').val('ff1493');
        $('#inputFeatColor1Mono').val('fa0087');
        $('#inputFeatColor1Border').val('cc1075');
        $('#inputFeatColor2').val('120052');
        $('#inputFeatColor2Mono').val('0c0039');
        $('#inputFeatColor2Border').val('0e0041');
        $('#inputFeatColor3').val('652ec7');
        $('#inputFeatColor3Mono').val('5a29b2');
        $('#inputFeatColor3Border').val('50249f');
        $('#inputFeatColor4').val('00c2ba');
        $('#inputFeatColor4Mono').val('00a9a2');
        $('#inputFeatColor4Border').val('009b94');
        $('#inputFeatColor5').val('82e0bf');
        $('#inputFeatColor5Mono').val('6edbb5');
        $('#inputFeatColor5Border').val('68b398');
        $('#inputAllCatColor').val('1C3648');
        $('#inputAllCatColorMono').val('152836');
        $('#inputAllCatColorBorder').val('091219');
        $('#inputMobWhatsNewColor').val('120052');
        $('#inputMobWhatsNewColorMono').val('0c0039');
        $('#inputMobWhatsNewColorBorder').val('0e0041');
        $('#inputMobPopularColor').val('652ec7');
        $('#inputMobPopularColorMono').val('5a29b2');
        $('#inputMobPopularColorBorder').val('50249f');
        $('#inputGiftGuidesColor').val('00c2ba');
        $('#inputGiftGuidesColorMono').val('00a9a2');
        $('#inputGiftGuidesColorBorder').val('009b94');
        $('#inputMobSearchColor').val('82e0bf');
        $('#inputMobSearchColorMono').val('6edbb5');
        $('#inputMobSearchColorBorder').val('68b398');
    });
    $('#pirate').on("click", function()
    {
        $('#inputWhatsNewColor').val('FAFAFA');
        $('#inputWhatsNewColorMono').val('EDEDED');
        $('#inputWhatsNewColorBorder').val('C7C7C7');
        $('#inputWhatsNewColorText').val('333333');
        $('#inputFeatColor1').val('f42d2d');
        $('#inputFeatColor1Mono').val('f31515');
        $('#inputFeatColor1Border').val('c32424');
        $('#inputFeatColor2').val('14e141');
        $('#inputFeatColor2Mono').val('12ca3a');
        $('#inputFeatColor2Border').val('10b434');
        $('#inputFeatColor3').val('e2fd03');
        $('#inputFeatColor3Mono').val('cce502');
        $('#inputFeatColor3Border').val('b4ca02');
        $('#inputFeatColor4').val('bd1fc7');
        $('#inputFeatColor4Mono').val('a81cb1');
        $('#inputFeatColor4Border').val('97189f');
        $('#inputFeatColor5').val('18b8db');
        $('#inputFeatColor5Mono').val('15a5c4');
        $('#inputFeatColor5Border').val('1393af');
        $('#inputAllCatColor').val('1C3648');
        $('#inputAllCatColorMono').val('152836');
        $('#inputAllCatColorBorder').val('091219');
        $('#inputMobWhatsNewColor').val('f42d2d');
        $('#inputMobWhatsNewColorMono').val('f31515');
        $('#inputMobWhatsNewColorBorder').val('c32424');
        $('#inputMobPopularColor').val('14e141');
        $('#inputMobPopularColorMono').val('12ca3a');
        $('#inputMobPopularColorBorder').val('10b434');
        $('#inputGiftGuidesColor').val('e2fd03');
        $('#inputGiftGuidesColorMono').val('cce502');
        $('#inputGiftGuidesColorBorder').val('b4ca02');
        $('#inputMobSearchColor').val('bd1fc7');
        $('#inputMobSearchColorMono').val('a81cb1');
        $('#inputMobSearchColorBorder').val('97189f');
    });
    $('#denial').on("click", function()
    {
        $('#inputWhatsNewColor').val('FAFAFA');
        $('#inputWhatsNewColorMono').val('EDEDED');
        $('#inputWhatsNewColorBorder').val('C7C7C7');
        $('#inputWhatsNewColorText').val('333333');
        $('#inputFeatColor1').val('1f2369');
        $('#inputFeatColor1Mono').val('191c55');
        $('#inputFeatColor1Border').val('181c54');
        $('#inputFeatColor2').val('1e2a44');
        $('#inputFeatColor2Mono').val('161f32');
        $('#inputFeatColor2Border').val('182136');
        $('#inputFeatColor3').val('122140');
        $('#inputFeatColor3Mono').val('0c172c');
        $('#inputFeatColor3Border').val('0e1a33');
        $('#inputFeatColor4').val('160736');
        $('#inputFeatColor4Mono').val('0d041f');
        $('#inputFeatColor4Border').val('11052b');
        $('#inputFeatColor5').val('08020a');
        $('#inputFeatColor5Mono').val('000000');
        $('#inputFeatColor5Border').val('060108');
        $('#inputAllCatColor').val('0e1b24');
        $('#inputAllCatColorMono').val('070d12');
        $('#inputAllCatColorBorder').val('0b151c');
        $('#inputMobWhatsNewColor').val('1f2369');
        $('#inputMobWhatsNewColorMono').val('191c55');
        $('#inputMobWhatsNewColorBorder').val('181c54');
        $('#inputMobPopularColor').val('1e2a44');
        $('#inputMobPopularColorMono').val('161f32');
        $('#inputMobPopularColorBorder').val('182136');
        $('#inputGiftGuidesColor').val('122140');
        $('#inputGiftGuidesColorMono').val('0c172c');
        $('#inputGiftGuidesColorBorder').val('0e1a33');
        $('#inputMobSearchColor').val('160736');
        $('#inputMobSearchColorMono').val('0d041f');
        $('#inputMobSearchColorBorder').val('11052b');
    });
    $('#deep-rainbow').on("click", function()
    {
        $('#inputWhatsNewColor').val('FAFAFA');
        $('#inputWhatsNewColorMono').val('EDEDED');
        $('#inputWhatsNewColorBorder').val('C7C7C7');
        $('#inputWhatsNewColorText').val('333333');
        $('#inputFeatColor1').val('b50606');
        $('#inputFeatColor1Mono').val('9c0505');
        $('#inputFeatColor1Border').val('900404');
        $('#inputFeatColor2').val('fcd944');
        $('#inputFeatColor2Mono').val('fcd42b');
        $('#inputFeatColor2Border').val('c9ad36');
        $('#inputFeatColor3').val('0c6d63');
        $('#inputFeatColor3Mono').val('09564e');
        $('#inputFeatColor3Border').val('09574f');
        $('#inputFeatColor4').val('0b2a75');
        $('#inputFeatColor4Mono').val('09225e');
        $('#inputFeatColor4Border').val('08215d');
        $('#inputFeatColor5').val('572e8a');
        $('#inputFeatColor5Mono').val('4b2877');
        $('#inputFeatColor5Border').val('45246e');
        $('#inputAllCatColor').val('0e1b24');
        $('#inputAllCatColorMono').val('070d12');
        $('#inputAllCatColorBorder').val('0b151c');
        $('#inputMobWhatsNewColor').val('b50606');
        $('#inputMobWhatsNewColorMono').val('9c0505');
        $('#inputMobWhatsNewColorBorder').val('900404');
        $('#inputMobPopularColor').val('0c6d63');
        $('#inputMobPopularColorMono').val('09564e');
        $('#inputMobPopularColorBorder').val('09574f');
        $('#inputGiftGuidesColor').val('0b2a75');
        $('#inputGiftGuidesColorMono').val('09225e');
        $('#inputGiftGuidesColorBorder').val('08215d');
        $('#inputMobSearchColor').val('572e8a');
        $('#inputMobSearchColorMono').val('4b2877');
        $('#inputMobSearchColorBorder').val('45246e');
    });
    $('#rainbow').on("click", function()
    {
        $('#inputWhatsNewColor').val('9F009F');
        $('#inputWhatsNewColorMono').val('860086');
        $('#inputWhatsNewColorBorder').val('3f003f');
        $('#inputWhatsNewColorText').val('f9f9f9');
        $('#inputFeatColor1').val('4B0082');
        $('#inputFeatColor1Mono').val('3c0069');
        $('#inputFeatColor1Border').val('1e0034');
        $('#inputFeatColor2').val('0000C5');
        $('#inputFeatColor2Mono').val('0000ac');
        $('#inputFeatColor2Border').val('00004e');
        $('#inputFeatColor3').val('008000');
        $('#inputFeatColor3Mono').val('006700');
        $('#inputFeatColor3Border').val('003300');
        $('#inputFeatColor4').val('E3E300');
        $('#inputFeatColor4Mono').val('caca00');
        $('#inputFeatColor4Border').val('5a5a00');
        $('#inputFeatColor5').val('F49E00');
        $('#inputFeatColor5Mono').val('db8d00');
        $('#inputFeatColor5Border').val('613f00');
        $('#inputAllCatColor').val('F42400');
        $('#inputAllCatColorMono').val('db2000');
        $('#inputAllCatColorBorder').val('610e00');
        $('#inputMobWhatsNewColor').val('9F009F');
        $('#inputMobWhatsNewColorMono').val('860086');
        $('#inputMobWhatsNewColorBorder').val('3f003f');
        $('#inputMobPopularColor').val('0000C5');
        $('#inputMobPopularColorMono').val('0000ac');
        $('#inputMobPopularColorBorder').val('00004e');
        $('#inputGiftGuidesColor').val('008000');
        $('#inputGiftGuidesColorMono').val('006700');
        $('#inputGiftGuidesColorBorder').val('003300');
        $('#inputMobSearchColor').val('F42400');
        $('#inputMobSearchColorMono').val('db2000');
        $('#inputMobSearchColorBorder').val('610e00');
    });
    $("#resetMenuColors").on("click", function()
    {
        $('#output-reset').css('float', 'left');
        $('#output-reset').text('Done. Save the settings to see the changes.');
        $('#inputFeatColor1').val('E97103');
        $('#inputFeatColor1Mono').val('D06503');
        $('#inputFeatColor1Border').val('AE4E01');
        $('#inputFeatColor2').val('EB9E31');
        $('#inputFeatColor2Mono').val('E9931A');
        $('#inputFeatColor2Border').val('BF7514');
        $('#inputFeatColor3').val('19A2D5');
        $('#inputFeatColor3Mono').val('1691BE');
        $('#inputFeatColor3Border').val('0C6E95');
        $('#inputFeatColor4').val('197AB8');
        $('#inputFeatColor4Mono').val('166BA2');
        $('#inputFeatColor4Border').val('0A4B75');
        $('#inputFeatColor5').val('224459');
        $('#inputFeatColor5Mono').val('1B3647');
        $('#inputFeatColor5Border').val('10222C');
        $('#inputWhatsNewColor').val('FAFAFA');
        $('#inputWhatsNewColorMono').val('EDEDED');
        $('#inputWhatsNewColorBorder').val('C7C7C7');
        $('#inputWhatsNewColorText').val('333333');
        $('#inputAllCatColor').val('1C3648');
        $('#inputAllCatColorMono').val('152836');
        $('#inputAllCatColorBorder').val('091219');
        $('#inputMobWhatsNewColor').val('EB9E31');
        $('#inputMobWhatsNewColorMono').val('E9931A');
        $('#inputMobWhatsNewColorBorder').val('BF7514');
        $('#inputMobPopularColor').val('E97103');
        $('#inputMobPopularColorMono').val('D06503');
        $('#inputMobPopularColorBorder').val('AE4E01');
        $('#inputGiftGuidesColor').val('19A2D5');
        $('#inputGiftGuidesColorMono').val('1691BE');
        $('#inputGiftGuidesColorBorder').val('0C6E95');
        $('#inputMobSearchColor').val('197AB8');
        $('#inputMobSearchColorMono').val('166BA2');
        $('#inputMobSearchColorBorder').val('0A4B75');
    });
    $("#resetAllColors").on("click", function()
    {
        $('#output-reset').css('float', 'right');
        $('#output-reset').text('Done. Save the settings to see the changes.');
        $('#inputFeatColor1').val('E97103');
        $('#inputFeatColor1Mono').val('D06503');
        $('#inputFeatColor1Border').val('AE4E01');
        $('#inputFeatColor2').val('EB9E31');
        $('#inputFeatColor2Mono').val('E9931A');
        $('#inputFeatColor2Border').val('BF7514');
        $('#inputFeatColor3').val('19A2D5');
        $('#inputFeatColor3Mono').val('1691BE');
        $('#inputFeatColor3Border').val('0C6E95');
        $('#inputFeatColor4').val('197AB8');
        $('#inputFeatColor4Mono').val('166BA2');
        $('#inputFeatColor4Border').val('0A4B75');
        $('#inputFeatColor5').val('224459');
        $('#inputFeatColor5Mono').val('1B3647');
        $('#inputFeatColor5Border').val('10222C');
        $('#inputWhatsNewColor').val('FAFAFA');
        $('#inputWhatsNewColorMono').val('EDEDED');
        $('#inputWhatsNewColorBorder').val('C7C7C7');
        $('#inputWhatsNewColorText').val('333333');
        $('#inputAllCatColor').val('1C3648');
        $('#inputAllCatColorMono').val('152836');
        $('#inputAllCatColorBorder').val('091219');
        $('#inputMobWhatsNewColor').val('EB9E31');
        $('#inputMobWhatsNewColorMono').val('E9931A');
        $('#inputMobWhatsNewColorBorder').val('BF7514');
        $('#inputMobPopularColor').val('E97103');
        $('#inputMobPopularColorMono').val('D06503');
        $('#inputMobPopularColorBorder').val('AE4E01');
        $('#inputGiftGuidesColor').val('19A2D5');
        $('#inputGiftGuidesColorMono').val('1691BE');
        $('#inputGiftGuidesColorBorder').val('0C6E95');
        $('#inputMobSearchColor').val('197AB8');
        $('#inputMobSearchColorMono').val('166BA2');
        $('#inputMobSearchColorBorder').val('0A4B75');
        $('#inputCheckOutColor').val('FA9219');
        $('#inputSaveBtnColor').val('D90000');
        $('#inputRemoveBtnColor').val('FF243F');
        $('#inputSortBG').val('166ba2');
        $('#inputSortTXT').val('166ba2');
        $('#inputGiftsTXT').val('1691BE');
    });
});
</script>
<div class="col-xs-12"><div id="output"></div></div>
<section class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php 
            if($SiteSettings = $mysqli->query("SELECT * FROM settings WHERE id='1'")){
                $SettingsRow = mysqli_fetch_array($SiteSettings);
                $SiteSettings->close();
            }else{
                printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
            }
            if($ColorSettings = $mysqli->query("SELECT * FROM colors WHERE id='1'")){
                $ColorsRow = mysqli_fetch_array($ColorSettings);
                $ColorSettings->close();
            }else{
                printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
            }
            ?>
            <ul>
                <li class="has-sub"><a><span>General Settings</span></a>
                    <ul>
                        <form class="form-new" id="settingsForm" name="settingsForm" action="update_settings.php" enctype="multipart/form-data" method="post">
                        <li>
                            <div class="form-group">
                                <label for="inputTitle">Website Title</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon fa  fa-info"></span></span>
                                    <input type="text" id="inputTitle" name="inputTitle" class="form-control" placeholder="Enter your site title here" value="<?php echo $SettingsRow['name']?>">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="inputfile">Website Logo (650px x 108px)</label>
                                <input type="file" id="inputfile" name="inputfile" class="filestyle" data-iconName="glyphicon-picture" data-buttonText="Select Logo">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="inputfavicon">Website Favicon (only .ico file is accepted) [<a style="display: inline-block;color:gold;" href="http://tools.dynamicdrive.com/favicon/" target="_blank">Generate Favicons Here</a>]</label>
                                <input type="file" id="inputfavicon" name="inputfavicon" class="filestyle" data-iconName="glyphicon-picture" data-buttonText="Select Favicon">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                            <label for="inputSiteurl">Website URL (Without "http://" and end "/")</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon fa  fa-info"></span></span>
                                    <input type="text" id="inputSiteurl" name="inputSiteurl" class="form-control" placeholder="Eg- yourdomain.com or www.yourdomain.com" value="<?php if(empty($SettingsRow['siteurl'])){ echo $websiteurl; } else{ echo $SettingsRow['siteurl']; } ?>">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="inputDescription">Meta Description</label>
                                <textarea class="form-control" id="inputDescription" name="inputDescription" rows="3" placeholder="Enter a meta description for your website"><?php echo $SettingsRow['descrp']?></textarea>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="inputKeywords">Meta Keywords</label>
                                <textarea class="form-control" id="inputKeywords" name="inputKeywords" rows="3" placeholder="Enter a meta keywords for your website"><?php echo $SettingsRow['keywords']?></textarea>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="inputEmail">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="Enter your website email address" value="<?php echo $SettingsRow['email']?>">
                                    </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="has-sub"><a><span>Text Content Settings</span></a>
                    <ul>
                        <div class="row">
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputHome">Home Menu Text (Desktop & Mobile)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputHome" name="inputHome" class="form-control" placeholder="Ex: What's New" value="<?php echo $SettingsRow['txt_home']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputCategories">Categories Menu Text</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputCategories" name="inputCategories" class="form-control" placeholder="All Categories text.." value="<?php echo $SettingsRow['txt_all_cat']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputPopular">Popular Menu Text (Mobile)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputPopular" name="inputPopular" class="form-control" placeholder="Popular text on mobiles.." value="<?php echo $SettingsRow['txt_popular']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputGiftGuides">Gift Guides Text (Mobile)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputGiftGuides" name="inputGiftGuides" class="form-control" placeholder="Gift Guides text on mobiles.." value="<?php echo $SettingsRow['txt_gift_guides']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputNewest">Newest Sort Text (Homepage)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputNewest" name="inputNewest" class="form-control" placeholder="Newest text on homepage.." value="<?php echo $SettingsRow['txt_newest']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputPopularIndex">Popular Sort Text (Homepage)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputPopularIndex" name="inputPopularIndex" class="form-control" placeholder="Popular text on homepage.." value="<?php echo $SettingsRow['txt_popular_index']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputHigh">High Sort Text (Homepage)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputHigh" name="inputHigh" class="form-control" placeholder="Gift High text on homepage.." value="<?php echo $SettingsRow['txt_high']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputLow">Low Sort Text (Homepage)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputLow" name="inputLow" class="form-control" placeholder="Gift Low text on homepage.." value="<?php echo $SettingsRow['txt_low']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputBuy">Buy Button Text</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputBuy" name="inputBuy" class="form-control" placeholder="Buy Button Text. Ex: Check it out, Buy it now" value="<?php echo $SettingsRow['buy_button']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputPriceSymbol">Price Symbol (Default is '$')</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-usd"></span></span>
                                            <input type="text" id="inputPriceSymbol" name="inputPriceSymbol" class="form-control" placeholder="Symbol before price. For ex, $, € etc." value="<?php echo $SettingsRow['price_symbol']?>">
                                        </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputSave">Save Button Text</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputSave" name="inputSave" class="form-control" placeholder="Eg- SAVE, FAVORITE etc." value="<?php echo $SettingsRow['txt_save']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputRemove">Remove Button Text</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputRemove" name="inputRemove" class="form-control" placeholder="Eg- REMOVE, DELETE etc." value="<?php echo $SettingsRow['txt_remove']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputGiftsUnder">Gifts Under $20 Text</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputGiftsUnder" name="inputGiftsUnder" class="form-control" placeholder="Eg- Gifts Under, Gifts Below etc." value="<?php echo $SettingsRow['txt_gifts_under']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputGiftsUnderLimit">Gifts Under Limit</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputGiftsUnderLimit" name="inputGiftsUnderLimit" class="form-control" placeholder="Enter the price limit.." value="<?php echo $SettingsRow['gifts_under_limit']?>">
                                    </div>
                                </div>
                            </li>
                        </div> <!-- row -->
                            <li>
                                <div class="form-group">
                                    <label for="inputRelatedTxt">Related Products Text</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputRelatedTxt" name="inputRelatedTxt" class="form-control" placeholder="Eg- More products you may like.." value="<?php echo $SettingsRow['txt_related']?>">
                                        </div>
                                </div>
                            </li>
                    </ul>
                </li>
                <li class="has-sub"><a><span>Color Settings</span></a>
                    <ul>
                        <li class="has-sub"><a><span>Menu Color Palettes</span></a>
                            <ul>
                                <li>
                                    <table class="palette">
                                        <tr>
                                            <td><input id="neon" type="radio" name="color-palette" value="One"></td><td style="background: linear-gradient(to bottom,#FAFAFA 0,#EDEDED 100%);color: #333;">Home</td><td style="background: linear-gradient(to bottom,#ff1493 0,#fa0087 100%);">Menu 1</td><td style="background: linear-gradient(to bottom,#120052 0,#0c0039 100%);">Menu 2</td><td style="background: linear-gradient(to bottom,#652ec7 0,#5a29b2 100%);">Menu 3</td><td style="background: linear-gradient(to bottom,#00c2ba 0,#00a9a2 100%);">Menu 4</td><td style="background: linear-gradient(to bottom,#82e0bf 0,#6edbb5 100%);">Menu 5</td><td style="background: linear-gradient(to bottom,#1C3648 0,#152836 100%);">All Cat's</td>
                                        </tr>
                                        <tr>
                                            <td><input id="pirate" type="radio" name="color-palette" value="One"></td><td style="background: linear-gradient(to bottom,#FAFAFA 0,#EDEDED 100%);color: #333;">Home</td><td style="background: linear-gradient(to bottom,#f42d2d 0,#f31515 100%);">Menu 1</td><td style="background: linear-gradient(to bottom,#14e141 0,#12ca3a 100%);">Menu 2</td><td style="background: linear-gradient(to bottom,#e2fd03 0,#cce502 100%);">Menu 3</td><td style="background: linear-gradient(to bottom,#bd1fc7 0,#a81cb1 100%);">Menu 4</td><td style="background: linear-gradient(to bottom,#18b8db 0,#15a5c4 100%);">Menu 5</td><td style="background: linear-gradient(to bottom,#1C3648 0,#152836 100%);">All Cat's</td>
                                        </tr>
                                        <tr>
                                            <td><input id="denial" type="radio" name="color-palette" value="One"></td><td style="background: linear-gradient(to bottom,#FAFAFA 0,#EDEDED 100%);color: #333;">Home</td><td style="background: linear-gradient(to bottom,#1f2369 0,#191c55 100%);">Menu 1</td><td style="background: linear-gradient(to bottom,#1e2a44 0,#161f32 100%);">Menu 2</td><td style="background: linear-gradient(to bottom,#122140 0,#0c172c 100%);">Menu 3</td><td style="background: linear-gradient(to bottom,#160736 0,#0d041f 100%);">Menu 4</td><td style="background: linear-gradient(to bottom,#08020a 0,#000000 100%);">Menu 5</td><td style="background: linear-gradient(to bottom,#0e1b24 0,#070d12 100%);">All Cat's</td>
                                        </tr>
                                        <tr>
                                            <td><input id="deep-rainbow" type="radio" name="color-palette" value="One"></td><td style="background: linear-gradient(to bottom,#FAFAFA 0,#EDEDED 100%);color: #333;">Home</td><td style="background: linear-gradient(to bottom,#b50606 0,#9c0505 100%);">Menu 1</td><td style="background: linear-gradient(to bottom,#fcd944 0,#fcd42b 100%);">Menu 2</td><td style="background: linear-gradient(to bottom,#0c6d63 0,#09564e 100%);">Menu 3</td><td style="background: linear-gradient(to bottom,#0b2a75 0,#09225e 100%);">Menu 4</td><td style="background: linear-gradient(to bottom,#572e8a 0,#4b2877 100%);">Menu 5</td><td style="background: linear-gradient(to bottom,#1C3648 0,#152836 100%);">All Cat's</td>
                                        </tr>
                                        <tr>
                                            <td><input id="rainbow" type="radio" name="color-palette" value="One"></td><td style="background: linear-gradient(to bottom,#9F009F 0,#860086 100%);color: #fff;">Home</td><td style="background: linear-gradient(to bottom,#4B0082 0,#3c0069 100%);">Menu 1</td><td style="background: linear-gradient(to bottom,#0000C5 0,#0000ac 100%);">Menu 2</td><td style="background: linear-gradient(to bottom,#008000 0,#006700 100%);">Menu 3</td><td style="background: linear-gradient(to bottom,#E3E300 0,#caca00 100%);">Menu 4</td><td style="background: linear-gradient(to bottom,#F49E00 0,#db8d00 100%);">Menu 5</td><td style="background: linear-gradient(to bottom,#F42400 0,#db2000 100%);">All Cat's</td>
                                        </tr>
                                    </table>
                                </li>
                            </ul>   
                        </li>
                        <li class="has-sub"><a><span>Choose Colors Manually</span></a>
                            <ul>
                                <span>Tip - <a style="display: inline-block;color:gold;" href="https://www.youtube.com/watch?v=3gOsZLtCMl0&feature=youtu.be" target="_blank"><u>How to choose monochromatic colors (video)</u></a></span>
                                <div class="row">
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor1">Menu 1 Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor1" name="inputFeatColor1" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_1']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor1Mono">Menu 1 Monochromatic Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor1Mono" name="inputFeatColor1Mono" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_1_mono']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor1Border">Menu 1 Hover Border Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor1Border" name="inputFeatColor1Border" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_1_border']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor2">Menu 2 Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor2" name="inputFeatColor2" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_2']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor2Mono">Menu 2 Monochromatic Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor2Mono" name="inputFeatColor2Mono" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_2_mono']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor2Border">Menu 2 Hover Border Color</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                                <input type="text" id="inputFeatColor2Border" name="inputFeatColor2Border" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_2_border']?>">
                                            </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor3">Menu 3 Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor3" name="inputFeatColor3" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_3']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor3Mono">Menu 3 Monochromatic Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor3Mono" name="inputFeatColor3Mono" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_3_mono']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor3Border">Menu 3 Hover Border Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor3Border" name="inputFeatColor3Border" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_3_border']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor4">Menu 4 Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor4" name="inputFeatColor4" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_4']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor4Mono">Menu 4 Monochromatic Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor4Mono" name="inputFeatColor4Mono" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_4_mono']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor4Border">Menu 4 Hover Border Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor4Border" name="inputFeatColor4Border" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_4_border']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor5">Menu 5 Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor5" name="inputFeatColor5" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_5']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor5Mono">Menu 5 Monochromatic Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor5Mono" name="inputFeatColor5Mono" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_5_mono']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputFeatColor5Border">Menu 5 Hover Border Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputFeatColor5Border" name="inputFeatColor5Border" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['feat_col_5_border']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-3">
                                        <label for="inputWhatsNewColor">What's New Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputWhatsNewColor" name="inputWhatsNewColor" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['whats_new_col']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-3">
                                        <label for="inputWhatsNewColorMono">What's New Mono.</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputWhatsNewColorMono" name="inputWhatsNewColorMono" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['whats_new_col_mono']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-3">
                                        <label for="inputWhatsNewColorBorder">What's New Border</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputWhatsNewColorBorder" name="inputWhatsNewColorBorder" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['whats_new_col_border']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-3">
                                        <label for="inputWhatsNewColorText">What's New Text</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputWhatsNewColorText" name="inputWhatsNewColorText" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['whats_new_col_text']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputAllCatColor">All Categories Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputAllCatColor" name="inputAllCatColor" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['all_cat_col']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputAllCatColorMono">All Categories Mono. Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputAllCatColorMono" name="inputAllCatColorMono" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['all_cat_col_mono']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputAllCatColorBorder">All Categories Border Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputAllCatColorBorder" name="inputAllCatColorBorder" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['all_cat_col_border']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputMobWhatsNewColor">Mobile Home Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputMobWhatsNewColor" name="inputMobWhatsNewColor" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_whats_new_color']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputMobWhatsNewColorMono">Mobile Home Mono. Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputMobWhatsNewColorMono" name="inputMobWhatsNewColorMono" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_whats_new_color_mono']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputMobWhatsNewColorBorder">Mobile Home Border Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputMobWhatsNewColorBorder" name="inputMobWhatsNewColorBorder" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_whats_new_color_border']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputMobPopularColor">Mobile Popular Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputMobPopularColor" name="inputMobPopularColor" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_popular_color']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputMobPopularColorMono">Mobile Popular Mono. Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputMobPopularColorMono" name="inputMobPopularColorMono" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_popular_color_mono']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputMobPopularColorBorder">Mobile Popular Color Border</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputMobPopularColorBorder" name="inputMobPopularColorBorder" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_popular_color_border']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputGiftGuidesColor">Mobile Gift Guides Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputGiftGuidesColor" name="inputGiftGuidesColor" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_gift_guides_color']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputGiftGuidesColorMono">Mobile Gift Guides Mono. Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputGiftGuidesColorMono" name="inputGiftGuidesColorMono" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_gift_guides_color_mono']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputGiftGuidesColorBorder">Mobile Gift Guides Border</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputGiftGuidesColorBorder" name="inputGiftGuidesColorBorder" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_gift_guides_color_border']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputMobSearchColor">Mobile Search Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputMobSearchColor" name="inputMobSearchColor" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_search_color']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputMobSearchColorMono">Mobile Search Mono Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputMobSearchColorMono" name="inputMobSearchColorMono" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_search_color_mono']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputMobSearchColorBorder">Mobile Search Border Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputMobSearchColorBorder" name="inputMobSearchColorBorder" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['mob_search_color_border']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputCheckOutColor">Check Out Button Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputCheckOutColor" name="inputCheckOutColor" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['btn_check_out']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputSaveBtnColor">Save Button Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputSaveBtnColor" name="inputSaveBtnColor" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['btn_save']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputRemoveBtnColor">Remove Button Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputRemoveBtnColor" name="inputRemoveBtnColor" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['btn_remove']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputSortBG">Sort Active BG (Home)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputSortBG" name="inputSortBG" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['sort_bg_col']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputSortTXT">Sort Inactive Text (Home)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputSortTXT" name="inputSortTXT" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['sort_txt_col']?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-4">
                                        <label for="inputGiftsTXT">Gifts Under Text (Home)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                            <input type="text" id="inputGiftsTXT" name="inputGiftsTXT" class="form-control jscolor" placeholder="Select the color.." value="<?php echo $ColorsRow['gifts_col']?>">
                                        </div>
                                    </div>
                                </li>
                            </div><!-- row -->
                                <div class="btn-reset"><a id="resetMenuColors" class="btn btn-danger btnDelete" style="margin-top: 35px; float:left;">Reset Menu Colors to Default</a> <a id="resetAllColors" class="btn btn-danger btnDelete" style="margin-top: 35px;float: right;">Reset All Colors to Default</a>
                                </div>
                                <div style="clear: both;" id="output-reset"></div>    
                            </ul>
                        </li>
                    </ul>
                </li>
                        
                <li class="has-sub"><a><span>Social Media Settings</span></a>
                    <ul>
                        <div class="row">
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputFbapp">Facebook App ID</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-facebook-square"></span></span>
                                        <input type="text" id="inputFbapp" name="inputFbapp" class="form-control" placeholder="Enter your facebook app id" value="<?php echo $SettingsRow['fbapp']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputFbpage">Facebook Page URL</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-facebook"></span></span>
                                        <input type="text" id="inputFbpage" name="inputFbpage" class="form-control" placeholder="Facebook page url" value="<?php echo $SettingsRow['fbpage']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputTwitter">Twitter URL</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-twitter"></span></span>
                                        <input type="text" id="inputTwitter" name="inputTwitter" class="form-control" placeholder="Twitter url" value="<?php echo $SettingsRow['twitter']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputPinterest">Pinterest URL</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pinterest"></span></span>
                                        <input type="text" id="inputPinterest" name="inputPinterest" class="form-control" placeholder="Pinterest URL" value="<?php echo $SettingsRow['pinterest']?>">
                                     </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputGplus">Google+ URL</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-google-plus"></span></span>
                                        <input type="text" id="inputGplus" name="inputGplus" class="form-control" placeholder="Google+ URL" value="<?php echo $SettingsRow['google_plus']?>">
                                    </div>
                                </div>
                            </li>
                        </div><!-- row -->
                    </ul>
                </li>
                <li class="has-sub"><a><span>Mailgun Settings</span></a>
                    <ul>
                        <span style="display: inline-block;">NOTE : Email box won't show if any of the required fields for Mailgun is empty.</span>
                        <div class="row">
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputMailgunPrivateKey">Mailgun Private Key</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputMailgunPrivateKey" name="inputMailgunPrivateKey" class="form-control" placeholder="" value="<?php echo $SettingsRow['MailgunPrivateKey']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputMailgunPublicKey">Mailgun Public Key</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputMailgunPublicKey" name="inputMailgunPublicKey" class="form-control" placeholder="" value="<?php echo $SettingsRow['MailgunPublicKey']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputMailgunDomain">Mailgun Domain</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputMailgunDomain" name="inputMailgunDomain" class="form-control" placeholder="" value="<?php echo $SettingsRow['MailgunDomain']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputMailgunList">Mailgun List Alias (Note- List name and Alias name are different)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputMailgunList" name="inputMailgunList" class="form-control" placeholder="" value="<?php echo $SettingsRow['MailgunList']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputMailgunSecret">Secret Key For Mailgun (no spaces, Eg- mYLst#@)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputMailgunSecret" name="inputMailgunSecret" class="form-control" placeholder="" value="<?php echo $SettingsRow['MailgunSecret']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputSubBoxTitle">Newsletter Box Title on  Mobile</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputSubBoxTitle" name="inputSubBoxTitle" class="form-control" placeholder="" value="<?php echo $SettingsRow['mobSubBoxTitle']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <label for="inputSubBoxBtnText">Newsletter Button Text on Mobile</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-font"></span></span>
                                        <input type="text" id="inputSubBoxBtnText" name="inputSubBoxBtnText" class="form-control" placeholder="" value="<?php echo $SettingsRow['mobSubBoxBtnText']?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="inputSubBoxDesc">Newsletter Description on Mobile</label>
                                        <textarea class="form-control" id="inputSubBoxDesc" name="inputSubBoxDesc" rows="3" placeholder="Enter a small description for the newsletter box.."><?php echo $SettingsRow['mobSubBoxDesc']?></textarea>
                                    </div>
                                </div>
                            </li>
                        </div><!-- row -->
                    </ul>
                </li>
                <li class="has-sub"><a><span>Other Settings</span></a>
                    <ul>
                        <li>
                            <div class="col-xs-12">          
                                <div class="form-group">
                                    <label for="inputAnalytics">Analytics Tracking Code</label>
                                    <textarea class="form-control" id="inputAnalytics" name="inputAnalytics" rows="5" placeholder="Enter analytics code here.."><?php echo $SettingsRow['analytics']?></textarea>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="col-xs-12">          
                                <div class="form-group">
                                    <label for="inputAddthis">AddThis Share Buttons Code</label>
                                        <textarea class="form-control" id="inputAddthis" name="inputAddthis" rows="2" placeholder="Enter AddThis code here.."><?php echo $SettingsRow['addthis']?></textarea> 
                                        <input id="disabled" value="0" type="radio" name="addthisFilter"> 
                                            <label class="addthis-radio">Disabled</label>  
                                        <input id="all" value="1" type="radio" name="addthisFilter"> 
                                            <label class="addthis-radio">All Pages</label> 
                                        <input id="products" value="2" type="radio" name="addthisFilter"> 
                                            <label class="addthis-radio">Product Pages & Blog</label> 
                                        <input id="all-no-products" value="3" type="radio" name="addthisFilter"> 
                                            <label class="addthis-radio">All Pages Except Product Pages</label>   
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- panel-body -->
        <div class="panel-footer clearfix">
            <button type="submit" id="submitButton" name="submitButton" class="btn btn-success btn-lg pull-right">Update Settings</button>
            </form>
        </div><!--panel-footer clearfix-->
    </div><!-- panel -->
</section>
</section>
<?php include("footer.php");?>

<script type="text/javascript">
    var value = "<?php echo $SettingsRow['addthisFilter']; ?>";
    switch(value)
    {
        case '0' :
        $('#disabled').get(0).checked = true;
        break;

        case '1' :
        $('#all').get(0).checked = true;
        break;

        case '2' :
        $('#products').get(0).checked = true;
        break;

        case '3' :
        $('#all-no-products').get(0).checked = true;
        break;

        default :
        $('#products').get(0).checked = true;
        break;
    }
</script>