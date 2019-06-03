<?php
session_start();
include('../db.php');
if ($_POST) {
    $id = $mysqli->escape_string($_GET['id']);
    if (!isset($_POST['inputTitle']) || strlen($_POST['inputTitle']) < 1) {
        //required variables are empty
        die('<div class="alert alert-danger">Please enter desired category.</div>');
    }
    if (!isset($_POST['inputIcon']) || strlen($_POST['inputIcon']) < 1) {
        die('<div class="alert alert-danger">Please enter the icon class name. Use icons from <a href="https://fontawesome.com">FontAwesome.com</a> only. Other icons may not work.</div>');
    }
    if (!isset($_POST['inputDescription']) || strlen($_POST['inputDescription']) < 1) {
        die('<div class="alert alert-danger">Please enter description for your new category.</div>');
    }
    $CategoryTitle = $mysqli->escape_string($_POST['inputTitle']);
    $cname2 = preg_replace("![^a-z0-9]+!i", "-", $CategoryTitle);
    $cname2 = urlencode($cname2);
    $cname2 = strtolower($cname2);
    $cname2 = strip_tags($cname2);
    $CategoryIcon = str_replace('"', "'", $mysqli->escape_string($_POST['inputIcon']));
    $CategoryDescription = $mysqli->escape_string($_POST['inputDescription']);
    $ParentCategory = $mysqli->escape_string($_POST['inputParent']);
    if (!empty($ParentCategory)) {
        $is_sub_cat = 1;
    }
    $mysqli->query("UPDATE mp_categories SET category_name='$CategoryTitle', category_description='$CategoryDescription', parent_id='$ParentCategory', category_icon='$CategoryIcon', category_slug='$cname2' WHERE category_id='$id'");
//  $mysqli->query("UPDATE mp_categories SET branch = 1 WHERE category_id = '$ParentCategory'");
    die('<div class="alert alert-success" role="alert">Category updated successfully.</div>');
} else {
    die('<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>');
}
?>