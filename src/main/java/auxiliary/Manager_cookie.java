package auxiliary;
import static squadrom.beans.Panel.*;
import org.apache.commons.codec.digest.DigestUtils;
import squadrom.controllers.Controller_main;

public class Manager_cookie {

    public String create(String register_mail, String register_password) {
        return DigestUtils.md5Hex(register_mail + panel.cookie_salt + register_password);
    }

    public boolean equals(Controller_main controller_main) {

        String mail         = controller_main.user.get_mail();
        String password     = controller_main.user.get_password();
        String cookie_token = controller_main.user.get_cookie_token();

        if(create(mail, password).equals(cookie_token)) { return true; }
        else { return false; }
    }

}