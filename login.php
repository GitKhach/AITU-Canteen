<?php
//login.php
session_start();
$error='';

if(isset($_GET['error']) and $_GET['error'] == 'password'){
    $error="Incorrect password, try again.";
}

if(isset($_GET['error']) and $_GET['error'] == 'email'){
    $error="Incorrect email, sign up or try again.";
}

$title = "Login - AITU Canteen";
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

<header class="site-header">
    <nav class="navbar">
        <a href="welcome.php" class="brand">
            <span class="brand-mark">AC</span>
            <span class="brand-text">
                <span class="brand-title">AITU Canteen</span>
                <span class="brand-subtitle">Astana IT University</span>
            </span>
        </a>
    </nav>
</header>

<main class="auth-page">

    <div class="form-container">

        <div class="form-header">
            <h1>Welcome back</h1>
            <p>Sign in to your AITU Canteen account.</p>
        </div>

        <?php if($error): ?>
            <div class="form-error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="login_check_post.php" method="POST">

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    placeholder="name@astanait.edu.kz"
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    placeholder="Enter your password"
                >
            </div>

            <button type="submit" class="submit-btn">
                Sign in
            </button>

        </form>

        <div class="auth-footer">
            Don't have an account?
            <a href="reg.php">Create one</a>
        </div>

    </div>

</main>

<footer class="site-footer">
    <p>&copy; <?php echo date("Y"); ?> AITU Canteen. All rights reserved.</p>
</footer>

</body>
</html>
