<?php include("header.php"); 
require_once "vendor/autoload.php";

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

use Mailgun\Mailgun;
  
$mailgun = Mailgun::create($privateKey);
$mailgunOptIn = $mailgun->OptInHandler(); 

?>

<div class="container container-mod" style="margin-top:85px;">

<?php

if(isset($_GET['hash']))
{
  $hash = $mailgunOptIn->validateHash($secret, $_GET['hash']);

  if($hash)
  {

    $list = $hash['mailingList'];
    $email = $hash['recipientAddress'];
    $mailgun->put('lists/' . $list . '/members/' . $email, [
       'subscribed' => 'yes'
    ]);

    $sending_message = $mailgun->messages()->send($domain,
                    array('from'    => $fromEmail,
                            'to'      => $email,
            'subject' => 'You have just subscribed!',
            'text' => 'Hello, thanks for confirming. You are now subscribed to our newsletter. You will get notified when new products are being added on our website. Have a good day!'
        ));

    echo '<div id="alertBox" class="alert alert-success">Thank you! Your subscription has been confirmed.</div>';
  }
  else
  {
    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again later.</div>");;
  }
}
else
{
  printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please try again later.</div>");;
}

?>

</div>