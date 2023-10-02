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

    -- FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE

END