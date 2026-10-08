<?php
//welcome.php
session_start();
if(!empty($_SESSION)){
    header("Location: index.php");
    exit();
}
$title = "Welcome - AITU Canteen";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="welcome-page">
    <div class="welcome-container">
        <div class="welcome-card">

            <section class="welcome-content">
                <span class="welcome-badge">AITU Campus</span>

                <h1>Everything you need from the campus canteen.</h1>

                <p>
                    Access the AITU Canteen portal, manage your account
                    and get started with your campus dining experience.
                </p>

                <div class="welcome-actions">
                    <a href="login.php" class="btn btn-primary">Login</a>
                    <a href="reg.php" class="btn btn-secondary">Create account</a>
                </div>
            </section>

            <section class="welcome-visual">
                <div class="visual-card">
                    <div class="visual-icon">🍴</div>
                    <h2>AITU Canteen</h2>
                    <p>
                        A simple campus food portal for students,
                        professors and university staff.
                    </p>
                </div>
            </section>

        </div>
    </div>
</div>

<footer class="site-footer">
    <p>&copy; <?php echo date("Y"); ?> AITU Canteen. All rights reserved.</p>
</footer>

</body>
</html>
