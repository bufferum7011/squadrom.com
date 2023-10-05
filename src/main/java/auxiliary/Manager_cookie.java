package auxiliary;
import static squadrom.beans.Panel.*;
import org.apache.commons.codec.digest.DigestUtils;
import squadrom.controllers.Main_controller;

public class Manager_cookie {

    public String create(String register_login, String register_mail, String register_password) {
        return DigestUtils.md5Hex(register_login + panel.cookie_salt + register_mail + register_password);
    }

    public boolean equals(Main_controller main_controller) {

        String login = main_controller.user.get_login();
        String mail = main_controller.user.get_mail();
        String password = main_controller.user.get_password();
        String cookie_token = main_controller.user.get_cookie_token();

        if(create(login, mail, password).equals(cookie_token)) { return true; }
        else { return false; }
    }

}