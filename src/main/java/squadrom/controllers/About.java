package squadrom.controllers;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import squadrom.models.User;

@Controller
@RequestMapping("/about")
public class About {

    @GetMapping
    public String get() {
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🟢О нас - Squadrom", false));
        main_controller.get_data();
        main_controller.save_data();
        return "about";
    }

}