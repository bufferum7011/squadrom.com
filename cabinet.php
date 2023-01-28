<?php

    $pass = false;
    if(isset($_COOKIE["token"])) {
        $mysqli = new mysqli("31.31.196.141", "u1840066_buffer", "hRXZLyLH74n6bcn1", "u1840066_squadrom");
        $mysqli->set_charset("utf-8");
        require_once "handler.php";
        $Showcase = new Showcase("me");
        $result = $mysqli->query("SELECT * FROM Login");

        $nickname = "no-name";
        $link_avatar = null;
        while($row = $result->fetch_array()) {
            // getting user data
            if($_COOKIE["token"] == token_crop($row["Token"])) {
                $nickname = $row["Nickname"];
                $link_avatar = $row["Link_avatar"];
                $pass = true;
            }
        }
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
                <img class="header_avatar" src="<?=$link_avatar;?>" alt="купить дрон">
            </button>
        </div>
    </header>

    <!-- cabinet -->
    <content class="cabinet">
        <!-- profile -->
        <div class="cabinet_profile">
            <div class="cabinet_title">Профиль</div>
            <div class="cabinet_frame_avatar">
                <img class="cabinet_avatar" src="<?=$link_avatar;?>" alt="купить дрон">
            </div>
            <div class="cabinet_name"> <?php echo $nickname; ?> </div>
            <ul>
                <li class="cabinet_select_item">
                    <a href="#cabinet_edit">
                        <img class="cabinet_select_item_img" src="img_sys/pen.png" alt="купить дрон">Редактировать
                    </a>
                </li>
                <li class="cabinet_select_item"><a href="#cabinet_add_product">Разместить товар</a></li>
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
                                    <li data-product="prod_">
                                        <lable class="showcase_blocks_title"><?=$Showcase->get_title_arr($i)?></lable>
                                        <div class="showcase_blocks_description"><?=crop_text($Showcase->get_desc_arr($i))?></div>
                                        <div class="showcase_blocks_place_image">
                                            <div class="showcase_blocks_place_image_hidden">
                                                <img class="showcase_blocks_image" src="<?=$Showcase->get_img_arr($i, 0)?>" alt="дрон">
                                            </div>
                                        </div>
                                        <ul class="showcase_blocks_action">
                                            <li>5.5<img class="showcase_blocks_rating_star" src="img_sys/star.png" alt="запчасти для дрона"></li>
                                            <li><?=$Showcase->get_price_arr($i)?> рублей</li>
                                            <li><button onclick="btn_like(this)"><img class="showcase_blocks_like" src="img_sys/like.png" alt="like"></button></li>
                                            <li style="color: brown;"><?=$Showcase->get_time_arr($i)?></li>
                                            <li><button class="cabinet_product_delete" onclick="btn_delete_product('<?=$Showcase->get_title_arr($i)?>', <?=$Showcase->get_id_arr($i)?>)" type="button">Удалить</button></li>
                                        </ul>
                                    </li>
                                <?php $i++; } ?>
                            </ul>
                        <?php } ?>

                    </div>
                </div>
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