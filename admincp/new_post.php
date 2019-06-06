<?php include("header.php");?>

<section class="col-md-2">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li><i class="fa fa-home"></i></li>
  <li class="active">Add New Post</li>
  <span class="theme-label">MarketPress v<?php echo $Settings['version'];?></span>
</ol>

<div class="page-header">
  <h3>Add New Post <small>Add new article</small></h3>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/1.2.1/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<link href="//oss.maxcdn.com/summernote/0.5.1/summernote.css" rel="stylesheet">
<script src="//oss.maxcdn.com/summernote/0.5.1/summernote.min.js"></script>
<script type='text/javascript'>//<![CDATA[ 
$(function(){
$('#desc').summernote({height: 500});
});//]]>  

</script>
<script>

$(function(){

$(":file").filestyle({iconName: "glyphicon-picture", buttonText: "Select Photo"});

});

$(document).ready(function()
{
    $('#AddPost').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitButton').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output").html('<div class="alert alert-info" role="alert">Updating... Please wait...</span></div>');
        $(this).ajaxSubmit({
        target: '#output',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    $('#submitButton').removeAttr('disabled'); //enable submit button
    //$('#output').html('');
}
</script>

<section class="col-md-8">

<div class="panel panel-default">

<div class="panel-body">   

<div id="output"></div>

<form action="submit_post.php" id="AddPost" enctype="multipart/form-data" method="post">

<div class="form-group">
<label for="mName">Title</label>
<input type="text" name="mName" id="mName" class="form-control" placeholder="Add a catchy & SEO friendly title">
</div>
  
<div class="form-group">
<label for="desc">Description</label>
<textarea name="desc" id="desc" cols=40 rows=15 class="form-control" placeholder=""></textarea>
</div>

<div class="form-group">
<label for="file">Featured Image</label>
<input type='file' class="file" name="mFile" id="mFile"/>
</div>

<div class="form-group">
<label for="meta_desc">Meta Description</label>
<textarea name="meta_desc" id="meta_desc" cols=40 rows=3 class="form-control" placeholder="Add an SEO friendly meta description here.."></textarea>
</div>

</div><!-- panel body -->

<div class="panel-footer clearfix">

<button type="submit" id="submitButton" class="btn btn-default btn-success btn-lg pull-right">Add Post</button>

</div><!--panel-footer clearfix-->

</form>


</div><!--panel panel-default-->  

</section>

</section><!--col-md-10-->

<?php include("footer.php");?>

