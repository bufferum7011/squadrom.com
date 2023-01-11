<!DOCTYPE html>
<html lang="en">
<head>
    <title>Squadrom - купить дрон</title>
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
            <button class="header_btn" onclick="window.location.href='bookmark.php'">Закладки</button>
            <button class="header_btn" data-modal-btn="modal_login">Войти</button>
        </div>
    </header>
    <!-- login -->
    <form class="login_window" action="btn.php" method="post" data-modal="modal_login">
        <ul class="login">
            <li>
                <p class="login_title">Вход</p>
                <button class="login_close" data-modal-close="modal_close">&times;</button>
            </li>
            <li><input class="login_input" type="email" name="email" placeholder="Почта"/></li>
            <li><input class="login_input" type="password" name="password" placeholder="Пароль"/></li>
            <li><input class="login_enter" type="submit" id="form_login" value="Войти"></li>
            <li><hr></li>
            <li><button class="login_transition" data-modal-btn="modal_register">Регистрация</button></li>
            <li><a class="login_transition" href="#">Забыли пароль?</a></li>
        </ul>
    </form>
    <!-- register -->
    <form class="login_window" action="btn.php" method="post" data-modal="modal_register">
        <ul>
            <li>
                <p class="login_title">Регистрация</p>
                <button class="login_close" data-modal-close="modal_close">&times;</button>
            </li>
            <li><input class="login_input" type="email" name="email" placeholder="Почта"/></li>
            <li><input class="login_input" type="password" name="password" placeholder="Пароль"/></li>
            <li><input class="login_enter" type="submit" id="form_register" value="Зарегестрироваться"></li>
            <li><hr></li>
            <li><button class="login_transition" data-modal-btn="modal_login">Войти</button></li>
            <li><a class="login_transition" href="#">Забыли пароль?</a></li>
        </ul>
    </form>
    
    <!-- showcase -->
    <div class="showcase">
        <!-- catalog -->
        <div class="showcase_catalog">
            <div class="showcase_title">Каталог</div>
            <div class="showcase_toolbar">
                <!-- search -->
                <input type="text" name="search" placeholder="Найти" autocomplete="off">
                
                <!-- btn_search -->
                <input type="button" name="btn_loop" onclick="btn_search(this)">

                <!-- btn_filter -->
                <input type="button" name="btn_filter" onclick="btn_filter(this)">
            </div>
            <ul class="showcase_catalog_selection">
                <li>text_1_text</li>
                <li>text_2_text</li>
                <li>text_3_text</li>
                <li>text_4_text</li>
                <li>text_5_text</li>
            </ul>
        </div>
        
        <!-- container здесь должен будет быть цикл -->
        <div class="showcase_container">
            <div class="showcase_title">Свежие объявления</div>
            <ul class="showcase_blocks">
                <li>
                    <div class="showcase_blocks_title">Дрон Huawei</div>
                    <div class="showcase_blocks_description">Высокоскоростной</div>
                    <div class="showcase_blocks_place_image">
                        <img class="showcase_blocks_image" src="img/drone.png" alt="drone">
                    </div>
                    <ul class="showcase_blocks_action">
                        <li>
                            5.5
                            <img class="showcase_blocks_rating_star" src="img/star.png" alt="rating">
                        </li>
                        <li>30000 руб.</li>
                        <li><button onclick="btn_like(this)"><img class="showcase_blocks_like" src="img/like.png" alt="like"></button></li>
                        <li><button onclick="btn_cart(this)"><img class="showcase_blocks_cart" src="img/cart.png" alt="cart"></button></li>
                    </ul>
                </li>
                <li>
                    <div class="showcase_blocks_title">Дрон Huawei</div>
                    <div class="showcase_blocks_description">Высокоскоростной</div>
                    <div class="showcase_blocks_place_image">
                        <img class="showcase_blocks_image" src="img/drone.png" alt="drone">
                    </div>
                    <ul class="showcase_blocks_action">
                        <li>
                            5.5
                            <img class="showcase_blocks_rating_star" src="img/star.png" alt="rating">
                        </li>
                        <li>30000 руб.</li>
                        <li><button onclick="btn_like(this)"><img class="showcase_blocks_like" src="img/like.png" alt="like"></button></li>
                        <li><button onclick="btn_cart(this)"><img class="showcase_blocks_cart" src="img/cart.png" alt="cart"></button></li>
                    </ul>
                </li>
                <li>
                    <div class="showcase_blocks_title">Дрон Huawei</div>
                    <div class="showcase_blocks_description">Высокоскоростной</div>
                    <div class="showcase_blocks_place_image">
                        <img class="showcase_blocks_image" src="img/drone.png" alt="drone">
                    </div>
                    <ul class="showcase_blocks_action">
                        <li>
                            5.5
                            <img class="showcase_blocks_rating_star" src="img/star.png" alt="rating">
                        </li>
                        <li>30000 руб.</li>
                        <li><button onclick="btn_like(this)"><img class="showcase_blocks_like" src="img/like.png" alt="like"></button></li>
                        <li><button onclick="btn_cart(this)"><img class="showcase_blocks_cart" src="img/cart.png" alt="cart"></button></li>
                    </ul>
                </li>
                <li>
                    <div class="showcase_blocks_title">Дрон Huawei</div>
                    <div class="showcase_blocks_description">Высокоскоростной</div>
                    <div class="showcase_blocks_place_image">
                        <img class="showcase_blocks_image" src="img/drone.png" alt="drone">
                    </div>
                    <ul class="showcase_blocks_action">
                        <li>
                            5.5
                            <img class="showcase_blocks_rating_star" src="img/star.png" alt="rating">
                        </li>
                        <li>30000 руб.</li>
                        <li><button onclick="btn_like(this)"><img class="showcase_blocks_like" src="img/like.png" alt="like"></button></li>
                        <li><button onclick="btn_cart(this)"><img class="showcase_blocks_cart" src="img/cart.png" alt="cart"></button></li>
                    </ul>
                </li>
            </ul>
            <ul class="showcase_blocks">
                <li>
                    <div class="showcase_blocks_title">Дрон Huawei</div>
                    <div class="showcase_blocks_description">Высокоскоростной</div>
                    <div class="showcase_blocks_place_image">
                        <img class="showcase_blocks_image" src="img/drone.png" alt="drone">
                    </div>
                    <ul class="showcase_blocks_action">
                        <li>
                            5.5
                            <img class="showcase_blocks_rating_star" src="img/star.png" alt="rating">
                        </li>
                        <li>30000 руб.</li>
                        <li><button onclick="btn_like(this)"><img class="showcase_blocks_like" src="img/like.png" alt="like"></button></li>
                        <li><button onclick="btn_cart(this)"><img class="showcase_blocks_cart" src="img/cart.png" alt="cart"></button></li>
                    </ul>
                </li>
                <li>
                    <div class="showcase_blocks_title">Дрон Huawei</div>
                    <div class="showcase_blocks_description">Высокоскоростной</div>
                    <div class="showcase_blocks_place_image">
                        <img class="showcase_blocks_image" src="img/drone.png" alt="drone">
                    </div>
                    <ul class="showcase_blocks_action">
                        <li>
                            5.5
                            <img class="showcase_blocks_rating_star" src="img/star.png" alt="rating">
                        </li>
                        <li>30000 руб.</li>
                        <li><button onclick="btn_like(this)"><img class="showcase_blocks_like" src="img/like.png" alt="like"></button></li>
                        <li><button onclick="btn_cart(this)"><img class="showcase_blocks_cart" src="img/cart.png" alt="cart"></button></li>
                    </ul>
                </li>
                <li>
                    <div class="showcase_blocks_title">Дрон Huawei</div>
                    <div class="showcase_blocks_description">Высокоскоростной</div>
                    <div class="showcase_blocks_place_image">
                        <img class="showcase_blocks_image" src="img/drone.png" alt="drone">
                    </div>
                    <ul class="showcase_blocks_action">
                        <li>
                            5.5
                            <img class="showcase_blocks_rating_star" src="img/star.png" alt="rating">
                        </li>
                        <li>30000 руб.</li>
                        <li><button onclick="btn_like(this)"><img class="showcase_blocks_like" src="img/like.png" alt="like"></button></li>
                        <li><button onclick="btn_cart(this)"><img class="showcase_blocks_cart" src="img/cart.png" alt="cart"></button></li>
                    </ul>
                </li>
                <li>
                    <div class="showcase_blocks_title">Дрон Huawei</div>
                    <div class="showcase_blocks_description">Высокоскоростной</div>
                    <div class="showcase_blocks_place_image">
                        <img class="showcase_blocks_image" src="img/drone.png" alt="drone">
                    </div>
                    <ul class="showcase_blocks_action">
                        <li>
                            5.5
                            <img class="showcase_blocks_rating_star" src="img/star.png" alt="rating">
                        </li>
                        <li>30000 руб.</li>
                        <li><button onclick="btn_like(this)"><img class="showcase_blocks_like" src="img/like.png" alt="like"></button></li>
                        <li><button onclick="btn_cart(this)"><img class="showcase_blocks_cart" src="img/cart.png" alt="cart"></button></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <hr>
        <div class="footer_content">
            <img class="footer_image" src="img/t4.png" alt="img">
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