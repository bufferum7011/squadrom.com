package squadrom.controllers;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
@RequestMapping("/about")
public class About {

    @GetMapping
    public String get() {
        new Main_controller("🟢О нас - Squadrom");
        return "about";
    }

}