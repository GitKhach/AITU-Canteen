<?php
//добавил проверк на совпадение имен, добавил проверку на правильноть пароля (двойной ввод), вцелом больше ничо не трогал,
// это какой то бардак блядский, вынеси все в функцию и делай все в функциях впред, потому что уже начинается
// спагетти код, потом сделай сначала логин, а потом уже авторизацию
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
$session_id = session_id();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $repeat = $_POST['reppassword'];

    if ($password != $repeat){
        header("Location: reg.php?error=passwords");
        exit();
    }

    $files_usernames = scandir("/var/www/html/data/accounts/");
    $usernames = [];
    foreach($files_usernames as $file){
        if($file == "." or $file == ".." or $file == "counter.txt"){
            continue;
        }
        $username = pathinfo($file, PATHINFO_FILENAME);
        $usernames[] = $username;
        if ($name == $username){
            header("Location: reg.php?error=names");
            exit();
        }
    }

    define("ACC_DIR", "/var/www/html/data/accounts/");
    $filename = ACC_DIR . trim($name) . ".txt";

    $storage = fopen($filename, "w");
    $cfile = fopen(ACC_DIR . "counter.txt", "r+");
    if($storage and $cfile){
        $counter = fread($cfile, filesize(ACC_DIR . "counter.txt"));
        $counter++;
        rewind($cfile);
        fwrite($cfile, $counter);
        $user_id = $counter;
        $password = md5($password);
        fwrite($storage, "name: $name\nemail: $email\nrole: $role\npasswor(md5): $password\nuser_id: $user_id\ndate: " . date("j F Y, H:i:s"));
    }
    else{
        http_response_code(500);
        exit();
    }
    fclose($cfile);
    fclose($storage);

    $_SESSION['username'] = $name;

    header("Location: index.php");
    exit();
}
else{
    header("Location: reg_form.php");
}

?>
