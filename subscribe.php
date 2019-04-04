<?php session_start();
ob_start();

 include("db.php");

require_once "vendor/autoload.php";
use Mailgun\Mailgun; 

$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
  
if($sqlemail = $mysqli->query("SELECT * FROM settings WHERE id='1'"))
{
  $emailRow = mysqli_fetch_array($sqlemail);

  $fromEmail = $emailRow['email'];
  $siteurl = $emailRow['siteurl'];
  $privateKey = $emailRow['MailgunPrivateKey'];
  $publicKey = $emailRow['MailgunPublicKey'];
  $domain = $emailRow['MailgunDomain'];
  $list = $emailRow['MailgunList'];
  $secret = $emailRow['MailgunSecret'];

  $sqlemail->close();
}
else
{
  die('<div style="padding: 4px 10px;" class="errorTxt error">There seems to be an issue. Please try again later.</div>');  
}

$mailgun = Mailgun::create($privateKey);
$mailgunOptIn = $mailgun->OptInHandler();

if(!empty($fromEmail) && !empty($privateKey) && !empty($publicKey) && !empty($domain) && !empty($list) && !empty($secret))
{
  $configured = 1;
}
else
{
  $configured = 0;
}

if($configured == 1)
{
 $email = $mysqli->escape_string($_POST['email']);

   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
   {
      die('<div style="padding: 4px 10px;" class="errorTxt error">Please enter a valid email address!</div>');
   } 

  $hash = $mailgunOptIn->generateHash($list, $secret, $email);
  $sending_message = $mailgun->messages()->send($domain,
                    array('from'    => $fromEmail,
                            'to'      => $email,
                            'subject' => 'Thank you! Please confirm your subscription.',
                            'html' => "
             Hello, <br><br>
             Thank you for the subscription! Please confirm your email by clicking the link below.<br><br>" .
             $protocol . $siteurl . "/confirm.php?hash={$hash}"));
       
        $result = $mailgun->post("lists/" . $list . "/members", array(
           'address' => $email,
           'subscribed' => 'no'  
        ));
      
        echo '<div style="padding: 4px 10px;" class="alert alert-success successTxt">Thank you! Please check your inbox.</div>';
}
else
{ 
  die('<div style="padding: 4px 10px; margin-bottom:3px; margin-left:3px;" class="errorTxt error">Mailing list is not ready yet.</div>'); 
}

ob_end_flush();

?>