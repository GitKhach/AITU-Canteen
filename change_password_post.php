<?php
    session_start();

    $DBhost = getenv('DB_HOST');
    $DBname = getenv('DB_NAME');
    $DBusername = getenv('DB_USER');
    $DBpassword = getenv('DB_PASSWORD');

    function User_data_fetch_P($id){
        global $DBhost, $DBname, $DBusername, $DBpassword;

        $dsn = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
        $pdo = new PDO($dsn, $DBusername, $DBpassword);

        $sql = "SELECT id, name, email, role, password, date FROM users WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function Password_update($NewPass, $id){
        global $DBhost, $DBname, $DBusername, $DBpassword;

        $dsn = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
        $pdo = new PDO($dsn, $DBusername, $DBpassword);

        $sql = "UPDATE users SET password=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$NewPass, $id]);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $OldPass = $_POST['current_password'];
        $NewPass = $_POST['new_password'];
        $NewPassRep = $_POST['confirm_password'];

        $userDataArr = User_data_fetch_P($_SESSION['user_id']);

        if(md5($OldPass) == $userDataArr['password']){

            if($NewPass == $NewPassRep){

                Password_update(md5($NewPass), $_SESSION['user_id']);

                header("Location: profile.php");
                exit();
            }
            else{
                header("Location: change_password.php?error=passwordCH");
                exit();
            }

        }
        else{
            header("Location: change_password.php?error=passwordR");
            exit();
        }
    }
    else{
        header("Location: change_password.php");
        exit();
    }
?>
