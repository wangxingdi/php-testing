<?php
include('../db.php');
/*
if ($settings_result_set = $mysqli->query("SELECT * FROM settings WHERE id='1'")) {
    $settings = mysqli_fetch_array($settings_result_set);
    $Active = $settings['active'];
    $settings_result_set->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>settings表似乎有问题，请检查一下。</div>");
}
*/
$upload_directory = '../images/';
if ($_POST) {
    if (!isset($_POST['category']) || strlen($_POST['category']) < 1 || $_POST['category'] < 1) {
        die('<div class="alert alert-danger" role="alert">请先选择一个分类。</div>');
    }
    if (!isset($_POST['product_name']) || strlen($_POST['product_name']) < 1) {
        die('<div class="alert alert-danger" role="alert">请输入名称。</div>');
    }
    if (!isset($_POST['product_meta_description']) || strlen($_POST['product_meta_description']) < 1) {
        die('<div class="alert alert-danger" role="alert">请输入Meta信息描述。</div>');
    }
    if (!isset($_POST['product_affiliate_url']) || strlen($_POST['product_affiliate_url']) < 1) {
        die('<div class="alert alert-danger" role="alert">请输入产品推广链接。</div>');
    }
    if (!isset($_POST['product_affiliate_url']) || strlen($_POST['product_affiliate_url']) > 1) {
        $CheckLink = $mysqli->escape_string($_POST['product_affiliate_url']);
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $CheckLink)) {
            //do nothing
        } else {
            die('<div class="alert alert-danger" role="alert">请输入完整的产品推广链接。</div>');
        }
    }
    if (!isset($_POST['product_description']) || strlen($_POST['product_description']) < 1) {
        die('<div class="alert alert-danger" role="alert">请输入产品描述。</div>');
    }
    if (!isset($_FILES['product_image']) && (!isset($_POST['product_external_link']) || strlen($_POST['product_external_link']) < 1)) {
        die('<div class="alert alert-danger" role="alert">需要上传图片或者输入外部图片链接</div>');
//        die('<div class="alert alert-danger" role="alert">请选择一张图片(推荐300px*250px)。</div>');
    }
    if (!isset($_POST['product_price']) || strlen($_POST['product_price']) < 1) {
        die('<div class="alert alert-danger" role="alert">请输入产品价格。</div>');
    }
    if ($_FILES['product_image']['error']) {
        die(upload_errors($_FILES['product_image']['error']));
    }
    $year = date('Y');
    $month = date('m');
    $date = date("F j, Y");
    $image_name = strtolower($_FILES['product_image']['name']);
    $image_path = $year.'/'.$month."/".$image_name;
    $file_type = $_FILES['product_image']['type'];
    if (isset($_POST['category-sub']) && strlen($_POST['category-sub']) > 0 && $_POST['category-sub'] > 0) {
        // sub category
        $Category = $mysqli->escape_string($_POST['category-sub']);
    } else {
        // category
        $Category = $mysqli->escape_string($_POST['category']);
    }
    if ($sql_cname2 = $mysqli->query("SELECT cname2 FROM mp_categories WHERE id='$Category' ")) {
        $cname2_row = mysqli_fetch_array($sql_cname2);
        $cname2 = $cname2_row['cname2'];
    } else {
        die('<div class="alert alert-danger" role="alert">获取分类代码失败，请检查您的分类配置。</div>');
    }

    $product_name = $mysqli->escape_string($_POST['product_name']);
    $product_affiliate_url = $mysqli->escape_string($_POST['product_affiliate_url']);
    $product_description = $mysqli->escape_string($_POST['product_description']);
    $product_price = $mysqli->escape_string($_POST['product_price']);
    $product_meta_description = $mysqli->escape_string($_POST['product_meta_description']);
    $product_permalink = $mysqli->escape_string($_POST['product_permalink']);
    $product_external_link = $mysqli->escape_string($_POST['product_external_link']);
    switch (strtolower($file_type)) {
        case 'image/png':
            break;
        case 'image/gif':
            break;
        case 'image/jpeg':
            break;
        default:
            die('<div class="alert alert-danger" role="alert">仅支持JPEG，PNG或者GIF类型的文件。</div>');
    }
    if (move_uploaded_file($_FILES['product_image']["tmp_name"], $upload_directory . $image_path)) {
        if (!$mysqli->query("INSERT INTO mp_products(product_name, product_affiliate_url, product_description, product_price, product_image, category_id, product_load_date, product_permalink, product_meta_description, product_external_link) VALUES 
                                                            ('$product_name', '$product_affiliate_url','$product_description','$product_price','$image_path','$Category','$date','$product_permalink', '$product_meta_description', '$product_external_link')")) {
            echo "Error : " . $mysqli->error;
        }
        ?>
        <script>
            $('#form-add-product').delay(1000).resetForm(1000);
        </script>
        <?php
        die('<div class="alert alert-success" role="alert">商品添加成功。</div>');
    } else {
        die('<div class="alert alert-danger" role="alert">图片上传遇到问题，请仔细检查。</div>');
    }
}
function upload_errors($err_code){
    switch ($err_code) {
        case UPLOAD_ERR_INI_SIZE:
            return '<div class="alert alert-danger" role="alert">Image file size is too big. Please try a smaller image</div>';
        case UPLOAD_ERR_FORM_SIZE:
            return '<div class="alert alert-danger" role="alert">Image file size is too big. Please try a smaller image</div>';
        case UPLOAD_ERR_PARTIAL:
            return '<div class="alert alert-danger" role="alert">Product listing submitted but product image did not uploaded properly.</div>';
        case UPLOAD_ERR_NO_FILE:
            return '<div class="alert alert-danger" role="alert">Product listing submitted but product image not uploaded.</div>';
        case UPLOAD_ERR_NO_TMP_DIR:
            return '<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>';
        case UPLOAD_ERR_CANT_WRITE:
            return '<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>';
        case UPLOAD_ERR_EXTENSION:
            return '<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>';
        default:
            return '<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>';
    }
}

?>