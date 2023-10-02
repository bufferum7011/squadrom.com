package squadrom.models;
import static squadrom.beans.Panel.*;
import java.sql.ResultSet;

public class User {

    public int id;
    public String login;
    public String mail;
    public String password;
    public String link_avatar;
    public String cookie_token;
    public boolean authorized;
    public String title;
    public boolean need_check;

    public int getId()              { return id; }
    public String get_login()       { return login; }
    public String get_mail()        { return mail; }
    public String get_password()    { return password; }
    public String get_link_avatar() { return link_avatar; }
    public boolean get_authorized() { return authorized; }
    public String get_cookie_token(){ return cookie_token; }
    public boolean get_need_check() { return need_check; }

    public void set_id(int id)                      { this.id = id; }
    public void set_login(String login)             { this.login = login; }
    public void set_mail(String mail)               { this.mail = mail; }
    public void set_password(String password)       { this.password = password; }
    public void set_link_avatar(String link_avatar) { this.link_avatar = link_avatar; }
    public void set_authorized(boolean authorized)  { this.authorized = authorized; }
    public void set_cookie_token(String cookie_token){ this.cookie_token = cookie_token; }

    public User() {}
    public User(String title, boolean need_check) {
        this.title = title;
        this.need_check = need_check;
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

    public User data_base(User user) {

        try {

            ResultSet result = sql.sql_callback("SELECT * FROM user WHERE user_cookie_token = '" + user.get_cookie_token() + "';");
            result.next();
            user.set_id(result.getInt("user_id"));
            user.set_login(result.getString("user_login"));
            user.set_mail(result.getString("user_mail"));
            user.set_password(result.getString("user_password"));
            user.set_link_avatar(result.getString("user_link_avatar"));
        }
        catch(Exception e) {}
        return user;
    }

}