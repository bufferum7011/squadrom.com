package squadrom.controllers;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import squadrom.models.User;

@Controller
@RequestMapping("/club")
public class Club {

    @GetMapping
    public String get() {
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🟢Клуб - Squadrom", false));
        main_controller.set_data();
        return "club";
    }

}