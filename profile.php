<?php
//profile.php
session_start();

if(empty($_SESSION) or isset($_GET['action']) and $_GET['action'] == 'signout'){
    session_unset();
    session_destroy();
    header("Location: welcome.php");
    exit();
}
else{
    $title = "Profile";
}
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
        <a href="index.php" class="brand">
            <span class="brand-mark">AC</span>
            <span class="brand-text">
                <span class="brand-title">AITU Canteen</span>
                <span class="brand-subtitle">Astana IT University</span>
            </span>
        </a>

    <div class="nav-links">
        <a href="index.php" class="nav-link">Main Page</a>
    </div>
</nav>

</header>

<main class="profile-page">

<section class="profile-header">
    <div>
        <div class="profile-eyebrow">Account</div>
        <h1>My Profile</h1>
        <p>Manage your personal information and account details.</p>
    </div>

    <a href="index.php" class="btn btn-secondary">
        Back to dashboard
    </a>
</section>

<section class="profile-grid">

    <div class="profile-card profile-main-card">

        <div class="profile-avatar">
            <span>JD</span>
        </div>

        <h2>John Doe</h2>

        <p class="profile-role">
            Student
        </p>

        <div class="profile-status">
            <span class="status-dot"></span>
            Active account
        </div>

        <button class="btn btn-primary profile-avatar-btn">
            Change avatar
        </button>

    </div>

    <div class="profile-card profile-info-card">

        <div class="card-heading">
            <div>
                <h2>Personal information</h2>
                <p>Your account information</p>
            </div>
        </div>

        <div class="profile-info-grid">

            <div class="profile-info-item">
                <span class="info-label">Full name</span>
                <span class="info-value"><?= $_SESSION['username'];?></span>
            </div>

            <div class="profile-info-item">
                <span class="info-label">Email address</span>
                <span class="info-value"><?= $_SESSION['email'];?></span>
            </div>

            <div class="profile-info-item">
                <span class="info-label">University role</span>
                <span class="info-value"><?= $_SESSION['userrole'];?></span>
            </div>

            <div class="profile-info-item">
                <span class="info-label">User ID</span>
                <span class="info-value"><?= $_SESSION['user_id'];?></span>
            </div>

            <div class="profile-info-item">
                <span class="info-label">Account created</span>
                <span class="info-value"><?= $_SESSION['regdate'];?></span>
            </div>

            <div class="profile-info-item">
                <span class="info-label">Account status</span>
                <span class="info-value info-success">Active</span>
            </div>

        </div>

        <div class="profile-actions">
            <button class="btn btn-primary">
                Edit profile
            </button>

            <button class="btn btn-secondary">
                Change password
            </button>
        </div>

    </div>

</section>

<section class="profile-card account-settings">

    <div class="card-heading">
        <div>
            <h2>Account settings</h2>
            <p>Additional account options</p>
        </div>
    </div>

    <div class="settings-list">

        <div class="setting-item">
            <div class="setting-icon">🔒</div>

            <div class="setting-content">
                <h3>Password</h3>
                <p>Change your account password.</p>
            </div>

            <button class="btn btn-secondary">
                Change
            </button>
        </div>

        <div class="setting-item">
            <div class="setting-icon">✉</div>

            <div class="setting-content">
                <h3>Email address</h3>
                <p>Update the email associated with your account.</p>
            </div>

            <button class="btn btn-secondary">
                Change
            </button>
        </div>

        <div class="setting-item setting-danger">
            <div class="setting-icon">⚠</div>

            <div class="setting-content">
                <h3>Delete account</h3>
                <p>Permanently remove your AITU Canteen account.</p>
            </div>

            <button class="btn btn-danger">
                Delete
            </button>
        </div>

    </div>

</section>

</main>

<footer class="site-footer">
    <p>&copy; <?php echo date("Y"); ?> AITU Canteen. All rights reserved.</p>
</footer>

</body>
</html>
