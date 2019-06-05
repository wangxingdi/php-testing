<?php
include("../db.php");
$product_id = $mysqli->escape_string($_POST['id']);
if ($products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE product_id='$product_id'")) {
    $products_row = mysqli_fetch_array($products_result_set);
    $products_num = $products_result_set->num_rows;
    $product_image = $products_row['product_image'];
    $products_result_set->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>产品删除失败：查询不到被删除的产品</div>");
}
if ($products_num == 1) {
    unlink("../images/$product_image");
}
$products_del = $mysqli->query("DELETE FROM mp_products WHERE id='$product_id'");
$products_del->close();
echo '<div class="alert alert-success" role="alert">产品删除成功</div>';
?>