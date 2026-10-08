<?php
//reg.php
session_start();

$title = "Registration - AITU Canteen";
$error = '';

if(isset($_GET['error']) and $_GET['error'] == 'names'){
    $error = "Email is already taken!\nSign in or try another email.";
}

if(isset($_GET['error']) and $_GET['error'] == 'passwords'){
    $error = "Passwords do mot match!";
}

if(isset($_GET['error']) and $_GET['error'] == 'sql'){
    $error = "Database error, please try again";
}

if(isset($_GET['error']) and $_GET['error'] == 'unknown'){
    $error = "Unknown server error, try again later";
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
            <h1>Create an account</h1>
            <p>Register for the AITU Canteen portal.</p>
        </div>

        <?php if($error): ?>
            <div class="form-error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="reg_check_post.php" method="POST">

            <div class="form-group">
                <label for="name">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    placeholder="Enter your full name"
                >
            </div>

            <div class="form-group">
                <label for="email">Corporate email</label>
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
                    placeholder="Enter password"
                >
            </div>

            <div class="form-group">
                <label for="reppassword">Repeat password</label>
                <input
                    type="password"
                    id="reppassword"
                    name="reppassword"
                    required
                    placeholder="Repeat password"
                >
            </div>

            <div class="form-group">
                <label for="role">Role at the university</label>
                <select id="role" name="role" required>
                    <option value="">Please choose a role</option>
                    <option value="student">Student</option>
                    <option value="professor">Professor</option>
                    <option value="administator">Administration</option>
                    <option value="technical stuff">Technical stuff</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">
                Create account
            </button>

        </form>

        <div class="auth-footer">
            Already have an account?
            <a href="login.php">Sign in</a>
        </div>

    </div>

</main>

<footer class="site-footer">
    <p>&copy; <?php echo date("Y"); ?> AITU Canteen. All rights reserved.</p>
</footer>

</body>
</html>
