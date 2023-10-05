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
        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🟢О нас - Squadrom", false));
        controller_main.get_data();
        controller_main.save_data();
        return "about";
    }

}