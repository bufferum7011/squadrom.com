-- Active: 1693916727275@@151.248.117.244@3306@squadrom
DROP PROCEDURE proc_reset_tables;
CREATE DEFINER=`bufferum`@`%` PROCEDURE `proc_reset_tables`()
BEGIN

    -- Удаляем таблицы, если они ещё существуют
    SET FOREIGN_KEY_CHECKS = 0;
        DROP TABLE IF EXISTS user;
        DROP TABLE IF EXISTS setting;
    SET FOREIGN_KEY_CHECKS = 1;

    -- Создание таблицы пользователей
    CREATE TABLE user (
        user_id INT AUTO_INCREMENT PRIMARY KEY,             -- PRIMARY KEY(id_user)
        user_login VARCHAR(300) NULL,                       -- Логин
        user_mail VARCHAR(300) NULL,                        -- Почта
        user_password VARCHAR(300) NULL,                    -- Пароль
        user_link_avatar VARCHAR(300) NULL DEFAULT '/img_sys/default_avatar.webp', -- Ссылка на аватарку
        user_cookie_token VARCHAR(300) NULL                 -- Cookie_token
    );

    -- Создание таблицы заказов
    -- CREATE TABLE list_avatar (
    --     id_order INT AUTO_INCREMENT PRIMARY KEY,            -- PRIMARY KEY(id_order)
    --     id_user INT NOT NULL,                               -- id_user(СВЯЗАН)
    --     order_status VARCHAR(100) NULL DEFAULT "CREATING",  -- Статус заявки
    --     profit INT NULL DEFAULT NULL,                       -- Заработок
	-- 	date_time VARCHAR(100) NULL DEFAULT "01.01.24; 08:00-17:00",-- Дата и время когда на работу('dd-mm-yy; hh:mi')
    --     quantity_workers INT NULL DEFAULT 1,                -- Количество рабочих
	-- 	address VARCHAR(100) NULL DEFAULT NULL,             -- Адресс заказа
	-- 	task VARCHAR(300) NULL DEFAULT NULL,                -- Какая задача

    --     FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
    -- );

    -- Создаем таблицу настроек
    -- CREATE TABLE setting ();

END