<?php
//login_check_post.php

session_start();
$session_id = session_id();

$DBhost = getenv('DB_HOST');
$DBname = getenv('DB_NAME');
$DBusername = getenv('DB_USER');
$DBpassword = getenv('DB_PASSWORD');

function Email_check($email){
    global $DBhost, $DBname, $DBusername, $DBpassword;
    $dsn = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
    $pdo = new PDO($dsn, $DBusername, $DBpassword);
    $sql = "SELECT email FROM users WHERE email=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    return !empty($stmt->fetch());
}

function Password_fetch($email){
    global $DBhost, $DBname, $DBusername, $DBpassword;

    $dsn = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
    $pdo = new PDO($dsn, $DBusername, $DBpassword);
    $sql = "SELECT password FROM users WHERE email=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $password_fdb = $stmt->fetchColumn();
    return $password_fdb;
}

function User_data_fetch($email){
    global $DBhost, $DBname, $DBusername, $DBpassword;

    $dsn = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
    $pdo = new PDO($dsn, $DBusername, $DBpassword);
    $sql = "SELECT id, name, email, role, date FROM users WHERE email=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $userArr = User_data_fetch($email);

    if(Email_check($email)){
        if($password == Password_fetch($email)){
            $_SESSION['user_id'] = $userArr['id'];
            $_SESSION['username'] = $userArr['name'];
            $_SESSION['email'] = $userArr['email'];
            $_SESSION['userrole'] = $userArr['role'];
            $_SESSION['regdate'] = $userArr['date'];
            $_SESSION['session_id'] = session_id();
            header("Location: index.php");
            exit();
        }
        else{
            header("Location: login.php?error=password");
            exit;
        }
    }
    else{
        header("Location: login.php?error=email");
        exit;
    }
}

?>
