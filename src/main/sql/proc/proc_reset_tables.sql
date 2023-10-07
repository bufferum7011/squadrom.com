DROP PROCEDURE proc_reset_tables;
CREATE DEFINER=`bufferum`@`%` PROCEDURE `proc_reset_tables`()
BEGIN

    -- Удаляем таблицы, если они ещё существуют
    SET FOREIGN_KEY_CHECKS = 0;
        DROP TABLE IF EXISTS user;
        DROP TABLE IF EXISTS showcase;
    SET FOREIGN_KEY_CHECKS = 1;

    -- Создание таблицы пользователей
    CREATE TABLE user (
        id                 INT AUTO_INCREMENT PRIMARY KEY,                 -- PRIMARY KEY(id)
        login              VARCHAR(300) NULL,                              -- Логин
        email              VARCHAR(300) NULL,                              -- Почта
        password           VARCHAR(300) NULL,                              -- Пароль
        link_avatar        VARCHAR(300) NULL DEFAULT '/img_sys/default_avatar.webp', -- Ссылка на аватарку
        cookie_token       VARCHAR(300) NULL                               -- Cookie_token
    );

    -- Создание таблицы товаров
    CREATE TABLE showcase (
        id              INT AUTO_INCREMENT PRIMARY KEY,                 -- PRIMARY KEY(id)
        seller          INT NULL DEFAULT NULL,                          -- Ссылка на продовца
        name            VARCHAR(300) NULL DEFAULT 'Название товара',    -- Название
        description     VARCHAR(300) NULL DEFAULT 'Описание товара..',  -- Описание
        price           INT NULL DEFAULT 0,                             -- Цена
        img             JSON NULL DEFAULT NULL,                         -- Картинки
        type            VARCHAR(300) NULL DEFAULT 'NONE',               -- Тип товара
        number_likes    INT NULL DEFAULT 0,                             -- Количесво лайков
        number_views    INT NULL DEFAULT 0,                             -- Количесво просмотров
        date            VARCHAR(300) NULL DEFAULT '03.10.23',           -- Когда выложили
        quantity        INT NULL DEFAULT 0,                             -- Количество товара

        FOREIGN KEY (seller) REFERENCES user(id) ON DELETE CASCADE
    );

END