<?php
    if(isset($_GET["id"])) {
        require_once "handler.php";
        $My_crypt = new My_crypt();
        $Login = new Login();
        $Showcase = new Showcase($_GET["id"]);
        $Login->get_data_seller($_GET["id"]);
    } else { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$Showcase->get_title_arr(0)?> - Squadrom</title>
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
                if($Login->pass) {
                    ?><button class="header_btn" onclick="window.location.href='cabinet.php'">
                        <img class="header_avatar" src="<?= $Login->get_link_avatar()?>" alt="купить дрон">
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
            <li><input class="modal_input" type="name" name="nickname_register" placeholder="Имя"/></li>
            <li><input class="modal_enter" type="submit" name="enter_register" value="Зарегестрироваться"></li>
            <li><hr></li>
            <li><button class="modal_transition" type="button" onclick="modal_login()">Войти</button></li>
            <li><a class="modal_transition" href="#">Забыли пароль?</a></li>
        </ul>
    </form>
    
    <!-- text -->
    <content class="wrapper">
        <!-- catalog -->
        <div class="showcase_catalog">
            <div class="showcase_title">Каталог</div>
            <div class="showcase_toolbar">
                <!-- search -->
                <input type="text" name="search" placeholder="Найти" autocomplete="off">
                
                <!-- btn_search -->
                <input type="button" name="btn_loop" onclick="btn_search()">

                <!-- btn_filter -->
                <input type="button" name="btn_filter" onclick="btn_filter()">
            </div>
            <ul class="showcase_catalog_selection">
                <li>text_1_text</li>
                <li>text_2_text</li>
                <li>text_3_text</li>
                <li>text_4_text</li>
                <li>text_5_text</li>
            </ul>
        </div>

        <!-- lot -->
        <div class="lot">
            <div class="lot_left">
                <!-- title -->
                <p class="lot_title"><?=$Showcase->get_title_arr(0)?></p>

                <!-- images -->
                <ul class="lot_img">
                    <li><img class="lot_img_big" src="<?= $Showcase->get_img_arr(0, 0)?>"></li>
                    <div class="lot_img_small_frame">
                        <?php for($i = 0; $i < $Showcase->get_count_imgs(); $i++) { ?>
                            <li><img class="lot_img_small" src="<?= $Showcase->get_img_arr(0, $i)?>"></li>
                        <?php } ?>
                    </div>
                </ul>

                <!-- description -->
                <p class="lot_desc"><?= $Showcase->get_desc_arr(0)?></p>
            </div>

            <div class="lot_left hr_vert">
                <!-- price -->
                <p class="lot_price">Цена: <?= $Showcase->get_price_arr(0)?> руб.</p>

                <!-- seller -->
                <ul class="lot_seller">
                    <li>Продавец:</li>
                    <li><img class="header_avatar" src="<?=$Login->get_seller_link_avatar()?>"></li>
                    <li><?=$Login->get_seller_nickname()?></li>
                </ul>
            </div>
        </div>
    </content>

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
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>