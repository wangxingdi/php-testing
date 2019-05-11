<?php
include('db.php');
$product_id = $mysqli->escape_string($_GET['id']);
if ($products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_id='$product_id'")) {
    $products_row = mysqli_fetch_array($products_result_set);
    $product_affiliate_url = $products_row['product_affiliate_url'];
    $products_result_set->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>查询产品失败(offer_link.php)</div>");;
}
$mysqli->query("UPDATE mp_products SET product_hits=product_hits+1 WHERE product_id='$product_id'");
header('Location: ' . $product_affiliate_url . '');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $products_row['product_name']; ?></title>
</head>
<body>
</body>
</html>