package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import auxiliary.Manager_cookie;
import jakarta.servlet.http.Cookie;
import jakarta.servlet.http.HttpServletResponse;
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
        @Autowired HttpServletResponse response,
        @RequestParam(required = false, value = "login_email", defaultValue = "null") String login_email,
        @RequestParam(required = false, value = "login_password", defaultValue = "null") String login_password,
        @RequestParam(required = false, value = "login_enter", defaultValue = "null") String login_enter,

        @RequestParam(required = false, value = "register_login", defaultValue = "null") String register_login,
        @RequestParam(required = false, value = "register_mail", defaultValue = "null") String register_mail,
        @RequestParam(required = false, value = "register_password", defaultValue = "null") String register_password,
        @RequestParam(required = false, value = "register_enter", defaultValue = "null") String register_enter) {

        print.debag("[Index=POST]");
        Controller_main controller_main = new Controller_main();
        // controller_main.set_response(response);
        controller_main.set_user(new User("🔴Не верные данные", false));
        controller_main.get_data();

        // Код для обработки нажатия кнопки login_enter
        if(!login_enter.equals("null")) {

            print.debag("[login_enter != 'null']");
            if(register_login == "null" || register_mail == "null" || register_password == "null") {
                print.debag("[НИЧЕГО НЕ ВПИСАНО]");
                controller_main.save_data();
                return "index";
            }
            else {

                print.debag("[НАЧИНАЮ АВТОРИЗАЦИЮ]");
                // Авторизирую пользователя
                if(new Manager_cookie().equals(controller_main)) {
                    controller_main.user.set_title("🟢Кабинет - Sqaudrom");
                    controller_main.save_data();
                    return "redirect:/cabinet#edit";
                }
                else { controller_main.save_data(); return "index"; }
            }
        }

        // Код для обработки нажатия кнопки register_enter
        else if(!register_enter.equals("null")) {

            print.debag("[register_enter != 'null']");
            if(login_email == "null" || login_password == "null") {
                print.debag("[НИЧЕГО НЕ ВПИСАНО]");
                controller_main.save_data();
                return "index";
            }
            else {

                print.debag("[НАЧИНАЮ РЕГИСТРАЦИЮ]");
                // Регистрирую пользователя
                String cookie = new Manager_cookie().create(register_mail, register_password);

                controller_main.get_response().addCookie(new Cookie(panel.cookie_name, cookie));
                controller_main.user.user_create(register_login, register_mail, register_password, cookie);
                controller_main.user.set_title("🟢Кабинет - Sqaudrom");
                controller_main.save_data();
                return "redirect:/cabinet#edit";
            }
        }
        else { controller_main.save_data(); return "index"; }
    }

    // @GetMapping("/{unknown_1}")
    // public String unknown_1(@PathVariable(value = "unknown_1") String unknown_1) {
    //     controller_main controller_main = new controller_main();
    //     controller_main.set_user(new User("🔴Такой страницы нет", false));
    //     controller_main.set_data();
    //     return "index";
    // }

    // @GetMapping("/{unknown_1}/{unknown_2}")
    // public String unknown_2(@PathVariable(value = "unknown_1") String unknown_1) {
    //     controller_main controller_main = new controller_main();
    //     controller_main.set_user(new User("🔴Такой страницы нет", false));
    //     controller_main.set_data();
    //     return "index";
    // }

    // @GetMapping("/{unknown_1}/{unknown_2}/{unknown_3}")
    // public String unknown_3(@PathVariable(value = "unknown_1") String unknown_1) {
    //     controller_main controller_main = new controller_main();
    //     controller_main.set_user(new User("🔴Такой страницы нет", false));
    //     controller_main.set_data();
    //     return "index";
    // }

}