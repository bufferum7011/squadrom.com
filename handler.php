<?php
$mysql = new mysqli("31.31.196.141", "u1840066_buffer", "hRXZLyLH74n6bcn1", "u1840066_squadrom");
$mysql->set_charset("utf-8");

// hashing and dehashing login/password
function hashing($email) { return password_hash($email, PASSWORD_DEFAULT); }
// function dehashing($email, $token) { return password_verify($email, $token); }
function crop($hash) { return substr($hash, 0, 30); }

// register
if(isset($_POST["enter_register"])) {
    try {
        // чтение данных
        $email_register = $_POST["email_register"];
        $password_register = crop(hashing($_POST["password_register"]));
        $nickname = $_POST["nickname"];
        $token = crop(hashing($_POST["email_register"]));

        // регистрация в базе
        $mysql->query("INSERT INTO `Login` (`Email`, `Password`, `Token`, `Nickname`)
            VALUES('$email_register', '$password_register', '$token', '$nickname')");
        
        //set cookie
        setcookie("token", $token);
        setcookie("email", $email_register);

        if(!mkdir("img/users/" . $token, 0777, true)) {
            echo "<script language='javascript'>alert('Папка не создана');</script>";
        }
        else { header("Location: cabinet.php"); exit; }
    }
    catch(Exception $e) { header("Location: index.php"); exit; }
}

// login
if(isset($_POST["enter_login"])) {
    $key = false;
    while($row = $mysql->query("SELECT * FROM Login")->fetch_array()) {
        //проверка авторизации
        $email_chaeck = $row["Email"];
        $password_chaeck = $row["Password"];
        if(($_POST["email_login"] == $email_chaeck) && (crop(hashing($_POST["password_login"])) == $password_chaeck)) {
            $key = true;
            header("Location: cabinet.php"); exit;
        }
    }
    if(!$key) { header("Location: index.php"); exit; }
}

// Обработка add_product
if(isset($_POST["add_product"])) {

    // $title = $_POST["title"];
    // $name = $_FILES["img"]["name"];
    // $tmp_name = $_FILES["img"]["tmp_name"];
    // move_uploaded_file($tmp_name, "img/" . $name);

}
$mysql->close();
?>