<?php

include("../db.php");

$id = $mysqli->escape_string($_POST['id']);

$update = $mysqli->query("UPDATE listings SET active='3', feat='0' WHERE id='$id'");

echo '<div class="alert alert-success" role="alert">Product listing successfully deactivated</div>';

?>