<?php
include('db.php');

if($_POST)
{	
	
	if(!isset($_POST['uName']) || strlen($_POST['uName'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger">Please let us know your username.</div>');
	}
	
	$UN = $mysqli->escape_string($_POST['uName']);
	
	if($UserCheck = $mysqli->query("SELECT * FROM users WHERE username ='$UN'")){

   	$VdUser = mysqli_fetch_array($UserCheck);
	
	$UNV = $VdUser['username'];

   	$UserCheck->close();
   
	}else{
   
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");

	}
	
	if ($_POST['uName'] == $UNV)
	{
		//required variables are empty
		die('<div class="alert alert-danger">Username already taken. Please try another.</div>');
	}
	
	if(!isset($_POST['uName']) || strlen($_POST['uName'])<3)
	{
		//required variables are empty
		die('<div class="alert alert-danger">Username must be more then 3 characters long.</div>');
	}
	
	if(!isset($_POST['uEmail']) || strlen($_POST['uEmail'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger">Please let us know your email adress.</div>');
	}
	
	$email_address = $_POST['uEmail'];
	
	if($EmailCheck = $mysqli->query("SELECT * FROM users WHERE email ='$email_address'")){

   	$EmailRow = mysqli_fetch_array($EmailCheck);
	
	$ValidateEmail = $EmailRow['email'];

   	$EmailCheck->close();
   
	}else{
   
     printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");

	}
	
	if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
  	// The email address is valid
	} else {
  		die('<div class="alert alert-danger">Please enter a valid email address.</div>');
	}
	
	if ($_POST['uEmail'] == $ValidateEmail)
	{
		//required variables are empty
		die('<div class="alert alert-danger">Email address already in use.</div>');
	}
	
	if(!isset($_POST['uPassword']) || strlen($_POST['uPassword'])<1)
	{
		//required variables are empty
		die('<div class="alert alert-danger">Please provide a password.</div>');
	}
	
	if(!isset($_POST['uPassword']) || strlen($_POST['uPassword'])<6)
	{
		//required variables are empty
		die('<div class="alert alert-danger">Password must be least 6 characters long.</div>');
	}
		if(!isset($_POST['cPassword']) || strlen($_POST['cPassword'])< 1)
	{
		//required variables are empty
		die('<div class="alert alert-danger">Please enter the same password as above.</div>');
	}
	
	if ($_POST['uPassword']!== $_POST['cPassword'])
 	{
		//required variables are empty
     	die('<div class="alert alert-danger">Password did not match! Try again.</div>');
 	
	}
			
	
	$UserName  			= $mysqli->escape_string($_POST['uName']); // Username
	$Email  			= $mysqli->escape_string($_POST['uEmail']); // Email
	$Password  			= $mysqli->escape_string($_POST['uPassword']); // Password
	$EnPassword         = md5($Password); // Encript Password
	$RegDate		    = date("F j, Y"); //date
	
	
		
// Insert info into database table.. do w.e!
		$mysqli->query("INSERT INTO users(username, email, password, registered_date) VALUES ('$UserName', '$Email', '$EnPassword','$RegDate')");
		
?>
<script type="text/javascript">

function leave() {
  window.location = "login/";
}
setTimeout("leave()", 1000);

</script>
<?php		
		
		die('<div class="alert alert-info">Thank you for registering. Please wait while we redirect you to login.</div>');
		

   }else{
   		die('<div class="alert alert-danger">There seems to be a problem. Please try again.</div>');
   } 

?>