<?php
    $mysql = new mysqli("31.31.196.141", "u1840066_buffer", "hRXZLyLH74n6bcn1", "u1840066_squadrom");
    $mysql->set_charset("utf-8");
    $bd_arr = $mysql->query("SELECT * FROM Login");

    // hashing login/password
    function hashing($email) { return password_hash($email."9Y-r_3O0", PASSWORD_DEFAULT); }
    function crop($hash) { return substr($hash, 10, 30); }

    // register
    if(isset($_POST["enter_register"])) {
        try {
            // getting user data
            $nickname = $_POST["nickname_register"];
            $email_register = $_POST["email_register"];
            $password_register = crop(hashing($_POST["password_register"]));
            $token = crop(hashing($_POST["email_register"]));
            // send data to bd
            $mysql->query("INSERT INTO `Login` (`Email`, `Password`, `Token`, `Nickname`) VALUES('$email_register', '$password_register', '$token', '$nickname')");
            setcookie("token", $token);
            $mysql->close();
            // create folder for user
            mkdir("img/users/" . $token, 0777, true);
            header("Location: cabinet.php");
            exit;
        }
        // такой пользователь уже есть
        catch(Exception $e) { header("Location: index.php"); exit; }
    }

    // login
    if(isset($_POST["enter_login"])) {
        $key = false;
        while($row = $bd_arr->fetch_array()) {
            // authorization verification by token
            if(($_POST["email_login"] == $row["Email"]) && (crop(hashing($_POST["password_login"])) == $row["Password"])) {
                $token = crop(hashing($_POST["email__login"]));
                setcookie("token", $token);
                $mysql->close();
                $key = true;
                header("Location: cabinet.php"); exit;
            }
        }
        // такоего юзера нет
        if(!$key) { $mysql->close(); header("Location: index.php"); exit; }
    }    

    // profile change
    if(isset($_POST["edit_email"])) {
        $email = $_POST["set_email"];
        $token_before = $_COOKIE["token"];
        $token = crop(hashing($_POST["set_email"]));
        $mysql->query("UPDATE `Login` SET `Email` = '$email', `Token` = '$token' WHERE `Token` = '$token_before'");
        setcookie("token", $token);
        header("Location: cabinet.php"); exit;
    }
    if(isset($_POST["edit_nickname"])) {
        $token = $_COOKIE["token"];
        $nickname = $_POST["set_nickname"];
        $mysql->query("UPDATE `Login` SET `Nickname` = '$nickname' WHERE `Token` = '$token'");
        header("Location: cabinet.php"); exit;
    }
    if(isset($_POST["edit_avatar"])) {
        $token = $_COOKIE["token"];
        $link_avatar = "img/users/" . $token . "/avatar.png";
        move_uploaded_file($_FILES["set_avatar"]["tmp_name"], $link_avatar);
        $mysql->query("UPDATE `Login` SET `Link_avatar` = '$link_avatar' WHERE `Token` = '$token'");
        header("Location: cabinet.php"); exit;
    }

    $mysql->close();
?>