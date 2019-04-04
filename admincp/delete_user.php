<?php

include("../db.php");

$del = $mysqli->escape_string($_POST['id']);


$mysqli->query("DELETE FROM users WHERE user_id='$del'");

echo '<div class="alert alert-success" role="alert">User successfully deleted</div>';

?>