package squadrom.controllers;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import squadrom.models.User;

@Controller
@RequestMapping("/cabinet")
public class Cabinet {

    @GetMapping
    public String get() {
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🟢Кабинет - Squadrom", true));
        main_controller.set_data();
        if(!main_controller.user.get_authorized()) { return "index"; }
        else { return "cabinet#edit"; }
    }

    @GetMapping("#edit")
    public String get_edit() {
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🟢Кабинет - Squadrom", true));
        main_controller.set_data();
        if(!main_controller.user.get_authorized()) { return "index"; }
        else { return "cabinet#edit"; }
    }

    @GetMapping("#faforite")
    public String get_faforite() {
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🟢Избранное - Squadrom", true));
        main_controller.set_data();
        if(!main_controller.user.get_authorized()) { return "index"; }
        else { return "cabinet#edit"; }
    }

}