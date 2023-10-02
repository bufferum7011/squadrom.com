package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.apache.commons.codec.digest.DigestUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import jakarta.servlet.http.Cookie;
import jakarta.servlet.http.HttpServletResponse;
import squadrom.models.User;

@Controller
@RequestMapping("/")
public class Index {

    @GetMapping
    public String get() {
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🟢Squadrom", false));
        main_controller.set_data();
        return "index";
    }

    @PostMapping
    public String post(
        @Autowired HttpServletResponse response,
        @RequestParam(required = true, defaultValue = "NONE") String register_login,
        @RequestParam(required = true, defaultValue = "NONE") String register_mail,
        @RequestParam(required = true, defaultValue = "NONE") String register_password) {

        Main_controller main_controller = new Main_controller();
        main_controller.set_response(response);
        
        if(register_login == "NONE" || register_mail == "NONE" || register_password == "NONE") {
            main_controller.set_user(new User("🔴Не верные данные", false));
            main_controller.set_data();
            return "redirect:/";
        }
        else {

            // Авторизуем пользователя
            String cookie = DigestUtils.md5Hex(register_login + panel.cookie_salt + register_mail + register_password);

            main_controller.get_response().addCookie(new Cookie(panel.cookie_name, cookie));
            main_controller.set_user(new User("🟢Кабинет - Squadrom", false));
            main_controller.user.user_create(register_login, register_mail, register_password, cookie);
            main_controller.set_data();
            return "redirect:/cabinet#edit";
        }
    }

    @GetMapping("/{unknown_1}")
    public String unknown_1(@PathVariable(value = "unknown_1") String unknown_1) {
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🔴Такой страницы нет", false));
        main_controller.set_data();
        return "index";
    }

    @GetMapping("/{unknown_1}/{unknown_2}")
    public String unknown_2(@PathVariable(value = "unknown_1") String unknown_1) {
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🔴Такой страницы нет", false));
        main_controller.set_data();
        return "index";
    }

    @GetMapping("/{unknown_1}/{unknown_2}/{unknown_3}")
    public String unknown_3(@PathVariable(value = "unknown_1") String unknown_1) {
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🔴Такой страницы нет", false));
        main_controller.set_data();
        return "index";
    }

}