<?php
    if(isset($_POST['#btnLogin'])) {
        //Получения значений из форм и подключение к бд
        $email = $_POST['email'];
        $password = $_POST['password'];
        $mysql = new mysqli("31.31.196.141", "u1840066_solar", "hRXZLyLH74n6bcn1", "u1840066_sls");
        $mysql->set_charset("utf-8");
        
        //Поиск логина в бд
        $result = $mysql->query("SELECT * FROM Login");
        $rowsCount = $result->num_rows; //количество полученных строк
        global $idCheck, $emailChaeck, $passwordCheck;

        while($row2 = mysqli_fetch_array($result)) {
            $emailChaeck1 = $row2["Email"];
            if($emailChaeck1 == $email) {
                $idCheck = $row2["Id"];
                $emailChaeck = $row2["Email"];
                $passwordCheck = $row2["Password"];
            }
        }
        
        //Предастовление или отказ в доступе
        if(($email == $emailChaeck) && ($password == $passwordCheck)) {
            if($email == "bufferum@yandex.ru") {
                header('Location: http://triple-sls.com/php/add_product.php');
                exit();
            }
            else { ?> loginOK(); <?php }
        }
        else { ?> loginNO(); <?php }

        //Очистка данных
        $email = null;
        $idCheck = null;
        $emailChaeck = null;
        $passwordCheck = null;
        $result->free();
        $mysql->close();
    }

    //Регистрация пользователя
    if(isset($_POST['#btnRegister'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $mysql = new mysqli("31.31.196.141", "u1840066_solar", "hRXZLyLH74n6bcn1", "u1840066_sls");
        $mysql->set_charset("utf-8");

        //Поиск логина в бд
        $sql = "INSERT INTO `Login` (`Email`, `Password`) VALUES('$email', '$password')";
        if($mysql->query($sql)) { ?> registerOK(); <?php }
        else { ?> registerNO(); <?php }
        
        $mysql->close();
    }
    
?>