package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
@RequestMapping("/cabinet")
public class Cabinet {

    // @GetMapping
    // public String get() {
    //     print.debag("[10]");

    //     new Main_controller("🟢Кабинет - Squadrom", true);
    //     if(!user.authorized) { return "index"; }
    //     else { return "cabinet#edit"; }
    // }

    @GetMapping("#edit")
    public String get_edit() {
        print.debag("[8]");
        new Main_controller("🟢Кабинет - Squadrom", true);
        if(!user.authorized) { return "index"; }
        else { return "cabinet#edit"; }
    }

    @GetMapping("#faforite")
    public String get_faforite() {
        print.debag("[9]");
        new Main_controller("🟢Избранное - Squadrom", true);
        if(!user.authorized) { return "index"; }
        else { return "cabinet#faforite"; }
    }

}