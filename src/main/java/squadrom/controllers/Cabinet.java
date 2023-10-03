package squadrom.controllers;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import jakarta.servlet.http.HttpServletResponse;
import squadrom.models.User;

@Controller
@RequestMapping("/cabinet")
public class Cabinet {

    @GetMapping("")
    public String get() {
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🟢Кабинет - Squadrom", true));
        main_controller.set_data();
        if(!main_controller.user.get_authorized()) { return "index"; }
        else { return "cabinet"; }
    }

    @PostMapping("")
    public String post(
        @Autowired HttpServletResponse response,
        @RequestParam(required = true, defaultValue = "NULL") String reset_login,
        @RequestParam(required = true, defaultValue = "NULL") String reset_email,
        @RequestParam(required = true, defaultValue = "NULL") String reset_avatar,
        @RequestParam(required = true, defaultValue = "NULL") String reset_password) {

        Main_controller main_controller = new Main_controller();
        main_controller.set_response(response);

        if(reset_login == "NULL" || reset_email == "NULL" || reset_avatar == "NULL" || reset_password == "NULL") {
            main_controller.set_user(new User("🔴Не верные данные", false));
            main_controller.set_data();
            return "redirect:/cabinet";
        }
        else {

            if(reset_login != "NULL") {
                main_controller.user.set_login(reset_login);
            }
            if(reset_email != "NULL") {
                main_controller.user.set_mail(reset_email);
            }
            if(reset_avatar != "NULL") {
                main_controller.user.set_link_avatar(reset_avatar);
            }
            if(reset_password != "NULL") {
                main_controller.user.set_password(reset_password);
            }

            main_controller.set_user(new User("🟢Кабинет - Squadrom", false));
            main_controller.set_data();

            return "redirect:/cabinet";
        }
    }

}