<?php
    session_start();

    if(isset($_GET['error']) && $_GET['error'] == "passwordCH"){
        $error = "New passwords do not match, please try again.";
    }
    else if(isset($_GET['error']) && $_GET['error'] == "passwordR"){
        $error = "Old password is incorrect, please try again.";
    }

    if(empty($_SESSION) or isset($_GET['action']) and $_GET['action'] == 'signout'){
        session_unset();
        session_destroy();
        header("Location: welcome.php");
        exit();
    }
    else{
        $title = "Change Password";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - AITU Canteen</title>
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

    <section class="auth-card">

        <?php if(isset($error)): ?>
            <div class="error-message">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <div class="auth-header">
            <div class="profile-eyebrow">Account security</div>

            <h1>Change Password</h1>

            <p>
                Update your password to keep your account secure.
            </p>
        </div>

        <form action="change_password_post.php" method="POST" class="auth-form">

            <div class="form-group">
                <label for="current_password">Current password</label>

                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    placeholder="Enter your current password"
                >
            </div>

            <div class="form-group">
                <label for="new_password">New password</label>

                <input
                    type="password"
                    id="new_password"
                    name="new_password"
                    placeholder="Enter your new password"
                >
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm new password</label>

                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    placeholder="Repeat your new password"
                >
            </div>

            <div class="password-requirements">
                <div class="requirements-title">Password requirements</div>

                <ul>
                    <li>At least 8 characters</li>
                    <li>Contains uppercase and lowercase letters</li>
                    <li>Contains at least one number</li>
                </ul>
            </div>

            <div class="auth-actions">
                <a href="profile.php" class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    Change password
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
