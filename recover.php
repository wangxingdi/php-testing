<?php include("header.php");

error_reporting(E_ALL ^ E_NOTICE);

?>

<?php
if(isset($_SESSION['username'])){?>
<script type="text/javascript">
function leave() {
window.location = "index.html";
}
setTimeout("leave()", 2);
</script>
<?php }else{?>

<div class="container container-pull" id="display-posts">

<script>
$(document).ready(function()
{
    $('#recoveredForm').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitButton').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output").html('<div class="alert alert-info" role="alert">Working.. Please wait..</div>');
		
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

<div class="col-top">

<div class="col-md-8">

<div class="page-titles"><h1>Recover Username/Password</h1></div>

<div class="col-form">

<div id="loadding"></div>

<div id="output"></div>

<form id="recoveredForm" action="send_recovery.php" method="post">

<div class="form-group">
            <label for="inputRecovery">Registered Email</label>
                <div class="input-group">
                   <span class="input-group-addon">@</span>
<input type="email" class="form-control" name="inputRecovery" id="inputRecovery" placeholder="Your Email Address">
</div>
</div>
   
<button type="submit" id="submitButton" class="btn btn-default btn-warning btn-lg pull-right btn-font">Reset</button>

</form>

</div><!--col-form-->

</div><!--col-md-8-->

<div class="col-md-4 mobile-remove">

<?php include("side_bar.php");?>


</div><!--col-md-4-->

</div><!--col-top-->

</div><!-- /.container -->

<?php } include("footer.php"); ?> 