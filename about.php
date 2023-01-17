<!DOCTYPE html>
<html lang="en">
<head>
    <title>О Squadrom</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img_sys/1000new.png">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <!-- header -->
    <header>
        <!-- label -->
        <a class="header_label" onclick="window.location.href='index.php'">
            <div class="header_barrier"><img class="header_logo" src="img_sys/1000new.png"/></div>
            <p class="header_title">Squadrom</p>
        </a>
        
        <!-- nav -->
        <div class="header_nav">
            <button class="header_btn" onclick="window.location.href='club.php'">Клуб</button>
            <button class="header_btn" onclick="window.location.href='about.php'">О нас</button>
            <button class="header_btn" onclick="window.location.href='bookmark.php'">Закладки</button>
            <button class="header_btn" data-modal-btn="modal_login">Войти</button>
        </div>
    </header>
    <!-- modal_window -->
    <form class="modal_window" id="modal_window" action="handler.php" method="post" data-modal>
        <!-- login -->
        <ul class="modal" id="modal_login">
            <li>
                <p class="modal_title">Вход</p>
                <button class="modal_close" type="button" onclick="modal_login_close()">&times;</button>
            </li>
            <li><input class="modal_input" type="email" name="email_login" placeholder="Почта"/></li>
            <li><input class="modal_input" type="password" name="password_login" placeholder="Пароль"/></li>
            <li><button class="modal_enter" type="submit" name="enter_login">Войти</button></li>
            <li><hr></li>
            <li><button class="modal_transition" type="button" onclick="modal_register()">Регистрация</button></li>
            <li><a class="modal_transition" href="#">Забыли пароль?</a></li>
        </ul>

        <!-- register -->
        <ul class="modal" id="modal_register">
            <li>
                <p class="modal_title">Регистрация</p>
                <button class="modal_close" type="button" onclick="modal_register_close()">&times;</button>
            </li>
            <li><input class="modal_input" type="email" name="email_register" placeholder="Почта"/></li>
            <li><input class="modal_input" type="password" name="password_register" placeholder="Пароль"/></li>
            <li><input class="modal_enter" type="submit" name="enter_register" value="Зарегестрироваться"></li>
            <li><hr></li>
            <li><button class="modal_transition" type="button" onclick="modal_login()">Войти</button></li>
            <li><a class="modal_transition" href="#">Забыли пароль?</a></li>
        </ul>
    </form>
    
    <p style="margin-top: 50px;">Тут будет о нас</p>
    <p>Обещаю</p>

    <!-- footer -->
    <footer>
        <hr>
        <div class="footer_content">
            <img class="footer_image" src="img_sys/t4.png" alt="купить дрон">
            <ul class="footer_block">
                <div class="footer_title"><p>Компания</p></div>
                <li><a href="about.html">О нас</a></li>
                <li><a href="club.html">Клуб</a></li>
                <li><a href="#">Вакансии</a></li>
                <li><a href="#">Персональные данные</a></li>
            </ul>
            <ul class="footer_block">
                <div class="footer_title"><p>Пользователям</p></div>
                <li><a href="#">Доставка</a></li>
                <li><a href="#">Как оформить заказ</a></li>
                <li><a href="#">Способы оплаты</a></li>
                <li><a href="#">Статус заказа</a></li>
                <li><a href="#">Обмен, возврат, гарантия</a></li>
                <li><a href="#">Бонусная программа</a></li>
                <li><a href="#">Подарочный стикеры</a></li>
                <li><a href="#">Помощь</a></li>  
            </ul>
        </div>
        <hr>
        <p class="footer_outro">© 2021-2023 Squadrom. Администрация Сайта не несет ответственности за размещаемые Пользователями материалы (в т.ч. информацию и изображения), их содержание и качество.</p>
    </footer>
    <script type="text/javascript" src="/js/script.js"></script>
</body>
</html>