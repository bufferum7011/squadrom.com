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
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🟢Squadrom", false));
        main_controller.get_data();
        main_controller.save_data();
        return "index";
    }

    @PostMapping("/register")
    public String post_register (
        @Autowired HttpServletResponse response,
        @RequestParam(required = true, defaultValue = "null") String register_login,
        @RequestParam(required = true, defaultValue = "null") String register_mail,
        @RequestParam(required = true, defaultValue = "null") String register_password) {

        Main_controller main_controller = new Main_controller();
        main_controller.set_response(response);
        main_controller.set_user(new User("🔴Не верные данные", false));
        main_controller.get_data();

        if(register_login == "null" || register_mail == "null" || register_password == "null") {
            main_controller.save_data();
            return "index";
        }
        else {

            // Авторизуем пользователя
            String cookie = new Manager_cookie().create(register_login, register_mail, register_password);

            main_controller.get_response().addCookie(new Cookie(panel.cookie_name, cookie));
            main_controller.user.user_create(register_login, register_mail, register_password, cookie);
            main_controller.user.set_title("🟢Кабинет - Sqaudrom");
            main_controller.save_data();
            return "redirect:/cabinet#edit";
        }
    }

    @PostMapping("/login")
    public String post_login (
        @Autowired HttpServletResponse response,
        @RequestParam(required = true, value = "login_email", defaultValue = "null") String login_email,
        @RequestParam(required = true, value = "login_password", defaultValue = "null") String login_password) {

        Main_controller main_controller = new Main_controller();
        main_controller.set_response(response);
        main_controller.set_user(new User("🔴Не верные данные", false));
        main_controller.get_data();

        if(login_email == "null" || login_password == "null") {
            main_controller.save_data();
            return "redirect:/index";
        }
        else {

            // Авторизуем пользователя
            if(new Manager_cookie().equals(main_controller)) {
                main_controller.user.set_title("🟢Кабинет - Sqaudrom");
                main_controller.save_data();
                return "redirect:/cabinet#edit";
            }
            else { return "redirect:/index"; }
        }
    }

    // @GetMapping("/{unknown_1}")
    // public String unknown_1(@PathVariable(value = "unknown_1") String unknown_1) {
    //     Main_controller main_controller = new Main_controller();
    //     main_controller.set_user(new User("🔴Такой страницы нет", false));
    //     main_controller.set_data();
    //     return "index";
    // }

    // @GetMapping("/{unknown_1}/{unknown_2}")
    // public String unknown_2(@PathVariable(value = "unknown_1") String unknown_1) {
    //     Main_controller main_controller = new Main_controller();
    //     main_controller.set_user(new User("🔴Такой страницы нет", false));
    //     main_controller.set_data();
    //     return "index";
    // }

    // @GetMapping("/{unknown_1}/{unknown_2}/{unknown_3}")
    // public String unknown_3(@PathVariable(value = "unknown_1") String unknown_1) {
    //     Main_controller main_controller = new Main_controller();
    //     main_controller.set_user(new User("🔴Такой страницы нет", false));
    //     main_controller.set_data();
    //     return "index";
    // }

}