<?php
$mysql = new mysqli("31.31.196.141", "u1840066_buffer", "hRXZLyLH74n6bcn1", "u1840066_squadrom");
$mysql->set_charset("utf-8");

// register
if(isset($_POST["enter_register"])) {
    try {
        $email_register = $_POST["email_register"];
        $password_register = password_hash($_POST["password_register"]."9I-f_Ge1", PASSWORD_DEFAULT);
        $mysql->query("INSERT INTO `Login` (`Email`, `Password`) VALUES('$email_register', '$password_register')");
        header("Location: cabinet.php"); exit;
    }
    catch(Exception $e) { header("Location: index.php"); exit; }
}

// login
if(isset($_POST["enter_login"])) {
    $key = false;
    while($row = $mysql->query("SELECT * FROM Login")->fetch_array()) {
        $emailChaeck = $row["Email"];
        $passwordCheck = $row["Password"];
        //проверка авторизации
        if(($_POST["email_login"] == $emailChaeck) && (password_verify($_POST["password_login"]."9I-f_Ge1", $passwordCheck))) {
            $key = true;
            header("Location: cabinet.php"); exit;
        }
    }
    if(!$key) { header("Location: index.php"); exit; }
}

// Обработка add_product
if(isset($_POST["add_product"])) {

    // $title = $_POST["title"];
    $name = $_FILES["img"]["name"];
    $tmp_name = $_FILES["img"]["tmp_name"];
    move_uploaded_file($tmp_name, "img/" . $name);

}
?>