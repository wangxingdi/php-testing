<?php include("header.php");?>

<section class="col-md-2">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li><i class="fa fa-home"></i></li>
  <li>Categories</li>
  <li class="active">Add New Category</li>
  <span class="theme-label">Amazon Dominator v<?php echo $Settings['version'];?></span>
</ol>

<div class="page-header">
  <h3>New Category <small>Add new category</small></h3>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

<script>
$(document).ready(function()
{
    $('#categoryForm').on('submit', function(e)
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

<div id="output"></div>

<form id="categoryForm" action="submit_category.php" method="post">

<div class="form-group">
        <label for="inputTitle">Category</label>
    <div class="input-group">
         <span class="input-group-addon"><span class="glyphicon fa  fa-info"></span></span>
      <input type="text" id="inputTitle" name="inputTitle" class="form-control" placeholder="Enter your new category" >
    </div>
</div>

<div class="form-group">
        <label for="inputParent">Parent Category (OPTIONAL)</label>
    <div class="input-group">
         <span class="input-group-addon"><span class="glyphicon fa  fa-info"></span></span>
      <select id="inputParent" name="inputParent" class="form-control">
        <option value="0">Select a parent category</option>

<?php

if($cat_sql = $mysqli->query("SELECT * FROM categories WHERE is_sub_cat=0"))
{
  while($cat_row = mysqli_fetch_array($cat_sql))
  {
    $cat_id = $cat_row['id'];
    $cat_name = $cat_row['cname'];

  ?>
   
    <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>

 <?php 
  } ?>
   </select>
  </div>
</div>

<?php 
}
else
{
  printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again.</div>");
}

?>

<div class="form-group">
<label for="inputDescription">Category Description</label>
<textarea class="form-control" id="inputDescription" name="inputDescription" rows="3" placeholder="Enter description for your new category"></textarea>
</div>

<div class="form-group">
        <label for="inputIcon">Font Awesome Icon HTML (Use <a href="https://fontawesome.com" target="_blank">FontAwesome.com</a> only. Icons from other sources may not work.)</label>
    <div class="input-group">
         <span class="input-group-addon"><span class="glyphicon fa  fa-info"></span></span>
      <input type="text" id="inputIcon" name="inputIcon" class="form-control" placeholder="For example - <i class='fas fa-cogs'></i>">
    </div>
</div>


</div><!-- panel body -->

<div class="panel-footer clearfix">

<button type="submit" id="submitButton" class="btn btn-default btn-success btn-lg pull-right">Submit</button>

</div><!--panel-footer clearfix-->

</form>


</div><!--panel panel-default-->  

</section>

</section><!--col-md-10-->

<?php include("footer.php");?>