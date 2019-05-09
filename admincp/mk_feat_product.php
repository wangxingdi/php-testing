<?php
include("../db.php");
$id = $mysqli->escape_string($_POST['id']);
$update = $mysqli->query("UPDATE mp_products SET feat='1' WHERE id='$id'");
echo '<div class="alert alert-success" role="alert">未知的mk_feat_product.php</div>';
?>