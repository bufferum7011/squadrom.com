package squadrom.controllers;
import static squadrom.beans.Panel.*;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.CookieValue;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import squadrom.repositories.PostRepository;

@Controller
public class MainController {

    @Autowired private PostRepository post_repository;

    @GetMapping("/")
    public String index(@CookieValue("squadrom_token") String squadrom_token, HttpServletRequest request) {
        request.setAttribute("title", "Squadrom");

        Cookie cookie = new Cookie("squadrom_token", "Jovan");
        request.

        // request.setAttribute("posts", post_repository.findAll());
        return "index";
    }

    @GetMapping("/club")
    public String club(HttpServletRequest request) {
        request.setAttribute("title", "Клуб - Squadrom");
        return "club";
    }
    
    @GetMapping("/about")
    public String about(HttpServletRequest request) {
        request.setAttribute("title", "О нас - Squadrom");
        return "about";
    }

    @GetMapping("/cabinet")
    public String cabinet(HttpServletRequest request) {
        request.setAttribute("title", "Кабинет - Squadrom");
        return "cabinet";
    }

    @GetMapping("/cabinet#faforite")
    public String faforite(HttpServletRequest request) {
        request.setAttribute("title", "Избранное - Squadrom");
        return "cabinet#faforite";
    }

    @PostMapping("/add")
    public String add(
        // @RequestParam(required = false, defaultValue = "0") String mail,
        // @RequestParam(required = false, defaultValue = "NO_NAME") String password,
        @RequestParam int weight, HttpServletRequest request) {
            // Post post = new Post(mail, password, token);
            // post_repository.save(post);
            return "add";
    }

}