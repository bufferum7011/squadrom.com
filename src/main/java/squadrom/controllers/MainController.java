package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.apache.commons.codec.digest.DigestUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import jakarta.servlet.http.Cookie;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import squadrom.repositories.PostRepository;

@Controller
public class MainController {

    @Autowired public static PostRepository post_repository;
    @Autowired public static HttpServletRequest request;
    @Autowired public static HttpServletResponse response;
    private static String login;
    private static String password;
    private static String mail;
    private static boolean key_pass;
    private static String cookie_value;

    private MainController() {
        login = null;
        password = null;
        mail = null;
        key_pass = false;
        cookie_value = null;

        Cookie[] cookies = request.getCookies();
        if(cookies != null) {
            for(Cookie cookie : cookies) {

                // Человек уже пользователя
                if(cookie.getName().equals(panel.cookie_name)) {
                    key_pass = true;
                    cookie_value = cookie.getValue();
                    
                }
            }
        }
        else {

            // Авторизуем пользователя
            cookie_value = DigestUtils.md5Hex(login + panel.cookie_salt + password + mail);
            response.addCookie(new Cookie(panel.cookie_name, cookie_value));
        }
    }

    // request.setAttribute("posts", post_repository.findAll());
    
    // Post post = new Post(mail, password, token);
    // post_repository.save(post);

    // @RequestParam(required = false, defaultValue = "0") String mail,
    // @RequestParam(required = false, defaultValue = "NO_NAME") String password,

    @GetMapping("/")
    public String index_get() {
        new MainController();
        request.setAttribute("title", "Squadrom");
        return "index";
    }
    @PostMapping("/")
    public String index_post() {
        new MainController();
        request.setAttribute("title", "Squadrom");
        return "index";
    }

    @GetMapping("/club")
    public String club_get() {
        // get_cookie(request, response);
        request.setAttribute("title", "Клуб - Squadrom");
        return "club";
    }

    @GetMapping("/about")
    public String about_get() {
        // get_cookie(request, response);
        request.setAttribute("title", "О нас - Squadrom");
        return "about";
    }

    @GetMapping("/cabinet")
    public String cabinet_get() {
        // get_cookie(request, response);
        request.setAttribute("title", "Кабинет - Squadrom");
        return "cabinet";
    }

    @GetMapping("/cabinet#faforite")
    public String faforite_get() {
        // get_cookie(request, response);
        request.setAttribute("title", "Избранное - Squadrom");
        return "cabinet#faforite";
    }

}