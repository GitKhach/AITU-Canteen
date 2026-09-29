<?php
session_start();
include("header.php");
$title = "AITU Canteen";
if(empty($_SESSION) or $_SESSION['username'] == ''){
    header("Location: welcome.php");
}
else{
    print_r($_SESSION);
}

include("footer.php");
?>
