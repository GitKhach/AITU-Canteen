<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : "AITU Canteen"; ?></title>
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

            <?php if (!empty($_SESSION['username'])): ?>
                <div class="nav-user">
                    <a href="profile.php" class="user-name">
                        <?= htmlspecialchars($_SESSION['username']) ?>
                    </a>

                    <form action="index.php" method="GET" class="signout-form">
                        <input type="hidden" name="action" value="signout">
                        <button type="submit" class="signout-nav-btn">Sign Out</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main>
