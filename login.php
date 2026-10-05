<?php
session_start();
$error='';
if(isset($_GET['error']) and $_GET['error'] == 'password'){
    $error="Incorrect password, try again.";
}
if(isset($_GET['error']) and $_GET['error'] == 'email'){
    $error="Incorrect email, sign up or try again.";
}
require_once("login_form.php");

?>
