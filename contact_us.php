<?php include("header.php");
$successMsg = "";
$errorMsg = "";

if ($sql = $mysqli->query("SELECT email FROM mp_options WHERE id=1")) {
    $ActiveRow = mysqli_fetch_array($sql);
    $email = $ActiveRow['email'];
} else {
    printf("<div class='alert alert-danger alert-pull'>There seems to be an issue of settings, Please check it.</div>");
}

if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        //required variables are empty
        $errorMsg = "Please let us know your name!";
    } else if (empty($_POST['email'])) {
        //required variables are empty
        $errorMsg = "Please enter your email ID.";
    } else if (empty($_POST['message'])) {
        //required variables are empty
        $errorMsg = "Oops. Message is empty!";
    } else {
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $mailFrom = $_POST['email'];
        $message = $_POST['message'];
        $mailTo = $email;
        $headers = "From: " . $mailFrom;
        $txt = "You have received an email from " . $name . ".\n\n" . $message;
        mail($mailTo, $subject, $txt, $headers);
        $successMsg = "Thanks! Your message has been sent.";
    }
}

?>

<div class="container container-pull" id="display-posts">
    <div class="col-top">
        <div class="col-md-8">
            <div class="page-titles"><h1>联系我们</h1></div>
            <?php
            if (!empty($successMsg)) {
                echo '<div style="margin:15px;" class="alert alert-success">' . $successMsg . '</div>';
            }
            if (!empty($errorMsg)) {
                echo '<div style="margin:15px;" class="alert alert-danger">' . $errorMsg . '</div>';
            }
            ?>

            <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="ContactUs" method="post">
                <div id="output"></div>
                <div class="form-group">
                    <label for="name">姓名</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" tabindex="1" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" tabindex="2" required>
                </div>
                <div class="form-group">
                    <label for="email">主题</label>
                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" tabindex="3">
                </div>

                <div class="form-group">
                    <label for="fact">内容</label>
                    <textarea name="message" id="message" class="form-control" placeholder="Your Message" tabindex="4" required></textarea>
                </div>

                <input type="submit" name="submit" id="submit" value="发送" class="btn btn-default btn-warning pull-right btn-font" tabindex="5">
            </form>
        </div>
        <div class="col-md-4 mobile-remove">
            <?php include("side_bar.php"); ?>
        </div>
    </div>
</div>

<?php include("footer.php"); ?> 