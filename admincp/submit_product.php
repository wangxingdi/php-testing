<?php
include('../db.php');
if ($settings_result_set = $mysqli->query("SELECT * FROM settings WHERE id='1'")) {
    $settings = mysqli_fetch_array($settings_result_set);
    $Active = $settings['active'];
    $settings_result_set->close();
} else {
    printf("<div class='alert alert-danger alert-pull'>settings表似乎有问题，请检查一下。</div>");
}
$year = date('Y');
$month = date('m');
$upload_directory = '../uploads/300x250/'.$year.'/'.$month."/";
if (!@file_exists($upload_directory)) {
    die('<div class="alert alert-danger" role="alert">图片上传路径不存在。</div>');
}
if ($_POST) {
    if (!isset($_POST['category']) || strlen($_POST['category']) < 1 || $_POST['category'] < 1) {
        die('<div class="alert alert-danger" role="alert">请先选择一个分类。</div>');
    }
    if (!isset($_POST['mName']) || strlen($_POST['mName']) < 1) {
        die('<div class="alert alert-danger" role="alert">请输入标题。</div>');
    }
    if (!isset($_POST['meta_desc']) || strlen($_POST['meta_desc']) < 1) {
        die('<div class="alert alert-danger" role="alert">请输入网页元信息描述。</div>');
    }
    if (!isset($_POST['aff']) || strlen($_POST['aff']) < 1) {
        die('<div class="alert alert-danger" role="alert">请输入商品推广链接。</div>');
    }
    if (!isset($_POST['aff']) || strlen($_POST['aff']) > 1) {
        $CheckLink = $mysqli->escape_string($_POST['aff']);
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $CheckLink)) {
            //do nothing
        } else {
            die('<div class="alert alert-danger" role="alert">请输入完整的商品推广链接。</div>');
        }
    }
    if (!isset($_POST['disc']) || strlen($_POST['disc']) < 1) {
        die('<div class="alert alert-danger" role="alert">请输入一段商品描述。</div>');
    }
    if (!isset($_FILES['mFile'])) {
        die('<div class="alert alert-danger" role="alert">请选择一张图片(推荐300px*250px)。</div>');
    }
    if (!isset($_POST['price']) || strlen($_POST['price']) < 1) {
        die('<div class="alert alert-danger" role="alert">请输入商品价格。</div>');
    }
    if ($_FILES['mFile']['error']) {
        die(upload_errors($_FILES['mFile']['error']));
    }
    //uploaded file name
    $FileName = strtolower($_FILES['mFile']['name']);
    //file extension
    $ImageExt = substr($FileName, strrpos($FileName, '.'));
    //file type
    $FileType = $_FILES['mFile']['type'];
    //file size
    $FileSize = $_FILES['mFile']["size"];
    //Random number to make each filename unique.
    //$RandNumber = rand(0, 9999999999);
    $Date = date("F j, Y");
    // file title
    $FileTitle = $mysqli->escape_string($_POST['mName']);
    $pname = preg_replace("![^a-z0-9]+!i", "-", $FileTitle);
    $pname = urlencode($pname);
    $pname = strtolower($pname);
    $pname = strip_tags($pname);
    if (isset($_POST['category-sub']) && strlen($_POST['category-sub']) > 0 && $_POST['category-sub'] > 0) {
        // sub category
        $Category = $mysqli->escape_string($_POST['category-sub']);
    } else {
        // category
        $Category = $mysqli->escape_string($_POST['category']);
    }
    if ($sql_cname2 = $mysqli->query("SELECT cname2 FROM categories WHERE id='$Category' ")) {
        $cname2_row = mysqli_fetch_array($sql_cname2);
        $cname2 = $cname2_row['cname2'];
    } else {
        die('<div class="alert alert-danger" role="alert">获取分类代码失败，请检查您的分类配置。</div>');
    }

    $AffURL = $mysqli->escape_string($_POST['aff']);
    $Description = $mysqli->escape_string($_POST['disc']);
    $Price = $mysqli->escape_string($_POST['price']);
    $MetaDescription = $mysqli->escape_string($_POST['meta_desc']);
    $external = $mysqli->escape_string($_POST['external']);
    switch (strtolower($FileType)) {
        case 'image/png':
            break;
        case 'image/gif':
            break;
        case 'image/jpeg':
            break;
        default:
            die('<div class="alert alert-danger" role="alert">仅支持JPEG，PNG或者GIF类型的文件。</div>');
    }
    function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    $day = date('d');
    //$NewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($FileTitle));
    $NewFileName = preg_replace(array('/\s{1,}/'), array('-'), strtolower($FileTitle));
    $NewFileName = clean($NewFileName);
    $NewFileName = $day . '_' . $NewFileName . $ImageExt;
    //Rename and save uploded image file to destination folder.
    echo  $upload_directory . $NewFileName;
    if (move_uploaded_file($_FILES['mFile']["tmp_name"], $upload_directory . $NewFileName)) {
        if (!$mysqli->query("INSERT INTO listings(title, aff_url, discription, price, image, catid, date, saves, uid, feat, active, meta_description, pname, cname, external_link) VALUES ('$FileTitle', '$AffURL','$Description','$Price','$NewFileName','$Category','$Date','0','0','0','1', '$MetaDescription', '$pname', '$cname2', '$external')")) {
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