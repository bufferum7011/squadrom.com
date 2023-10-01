package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.context.request.RequestContextHolder;
import org.springframework.web.context.request.ServletRequestAttributes;
import jakarta.servlet.http.Cookie;
import squadrom.beans.User;

@Controller
public class Main_controller {

    public Main_controller() { }
    public Main_controller(String title, boolean need_check) {

        request = ((ServletRequestAttributes) RequestContextHolder.currentRequestAttributes()).getRequest();
        user.title = title;
        // user.authorized = false;
        // user.cookie_token = null;
        // // уточняю авторизацию (взможно там не мой токен)
        // Cookie[] cookies = request.getCookies();
        // for(int i = 0; cookies != null && cookies.length > i && cookies[i].getName().equals(panel.cookie_name); i++) {
        //     user.cookie_token = cookies[i].getValue();
        //     user.authorized = true;
        // }

        // if(cookies != null) {
        //     for(int i = 0; cookies.length > i; i++) {
        //         if(cookies[i].getName().equals(panel.cookie_name)) {
        //             user.cookie_token = cookies[i].getValue();
        //             user.authorized = true;
        //         }
        //     }
        // }

        // if(need_check && !user.authorized) {
        //     // try {
        //     //     response.getWriter().println("<script>window.confirm('Вы ещё не зарегистрировались.');</script>");
        //     // } catch (IOException e) {
        //     //     e.printStackTrace();
        //     // }
        // }

        // if(user.cookie_token != null) {
        //     try { new User(user.cookie_token); }
        //     catch(Exception e) { print.error("[MainContr_User] - ERROR"); }
        // }
        // else { }

        request.setAttribute("user", user);
    }

    @GetMapping("/{unknown_1}")
    public String unknown_1(@PathVariable(value = "unknown_1") String unknown_1) {
        new Main_controller("🔴Такой страницы нет", false);
        return "index";
    }

    @GetMapping("/{unknown_1}/{unknown_2}")
    public String unknown_2(@PathVariable(value = "unknown_1") String unknown_1) {
        new Main_controller("🔴Такой страницы нет", false);
        return "index";
    }

    @GetMapping("/{unknown_1}/{unknown_2}/{unknown_3}")
    public String unknown_3(@PathVariable(value = "unknown_1") String unknown_1) {
        new Main_controller("🔴Такой страницы нет", false);
        return "index";
    }

}