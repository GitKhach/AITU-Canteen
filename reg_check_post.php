<?php
//добавил проверк на совпадение имен, добавил проверку на правильноть пароля (двойной ввод), вцелом больше ничо не трогал,
// это какой то бардак блядский, вынеси все в функцию и делай все в функциях впред, потому что уже начинается
// спагетти код, потом сделай сначала логин, а потом уже авторизацию
function Data_To_File($name, $email, $role, $password){
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
}

function Names_Check($name){
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
}

function Data_To_DB($DBhost, $DBname, $DBusername, $DBpassword, $name, $email, $role, $password){
    $dsn = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
    $pdo = new PDO($dsn, $DBusername, $DBpassword);
    $sql = "INSERT INTO users  (name, email, role, password) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $role, md5($password)]);
}

session_start();
$session_id = session_id();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $repeat = $_POST['reppassword'];

    $DBhost = getenv('DB_HOST');
    $DBname = getenv('DB_NAME');
    $DBusername = getenv('DB_USER');
    $DBpassword = getenv('DB_PASSWORD');

    //password repeat-check
    if ($password != $repeat){
        header("Location: reg.php?error=passwords");
        exit();
    }
    Names_Check($name);

    Data_To_File($name, $email, $role, $password);

    DataBase_Logic($DBhost, $DBname, $DBusername, $DBpassword, $name, $email, $role, $password);

    $_SESSION['username'] = $name;

    header("Location: index.php");
    exit();
}
else{
    header("Location: reg_form.php");
}

?>
