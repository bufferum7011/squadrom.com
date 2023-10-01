<?php
    if(isset($_COOKIE["token"])) {
        require_once "handler.php";
        $Showcase = new Showcase("me");
        $My_crypt = new My_crypt();
        $Login = new Login();
        $Favourite = new Favourite();
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
            <button class="header_btn" onclick="window.location.href='cabinet.php'">
                <img class="header_avatar" src="<?=$Login->get_link_avatar()?>" alt="купить дрон">
            </button>
        </div>
    </header>

    <!-- cabinet -->
    <content class="cabinet">
        <!-- profile -->
        <div class="cabinet_profile">
            <div class="cabinet_title">Профиль</div>
            <div class="cabinet_frame_avatar">
                <img class="cabinet_avatar" src="<?=$Login->get_link_avatar()?>">
            </div>
            <div class="cabinet_name"> <?=$Login->get_nickname(); ?> </div>
            <ul>
                <li class="cabinet_select_item">
                    <a href="#cabinet_edit">
                        <img class="cabinet_select_item_img" src="img_sys/pen.png" alt="купить дрон">Редактировать
                    </a>
                </li>
                <li class="cabinet_select_item"><a href="#cabinet_add_product">Разместить товар</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_favourites">Избранное</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_2">Мои заказы</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_3">Статус заказа</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_4">Мои отзывы</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_5">Доставка</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_6">Настройки</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_item_7">Помощь</a></li>
                <li class="cabinet_select_item"><a href="#cabinet_exit" style="color: rgb(188, 82, 82);">Выход</a></li>
            </ul>
        </div>

        <!-- content -->
        <div class="cabinet_content">
            <!-- cabinet_edit -->
            <form class="cabinet_item" id="cabinet_edit" action="handler.php" method="post" enctype="multipart/form-data">
                <div class="cabinet_title">Редактирование профиля</div><hr>
                <!-- edit_email-->
                <ul class="cabinet_edit">
                    <li><p class="cabinet_subtitle">Изменить почту</p></li>
                    <li><input class="cabinet_edit_input" name="set_email" type="email"/></li>
                </ul>
                <!-- edit_nickname-->
                <ul class="cabinet_edit">
                    <li><p class="cabinet_subtitle">Изменить имя</p></li>
                    <li><input class="cabinet_edit_input" name="set_nickname" type="text" autocomplete="off"/></li>
                </ul>
                <!-- edit_avatar-->
                <ul class="cabinet_edit">
                    <li><p class="cabinet_subtitle">Изменить фотографию</p></li>
                    <li><input class="cabinet_edit_input" name="set_avatar" type="file"/></li>
                </ul>
                <input class="cabinet_edit_save" name="edit_profile" type="submit" value="Сохранить">
            </form>
            <!-- add_product -->
            <form class="cabinet_item" id="cabinet_add_product" action="handler.php" method="post" enctype="multipart/form-data">
                <div class="cabinet_title">Разместить товар</div><hr>
                <div style="display: flex;">
                    <!-- add_product-->
                    <div class="cabinet_add_product">
                        <!-- title -->
                        <ul class="cabinet_edit">
                            <li><p class="cabinet_subtitle">Название</p></li>
                            <li><input class="cabinet_edit_input" type="text" name="product_title" autocomplete="off"></li>
                        </ul>
                        <!-- description -->
                        <ul class="cabinet_edit cabinet_edit_textarea">
                            <li><p class="cabinet_subtitle">Описание</p></li>
                            <li><textarea class="cabinet_edit_textarea" name="product_desc" autocomplete="off"></textarea></li>
                        </ul>
                        <!-- price -->
                        <ul class="cabinet_edit">
                            <li><p class="cabinet_subtitle">Цена</p></li>
                            <li><input class="cabinet_edit_input" type="text" name="product_price" autocomplete="off"> руб.</li>
                        </ul>
                        <!-- img -->
                        <ul class="cabinet_edit">
                            <li><p class="cabinet_subtitle">Добавить фотографии</p></li>
                            <li><input class="cabinet_edit_input" name="product_img[]" type="file" multiple autocomplete="off"/></li>
                        </ul>
                        <input class="cabinet_edit_save" name="product_post" type="submit" value="Разместить">
                    </div>
                    <!-- user_product -->
                    <div class="hr_vert cabinet_product_scroll">

                        <!-- count product -->
                        <ul style="display: flex;">
                            <li class="cabinet_subtitle">Ваших товаров</li> 
                            <li class="cabinet_subtitle" style="margin: 0px 5px; color: rgb(0, 170, 65);"><?=$Showcase->get_count()?>шт</li>
                        </ul>
                        <?php for($i = 0; $i < $Showcase->get_count(); ) { ?>
                            <ul class="showcase_blocks">
                                <?php for($once = 0; $once < 3 && $Showcase->get_count() != $i; $once++) { ?>
                                    <li class="showcase_lot">
                                        <a href="lot.php?id=<?=$Showcase->get_id_arr($i)?>">
                                            <div class="showcase_blocks_title"><?=$Showcase->get_title_arr($i)?></div>
                                            <div class="showcase_blocks_description"><?=crop_text($Showcase->get_desc_arr($i))?></div>
                                            <div class="showcase_blocks_place_image">
                                                <div class="showcase_blocks_place_image_hidden">
                                                    <img class="showcase_blocks_image" src="<?=$Showcase->get_img_arr($i, 0)?>">
                                                </div>
                                            </div>
                                        </a>
                                        <div class="showcase_blocks_action">
                                            <p class="showcase_blocks_action_item"><?=$Showcase->get_price_arr($i)?>рублей</p>
                                            <button class="cabinet_product_delete" onclick="btn_delete_product('<?=$Showcase->get_title_arr($i)?>', <?=$Showcase->get_id_arr($i)?>)" type="button">Удалить</button>
                                        </div>
                                    </li>
                                <?php $i++; } ?>
                            </ul>
                        <?php } ?>

                    </div>
                </div>
            </form>
            <!-- faforite -->
            <div class="cabinet_item" id="cabinet_favourites">
                <div class="cabinet_title">Избранное</div><hr>
                <div class="cabinet_favourites">
                    <!-- count product -->
                    <?php $count = $Favourite->get_count_favourite(); ?>
                    <ul style="display: flex;">
                        <li class="cabinet_subtitle">Ваших избранных</li> 
                        <li class="cabinet_subtitle" style="margin: 0px 5px; color: rgb(0, 170, 65);"><?= $count; ?>шт</li>
                    </ul>

                    <?php if($count != null || $count != 0) { for($i = 0; $i < $count; ) { ?>
                    <ul class="showcase_blocks">
                        <?php for($once = 0; $once < 1; $once++) { ?>
                            <li class="showcase_lot">
                                <a href="lot.php?id=<?=$Favourite->get_id_arr($i)?>">
                                    <div class="showcase_blocks_title"><?=$Favourite->get_title_arr($i)?></div>
                                    <div class="showcase_blocks_description"><?=crop_text($Favourite->get_desc_arr($i))?></div>
                                    <div class="showcase_blocks_place_image">
                                        <div class="showcase_blocks_place_image_hidden">
                                            <img class="showcase_blocks_image" src="<?=$Favourite->get_img_arr($i, 0)?>">
                                        </div>
                                    </div>
                                </a>
                                <div class="showcase_blocks_action">
                                    <p class="showcase_blocks_action_item"><?=$Favourite->get_price_arr($i)?>рублей</p>
                                    <button class="showcase_blocks_action_item" type="button" onclick="btn_like(<?=$Favourite->get_id_arr($i)?>)">
                                        <svg class="showcase_blocks_like" viewBox="0 0 100 100">
                                            <path id="prod_<?=$Favourite->get_id_arr($i)?>" class="showcase_like" d="m24 39.25-1.1-1.05q-5-4.55-8.275-7.85-3.275-3.3-5.175-5.8T6.8 20.075Q6.05 18.1 6.05 16.1q0-3.75 2.525-6.25t6.225-2.5q2.7 0 5.05 1.475Q22.2 10.3 24 13.1q1.95-2.85 4.225-4.3Q30.5 7.35 33.2 7.35q3.7 0 6.225 2.5 2.525 2.5 2.525 6.2 0 2-.75 4t-2.65 4.5q-1.9 2.5-5.175 5.8T25.1 38.2Z"/>
                                        </svg>
                                        <?php if($Favourite->check_favourite($Favourite->get_id_arr($i))) { ?>
                                        <script type="text/javascript"> prod_<?=$Favourite->get_id_arr($i)?>.style.fill = "rgb(188, 64, 64)";</script>
                                        <?php } ?>
                                    </button>
                                </div>
                            </li>
                        <?php $i++; } ?>
                    </ul>
                    <?php } } else { ?><p style="color: rgb(255, 255, 255); font-size: 25px;">Список пуст</p><?php } ?>
                </div>
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
            <!-- cabinet_exit -->
            <form class="cabinet_item" id="cabinet_exit" action="handler.php" method="post" enctype="multipart/form-data">
                <div class="cabinet_title">Выход</div><hr>
                <ul class="cabinet_edit">
                    <li><p class="cabinet_subtitle">Выйти из аккаунта</p></li>
                    <li><input class="cabinet_logout" type="submit" name="profile_logout" value="Logout"></li>
                </ul>
                <ul class="cabinet_edit">
                    <li><p class="cabinet_subtitle">Удалить аккаунт</p></li>
                    <li><input class="cabinet_logout" type="submit" name="profile_delete_account" value="Delete"></li>
                </ul>
            </form>
        </div>
    </content>

    <!-- footer -->
    <footer>
        <hr><p class="footer_outro">© 2021-2023 Squadrom. Администрация Сайта не несет ответственности за размещаемые Пользователями материалы (в т.ч. информацию и изображения), их содержание и качество.</p>
    </footer>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>