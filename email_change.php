<?php
    session_start();

    if(isset($_GET['error']) and $_GET['error'] == 'password'){
        $error = "Password is incorrect, please try again.";
    }
    else if(isset($_GET['error']) and $_GET['error'] == 'email'){
        $error = "Email is already taken!\nSign in or try another email.";
    }

    if(empty($_SESSION) or isset($_GET['action']) and $_GET['action'] == 'signout'){
        session_unset();
        session_destroy();
        header("Location: welcome.php");
        exit();
    }
    else{
        $title = "Change email";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Email - AITU Canteen</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="site-header">
    <nav class="navbar">

        <a href="index.php" class="brand">
            <span class="brand-mark">AC</span>

            <span class="brand-text">
                <span class="brand-title">AITU Canteen</span>
                <span class="brand-subtitle">Astana IT University</span>
            </span>
        </a>

        <div class="nav-links">
            <a href="index.php" class="nav-link">Main Page</a>
            <a href="profile.php" class="nav-link">Profile</a>
        </div>

    </nav>
</header>

<main class="auth-page">
    <?php if(isset($error)): ?>
        <div class="error-message">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <?php if(isset($message)): ?>
        <div class="success-message">
            <?= $message ?>
        </div>
    <?php endif; ?>
    <section class="auth-card">

        <div class="auth-header">
            <div class="profile-eyebrow">Account security</div>

            <h1>Change Email</h1>

            <p>
                Update the email address associated with your account.
            </p>
        </div>

        <form action="email_change_post.php" method="POST" class="auth-form">

            <div class="form-group">
                <label for="email_password">Enter your password</label>

                <input
                    type="password"
                    id="email_password"
                    name="email_password"
                    placeholder="Enter your password"
                >
            </div>

            <div class="form-group">
                <label for="new_email">New email</label>

                <input
                    type="email"
                    id="new_email"
                    name="new_email"
                    placeholder="Enter your new email"
                >
            </div>

            <div class="auth-actions">
                <a href="profile.php" class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    Change email
                </button>
            </div>

        </form>

    </section>

</main>

<footer class="site-footer">
    <p>
        &copy; <?= date("Y") ?> AITU Canteen. All rights reserved.
    </p>
</footer>

</body>
</html>
