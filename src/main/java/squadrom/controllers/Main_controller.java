package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.apache.commons.codec.digest.DigestUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.context.request.RequestContextHolder;
import org.springframework.web.context.request.ServletRequestAttributes;
import org.springframework.web.servlet.ModelAndView;

import jakarta.servlet.http.Cookie;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import squadrom.beans.User;

@Controller
public class Main_controller {

    // request.setAttribute("posts", post_repository.findAll());
    // Post post = new Post(mail, password, token);
    // post_repository.save(post);

    // @Qualifier("request_2")
    // @Autowired private HttpServletRequest request = (HttpServletRequest) context.getBean("request_2");
    // @Autowired private HttpServletResponse response;

    public Main_controller() { }
    public Main_controller(String title) {

        request = ((ServletRequestAttributes) RequestContextHolder.currentRequestAttributes()).getRequest();
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
    public String index_get() {
        new Main_controller("Squadrom");
        return "index";
    }
    @PostMapping("/")
    public ModelAndView index_post(
            HttpServletResponse response,
            @RequestParam(required = true, defaultValue = "NONE_register_login") String register_login,
            @RequestParam(required = true, defaultValue = "NONE_register_mail") String register_mail,
            @RequestParam(required = true, defaultValue = "NONE_register_password") String register_password) {

        if(register_login == "NONE" || register_mail == "NONE" || register_password == "NONE") {
            new Main_controller("Не верные данные");
            return new ModelAndView("redirect:/");
        }
        else {
            // Авторизуем пользователя
            user.user_cookie_token = DigestUtils.md5Hex(register_login + panel.cookie_salt + register_mail + register_password);
            response.addCookie(new Cookie(panel.cookie_name, user.user_cookie_token));
            user.create_user(register_login, register_mail, register_password, user.user_cookie_token);
            new Main_controller("Кабинет - Squadrom");
            return new ModelAndView("redirect:/cabinet#cabinet_edit");
        }
    }

    @GetMapping("/club")
    public String club_get() {
        new Main_controller("Клуб - Squadrom");
        return "club";
    }

    @GetMapping("/about")
    public String about_get() {
        new Main_controller("О нас - Squadrom");
        return "about";
    }

    @GetMapping("/cabinet")
    public String cabinet_get() {
        new Main_controller("Кабинет - Squadrom");
        return "cabinet";
    }
    @GetMapping("/cabinet#faforite")
    public String faforite_get() {
        new Main_controller("Избранное - Squadrom");
        return "cabinet#faforite";
    }

    @GetMapping("/{unknown}")
    public String unknown(@PathVariable(value = "unknown") String unknown) {
        new Main_controller("Такой страницы нет");
        return "index";
    }

}