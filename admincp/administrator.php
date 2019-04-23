<?php include("header.php");?>

<section class="col-md-2">

<?php include("left_menu.php");?>
                    
</section><!--col-md-2-->

<section class="col-md-10">

<ol class="breadcrumb">
  <li><i class="fa fa-home"></i></li>
  <li class="active">Administrator</li>
  <span class="theme-label">Amazon Dominator v<?php echo $Settings['version'];?></span>
</ol>

<div class="page-header">
  <h3>Administrator <small>Manage your administrator credentials</small></h3>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-filestyle@1.2.1/src/bootstrap-filestyle.min.js"></script>
<script>
$(function(){
$(":file").filestyle({iconName: "glyphicon-picture", buttonText: "Select Photo"});
});
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-form@4.2.2/dist/jquery.form.min.js"></script>

<script>
$(document).ready(function()
{
    $('#credentialsForm').on('submit', function(e)
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

if($GetAdmin = $mysqli->query("SELECT * FROM admin WHERE id='1'")){

    $AdminRow = mysqli_fetch_array($GetAdmin);
	
    $GetAdmin->close();
	
}else{
    
	 printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");
}


?>

<div id="output"></div>

<form id="credentialsForm" action="update_credentials.php" method="post">

<div class="form-group">
        <label for="inputUsername">Username</label>
    <div class="input-group">
         <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
      <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Enter administrator username" value="<?php echo $AdminRow['adminuser']?>">
    </div>
</div>

<div class="form-group">
            <label for="inputCurrentPassword">Current Password</label>
                <div class="input-group">
                   <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
<input type="password" class="form-control" name="inputCurrentPassword" id="inputCurrentPassword" placeholder="Enter Your Current Password">
</div>
</div>

<div class="form-group">
            <label for="inputPassword">New Password</label>
                <div class="input-group">
                   <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
<input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Enter New Password">
</div>
</div>

<div class="form-group">
            <label for="inputConfirmPassword">Confirm Password</label>
                <div class="input-group">
                   <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
<input type="password" class="form-control" name="inputConfirmPassword" id="inputConfirmPassword" placeholder="Retype New Password">
</div>
</div>

</div><!-- panel body -->

<div class="panel-footer clearfix">

<button type="submit" id="submitButton" class="btn btn-default btn-success btn-lg pull-right">Update Credentials</button>

</div><!--panel-footer clearfix-->

</form>


</div><!--panel panel-default-->  

</section>

</section><!--col-md-10-->

<?php include("footer.php");?>