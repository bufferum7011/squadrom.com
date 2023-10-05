package squadrom.models;
import static squadrom.beans.Panel.*;
import java.sql.ResultSet;
import org.springframework.web.multipart.MultipartFile;
import auxiliary.Manager_file;

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


    public void set_authorized(boolean authorized)  { this.authorized = authorized; }
    public void set_need_check(boolean need_check)  { this.need_check = need_check; }
    public void set_title(String title)             { this.title = title; }

    public void set_id(int id) { this.id = id; }

    public void set_login(String login) {
        this.login = login;
        sql.sql_update("UPDATE user SET login = '" + login + "' WHERE id = " + id + ";");
    }
    public void set_mail(String mail) {
        this.mail = mail;
        sql.sql_update("UPDATE user SET mail = '" + mail + "' WHERE id = " + id + ";");
    }
    public void set_password(String password) {
        this.password = password;
        sql.sql_update("UPDATE user SET password = '" + password + "' WHERE id = " + id + ";");
    }
    public void set_link_avatar(String cookie_token, MultipartFile link_avatar) {
        String path_avatar = new Manager_file().upload_avatar(cookie_token, link_avatar);
        this.link_avatar = path_avatar;
        sql.sql_update("UPDATE user SET link_avatar = '" + path_avatar + "' WHERE id = " + id + ";");
    }
    public void set_link_avatar(String link_avatar) {
        this.link_avatar = link_avatar;
        sql.sql_update("UPDATE user SET link_avatar = '" + link_avatar + "' WHERE id = " + id + ";");
    }
    public void set_cookie_token(String cookie_token) {
        this.cookie_token = cookie_token;
        sql.sql_update("UPDATE user SET cookie_token = '" + cookie_token + "' WHERE id = " + id + ";");
    }


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

    public void delete_user() {
        sql.sql_update("DELETE FROM user WHERE id = " + id + ";");
    }

    public User data_base(User user) {
        try {
            ResultSet result = sql.sql_callback("SELECT * FROM user WHERE cookie_token = '" + user.get_cookie_token() + "';");
            result.next();
            user.id = result.getInt("id");
            user.login = result.getString("login");
            user.mail = result.getString("mail");
            user.password = result.getString("password");
            user.link_avatar = result.getString("link_avatar");
        }
        catch(Exception e) {}
        return user;
    }

    @Override
    public String toString() {
        return "[\n" +
                "id=" + id + "\n" +
                "login=" + login + "\n" +
                "mail=" + mail + "\n" +
                "password=" + password + "\n" +
                "link_avatar=" + link_avatar + "\n" +
                "cookie_token=" + cookie_token + "\n" +
                "authorized=" + authorized + "\n" +
                "title=" + title + "\n" +
                "need_check=" + need_check + "\n" +
                "]\n";
    }

}