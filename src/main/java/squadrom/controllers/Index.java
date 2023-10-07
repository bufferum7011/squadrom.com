package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import auxiliary.Verification;
import squadrom.models.User;

@Controller
@RequestMapping("/")
public class Index {

    @GetMapping("")
    public String get() {
        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🟢Squadrom", false));
        controller_main.get_data();
        controller_main.save();
        return "index";
    }

    @PostMapping("")
    public String post (
        @RequestParam(required = false, value = "login_email") String login_email,
        @RequestParam(required = false, value = "login_password") String login_password,

        @RequestParam(required = false, value = "register_login") String register_login,
        @RequestParam(required = false, value = "register_email") String register_email,
        @RequestParam(required = false, value = "register_password") String register_password) {

        Verification verification = new Verification();
        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🔴Не верные данные", false));
        controller_main.get_data();

        // Обработка login_enter и авторизация пользователя
        try {
            String login_enter = controller_main.get_request().getParameter("login_enter");
            boolean key = login_email != "null" || login_password != "null";
            if(login_enter.equals("Войти") && key) {
                verification.add_cookie(controller_main, login_email, login_password);
                controller_main.user.set_mail(login_email);
                controller_main.user.set_password(login_password);
                if(verification.check_authorization(controller_main)) {
                    print.result("[login]");
                    controller_main.user.set_title("🟢Кабинет - Sqaudrom");
                    controller_main.save();
                    return "redirect:/cabinet#edit";
                }
            }
        }
        catch(Exception e) { print.error("[login_enter]"); }

        // Обработка register_enter и регистрация пользователя
        try {
            String register_enter = controller_main.get_request().getParameter("register_enter");
            boolean key = register_login != "null" || register_email != "null" || register_password != "null";
            if(register_enter.equals("Зарегестрироваться") && key) {

                print.result("[register]");
                verification.add_cookie(controller_main, register_email, register_password);
                controller_main.user.user_create(register_login, register_email, register_password, verification.get_cookie());
                controller_main.user.set_title("🟢Кабинет - Sqaudrom");
                controller_main.save();
                return "redirect:/cabinet#edit";
            }
        }
        catch(Exception e) { print.error("[register_enter]"); }

        print.error("[НИ ОДНА КНОПКА]");
        verification.remove_cookie(controller_main);
        controller_main.save();
        return "index";
    }

}