<?php
session_start();
include('../db.php');
if ($_POST) {
    $ad1 = $mysqli->escape_string($_POST['inputAd1']);
    $ad2 = $mysqli->escape_string($_POST['inputAd2']);
    $ad3 = $mysqli->escape_string($_POST['inputAd3']);
    $ad4 = $mysqli->escape_string($_POST['inputAd4']);
    $mysqli->query("UPDATE mp_ads SET ads_ad1='$ad1',ads_ad2='$ad2',ads_ad3='$ad3', ads_ad4='$ad4' WHERE ads_id=1");
    die('<div class="alert alert-success" role="alert">Site advertisements updated successfully.</div>');
} else {
    die('<div class="alert alert-danger" role="alert">There seems to be a problem. please try again.</div>');
}
?>