package squadrom.beans;
import static squadrom.beans.Panel.*;
import java.sql.ResultSet;
import java.sql.SQLException;
import org.springframework.stereotype.Component;
import jakarta.annotation.PostConstruct;
import jakarta.annotation.PreDestroy;

@Component
public class User {

    public int user_id;
    public String user_mail;
    public String user_login;
    public String user_password;
    public String user_link_avatar;
    public String user_cookie_token;

    public boolean key_pass;
    public String title;


    @PostConstruct 
    public void _init() {
        print._init("USER");
    }
    @PreDestroy
    public void _dest() {
        print._dest("USER");
    }


    public User() { }
    public User(String user_cookie_token) throws SQLException {

        user.user_cookie_token = user_cookie_token;
        user.user_link_avatar = "/img_sys/default_avatar.webp";

        ResultSet result = sql.sql_callback("SELECT * FROM user WHERE user_cookie_token = " + user_cookie_token + ";");
        result.next();
        user.user_id = result.getInt("user_id");
        user.user_mail = result.getString("user_mail");
        user.user_login = result.getString("user_login");
        user.user_password = result.getString("user_password");
        user.user_link_avatar = result.getString("user_link_avatar");
    }


    // Создие пользователя
    public void create_user(String user_mail, String user_login, String user_password, String user_cookie_token) {

        sql.sql_update("INSERT INTO user (user_login, user_mail, user_password, user_cookie_token) VALUES(" +
            user_login + ", " +
            user_mail + ", " +
            user_password + ", " +
            user_cookie_token +
        ");");
    }

}