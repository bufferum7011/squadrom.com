<?php
    class My_crypt {
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
            if(hash_equals($hmac, $calcmac)) { return $original_plaintext; } else { return false; }
        }
    }

    class Showcase {
        private $id_arr = [];
        private $token_arr = [];
        private $title_arr = [];
        private $desc_arr = [];
        private $price_arr = [];
        private $img_arr = [];
        private $time_arr = [];
        private $count = 0;

        // get list products
        public function get_count() { return $this->count; }
        public function get_count_imgs() { return count($this->img_arr[0]); }
        public function get_id_arr(int $i) { return $this->id_arr[$i]; }
        public function get_token_arr(int $i) { return $this->token_arr[$i]; }
        public function get_title_arr(int $i) { return $this->title_arr[$i]; }
        public function get_desc_arr(int $i) { return $this->desc_arr[$i]; }
        public function get_price_arr(int $i) { return $this->price_arr[$i]; }
        public function get_img_arr(int $i, int $j) { return $this->img_arr[$i][$j]; }
        public function get_time_arr(int $i) { return $this->time_arr[$i]; }
        // constructor
        public function __construct($code = "none") {
            $mysqli = new mysqli("31.31.196.141", "u1840066_buffer", "hRXZLyLH74n6bcn1", "u1840066_squadrom");
            $mysqli->set_charset("utf-8");
            $token = get_token_full();
            if($code == "me") {
                $mysqli->multi_query("SELECT count(*) FROM Showcase WHERE `Token` = '$token'; SELECT * FROM Showcase WHERE `Token` = '$token' ORDER BY Id DESC;");
            }
            elseif(is_numeric($code)) {
                $mysqli->multi_query("SELECT count(*) FROM Showcase; SELECT * FROM Showcase WHERE `Id` = '$code' ORDER BY Id DESC;");
            }
            else {
                $mysqli->multi_query("SELECT count(*) FROM Showcase; SELECT * FROM Showcase ORDER BY Id DESC;");
            }
            $key = true;
            do {
                if($result = $mysqli->store_result(MYSQLI_ASSOC)) {
                    foreach($result as $i => $item) {
                        // get Token, Link_img
                        if(!$key) {
                            $this->id_arr[$i] = $item["Id"];
                            $this->token_arr[$i] = $item["Token"];
                            $this->title_arr[$i] = $item["Title"];
                            $this->desc_arr[$i] = $item["Description"];
                            $this->price_arr[$i] = $item["Price"];
                            $this->time_arr[$i] = $item["Time"];
                            $this->img_arr[$i] = json_decode($item["Link_img"]);
                        }
                        // get total count(*)
                        if($key) { foreach($item as $item2) { $this->count = $item2; $key = false; break; } }
                    }
                }
            } while($mysqli->next_result());
            $mysqli->close();
            unset($mysqli);
        }
    }

    class Login {
        // get your data
        private $link_avatar = "img_sys/default_avatar.webp";
        private $nickname = "no-name";
        public $pass = false;
        public function get_link_avatar() { return $this->link_avatar; }
        public function get_nickname() { return $this->nickname; }

        // seller
        private $seller_nickname = "no-name";
        private $seller_link_avatar = "img_sys/default_avatar.webp";
        public function get_seller_nickname() { return $this->seller_nickname; }
        public function get_seller_link_avatar() { return $this->seller_link_avatar; }
        public function get_data_seller($id) {
            $result = exec_sql("SELECT Token FROM Showcase WHERE `Id` = '$id'");
            while($row = $result->fetch_array()) { $token = $row["Token"]; }
            $result = exec_sql("SELECT * FROM Login WHERE `Token` = '$token'");
            while($row = $result->fetch_array()) {
                $this->seller_nickname = $row["Nickname"];
                $this->seller_link_avatar = $row["Link_avatar"];
            }
        }

        public function __construct() {
            if(isset($_COOKIE["token"])) {
                $result = exec_sql("SELECT * FROM Login");
                while($row = $result->fetch_array()) {
                    if($_COOKIE["token"] == token_crop($row["Token"])) {
                        $this->link_avatar = $row["Link_avatar"];
                        $this->nickname = $row["Nickname"];
                        $this->pass = true;
                    }
                }
            }
        }
    }
    
    class Favourite {
        private array $favourite = [];
        private array $id_arr = [];
        private array $title_arr = [];
        private array $desc_arr = [];
        private array $price_arr = [];
        private array $img_arr = [];
        private array $time_arr = [];

        public function get_id_arr(int $i) { return $this->id_arr[$i]; }
        public function get_title_arr(int $i) { return $this->title_arr[$i]; }
        public function get_desc_arr(int $i) { return $this->desc_arr[$i]; }
        public function get_price_arr(int $i) { return $this->price_arr[$i]; }
        public function get_img_arr(int $i, int $j) { return $this->img_arr[$i][$j]; }
        public function get_time_arr(int $i) { return $this->time_arr[$i]; }
        // public function get_favourite(int $i) { return $this->favourite[$i]; }
        public function get_count_favourite() { return count($this->favourite); }
        public function check_favourite($id) {
            if($this->favourite !== null) {
                $key = true;
                for($i = 0; $i < count($this->favourite); $i++) {
                    if($this->favourite[$i] == $id) { $key = false; return true; }
                }
                if($key) { return false; }
            }
            else { return false; }
        }
        public function set_favourite($id) {
            $key = false;
            $result = exec_sql("SELECT Favourite FROM Favourite");
            while($row = $result->fetch_array()) { if($row["Favourite"] == $id) { $key = true; } }
            if($key) { exec_sql("DELETE FROM `Favourite` WHERE `Favourite` = '$id'"); }
            else { exec_sql("INSERT INTO `Favourite` (`Token`, `Favourite`) VALUES('{$_COOKIE['token']}', '$id')"); }
            header("Location: index.php"); exit;
        }
        
        public function __construct() {
            if(isset($_COOKIE["token"])) {
                $token  = $_COOKIE["token"];
                $result_count_favourite = exec_sql("SELECT * FROM Favourite WHERE Token = '$token'");
                $i = 0;
                while($row = $result_count_favourite->fetch_array()) {
                    $this->favourite[$i] = $row['Favourite']; $i++;
                }

                $result = exec_sql("SELECT Showcase.* FROM Showcase, Favourite WHERE Showcase.Id = Favourite.Favourite AND Favourite.Token = '$token'");
                
                $i = 0;
                while($row = $result->fetch_array()) {
                    $this->id_arr[$i] = $row["Id"];
                    $this->title_arr[$i] = $row["Title"];
                    $this->desc_arr[$i] = $row["Description"];
                    $this->price_arr[$i] = $row["Price"];
                    $this->time_arr[$i] = $row["Time"];
                    $this->img_arr[$i] = json_decode($row["Link_img"]);
                    $i++;
                }
            }
        }
    }

    // execute_sql
    function exec_sql(string $sql, int $quantity = 1) {
        $mysqli = new mysqli("31.31.196.141", "u1840066_buffer", "hRXZLyLH74n6bcn1", "u1840066_squadrom");
        $mysqli->set_charset("utf-8");
        if($quantity == 1) { $result = $mysqli->query($sql); }
        else { $result = $mysqli->query($sql); }
        $mysqli->close();
        unset($mysqli);
        return $result;
    }

    // token_crop
    function token_crop(string $token, int $size = 30, $hash = "") {
        foreach(str_split($token) as $char) { if($char != "/") { $hash .= $char; } else { $hash .= "_"; } }
        return substr($hash, 10, $size);
    }

    // get_token_full
    function get_token_full() {
        if(isset($_COOKIE["token"])) {
            $result = exec_sql("SELECT Token FROM Login");
            while($row = $result->fetch_array()) {
                if($_COOKIE["token"] == token_crop($row["Token"])) { return $row["Token"]; }
            }
            return false;
        }
    }

    // crop_text
    function crop_text($text) { return substr($text, 0, 26) . ".."; }

    // delete_directory
    function dir_del($dir) {
        $files = array_diff(scandir($dir), array('.', '..')); 
        foreach($files as $file) { is_dir("$dir/$file") ? dir_del("$dir/$file") : unlink("$dir/$file"); }
        return rmdir($dir);
    }
    
    // register
    if(isset($_POST["enter_register"])) {
        try {
            // getting user data
            $My_crypt = new My_crypt();
            $email_register = $_POST["email_register"];
            $nickname_register = $_POST["nickname_register"];
            $password_register = $My_crypt->encrypt($_POST["password_register"]);
            $token_register = $My_crypt->encrypt($_POST["email_register"]);
            // send data to bd
            exec_sql("INSERT INTO `Login` (`Email`, `Password`, `Token`, `Nickname`)
                        VALUES('$email_register', '$password_register', '$token_register', '$nickname_register')");
            $token_register = token_crop($token_register);
            setcookie("token", $token_register);
            // create folder for user
            mkdir("img/users/" . $token_register, 0777, true);
            header("Location: cabinet.php"); exit;
        }
        // такой пользователь уже есть
        catch(Exception $e) { header("Location: index.php"); exit; }
    }

    // login
    if(isset($_POST["enter_login"])) {
        $My_crypt = new My_crypt();
        $key = false;
        $result = exec_sql("SELECT * FROM Login");
        while($row = $result->fetch_array()) {
            // authorization verification by token
            if(($_POST["email_login"] == $row["Email"]) && ($My_crypt->decrypt($row["Password"]) == $_POST["password_login"])) {
                setcookie("token", token_crop($row["Token"]));
                $key = true; header("Location: cabinet.php"); exit;
            }
        }
        // такоего юзера нет
        if(!$key) { header("Location: index.php"); exit; }
    }    

    // profile change
    if(isset($_POST["edit_profile"])) {
        $token = get_token_full();
        $My_crypt = new My_crypt();
        if(!empty($_POST["set_email"])) {
            $token_new = $My_crypt->encrypt($_POST["set_email"]);
            // update bd
            exec_sql("UPDATE `Login` SET `Email` = '{$_POST["set_email"]}', `Token` = '$token_new' WHERE `Token` = '$token'");
            // update cookie
            $token_new = token_crop($token_new);
            setcookie("token", $token_new);
            // update directory
            mkdir("img/users/" . $token_new);
            move_uploaded_file("img/users/" . $token . "/avatar.png", "img/users/" . $token_new . "/avatar.png");
            dir_del("img/users/" . $token);
            $token = $token_new;
        }
        if(!empty($_POST["set_nickname"])) {
            $token = get_token_full();
            exec_sql("UPDATE `Login` SET `Nickname` = '{$_POST["set_nickname"]}' WHERE `Token` = '$token'");
        }
        if(!empty($_FILES["set_avatar"])) {
            $token = $_COOKIE["token"];
            $link_avatar = "img/users/" . $token . "/avatar.png";
            move_uploaded_file($_FILES["set_avatar"]["tmp_name"], $link_avatar);
            $token = get_token_full();
            exec_sql("UPDATE `Login` SET `Link_avatar` = '$link_avatar' WHERE `Token` = '$token'");
        }
        header("Refresh: 0; url=https://squadrom.com/cabinet.php"); exit;
    }

    // delete account
    if(isset($_POST["profile_delete_account"])) {
        $token = get_token_full();
        // delete data to bd
        exec_sql("DELETE FROM `Login` WHERE `Token` = '$token'");
        // delete directory
        dir_del("img/users/" . $_COOKIE["token"]);
        // delete cookie
        setcookie("token", "", time() - 3600);
        header("Location: index.php"); exit;
    }

    // logout from account
    if(isset($_POST["profile_logout"])) { setcookie("token", "", time() - 3600); header("Location: index.php"); exit; }

    // add_product
    if(isset($_POST["product_post"])) {
        $img_arr = [];
        $My_crypt = new My_crypt();
        foreach($_FILES["product_img"]["tmp_name"] as $i => $tmp_name) {
            // 1.1. upload img[] to temporary folder "buffer"
            // 1.2. тут должен быть также вывод сразу в cabinet_add_product
            $link_buffer = "img/buffer/" . token_crop($My_crypt->encrypt((string)$tmp_name), 8) . ".webp";
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
            $token = get_token_full();
            exec_sql("INSERT INTO `Showcase` (`Token`, `Title`, `Description`, `Price`, `Link_img`)
            VALUES('$token', '{$_POST["product_title"]}', '{$_POST["product_desc"]}', '{$_POST["product_price"]}', '$json')");
        }
        //пользователь ввел пустую строку в названии
        catch(Exception $e) {  }
        header("Location: cabinet.php"); exit;
    }

    // 1) delete_product
    // 2) like
    if(isset($_GET["id"]) && isset($_GET["code"])) {
        $id = $_GET["id"];
        $code = $_GET["code"];
        if($code == "del_prod") {
            exec_sql("DELETE FROM `Showcase` WHERE `Id` = '$id'");
            header("Location: cabinet.php"); exit;
        }
        elseif($code == "like") {
            if(isset($_COOKIE["token"])) {
                $Favourite = new Favourite();
                $Favourite->set_favourite($id);
                header("Location: cabinet.php"); exit;
            }
            else {
                echo "<script language='javascript'>
                        alert('Для начала войдите в аккаунт');
                        window.location.href = 'index.php';
                    </script>";
                exit;
            }
        }
    }
?>