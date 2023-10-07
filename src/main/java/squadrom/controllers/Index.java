package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import auxiliary.Manager_cookie;
import jakarta.servlet.http.Cookie;
import squadrom.models.User;

@Controller
@RequestMapping("/")
public class Index {

    @GetMapping("")
    public String get() {
        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🟢Squadrom", false));
        controller_main.get_data();
        controller_main.save_data();
        return "index";
    }

    @PostMapping("")
    public String post (
        @RequestParam(required = false, value = "login_email") String login_email,
        @RequestParam(required = false, value = "login_password") String login_password,

        @RequestParam(required = false, value = "register_login") String register_login,
        @RequestParam(required = false, value = "register_email") String register_email,
        @RequestParam(required = false, value = "register_password") String register_password) {

        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🔴Не верные данные", false));
        controller_main.user.set_cookie_token(new Manager_cookie().create(register_email, register_password));
        controller_main.get_data();
        String login_enter = "", register_enter = "";

        try {
            login_enter = controller_main.get_request().getParameter("login_enter");
            if(login_enter.equals("Войти")) {
                // Код для обработки нажатия кнопки login_enter
                if(login_email != "null" || login_password != "null") {
                    print.debag("[login_enter]");
                    print.debag("[НАЧИНАЮ АВТОРИЗАЦИЮ]");
                    // Авторизирую пользователя
                    if(new Manager_cookie().equals(controller_main)) {
                        print.debag("Я вошел в авторизацию");
                        controller_main.user.set_title("🟢Кабинет - Sqaudrom");
                        controller_main.save_data();
                        print.debag("ВСё пересылаю");
                        return "redirect:/cabinet#edit";
                    }
                }
            }
        }
        catch(Exception e) { print.error("[login_enter]"); }

        try {
            register_enter = controller_main.get_request().getParameter("register_enter");
            if(register_enter.equals("Зарегестрироваться")) {
                // Код для обработки нажатия кнопки register_enter
                if(register_login != "null" || register_email != "null" || register_password != "null") {
                    print.debag("[register_enter]");
                    print.debag("[НАЧИНАЮ РЕГИСТРАЦИЮ]");
                    // Регистрирую пользователя
                    String cookie = new Manager_cookie().create(register_email, register_password);

                    controller_main.get_response().addCookie(new Cookie(panel.cookie_name, cookie));
                    controller_main.user.user_create(register_login, register_email, register_password, cookie);
                    controller_main.user.set_title("🟢Кабинет - Sqaudrom");
                    controller_main.save_data();
                    return "redirect:/cabinet#edit";
                }
            }
        }
        catch(Exception e) { print.error("[register_enter]"); }

        print.debag("[НИ ОДНА КНОПКА]");
        controller_main.save_data();
        return "index";
    }

}