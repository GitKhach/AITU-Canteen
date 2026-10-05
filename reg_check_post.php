<?php

//убери прверку по имени, сделай проверку по почте, начинай делать логин, не забудь сделать проверку почты письмом на почту

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
    $sql = "INSERT INTO users  (name, email, role, password) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $role, md5($password)]); //хеширование надо будет нормальное сделать
}

session_start();
$session_id = session_id();
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

    $_SESSION['username'] = $name;

    header("Location: index.php");
    exit();

}
else{
    header("Location: reg.php?error=unknown");
}

?>
