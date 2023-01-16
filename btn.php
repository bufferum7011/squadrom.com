<?php
    $mysql = new mysqli("31.31.196.141", "u1840066_buffer", "hRXZLyLH74n6bcn1", "u1840066_squadrom");
    $mysql->set_charset("utf-8");
    
    // Вход пользователя
    if(isset($_POST["enter_login"])) {
        // Чтение данныех с input
        $email_login = $_POST['email_login'];
        $password_login = $_POST['password_login'];
        // поиск на существование такого пользователя
        if($result = $mysql->query("SELECT * FROM Login")) {
            $key = false;
            while($row = $result->fetch_array()) {
                $emailChaeck = $row["Email"];
                $passwordCheck = $row["Password"];
                //проверка на данный и в базы
                if(($emailChaeck == $email_login) && ($passwordCheck == $password_login)) {
                    $key = true;
                    header("Location: cabinet.php");
                    exit;
                }
            }
            if(!$key) { header("Location: index.php"); exit; }
        }
    }

    // Добавление нового пользователя
    if(isset($_POST["enter_register"])) {
        // Чтение данныех с input
        $email_register = $_POST['email_register'];
        $password_register = $_POST['password_register'];
        try {
            $mysql->query("INSERT INTO `Login` (`Email`, `Password`) VALUES('$email_register', '$password_register')");
            header("Location: cabinet.php");
            exit;
        }
        catch(Exception $e) {
            header("Location: index.php");
            exit;
        }
    }
?>