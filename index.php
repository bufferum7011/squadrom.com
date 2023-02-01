<?php
    require_once "handler.php";
    $Showcase = new Showcase();
    $My_crypt = new My_crypt();
    $Login = new Login();
    $Favourite = new Favourite();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Купить дрон - Squadrom</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img_sys/1000new.png">
    <link rel="stylesheet" href="/style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
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
                    ?><button class="header_btn" onclick="window.location.href='cabinet.php#cabinet_add_product'">
                        <img class="header_avatar" src="<?=$Login->get_link_avatar()?>">
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
    
    <!-- showcase -->
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

        <!-- container -->
        <div class="showcase">
            <div class="showcase_title">Свежие объявления</div>
            <?php for($i = 0; $i < $Showcase->get_count(); ) { ?>
                <ul class="showcase_blocks">
                    <?php for($once = 0; $once < 4 && $Showcase->get_count() != $i; $once++) { ?>
                        <li class="showcase_lot">
                            <a href="lot.php?id=<?=$Showcase->get_id_arr($i)?>">
                                <div class="showcase_blocks_title"><?=$Showcase->get_title_arr($i)?></div>
                                <div class="showcase_blocks_description"><?=crop_text($Showcase->get_desc_arr($i))?></div>
                                <div class="showcase_blocks_place_image">
                                    <div class="showcase_blocks_place_image_hidden">
                                        <img class="showcase_blocks_image" src="<?=$Showcase->get_img_arr($i, 0)?>" alt="дрон">
                                    </div>
                                </div>
                            </a>
                            <div class="showcase_blocks_action">
                                <p class="showcase_blocks_action_item"><?=$Showcase->get_price_arr($i)?>рублей</p>
                                <!-- ========= -->
                                <button class="showcase_blocks_action_item" type="button" onclick="btn_like(<?=$Showcase->get_id_arr($i)?>)">
                                    <svg class="showcase_blocks_like" viewBox="0 0 100 100">
                                        <path id="prod_<?=$Showcase->get_id_arr($i)?>" class="showcase_like" d="m24 39.25-1.1-1.05q-5-4.55-8.275-7.85-3.275-3.3-5.175-5.8T6.8 20.075Q6.05 18.1 6.05 16.1q0-3.75 2.525-6.25t6.225-2.5q2.7 0 5.05 1.475Q22.2 10.3 24 13.1q1.95-2.85 4.225-4.3Q30.5 7.35 33.2 7.35q3.7 0 6.225 2.5 2.525 2.5 2.525 6.2 0 2-.75 4t-2.65 4.5q-1.9 2.5-5.175 5.8T25.1 38.2Z"/>
                                    </svg>
                                    <?php if($Favourite->check_favourite($Showcase->get_id_arr($i))) { ?>
                                        <script type="text/javascript">
                                            prod_<?=$Showcase->get_id_arr($i)?>.style.fill = "rgb(188, 64, 64)";
                                        </script>
                                    <?php } ?>
                                </button>
                                <!-- ========= -->
                            </div>
                        </li>
                    <?php $i++; } ?>
                </ul>
            <?php } ?>
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