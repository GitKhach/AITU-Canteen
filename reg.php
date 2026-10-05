<?php
session_start();
include("header.php");
$title = "Registration";
$error = '';
if(isset($_GET['error']) and $_GET['error'] == 'names'){
    $error = "Email is already taken!\nSign in or try another email.";
}
if(isset($_GET['error']) and $_GET['error'] == 'passwords'){
    $error = "Passwords do mot match!";
}
if(isset($_GET['error']) and $_GET['error'] == 'sql'){
    $error = "Database error, please try again";
}
if(isset($_GET['error']) and $_GET['error'] == 'unknown'){
    $error = "Unknown server error, try again later";
}
require_once("reg_form.php");

$_SESSION['username'] = $_COOKIE['username'];

include("footer.php");
?>
