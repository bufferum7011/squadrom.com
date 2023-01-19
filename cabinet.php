<?php
    $GLOBALS["pass"] = false;
    if(isset($_COOKIE["token"])) {
        $mysql = new mysqli("31.31.196.141", "u1840066_buffer", "hRXZLyLH74n6bcn1", "u1840066_squadrom");
        $mysql->set_charset("utf-8");
        $bd_arr = $mysql->query("SELECT * FROM Login");
    
        $GLOBALS["token"] = $_COOKIE["token"];
        $GLOBALS["nickname"] = "no-name";
        $GLOBALS["link_avatar"] = null;
        while($row = $bd_arr->fetch_array()) {
            // getting user data
            if($_COOKIE["token"] == $row["Token"]) {
                $email = $row["Email"];
                $nickname = $row["Nickname"];
                $link_avatar = $row["Link_avatar"];
                $pass = true;
            }
        }
        $mysql->close();
    }
    else { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Личный кабинет - Squadrom</title>
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
            <button class="header_btn" onclick="window.location.href='bookmark.php'">Избранное</button>
            <?php
                if($pass) {
                    ?><button class="header_btn" onclick="window.location.href='cabinet.php'">
                        <img class="header_avatar" src="<?php echo $link_avatar;?>" alt="купить дрон">
                    </button><?php
                }
                else { ?><button class="header_btn" onclick="modal_login()">Войти</button><?php }
            ?>
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

    <!-- cabinet -->
    <content class="cabinet">
        <div class="cabinet_profile">
            <div class="cabinet_title">Профиль</div>
            <img class="cabinet_avatar" src="<?php echo $link_avatar;?>" alt="купить дрон">
            <div class="cabinet_name"> <?php echo $nickname; ?> </div>
            <ul>
                <li class="cabinet_select_item">
                    <a href="#cabinet_edit">
                        <img class="cabinet_select_item_img" src="img_sys/pen.png" alt="купить дрон">Редактировать
                    </a>
                </li>
                <li class="cabinet_select_item"><a href="#cabinet_item_1">Избранное</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_2">Мои заказы</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_3">Статус заказа</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_4">Мои отзывы</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_5">Доставка</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_6">Настройки</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_7">Помощь</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_exit" style="color: rgb(188, 82, 82);">Выход</a></li>
            </ul>
        </div>
        <div class="cabinet_content">
            <!-- add_product -->
            <form class="cabinet_item" id="cabinet_edit" action="handler.php" method="post" enctype="multipart/form-data">
                <div class="cabinet_title">Редактирование профиля</div><hr>
                <ul class="cabinet_edit">
                    <li><p class="cabinet_subtitle">Изменить почту</p></li>
                    <li><input class="cabinet_edit_input" name="set_email" type="email"/></li>
                    <li><input class="cabinet_edit_input" name="edit_email" type="submit" value="Добавить"></li>
                </ul>
                <ul class="cabinet_edit">
                    <li><p class="cabinet_subtitle">Изменить имя</p></li>
                    <li><input class="cabinet_edit_input" name="set_nickname" type="text"/></li>
                    <li><input class="cabinet_edit_input" name="edit_nickname" type="submit" value="Добавить"></li>
                </ul>
                <ul class="cabinet_edit">
                    <li><p class="cabinet_subtitle">Изменить фотографию</p></li>
                    <li><input class="cabinet_edit_input" name="set_avatar" type="file"/></li>
                    <li><input class="cabinet_edit_input" name="edit_avatar" type="submit" value="Добавить"></li>
                </ul>
            </form>
            <div class="cabinet_item" id="cabinet_item_1">
                <div class="cabinet_title">Избранное</div><hr>
                Cabinet_item_1. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_2">
                <div class="cabinet_title">Мои заказы</div><hr>
                Cabinet_item_2. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_3">
                <div class="cabinet_title">Статус заказа</div><hr>
                Cabinet_item_3. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_4">
                <div class="cabinet_title">Мои отзывы</div><hr>
                Cabinet_item_4. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_5">
                <div class="cabinet_title">Доставка</div><hr>
                Cabinet_item_5. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_6">
                <div class="cabinet_title">Настройки</div><hr>
                Cabinet_item_6. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_item_7">
                <div class="cabinet_title">Помощь</div><hr>
                Cabinet_item_7. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error alias quisquam non quas asperiores labore aut? Non, necessitatibus quae deserunt dignissimos temporibus earum corrupti unde similique dicta inventore magnam saepe.
            </div>
            <div class="cabinet_item" id="cabinet_exit">
                <div class="cabinet_title">Выход</div><hr>
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