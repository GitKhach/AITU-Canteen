<div class="form-container">
    <h2>Login</h2>
    <?php
    if($error) {
    ?>
        <p style="color: red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php
    }
    ?>
    <form action="login_check_post.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required placeholder="Enter your email">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password">
        </div>

        <button type="submit" class="submit-btn">Login</button>
    </form>
</div>

<style>
    .form-container {
        max-width: 420px;
        margin: 30px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        font-family: Arial, sans-serif;
    }
    .form-container h2 {
        margin-top: 0;
        margin-bottom: 20px;
        color: #2c3e50;
        text-align: center;
        font-size: 24px;
    }
    .form-group {
        margin-bottom: 18px;
    }
    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #34495e;
        font-size: 14px;
    }
    .form-group input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccd1d9;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 14px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-group input:focus {
        border-color: #3498db;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        outline: none;
    }
    .submit-btn {
        width: 100%;
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.2s;
        margin-top: 10px;
    }
    .submit-btn:hover {
        background-color: #2980b9;
    }
</style>

//login_form.php
