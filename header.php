<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : "AITU Canteen"; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
            color: #333;
        }
        nav {
            margin-bottom: 20px;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .nav-links a {
            margin-right: 15px;
            text-decoration: none;
            color: #0066cc;
            font-weight: bold;
        }
        nav .nav-links a:hover {
            text-decoration: underline;
        }
        .signout-form {
            display: inline;
            margin: 0;
            padding: 0;
        }
        .signout-nav-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 6px 14px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .signout-nav-btn:hover {
            background-color: #c0392b;
        }
        footer {
            margin-top: 40px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-links">
            <a href="index.php">Main Page</a>
        </div>
        <?php if (!empty($_SESSION['username'])): ?>
            <form action="index.php" method="GET" class="signout-form">
                <input type="hidden" name="action" value="signout">
                <button type="submit" class="signout-nav-btn">Sign Out</button>
            </form>
        <?php endif; ?>
    </nav>
    <main>

    //header.php
