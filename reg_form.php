<div class="form-container">
    <h2>Registration</h2>
    <?php
    if($error) {
    ?>
        <p style="color: red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php
    }
    ?>
    <form action="reg_check_post.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter your full name">
        </div>

        <div class="form-group">
            <label for="email">Corporative email:</label>
            <input type="email" id="email" name="email" required placeholder="name@astanait.edu.kz">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Enter password">
        </div>

        <div class="form-group">
            <label for="reppassword">Repeat password:</label>
            <input type="password" id="reppassword" name="reppassword" required placeholder="Enter password">
        </div>

        <div class="form-group">
            <label for="role">Select your role at the university:</label>
            <select id="role" name="role" required>
                <option value="">Please choose a role</option>
                <option value="student">Student</option>
                <option value="professor">Professor</option>
                <option value="administator">Administration</option>
                <option value="technical stuff">Technical stuff</option>
                <option value="other">Other</option>
            </select>
        </div>

        <button type="submit" class="submit-btn">Create an account</button>
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
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccd1d9;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 14px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-group input:focus,
    .form-group select:focus {
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

//reg_form.php
