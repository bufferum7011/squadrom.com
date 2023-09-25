package squadrom.controllers;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
// import squadrom.models.Post;
import squadrom.repositories.PostRepository;

@Controller
public class MainController {

    @Autowired private PostRepository post_repository;

    @GetMapping("/")
    public String index(Model model) {
        model.addAttribute("title", "Squadrom");
        // model.addAttribute("posts", post_repository.findAll());
        return "index";
    }

    @GetMapping("/club")
    public String club(Model model) {
        model.addAttribute("title", "Клуб - Squadrom");
        return "club";
    }
    
    @GetMapping("/about")
    public String about(Model model) {
        model.addAttribute("title", "О нас - Squadrom");
        return "about";
    }

    @GetMapping("/cabinet")
    public String cabinet(Model model) {
        model.addAttribute("title", "Кабинет - Squadrom");
        return "cabinet";
    }

    @GetMapping("/cabinet#faforite")
    public String faforite(Model model) {
        model.addAttribute("title", "Избранное - Squadrom");
        return "cabinet#faforite";
    }

    @PostMapping("/add")
    public String add(
        // @RequestParam(required = false, defaultValue = "0") String mail,
        // @RequestParam(required = false, defaultValue = "NO_NAME") String password,
        @RequestParam int weight, Model model) {
            // Post post = new Post(mail, password, token);
            // post_repository.save(post);
            return "add";
    }

}