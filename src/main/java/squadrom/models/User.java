package squadrom.models;
import static squadrom.beans.Panel.*;
import java.sql.ResultSet;

public class User {

    private int id;
    private String login;
    private String mail;
    private String password;
    private String link_avatar;
    private String cookie_token;
    private boolean authorized;
    private String title;
    private boolean need_check;

    public int getId()              { return id; }
    public String get_login()       { return login; }
    public String get_mail()        { return mail; }
    public String get_password()    { return password; }
    public String get_link_avatar() { return link_avatar; }
    public boolean get_authorized() { return authorized; }
    public String get_cookie_token(){ return cookie_token; }
    public boolean get_need_check() { return need_check; }
    public String get_title()       { return title; }

    public void set_id(int id)                      { this.id = id; }
    public void set_login(String login)             { this.login = login; }
    public void set_mail(String mail)               { this.mail = mail; }
    public void set_password(String password)       { this.password = password; }
    public void set_link_avatar(String link_avatar) { this.link_avatar = link_avatar; }
    public void set_authorized(boolean authorized)  { this.authorized = authorized; }
    public void set_cookie_token(String cookie_token){ this.cookie_token = cookie_token; }
    public void set_need_check(boolean need_check)  { this.need_check = need_check; }
    public void set_title(String title)             { this.title = title; }

    public User() {}
    public User(String title, boolean need_check) {
        set_need_check(need_check);
        set_title(title);
    }

    // Создие пользователя
    public void user_create(String login, String mail, String password, String cookie_token) {

        sql.sql_update("INSERT INTO user (login, mail, password, cookie_token) VALUES('" +
            login + "', '" +
            mail + "', '" +
            password + "', '" +
            cookie_token +
        "');");
    }

    public User data_base(User user) {

        try {

            ResultSet result = sql.sql_callback("SELECT * FROM user WHERE cookie_token = '" + user.get_cookie_token() + "';");
            result.next();
            user.set_id(result.getInt("id"));
            user.set_login(result.getString("login"));
            user.set_mail(result.getString("mail"));
            user.set_password(result.getString("password"));
            user.set_link_avatar(result.getString("link_avatar"));
        }
        catch(Exception e) {}
        return user;
    }

}