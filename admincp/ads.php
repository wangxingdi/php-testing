<?php include("header.php");?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-filestyle@1.2.1/src/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-form@4.2.2/dist/jquery.form.min.js"></script>

<section class="col-md-2">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li><i class="fa fa-home"></i></li>
  <li class="active">Advertisements</li>
  <span class="theme-label">MarketPress v<?php echo $Settings['version'];?></span>
</ol>

<div class="page-header">
  <h3>Advertisements <small>Update website advertisements</small></h3>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-form@4.2.2/dist/jquery.form.min.js"></script>

<script>

$(function(){

$(":file").filestyle({iconName: "glyphicon-picture", buttonText: "Select Featured Image"});

});

$(document).ready(function()
{
    $('#adsForm').on('submit', function(e)
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
    $('#UploadImage').on('submit', function(e)
    {
        e.preventDefault();
        //show uploading message
        $("#output").html('<div class="alert alert-info" role="alert">Uploading image and generating code..</span></div>');
        $(this).ajaxSubmit({
        target: '#output'
        });
    });
});

</script>

<section class="col-md-8">

<div class="panel panel-default">

    <div class="panel-body">

<?php 

if($Ads = $mysqli->query("SELECT * FROM mp_siteads")){

    $AdRow = mysqli_fetch_array($Ads);
    
    $Ads->close();
    
}else{
    
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");;
}


?>

<div id="output"></div>

<form action="upload_featured_image.php" id="UploadImage" enctype="multipart/form-data" method="post">

<div class="form-group">
    <label for="inputFeatImage">Upload Featured Image For Homepage</label>
        <input type="file" id="inputFeatImage" name="inputFeatImage" class="filestyle" data-iconName="glyphicon-picture" data-buttonText="Select Featured Image">
</div>

<div class="form-group">
    <label for="inputLink">Featured Image Target Link</label>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon fa  fa-info"></span></span>
                <input type="text" id="inputLink" name="inputLink" class="form-control" placeholder="Enter the target link" value="">
        </div>
</div>

<button style="margin-bottom: 10px;" type="submit" id="uploadBtn" name="UploadFeatImage" class="btn btn-default btn-primary">Update Featured Image</button>

</form>

<form id="adsForm" action="update_ads.php" method="post">

<div class="form-group">
<label for="inputAd4">Generated Code For Featured Image (You can also paste your own code)</label>
<textarea class="form-control" id="inputAd4" name="inputAd4" rows="3" placeholder="Image on top of the content"><?php echo $AdRow['ads_ad4']?></textarea>
</div>

<div class="form-group">
<label for="inputAd1">HTML/JavaScript Based Advertisements</label>
<textarea class="form-control" id="inputAd1" name="inputAd1" rows="3" placeholder="Rectangle responsive advertisement code"><?php echo $AdRow['ads_ad1']?></textarea>
</div>

<div class="form-group">
<label for="inputAd2">HTML/JavaScript Based Advertisements</label>
<textarea class="form-control" id="inputAd2" name="inputAd2" rows="3" placeholder="Leaderboard responsive advertisement code"><?php echo $AdRow['ads_ad2']?></textarea>
</div>

<div class="form-group">
<label for="inputAd3">HTML/JavaScript Based Advertisements</label>
<textarea class="form-control" id="inputAd3" name="inputAd3" rows="3" placeholder="Leaderboard mobile or responsive advertisement code (display on mobile devices only)"><?php echo $AdRow['ads_ad3']?></textarea>
</div>

</div><!-- panel body -->

<div class="panel-footer clearfix">

<button type="submit" id="submitButton" class="btn btn-default btn-success btn-lg pull-right">Update Advertisements</button>

</div><!--panel-footer clearfix-->

</form>

</div><!--panel panel-default--> 

</section>

</section><!--col-md-10-->

<?php include("footer.php");?>