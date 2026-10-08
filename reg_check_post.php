<?php
//reg_check_post.php

session_start();

$DBhost = getenv('DB_HOST');
$DBname = getenv('DB_NAME');
$DBusername = getenv('DB_USER');
$DBpassword = getenv('DB_PASSWORD');
function Emails_CheckDB($email){
    global $DBhost, $DBname, $DBusername, $DBpassword;
    $dsn = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
    $pdo = new PDO($dsn, $DBusername, $DBpassword);
    $sql = "SELECT id FROM users WHERE email=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if($stmt->fetch()){
        header("Location: reg.php?error=names");
        exit();
    }
}

function Data_To_DB($name, $email, $role, $password){
    global $DBhost, $DBname, $DBusername, $DBpassword;
    $dsn = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
    $pdo = new PDO($dsn, $DBusername, $DBpassword);
    $sql = "INSERT INTO users  (name, email, role, password, date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $role, md5($password), date('F j, Y')]); //хеширование надо будет нормальное сделать
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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $repeat = $_POST['reppassword'];

    //password repeat-check
    if ($password != $repeat){
        header("Location: reg.php?error=passwords");
        exit();
    }
    Emails_CheckDB($email);
    Data_To_DB($name, $email, $role, $password);

    $userArr = User_data_fetch($email);
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
    header("Location: reg.php?error=unknown");
}

?>
