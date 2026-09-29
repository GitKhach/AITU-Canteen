<?php
session_start();
include("header.php");
$title = "Login";
$error = '';
if(isset($_GET['error']) and $_GET['error'] == 'names'){
    $error = "Name is already taken!";
}
if(isset($_GET['error']) and $_GET['error'] == 'passwords'){
    $error = "Passwords do mot match!";
}
require_once("reg_form.php");

$_SESSION['username'] = $_COOKIE['username'];

include("footer.php");
?>
