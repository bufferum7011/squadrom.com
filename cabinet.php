<!DOCTYPE html>
<html lang="en">
<head>
    <title>Личный кабинет - Squadrom</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/1000new.png">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <!-- header -->
    <header>
        <!-- label -->
        <a class="header_label" onclick="window.location.href='index.php'">
            <div class="header_barrier"><img class="header_logo" src="img/1000new.png"/></div>
            <p class="header_title">Squadrom</p>
        </a>
        
        <!-- nav -->
        <div class="header_nav">
            <button class="header_btn" onclick="window.location.href='club.php'">Клуб</button>
            <button class="header_btn" onclick="window.location.href='about.php'">О нас</button>
            <button class="header_btn" onclick="window.location.href='bookmark.php'">Избранное</button>
            <button class="header_btn" onclick="modal_login()">Войти</button>
        </div>
    </header>
    <!-- modal_window -->
    <form class="modal_window" id="modal_window" action="hendler.php" method="post" data-modal>
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

    <!-- cabinet -->
    <content class="cabinet">
        <div class="cabinet_profile">
            <div class="cabinet_title">Ваш профиль</div>
            <div class="content_avatar"></div>
            <div class="content_name">Bufferum</div>
            <button class="content_edit" onclick="btn_edit()"><img src="img/pen.png" alt="edit">Редактировать</button>
            <ul>
                <li class="cabinet_select_item"><a href="#cabinet_item_1">Избранное</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_2">Мои заказы</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_3">Статус заказа</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_4">Мои отзывы</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_5">Доставка</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_6">Настройки</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_7">Помощь</a></li>
            </ul>
        </div>
        <div class="cabinet_content">
            <div class="cabinet_item" id="cabinet_item_1" >
                <div class="cabinet_title">Избранное</div><hr>
                <div class="cabinet_empty">Список пуст </div>
                Cabinet_item_1. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_2">
                <div class="cabinet_title">Мои заказы</div><hr>
                <div class="cabinet_empty">Список пуст </div>
                Cabinet_item_2. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_3">
                <div class="cabinet_title">Статус заказа</div><hr>
                <div class="cabinet_empty">Список пуст </div>
                Cabinet_item_3. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_4">
                <div class="cabinet_title">Мои отзывы</div><hr>
                <div class="cabinet_empty">Список пуст </div>
                Cabinet_item_4. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_5">
                <div class="cabinet_title">Доставка</div><hr>
                <div class="cabinet_empty">Список пуст </div>
                Cabinet_item_5. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_6">
                <div class="cabinet_title">Настройки</div><hr>
                <div class="cabinet_empty">Список пуст </div>
                Cabinet_item_6. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_7">
                <div class="cabinet_title">Помощь</div><hr>
                <div class="cabinet_empty">Список пуст </div>
                Cabinet_item_7. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
        </div>
    </content>

    <!-- footer -->
    <footer>
        <hr><p class="footer_outro">© 2021-2023 Squadrom. Администрация Сайта не несет ответственности за размещаемые Пользователями материалы (в т.ч. информацию и изображения), их содержание и качество.</p>
    </footer>
    <script type="text/javascript" src="/js/script.js"></script>
</body>
</html>