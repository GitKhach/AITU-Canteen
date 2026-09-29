<?php
    $title = "Welcome - AITU Portal";
    include("header.php");

?>

<div class="welcome-container">
    <div class="welcome-card">
        <h1>Welcome to AITU Portal</h1>
        <p>Please choose an option to continue to your account or create a new one.</p>

        <div class="button-group">
            <a href="login.php" class="btn btn-login">Login</a>
            <a href="reg.php" class="btn btn-register">Register</a>
        </div>
    </div>
</div>

<style>
    .welcome-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 60vh;
        font-family: Arial, sans-serif;
    }
    .welcome-card {
        background: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        text-align: center;
        max-width: 400px;
        width: 100%;
    }
    .welcome-card h1 {
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 26px;
    }
    .welcome-card p {
        color: #7f8c8d;
        margin-bottom: 30px;
        font-size: 15px;
        line-height: 1.5;
    }
    .button-group {
        display: flex;
        gap: 15px;
        justify-content: center;
    }
    .btn {
        flex: 1;
        padding: 12px 20px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.2s, transform 0.1s;
    }
    .btn:active {
        transform: scale(0.98);
    }
    .btn-login {
        background-color: #3498db;
        color: white;
    }
    .btn-login:hover {
        background-color: #2980b9;
    }
    .btn-register {
        background-color: #2ecc71;
        color: white;
    }
    .btn-register:hover {
        background-color: #27ae60;
    }
</style>

<?php
    include("footer.php");
?>
