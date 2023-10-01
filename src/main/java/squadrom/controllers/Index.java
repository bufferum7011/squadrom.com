package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.apache.commons.codec.digest.DigestUtils;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.ModelAndView;

@Controller
@RequestMapping("/")
public class Index {

    @GetMapping
    public String get() {
        new Main_controller("🟢Squadrom");
        return "index";
    }

    @PostMapping
    public ModelAndView post(
        // @Autowired HttpServletResponse response,
        @RequestParam(required = true, defaultValue = "NONE_register_login") String register_login,
        @RequestParam(required = true, defaultValue = "NONE_register_mail") String register_mail,
        @RequestParam(required = true, defaultValue = "NONE_register_password") String register_password) {

        if(register_login == "NONE" || register_mail == "NONE" || register_password == "NONE") {
            new Main_controller("🔴Не верные данные");
            return new ModelAndView("redirect:/");
        }
        else {

            // Авторизуем пользователя
            user.cookie_token = DigestUtils.md5Hex(register_login + panel.cookie_salt + register_mail + register_password);
            // response.addCookie(new Cookie(panel.cookie_name, user.cookie_token));
            user.user_create(register_login, register_mail, register_password, user.cookie_token);
            new Main_controller("🟢Кабинет - Squadrom");
            return new ModelAndView("redirect:/cabinet#edit");
        }
    }

}