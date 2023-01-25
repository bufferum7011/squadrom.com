<?php
    $mysqli = new mysqli("31.31.196.141", "u1840066_buffer", "hRXZLyLH74n6bcn1", "u1840066_squadrom");
    $mysqli->set_charset("utf-8");
    class my_crypt {
        private $key = "EZ44mFi3TlAey1b2w4Y7lVDuqO+SRxGXsa7nctnr/JmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFK/o9+Y5c83w==";
        private $cipher = "AES-128-CBC";
        private $hash_algo = "sha256";
        private $salt = "9Y-r_3O0";

        function encrypt($word) {
            $ivlen = openssl_cipher_iv_length($this->cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $cipher_text = openssl_encrypt($word, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv);
            $hmac = hash_hmac($this->hash_algo, $cipher_text, $this->key, true);

            return base64_encode($iv . $hmac . $cipher_text);
        }
        function decrypt($word_hash) {
            $word_hash = base64_decode($word_hash);
            $ivlen = openssl_cipher_iv_length($this->cipher);
            $iv = substr($word_hash, 0, $ivlen);
            $hmac = substr($word_hash, $ivlen, $sha2len = 32);
            $cipher_text = substr($word_hash, $ivlen + $sha2len);
            $original_plaintext = openssl_decrypt($cipher_text, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv);
            $calcmac = hash_hmac($this->hash_algo, $cipher_text, $this->key, true);

            if(hash_equals($hmac, $calcmac)) { return $original_plaintext; }
            return false;
        }
        function token_gen(string $token, int $size = 30, $hash = "") {
            foreach(str_split($token) as $char) { if($char != "/") { $hash .= $char; } else { $hash .= "_"; } }
            return substr($hash, 10, $size);
        }
    }
    $my_crypt = new my_crypt();

    class get_login {
        function get_token_full($token_crop) {
            global $mysqli;
            global $my_crypt;
            $result = $mysqli->query("SELECT Token FROM Login");
            while($row = $result->fetch_array()) {
                if($_COOKIE["token"] == $my_crypt->token_gen($row["Token"])) { return $row["Token"]; }
            }
            return false;
        }
    }
    $get_login = new get_login();
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
            $nickname_register = $_POST["nickname_register"];
            $password_register = $my_crypt->encrypt($_POST["password_register"]);
            $token_register = $my_crypt->encrypt($_POST["email_register"]);
            // send data to bd
            $mysqli->query("INSERT INTO `Login` (`Email`, `Password`, `Token`, `Nickname`)
                        VALUES('$email_register', '$password_register', '$token_register', '$nickname_register')");
            $token_register = $my_crypt->token_gen($token_register);
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
            if(($_POST["email_login"] == $row["Email"]) && ($my_crypt->decrypt($row["Password"]) == $_POST["password_login"])) {
                setcookie("token", $my_crypt->token_gen($row["Token"]));
                $key = true; $mysqli->close(); header("Location: cabinet.php"); exit;
            }
        }
        // такоего юзера нет
        if(!$key) { $mysqli->close(); header("Location: index.php"); exit; }
    }    

    // profile change
    if(isset($_POST["edit_profile"])) {
        $token = $get_login->get_token_full($_COOKIE["token"]);
        if(!empty($_POST["set_email"])) {
            $token_new = $my_crypt->encrypt($_POST["set_email"]);
            // update bd
            $mysqli->query("UPDATE `Login` SET `Email` = '{$_POST["set_email"]}', `Token` = '$token_new' WHERE `Token` = '$token'");
            // update cookie
            $token_new = $my_crypt->token_gen($token_new);
            setcookie("token", $token_new);
            // update directory
            mkdir("img/users/" . $token_new);
            move_uploaded_file("img/users/" . $token . "/avatar.png", "img/users/" . $token_new . "/avatar.png");
            dir_del("img/users/" . $token);
            $token = $token_new;
        }
        if(!empty($_POST["set_nickname"])) {
            $token = $get_login->get_token_full($_COOKIE["token"]);
            $mysqli->query("UPDATE `Login` SET `Nickname` = '{$_POST["set_nickname"]}' WHERE `Token` = '$token'");
        }
        if(!empty($_FILES["set_avatar"])) {
            $token = $_COOKIE["token"];
            $link_avatar = "img/users/" . $token . "/avatar.png";
            move_uploaded_file($_FILES["set_avatar"]["tmp_name"], $link_avatar);
            $token = $get_login->get_token_full($token);
            $mysqli->query("UPDATE `Login` SET `Link_avatar` = '$link_avatar' WHERE `Token` = '$token'");
        }
        $mysqli->close(); header("Refresh: 0; url=https://squadrom.com/cabinet.php"); exit;
    }

    // delete account
    if(isset($_POST["profile_delete_account"])) {
        $token = $get_login->get_token_full($_COOKIE["token"]);
        // delete data to bd
        $mysqli->query("DELETE FROM `Login` WHERE `Token` = '$token'");
        // delete directory
        dir_del("img/users/" . $_COOKIE["token"]);
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
            $link_buffer = "img/buffer/" . $my_crypt->token_gen($my_crypt->encrypt((string)$tmp_name), 8) . ".webp";
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

        $json = json_encode($img_arr);
        try {
            $token = $get_login->get_token_full($_COOKIE["token"]);
            $mysqli->query("INSERT INTO `Showcase` (`Token`, `Title`, `Description`, `Price`, `Link_img`)
            VALUES('$token', '{$_POST["product_title"]}', '{$_POST["product_desc"]}', '{$_POST["product_price"]}', '$json')");
        }
        //пользователь ввел пустую строку в названии
        catch(Exception $e) {  }
        $mysqli->close(); header("Location: cabinet.php"); exit;
    }
?>