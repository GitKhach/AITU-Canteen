<?php
    session_start();

    $DBhost = getenv('DB_HOST');
    $DBname = getenv('DB_NAME');
    $DBusername = getenv('DB_USER');
    $DBpassword = getenv('DB_PASSWORD');
    function Check_Password($entered_password, $id){
        global $DBhost, $DBname, $DBusername, $DBpassword;

        $dsn = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
        $pdo = new PDO($dsn, $DBusername, $DBpassword);

        $sql = "SELECT password FROM users WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        if (md5($entered_password) == $stmt->fetchColumn()){
            return true;
        }
        else{
            return false;
        }
    }
    function email_DB_check($new_email){
        global $DBhost, $DBname, $DBusername, $DBpassword;
        $dsn = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
        $pdo = new PDO($dsn, $DBusername, $DBpassword);
        $sql = "SELECT id FROM users WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$new_email]);
        if($stmt->fetch()){
            return true;
        }
        else {
            return false;
        }
    }
    function email_update($new_email, $id){
        global $DBhost, $DBname, $DBusername, $DBpassword;
        $dsn = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
        $pdo = new PDO($dsn, $DBusername, $DBpassword);

        $sql = "UPDATE users SET email=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$new_email, $id]);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $password = $_POST['email_password'];
        $nemail = $_POST['new_email'];
        if(Check_Password($password, $_SESSION['user_id'])){
            if(!email_DB_check($nemail)){
                email_update($nemail, $_SESSION['user_id']);
                $_SESSION['email'] = $nemail;

                header("Location: profile.php?message=email");
                exit();
            }
            else{
                header("Location: email_change.php?error=email");
                exit();
            }
        }
        else{
            header("Location: email_change.php?error=password");
            exit();
        }
    }
    else{
        header("Location: email_change.php");
        exit();
    }
?>
