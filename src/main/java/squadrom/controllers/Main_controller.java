package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import jakarta.servlet.http.Cookie;
import jakarta.servlet.http.HttpServletRequest;
import squadrom.beans.User;

@Controller
public class Main_controller {


    // request.setAttribute("posts", post_repository.findAll());

    // Post post = new Post(mail, password, token);
    // post_repository.save(post);

    // @RequestParam(required = false, defaultValue = "0") String mail,
    // @RequestParam(required = false, defaultValue = "NO_NAME") String password,

    // Принудительная авторизация пользователя
    // Авторизуем пользователя
    // user.user_cookie = DigestUtils.md5Hex(user.user_mail + panel.cookie_salt + user.user_login + user.user_password);
    // response.addCookie(new Cookie(panel.cookie_name, user.user_cookie));
    // print.debag("[СОЗДАЛ]");

    // @Autowired HttpServletRequest request, @Autowired HttpServletResponse response




    public Main_controller() { }
    public Main_controller(String title, HttpServletRequest request) {

        user.title = title;
        user.key_pass = false;

        // уточняю авторизацию (взможно там не мой токен)
        Cookie[] cookies = request.getCookies();
        for(int i = 0; cookies != null && cookies[i].getName().equals(panel.cookie_name); i++) {
            user.user_cookie_token = cookies[i].getValue();
            user.key_pass = true;
        }

        new User();
        request.setAttribute("user", user);
    }


    @GetMapping("/")
    public String index_get(@Autowired HttpServletRequest request) {
        new Main_controller("Squadrom", request);
        return "index";
    }
    @PostMapping("/")
    public String index_post() {
        return "index";
    }

    @GetMapping("/club")
    public String club_get(@Autowired HttpServletRequest request) {
        new Main_controller("Клуб - Squadrom", request);
        return "club";
    }

    @GetMapping("/about")
    public String about_get(@Autowired HttpServletRequest request) {
        new Main_controller("О нас - Squadrom", request);
        return "about";
    }

    @GetMapping("/cabinet")
    public String cabinet_get(@Autowired HttpServletRequest request) {
        new Main_controller("Кабинет - Squadrom", request);
        return "cabinet";
    }

    @GetMapping("/cabinet#faforite")
    public String faforite_get(@Autowired HttpServletRequest request) {
        new Main_controller("Избранное - Squadrom", request);
        return "cabinet#faforite";
    }

}