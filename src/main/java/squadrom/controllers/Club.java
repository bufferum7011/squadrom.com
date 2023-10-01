package squadrom.controllers;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
@RequestMapping("/club")
public class Club {

    @GetMapping
    public String get() {
        new Main_controller("🟢Клуб - Squadrom");
        return "club";
    }

}