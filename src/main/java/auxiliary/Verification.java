package auxiliary;
import static squadrom.beans.Panel.*;
import org.apache.commons.codec.digest.DigestUtils;
import jakarta.servlet.http.Cookie;
import squadrom.controllers.Controller_main;

public class Verification {

    private String cookie;
    public void set_cookie(String cookie) { this.cookie = cookie; }
    public String get_cookie() { return cookie; }

    public void add_cookie(Controller_main controller_main, String email, String password) {
        set_cookie(create_cookie(email, password));
        controller_main.user.set_cookie_token(get_cookie());
        controller_main.get_response().addCookie(new Cookie(panel.cookie_name, get_cookie()));
    }
    public void remove_cookie(Controller_main controller_main) {
        Cookie cookie = new Cookie(panel.cookie_name, null);
        cookie.setMaxAge(0);
        cookie.setPath("/");

        controller_main.get_response().addCookie(cookie);
    }

    public String create_cookie(String register_email, String register_password) {
        return DigestUtils.md5Hex(register_email + panel.cookie_salt + register_password);
    }

    public boolean check_authorization(Controller_main controller_main) {

        String email        = controller_main.user.get_email();
        String password     = controller_main.user.get_password();
        String cookie_token = controller_main.user.get_cookie_token();

        if(create_cookie(email, password).equals(cookie_token)) { return true; }
        else { return false; }
    }

}