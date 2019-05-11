<?php include("header.php");?>

<section class="col-md-2">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li><i class="fa fa-home"></i></li>
  <li>Manage Pages</li>
  <li class="active">Terms of Use</li>
  <span class="theme-label">MarketPress v<?php echo $Settings['version'];?></span>
</ol>

<div class="page-header">
  <h3>Terms of Use <small>Update terms of use page here</small></h3>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-form@4.2.2/dist/jquery.form.min.js"></script>
<link href="//oss.maxcdn.com/summernote/0.5.1/summernote.css" rel="stylesheet">
<script src="//oss.maxcdn.com/summernote/0.5.1/summernote.min.js"></script>

<script type='text/javascript'>//<![CDATA[ 
$(function(){
$('#inputPage').summernote({height: 500});
});//]]>  

</script>

<script>
$(document).ready(function()
{
    $('#updatePages').on('submit', function(e)
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
</script>

<section class="col-md-8">

<div class="panel panel-default">

    <div class="panel-body">

<?php 

if($Pages = $mysqli->query("SELECT * FROM pages WHERE id='3'")){

    $PageRow = mysqli_fetch_array($Pages);
	
    $Pages->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}


?>

<div id="output"></div>

<form id="updatePages" action="update_tnc_page.php" method="post">


<div class="form-group">
<textarea name="inputPage" id="inputPage" cols="30" rows="10"><?php echo $PageRow['page'];?></textarea>
</div>

</div><!-- panel body -->

<div class="panel-footer clearfix">

<button type="submit" id="submitButton" class="btn btn-default btn-success btn-lg pull-right">Update Page</button>

</div><!--panel-footer clearfix-->

</form>

</div><!--panel panel-default--> 

</section>

</section><!--col-md-10-->

<?php include("footer.php");?>