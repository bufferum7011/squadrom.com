package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.apache.commons.codec.digest.DigestUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import jakarta.servlet.http.Cookie;
import jakarta.servlet.http.HttpServletResponse;

@Controller
@RequestMapping("/")
public class Index {

    @GetMapping
    public String get() {
        // user.title = "Squadrom";
        print.debag("[GET_INDEX]");
        new Main_controller("🟢Squadrom", false);
        return "index";
    }

    @PostMapping
    public String post(
        @Autowired HttpServletResponse response,
        @RequestParam(required = true, defaultValue = "NONE") String register_login,
        @RequestParam(required = true, defaultValue = "NONE") String register_mail,
        @RequestParam(required = true, defaultValue = "NONE") String register_password) {

        print.debag("Я тут");
        if(register_login == "NONE" || register_mail == "NONE" || register_password == "NONE") {
            print.debag("[1]");
            new Main_controller("🔴Не верные данные", false);
            return "redirect:/";
        }
        else {

            print.debag("[2]");
            // Авторизуем пользователя
            user.cookie_token = DigestUtils.md5Hex(register_login + panel.cookie_salt + register_mail + register_password);
            response.addCookie(new Cookie(panel.cookie_name, user.cookie_token));
            user.user_create(register_login, register_mail, register_password, user.cookie_token);
            new Main_controller("🟢Кабинет - Squadrom", false);
            return "redirect:/cabinet#edit";
        }
    }

}