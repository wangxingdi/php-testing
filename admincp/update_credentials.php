<?php
session_start();
include('../db.php');
if ($_POST) {
    if ($admin_result_set = $mysqli->query("SELECT * FROM mp_users WHERE is_admin = 1")) {
        $admin_row = mysqli_fetch_array($admin_result_set);
        $admin_password = $admin_row['user_password'];
        $admin_result_set->close();
    } else {
        printf("<div class='alert alert-danger alert-pull'>There seems to be an issue. Please Trey again</div>");;
    }
    if (!isset($_POST['inputUsername']) || strlen($_POST['inputUsername']) < 1) {
        die('<div class="alert alert-danger" role="alert">Administrator username cannot be blank.</div>');
    }
    $current_password = $_POST['inputCurrentPassword'];
    $encrypt_current_password = md5($current_password);
    if ($encrypt_current_password !== $admin_password) {
        die('<div class="alert alert-danger" role="alert">Existing password doesn&acute;t match.</div>');
    }
    if (!isset($_POST['inputPassword']) || strlen($_POST['inputPassword']) < 1) {
        die('<div class="alert alert-danger" role="alert">Please provide a password.</div>');
    }
    if (!isset($_POST['inputPassword']) || strlen($_POST['inputPassword']) < 5) {
        die('<div class="alert alert-danger" role="alert">New password must be least 6 characters long.</div>');
    }
    if (!isset($_POST['inputConfirmPassword']) || strlen($_POST['inputConfirmPassword']) < 1) {
        die('<div class="alert alert-danger" role="alert">Please enter the same password as above.</div>');
    }
    if ($_POST['inputPassword'] !== $_POST['inputConfirmPassword']) {
        die('<div class="alert alert-danger" role="alert">Conform Password did not match! Try again.</div>');
    }
    $user_name = $mysqli->escape_string($_POST['inputUsername']);
    $user_password = $mysqli->escape_string($_POST['inputPassword']);
    $encrypt_new_user_password = md5($user_password);
    $mysqli->query("UPDATE mp_users SET user_name='$user_name', user_password='$encrypt_new_user_password' WHERE is_admin = 1 ");
    die('<div class="alert alert-success" role="alert">Your administrator credentials updated successfully.</div>');
} else {
    die('<div class="alert alert-danger" role="alert">There seems to be a problem. Please try again.</div>');
}
?>