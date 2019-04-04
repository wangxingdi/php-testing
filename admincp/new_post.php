<?php include("header.php");?>

<section class="col-md-2">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li>Admin CP</li>
  <li class="active">Add New Post</li>
</ol>

<div class="page-header">
  <h3>Add New Post <small>Add a new article</small></h3>
</div>

<script src="js/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<script>

$(function(){

$(":file").filestyle({iconName: "glyphicon-picture", buttonText: "Select Photo"});

});

$(document).ready(function()
{
    $('#AddProduct').on('submit', function(e)
    {
        tinyMCE.triggerSave();
        e.preventDefault();
        $('#submit').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output").html('<div class="alert alert-info" role="alert">Updating... Please wait...</span></div>');
        $(this).ajaxSubmit({
        target: '#output',
        success:  afterSuccess //call function after success
        });
    });
});

$(document).ready(function()
{
    $('#UploadImage').on('submit', function(e)
    {
        e.preventDefault();
        $("#url").hide();
        //show uploading message
        $("#output").html('<div class="alert alert-info" role="alert">Uploading image.. Please wait..</span></div>');
        $(this).ajaxSubmit({
        target: '#output',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    $('#submit').removeAttr('disabled'); //enable submit button
    //$('#output').html('');
}

</script>

<section class="col-md-8">

<div class="panel panel-default">

<div class="panel-body">   

<div id="output"></div>

<form action="upload_image.php" id="UploadImage" enctype="multipart/form-data" method="post">

<div class="form-group">
<input type="text" name="url" id="url" class="form-control" value="" placeholder="Upload image to get the URL here">
</div>

<div class="form-group">
<label for="file2">Upload Image & Get URL</label>
<input type='file' class="file" name="mFile2" id="mFile2"/>
</div>

<input style="margin-bottom: 8px;" type="submit" id="imageSubmitButton" name="UploadPostImage" class="btn btn-default btn-primary pull-right" value="Upload">

</form>

<form action="submit_post.php" id="AddProduct" enctype="multipart/form-data" method="post">

<div class="form-group">
<label for="mName">Title</label>
<input type="text" name="mName" id="mName" class="form-control" placeholder="Add a catchy title">
</div>

  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
       tinymce.init({
            selector: "#disc",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
</script>
  
  <div class="form-group">
<label for="disc">Description</label>
<textarea name="disc" id="disc" cols=40 rows=15 class="form-control" placeholder="Type the description.."></textarea>
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

<script type="text/javascript">
  function copy() {
  /* Get the text field */
  var copyText = document.getElementById("imageUrl");

  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  $('#copy-output').show();
}
</script>

