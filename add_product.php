<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../img/1000new.png">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    
    <!--Главная-->
    <nav class="send_file">
        <!-- Заполнение Login -->
        <form class="formLogin" method="post" enctype="multipart/form-data">
            <p class="titileLogin">Добавление продукта</p>
            <input class="login" name="title" type="text" placeholder="Title"/>
            <input class="login" name="photo" type="file"/>
            <input class="loginButton" name="send" type="submit" value="Добавить">
        </form>
    </nav>
</body>
</html>