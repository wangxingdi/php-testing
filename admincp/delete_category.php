<?php
include("../db.php");
$category_id = $mysqli->escape_string($_POST['id']);
if ($products_result_set = $mysqli->query("SELECT * FROM mp_products WHERE category_id='$category_id'")) {
    while ($products_rows = mysqli_fetch_array($products_result_set)) {
        $product_image = $products_rows['product_image'];
        unlink("../images/$product_image");
    }
    $products_result_set->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>删除分类失败(delete_category.php)</div>");
}
$mysqli->query("DELETE FROM mp_products WHERE category_id='$category_id'");
$mysqli->query("DELETE FROM mp_categories WHERE id='$category_id'");
echo '<div class="alert alert-success" role="alert">Category successfully deleted</div>';
?>