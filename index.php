<?php
//index.php
session_start();

if(empty($_SESSION) or isset($_GET['action']) and $_GET['action'] == 'signout'){
    session_unset();
    session_destroy();
    header("Location: welcome.php");
    exit();
}
else{
    $title = "AITU Canteen";
    include("header.php");

    print_r($_SESSION);

    include("footer.php");
}
?>
