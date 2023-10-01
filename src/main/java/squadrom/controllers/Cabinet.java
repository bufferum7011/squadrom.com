package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
@RequestMapping("/cabinet")
public class Cabinet {

    @GetMapping
    public String get() {
        user.need_check = true;
        new Main_controller("🟢Кабинет - Squadrom");
        if(!user.authorized) { return "index"; }
        else { return "cabinet#edit"; }
    }

    @GetMapping("#faforite")
    public String get_faforite() {
        print.debag("[Я в избранном]");
        user.need_check = true;
        new Main_controller("🟢Избранное - Squadrom");
        if(!user.authorized) { return "index"; }
        else { return "cabinet#faforite"; }
    }

}