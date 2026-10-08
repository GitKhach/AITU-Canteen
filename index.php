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
?>

<div class="dashboard">

    <section class="dashboard-header">
        <div class="eyebrow">AITU Canteen</div>

        <h1>
            Welcome, <?= htmlspecialchars($_SESSION['username']) ?>
        </h1>

        <p>
            Your campus canteen portal.
        </p>
    </section>

    <section class="dashboard-grid">

        <div class="dashboard-card">
            <div class="dashboard-card-icon">🍽</div>
            <h3>Menu</h3>
            <p>
                Browse the available food and drinks.
            </p>
        </div>

        <div class="dashboard-card">
            <div class="dashboard-card-icon">🛒</div>
            <h3>Orders</h3>
            <p>
                View and manage your canteen orders.
            </p>
        </div>

        <div class="dashboard-card">
            <div class="dashboard-card-icon">👤</div>
            <h3>Profile</h3>
            <p>
                Your account information and university role.
            </p>
        </div>

    </section>

</div>

<?php
    include("footer.php");
}
?>
