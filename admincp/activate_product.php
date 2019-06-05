<?php
include("../db.php");
$product_id = $mysqli->escape_string($_POST['id']);
$update = $mysqli->query("UPDATE mp_products SET product_state='1' WHERE product_id='$product_id'");
echo '<div class="alert alert-success" role="alert">激活产品成功</div>';
?>