<?php
    $mysqli = new mysqli("31.31.196.141", "u1840066_buffer", "hRXZLyLH74n6bcn1", "u1840066_squadrom");
    $mysqli->set_charset("utf-8");
    function token_gen(string $email, int $size = 30, $hash = "") {
        foreach(str_split($email) as $char) { if($char != "/") { $hash .= $char; } else { $hash .= "_"; } }
        return substr(password_hash($hash."9Y-r_3O0", PASSWORD_DEFAULT), 10, $size);
    }
    function dir_del($dir) { 
        $files = array_diff(scandir($dir), array('.', '..')); 
        foreach($files as $file) { is_dir("$dir/$file") ? dir_del("$dir/$file") : unlink("$dir/$file"); }
        return rmdir($dir);
    }
    
    // register
    if(isset($_POST["enter_register"])) {
        try {
            // getting user data
            $email_register = $_POST["email_register"];
            $password_register = token_gen($_POST["password_register"]);
            $token_register = token_gen($_POST["email_register"]);
            $nickname_register = $_POST["nickname_register"];
            // send data to bd
            $mysqli->query("INSERT INTO `Login` (`Email`, `Password`, `Token`, `Nickname`)
                        VALUES('$email_register', '$password_register', '$token_register', '$nickname_register')");
            setcookie("token", $token_register);
            // create folder for user
            mkdir("img/users/" . $token_register, 0777, true);
            $mysqli->close(); header("Location: cabinet.php"); exit;
        }
        // такой пользователь уже есть
        catch(Exception $e) { $mysqli->close(); header("Location: index.php"); exit; }
    }

    // login
    if(isset($_POST["enter_login"])) {
        $key = false;
        $result = $mysqli->query("SELECT * FROM Login");
        while($row = $result->fetch_array()) {
            // authorization verification by token
            if(($_POST["email_login"] == $row["Email"]) && (token_gen($_POST["password_login"]) == $row["Password"])) {
                setcookie("token", token_gen($_POST["email_login"]));
                $key = true; $mysqli->close(); header("Location: cabinet.php"); exit;
            }
        }
        // такоего юзера нет
        if(!$key) { $mysqli->close(); header("Location: index.php"); exit; }
    }    

    // profile change
    if(isset($_POST["edit_profile"])) {
        $GLOBALS["token"] = $_COOKIE["token"];
        if(!empty($_POST["set_email"])) {
            $token_new = token_gen($_POST["set_email"]);
            // update bd
            $mysqli->query("UPDATE `Login` SET `Email` = '{$_POST["set_email"]}', `Token` = '$token_new' WHERE `Token` = '$token'");
            // update cookie
            setcookie("token", $token_new);
            // update directory
            mkdir("img/users/" . $token_new);
            try { move_uploaded_file("img/users/" . $token . "/avatar.png", "img/users/" . $token_new . "/avatar.png"); }
            catch(Exception $e) { echo "<script language='javascript'>alert('Ещё нет фотографии');</script>"; }
            dir_del("img/users/" . $token);
            $GLOBALS["token"] = $token_new;
        }
        if(!empty($_POST["set_nickname"])) {
            $mysqli->query("UPDATE `Login` SET `Nickname` = '{$_POST["set_nickname"]}' WHERE `Token` = '$token'");
        }
        if(!empty($_FILES["set_avatar"])) {
            $link_avatar = "img/users/" . $token . "/avatar.png";
            move_uploaded_file($_FILES["set_avatar"]["tmp_name"], $link_avatar);
            $mysqli->query("UPDATE `Login` SET `Link_avatar` = '$link_avatar' WHERE `Token` = '$token'");
        }
        $mysqli->close(); header("Refresh: 0; url=https://squadrom.com/cabinet.php"); exit;
    }

    // delete account
    if(isset($_POST["profile_delete_account"])) {
        $GLOBALS["token"] = $_COOKIE["token"];
        // delete data to bd
        $mysqli->query("DELETE FROM `Login` WHERE `Token` = '$token'");
        // delete directory
        dir_del("img/users/" . $token);
        // delete cookie
        setcookie("token", "", time() - 3600);
        $mysqli->close(); header("Location: index.php"); exit;
    }

    // logout from account
    if(isset($_POST["profile_logout"])) { setcookie("token", "", time() - 3600); $mysqli->close(); header("Location: index.php"); exit; }

    // add_product
    if(isset($_POST["product_post"])) {
        $img_arr = [];
        foreach($_FILES["product_img"]["tmp_name"] as $i => $tmp_name) {
            // 1.1. upload img[] to temporary folder "buffer"
            // 1.2. тут должен быть также вывод сразу в cabinet_add_product
            $link_buffer = "img/buffer/" . token_gen((string)$tmp_name, 8) . ".webp";
            move_uploaded_file($tmp_name, $link_buffer);

            //2. set new name
            $product_img_type = (string)$_FILES["product_img"]["type"][$i];
            $is_alpha = false;// property opacity
            if($product_img_type == "image/png") { $img = imagecreatefrompng($link_buffer); $is_alpha = true; }
            elseif($product_img_type == "image/gif") { $img = imagecreatefromgif($link_buffer); $is_alpha = true; }
            elseif($product_img_type == "image/jpeg") { $img = imagecreatefromjpeg($link_buffer); }
            elseif($product_img_type == "image/jpg") { $img = imagecreatefromjpeg($link_buffer); }
            
            //3. converting img to webp
            if($is_alpha) {
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
            }
            imagewebp($img, $link_buffer, 85);
            $img_arr[$i] = $link_buffer;
        }

        // 4. set JSON file for sending
        $json = json_encode($img_arr);
        try {
            $mysqli->query("INSERT INTO `Showcase` (`Token`, `Title`, `Description`, `Price`, `Link_img`)
            VALUES('{$_COOKIE["token"]}', '{$_POST["product_title"]}', '{$_POST["product_desc"]}', '{$_POST["product_price"]}', '$json')");
        }
        //пользователь ввел пустую строку в названии
        catch(Exception $e) {  }
        $mysqli->close(); header("Location: cabinet.php"); exit;
    }
?>