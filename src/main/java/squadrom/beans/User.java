package squadrom.beans;
import static squadrom.beans.Panel.*;
import java.sql.ResultSet;
import org.springframework.stereotype.Component;
import jakarta.annotation.PostConstruct;
import jakarta.annotation.PreDestroy;

@Component
public class User {

    public int id;
    public String login;
    public String mail;
    public String password;
    public String link_avatar;
    public String cookie_token;
    public boolean authorized;
    public String title;

    // public int getId()              { return id; }
    // public String getLogin()        { return login; }
    // public String getMail()         { return mail; }
    // public String getPassword()     { return password; }
    // public String getLink_avatar()  { return link_avatar; }
    // public String getCookie_token() { return cookie_token; }
    // public boolean isAuthorized()   { return authorized; }
    // public String getTitle()        { return title; }

    // public void setId(int id)                       { this.id = id; }
    // public void setLogin(String login)              { this.login = login; }
    // public void setMail(String mail)                { this.mail = mail; }
    // public void setPassword(String password)        { this.password = password; }
    // public void setLink_avatar(String link_avatar)  { this.link_avatar = link_avatar; }
    // public void setCookie_token(String cookie_token){ this.cookie_token = cookie_token; }
    // public void setAuthorized(boolean authorized)   { this.authorized = authorized; }
    // public void setTitle(String title)              { this.title = title; }

    @PostConstruct
    public void _init() {
        print._init("USER");
    }
    @PreDestroy
    public void _dest() {
        print._dest("USER");
    }


    public User() { }
    public User(String cookie_token) {
        // User user = new User();
        // user.setCookie_token(cookie_token);
        // user.setLink_avatar("/img_sys/default_avatar.webp");


        user.cookie_token = cookie_token;
        user.link_avatar = "/img_sys/default_avatar.webp";

        try {

            ResultSet result = sql.sql_callback("SELECT * FROM user WHERE user_cookie_token = '" + cookie_token + "';");
            result.next();
            // user.setId(result.getInt("user_id"));
            // user.setLogin(result.getString("user_login"));
            // user.setMail(result.getString("user_mail"));
            // user.setPassword(result.getString("user_password"));
            // user.setLink_avatar(result.getString("user_link_avatar"));

            user.id = result.getInt("user_id");
            user.login = result.getString("user_login");
            user.mail = result.getString("user_mail");
            user.password = result.getString("user_password");
            user.link_avatar = result.getString("user_link_avatar");
        }
        catch(Exception e) { print.error("[ERROR]"); }
    }


    // Создие пользователя
    public void user_create(String user_mail, String user_login, String user_password, String user_cookie_token) {

        sql.sql_update("INSERT INTO user (user_login, user_mail, user_password, user_cookie_token) VALUES('" +
            user_login + "', '" +
            user_mail + "', '" +
            user_password + "', '" +
            user_cookie_token +
        "');");
    }

}