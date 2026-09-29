<?php
    session_start();
    $title = "Order Awaiting Confirmation";
    include("header.php");
?>

<h2>Order Awaiting Confirmation</h2>
<p>Your order has been successfully placed and is currently awaiting confirmation from the kitchen.</p>
<p>We will notify you once your order is being prepared!</p>

<p><a href="index.php">Return to Home Page</a></p>

<?php
    include("footer.php");
?>
